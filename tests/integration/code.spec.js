import { expect, test } from '@playwright/test';

// Code is highlighted by Rouge at build time; colours come from the --code-* theme variables in input.css.
const post = '/github/2023/01/18/github-pr-auto-request-review.html'; // a yaml block: `na` keys, `s` strings

for (const [theme, bg, key, str] of [
	['light', 'rgb(246, 248, 250)', 'rgb(5, 80, 174)', 'rgb(10, 48, 105)'],
	['dark', 'rgb(41, 45, 62)', 'rgb(247, 140, 108)', 'rgb(195, 232, 141)'],
]) {
	test(`code blocks use the ${theme} palette without a client-side highlighter`, async ({ page }) => {
		const thirdParty = [];
		page.on('request', (req) => {
			if (/cdnjs|highlight/.test(req.url())) thirdParty.push(req.url());
		});
		await page.route(/googletagmanager\.com|google-analytics\.com/, (route) => route.abort());
		await page.addInitScript((t) => localStorage.setItem('theme', t), theme);
		await page.goto(post);

		const pre = page.locator('article pre.highlight').first();
		await expect(pre).toHaveCSS('background-color', bg);
		await expect(pre.locator('.na').first()).toHaveCSS('color', key);
		await expect(pre.locator('.s').first()).toHaveCSS('color', str);
		expect(await page.evaluate(() => typeof window.hljs)).toBe('undefined');
		expect(thirdParty).toEqual([]);
	});
}
