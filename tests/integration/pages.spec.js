import { readFileSync } from 'node:fs';
import { join } from 'node:path';
import { expect, test } from '@playwright/test';

// Playwright transpiles specs to CommonJS (no "type": "module" here), hence __dirname.
// Every page in tests/expected-pages.txt must keep working at its exact URL,
// load all of its same-origin assets, and share the global header.
const pages = readFileSync(join(__dirname, '..', 'expected-pages.txt'), 'utf8')
	.split('\n')
	.map((line) => line.trim())
	.filter(Boolean)
	.map((p) => (p === 'index.html' ? '/' : `/${p}`));

test.beforeEach(async ({ page }) => {
	await page.route(/googletagmanager\.com|google-analytics\.com/, (route) => route.abort());
});

for (const path of pages) {
	test(`${path} renders with all assets`, async ({ page, baseURL }) => {
		const origin = new URL(baseURL).origin;
		const failed = [];
		page.on('response', (res) => {
			if (res.status() >= 400 && res.url().startsWith(origin)) failed.push(`${res.status()} ${res.url()}`);
		});

		const response = await page.goto(path);
		expect(response.status()).toBe(200);
		await page.waitForLoadState('networkidle');

		expect(failed, 'same-origin requests that failed').toEqual([]);
		await expect(page.locator('h1').first()).toBeVisible();
		await expect(page.locator('header nav a', { hasText: 'ABOUT' })).toHaveAttribute('href', '/#about');
		await expect(page.locator('#theme-toggle')).toBeVisible();

		// The header social icons are Liquid output; a stray brace renders them as "}}" (regression on 0eb6eb6).
		const socials = await page.locator('header a.glass-icon').evaluateAll((links) => links.map((a) => a.getAttribute('href')));
		expect(socials, 'header social links').toHaveLength(3);
		for (const href of socials) expect(href).toMatch(/^https:\/\/(github\.com|www\.upwork\.com|stackoverflow\.com)\//);
	});
}

test('stylesheet and scripts are served', async ({ request }) => {
	for (const asset of ['/css/style.css', '/js/app.js', '/js/theme.js', '/img/decor-1.webp', '/cv.pdf']) {
		const res = await request.get(asset);
		expect(res.ok(), asset).toBe(true);
	}
});

// The glass is translucent, so the mobile menu sheet must stay readable over the worst backdrop
// for each theme (white under dark glass, black under light glass), e.g. a white post thumbnail.
for (const [theme, backdrop] of [['dark', '#fff'], ['light', '#000']]) {
	test(`mobile menu text keeps AA contrast in ${theme} theme over a ${backdrop} backdrop`, async ({ page }) => {
		await page.setViewportSize({ width: 390, height: 700 });
		await page.addInitScript((t) => localStorage.setItem('theme', t), theme);
		await page.goto('/');
		await page.evaluate((bg) => {
			const cover = document.createElement('div');
			cover.style.cssText = `position:fixed;inset:0;z-index:10;background:${bg}`;
			document.body.appendChild(cover);
		}, backdrop);
		await page.click('#hamburger');
		const nav = page.locator('#nav-menu');
		await expect(nav).toBeVisible();

		const text = await nav.locator('a').first().evaluate((a) => getComputedStyle(a).color);
		// Measure the glass alone: hide the labels (visibility, not color: links transition color), screenshot, decode the pixels.
		await nav.evaluate((n) => n.querySelectorAll('a').forEach((a) => (a.style.visibility = 'hidden')));
		const box = await nav.boundingBox();
		const inset = 12; // skip the rim highlight and rounded corners
		const png = await page.screenshot({
			clip: { x: box.x + inset, y: box.y + inset, width: box.width - 2 * inset, height: box.height - 2 * inset },
		});
		const lums = await page.evaluate(async (b64) => {
			const img = new Image();
			img.src = `data:image/png;base64,${b64}`;
			await img.decode();
			const c = document.createElement('canvas');
			c.width = img.width;
			c.height = img.height;
			const ctx = c.getContext('2d');
			ctx.drawImage(img, 0, 0);
			const d = ctx.getImageData(0, 0, c.width, c.height).data;
			const lin = (v) => ((v /= 255) <= 0.03928 ? v / 12.92 : ((v + 0.055) / 1.055) ** 2.4);
			const out = [];
			for (let i = 0; i < d.length; i += 4) out.push(0.2126 * lin(d[i]) + 0.7152 * lin(d[i + 1]) + 0.0722 * lin(d[i + 2]));
			return out.sort((a, b) => a - b);
		}, png.toString('base64'));
		const [r, g, b] = text.match(/\d+(\.\d+)?/g).map(Number);
		const lin = (v) => ((v /= 255) <= 0.03928 ? v / 12.92 : ((v + 0.055) / 1.055) ** 2.4);
		const textLum = 0.2126 * lin(r) + 0.7152 * lin(g) + 0.0722 * lin(b);
		// Worst glass pixel: the brightest under light text, the darkest under dark text.
		const glassLum = theme === 'dark' ? lums[lums.length - 1] : lums[0];
		const ratio = (Math.max(textLum, glassLum) + 0.05) / (Math.min(textLum, glassLum) + 0.05);
		expect(ratio, `${theme} menu text ${text} on glass`).toBeGreaterThanOrEqual(4.5);
	});
}
