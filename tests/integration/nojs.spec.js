import { expect, test } from '@playwright/test';

test.use({ viewport: { width: 375, height: 740 } });

test.describe('without JavaScript', () => {
	test.use({ javaScriptEnabled: false });

	for (const path of ['/', '/macos/2026/10/10/macos-networkquality-speed-test.html']) {
		test(`${path}: the section links are reachable at phone width`, async ({ page }) => {
			await page.goto(path);
			await expect(page.locator('#hamburger')).toBeHidden();
			await expect(page.locator('#theme-toggle')).toBeHidden();
			for (const name of ['About', 'Resume', 'Portfolio', 'Blog', 'Contact']) {
				await expect(page.locator('#nav-menu').getByRole('link', { name, exact: true })).toBeVisible();
			}
			expect(await page.evaluate(() => document.documentElement.scrollWidth)).toBe(375);

			await page.locator('#nav-menu').getByRole('link', { name: 'Contact' }).click();
			await expect(page).toHaveURL(/\/#contact$/);
			await expect(page.locator('#contact h1, #contact h2').first()).toBeInViewport();
		});
	}
});

test('with JavaScript the sheet stays closed behind the hamburger', async ({ page }) => {
	await page.route(/googletagmanager\.com|google-analytics\.com/, (route) => route.abort());
	await page.goto('/');
	await expect(page.locator('html')).toHaveClass(/\bjs\b/);
	await expect(page.locator('#nav-menu')).toBeHidden();
	await page.locator('#hamburger').click();
	await expect(page.locator('#nav-menu').getByRole('link', { name: 'Contact' })).toBeVisible();
});
