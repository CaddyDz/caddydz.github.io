import { expect, test } from '@playwright/test';

test.beforeEach(async ({ page }) => {
	await page.route(/googletagmanager\.com|google-analytics\.com/, (route) => route.abort());
});

// Code samples that contain Liquid-like braces must be wrapped in {% raw %}, or Liquid renders them blank.
const rawSamples = [
	{
		path: '/github/2023/01/18/github-pr-auto-request-review.html',
		code: ['Authorization: token ${{ secrets.GITHUB_TOKEN }}', '${{ github.event.pull_request.number }}'],
		prose: 'authorization token (${{ secrets.GITHUB_TOKEN }})',
	},
	{
		path: '/javascript/2023/01/16/vue3-recursive-component-tree.html',
		code: ['{{ node.name }}'],
	},
];

for (const { path, code, prose } of rawSamples) {
	test(`${path} keeps its literal braces`, async ({ page }) => {
		await page.goto(path);
		const blocks = (await page.locator('article pre').allTextContents()).join('\n');
		for (const snippet of code) expect(blocks).toContain(snippet);
		if (prose) await expect(page.locator('article .prose')).toContainText(prose);
	});
}
