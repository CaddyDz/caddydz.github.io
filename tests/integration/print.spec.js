import { expect, test } from '@playwright/test';

const post = '/github/2023/01/18/github-pr-auto-request-review.html';

test.beforeEach(async ({ page }) => {
	await page.route(/googletagmanager\.com|google-analytics\.com/, (route) => route.abort());
});

test('a post prints as dark-on-white content without the site chrome, even in the dark theme', async ({ page }) => {
	await page.addInitScript(() => localStorage.setItem('theme', 'dark'));
	await page.goto(post);
	await page.emulateMedia({ media: 'print' });

	await expect(page.locator('header')).toBeHidden();
	await expect(page.locator('#blog')).toBeHidden();
	await expect(page.locator('#contact')).toBeHidden();
	await expect(page.locator('article > a[href="/#blog"]')).toBeHidden();

	await expect(page.locator('article h1')).toBeVisible();
	await expect(page.locator('article h1')).toHaveCSS('color', 'rgb(24, 24, 27)');
	await expect(page.locator('article .prose p').first()).toHaveCSS('color', 'rgb(63, 63, 70)');
	await expect(page.locator('body')).toHaveCSS('background-image', 'none');
	await expect(page.locator('body')).toHaveCSS('background-color', 'rgb(255, 255, 255)');
	await expect(page.locator('article pre').first()).toHaveCSS('color', 'rgb(0, 0, 0)');
});

test('the homepage keeps its sections in print', async ({ page }) => {
	await page.goto('/');
	await page.emulateMedia({ media: 'print' });
	await expect(page.locator('header')).toBeHidden();
	for (const id of ['#home', '#about', '#portfolio', '#blog', '#contact']) await expect(page.locator(id)).toBeVisible();
});

test('nav hover uses the 55% glass pill', async ({ page }) => {
	await page.addInitScript(() => localStorage.setItem('theme', 'light'));
	await page.goto(post);
	const link = page.locator('header nav a', { hasText: 'Resume' });
	await link.hover();
	await expect(link).toHaveCSS('background-color', 'color(srgb 1 1 1 / 0.385)'); // color-mix() result, as Chromium serialises it
});

test.describe('phone width', () => {
	test.use({ viewport: { width: 375, height: 740 } });

	test('hovering the hamburger keeps the glass tint under the pill', async ({ page }) => {
		await page.addInitScript(() => localStorage.setItem('theme', 'light'));
		await page.goto(post);
		const hamburger = page.locator('#hamburger');
		await hamburger.hover();
		await expect(hamburger).toHaveCSS('background-color', 'rgba(255, 255, 255, 0.6)'); // --glass-tint
		await expect(hamburger).toHaveCSS('background-image', /^linear-gradient\(color\(srgb 1 1 1 \/ 0\.385\)/);
	});
});
