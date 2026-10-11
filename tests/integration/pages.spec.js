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
