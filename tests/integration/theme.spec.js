import { expect, test } from '@playwright/test';

test.beforeEach(async ({ context }) => {
	await context.route(/googletagmanager\.com|google-analytics\.com/, (route) => route.abort());
});

// The `pageshow` (bfcache) half is unit-tested in tests/unit/theme.test.js: Playwright's Chromium runs without bfcache.
test('a theme change in one tab is applied in the other', async ({ context }) => {
	const first = await context.newPage();
	const second = await context.newPage();
	await first.goto('/');
	await second.goto('/');
	await expect(second.locator('html')).toHaveAttribute('data-theme', 'system');

	await first.locator('#theme-toggle').click(); // system -> light
	await expect(first.locator('html')).toHaveAttribute('data-theme', 'light');
	await expect(second.locator('html')).toHaveAttribute('data-theme', 'light');
	await expect(second.locator('html')).toHaveClass(/\blight\b/);
	await expect(second.locator('#theme-toggle')).toHaveAttribute('aria-label', 'Theme: light');

	await first.locator('#theme-toggle').click(); // light -> dark
	await expect(second.locator('html')).toHaveClass(/\bdark\b/);

	await first.locator('#theme-toggle').click(); // dark -> system (removes the key)
	await expect(second.locator('html')).toHaveAttribute('data-theme', 'system');
});
