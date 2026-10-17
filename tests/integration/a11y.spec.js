import { readFileSync } from 'node:fs';
import { join } from 'node:path';
import { expect, test } from '@playwright/test';

// Guards for the accessibility pass on the Glaz template (one h1, landmarks, menu state, focus, contrast, motion).
const pages = readFileSync(join(__dirname, '..', 'expected-pages.txt'), 'utf8')
	.split('\n')
	.map((line) => line.trim())
	.filter(Boolean)
	.map((p) => (p === 'index.html' ? '/' : `/${p}`));

test.beforeEach(async ({ page }) => {
	await page.route(/googletagmanager\.com|google-analytics\.com/, (route) => route.abort());
});

test('every page has exactly one h1 and a main landmark', async ({ page }) => {
	for (const path of pages) {
		await page.goto(path);
		await expect(page.locator('h1'), path).toHaveCount(1);
		await expect(page.locator('main#main'), path).toHaveCount(1);
	}
});

test('the skip link is the first tab stop and jumps to main', async ({ page }) => {
	await page.goto('/');
	await page.keyboard.press('Tab');
	const skip = page.getByRole('link', { name: 'Skip to content' });
	await expect(skip).toBeFocused();
	await expect(skip).toBeInViewport();
	await page.keyboard.press('Enter');
	await expect(page).toHaveURL(/#main$/);
	await expect(page.locator('main#main')).toBeFocused();
});

test.describe('phone width', () => {
	test.use({ viewport: { width: 375, height: 740 } });

	test('the hamburger reports and toggles its expanded state', async ({ page }) => {
		await page.goto('/');
		const hamburger = page.locator('#hamburger');
		const menu = page.locator('#nav-menu');
		await expect(hamburger).toHaveAttribute('aria-expanded', 'false');
		await expect(menu).toBeHidden();

		await hamburger.click();
		await expect(hamburger).toHaveAttribute('aria-expanded', 'true');
		await expect(menu).toBeVisible();

		await page.keyboard.press('Escape');
		await expect(hamburger).toHaveAttribute('aria-expanded', 'false');
		await expect(menu).toBeHidden();
		await expect(hamburger).toBeFocused();

		await hamburger.click();
		await page.mouse.click(5, 700); // a click outside the sheet closes it
		await expect(hamburger).toHaveAttribute('aria-expanded', 'false');
	});
});

test('contact inputs show a focus ring', async ({ page }) => {
	await page.goto('/');
	for (const id of ['#name', '#email', '#subject', '#message']) {
		await page.locator(id).focus();
		const outline = await page.locator(id).evaluate((el) => {
			const s = getComputedStyle(el);
			return { style: s.outlineStyle, width: s.outlineWidth, color: s.outlineColor };
		});
		expect(outline.style, id).toBe('solid');
		expect(outline.width, id).toBe('2px');
		expect(outline.color, id).not.toMatch(/rgba\(0, 0, 0, 0\)|transparent/);
	}
});

for (const [theme, color] of [
	['light', 'rgb(255, 255, 255)'],
	['dark', 'rgb(24, 24, 27)'],
]) {
	test(`gradient pills and buttons use the ${theme} on-gradient colour`, async ({ page }) => {
		await page.addInitScript((t) => localStorage.setItem('theme', t), theme);
		await page.goto('/');
		const colours = await page
			.locator('[data-project] .gradient, .button')
			.evaluateAll((els) => [...new Set(els.map((el) => getComputedStyle(el).color))]);
		expect(colours).toEqual([color]);
	});
}

test('trusted-by logos are named external links', async ({ page }) => {
	await page.goto('/');
	const links = page.locator('section').filter({ has: page.getByRole('heading', { name: 'Trusted by' }) }).locator('a');
	await expect(links).toHaveCount(3);
	for (const name of ['DiDCentral logo', 'Shyfter', 'Upwork']) {
		const link = links.and(page.getByRole('link', { name }));
		await expect(link, name).toHaveAttribute('target', '_blank');
		await expect(link, name).toHaveAttribute('rel', 'noopener noreferrer');
	}
});

test.describe('reduced motion', () => {
	test.use({ reducedMotion: 'reduce' });

	test('skill and tool icons do not spin on hover', async ({ page }) => {
		await page.goto('/');
		const card = page.locator('#about .group').filter({ has: page.getByText('Laravel', { exact: true }) });
		await card.hover();
		await expect(card.locator('svg').first()).toHaveCSS('transform', 'none');
		const skill = page.locator('#about .group').filter({ hasText: 'Database design' });
		await skill.hover();
		await expect(skill.locator('.gradient')).toHaveCSS('transform', 'none');
	});
});

test('closing the lightbox returns focus to the thumbnail', async ({ page }) => {
	await page.goto('/');
	const thumb = page.locator('.zoom-gallery a').first();
	await thumb.click();
	await expect(page.locator('#lightbox')).toBeVisible();
	await page.keyboard.press('Escape');
	await expect(page.locator('#lightbox')).toBeHidden();
	await expect(thumb).toBeFocused();
});
