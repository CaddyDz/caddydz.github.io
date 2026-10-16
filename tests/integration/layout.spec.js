import { expect, test } from '@playwright/test';

test.beforeEach(async ({ page }) => {
	await page.route(/googletagmanager\.com|google-analytics\.com/, (route) => route.abort());
});

test.describe('320px wide', () => {
	test.use({ viewport: { width: 320, height: 640 } });

	test('the hero keeps its side gutters and the page does not scroll sideways', async ({ page }) => {
		await page.goto('/');
		await page.evaluate(() => document.fonts.ready);
		for (const el of [page.locator('#home p.paragraph').first(), page.locator('#home dl')]) {
			const box = await el.boundingBox();
			expect(box.x).toBeGreaterThanOrEqual(16);
			expect(box.x + box.width).toBeLessThanOrEqual(320 - 16);
		}
		expect(await page.evaluate(() => document.documentElement.scrollWidth)).toBe(320);
	});
});

for (const [path, expected] of [
	['/', 11],
	['/css/2023/05/24/prevent-drag-overscroll-macos.html', 3],
]) {
	test(`${path} loads ${expected} decor images`, async ({ page }) => {
		const decor = new Set();
		page.on('request', (req) => {
			if (/\/img\/decor-\d+\.webp$/.test(req.url())) decor.add(req.url());
		});
		await page.goto(path);
		await page.waitForLoadState('networkidle');
		expect(decor.size).toBe(expected);
	});
}
