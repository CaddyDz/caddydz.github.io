import { expect, test } from '@playwright/test';

// jekyll-seo-tag replaced the hand-written OG/Twitter block; these are the tags that block emitted (plus canonical).
const post = '/github/2023/01/18/github-pr-auto-request-review.html';
const url = `https://dsalim.dev${post}`;
const title = 'Automate pull request review assignment on GitHub via actions';
const image = 'https://dsalim.dev/assets/img/gh-pr-review.png';

const meta = (page, key) => page.locator(`head meta[property="${key}"], head meta[name="${key}"]`);

test('a post keeps its share metadata', async ({ page }) => {
	await page.goto(post);
	await expect(page).toHaveTitle(title);
	const expected = {
		description: /^Managing pull requests \(PRs\) can be a challenging task\./,
		'og:type': 'article',
		'og:site_name': 'Salim Djerbouh',
		'og:title': title,
		'og:description': /^Managing pull requests/,
		'og:url': url,
		'og:image': image,
		'twitter:card': 'summary_large_image',
		'twitter:title': title,
		'twitter:image': image,
		'twitter:image:alt': title,
		'twitter:site': '@saly3301',
		'twitter:creator': '@saly3301',
		'article:published_time': '2023-01-18T00:00:00+00:00',
		author: 'Salim Djerbouh',
	};
	for (const [key, value] of Object.entries(expected)) {
		await expect(meta(page, key).first(), key).toHaveAttribute('content', value);
	}
	await expect(page.locator('head link[rel="canonical"]')).toHaveAttribute('href', url);
	await expect(page.locator('head title')).toHaveCount(1);
});

test('the homepage has a description and website card', async ({ page }) => {
	await page.goto('/');
	await expect(page).toHaveTitle('Salim Djerbouh');
	await expect(meta(page, 'description')).toHaveAttribute('content', 'Modern web developer, Laravel artisan');
	await expect(meta(page, 'og:type')).toHaveAttribute('content', 'website');
	await expect(page.locator('head link[rel="alternate"][type="application/atom+xml"]')).toHaveAttribute('href', 'https://dsalim.dev/feed.xml');
});

test('feed and sitemap list every post', async ({ request }) => {
	const feed = await (await request.get('/feed.xml')).text();
	const sitemap = await (await request.get('/sitemap.xml')).text();
	expect(feed).toContain(`<link href="${url}"`);
	expect(sitemap).toContain(`<loc>${url}</loc>`);
	expect((feed.match(/<entry>/g) ?? []).length).toBeGreaterThanOrEqual(9);
	expect(await (await request.get('/robots.txt')).text()).toContain('Sitemap: https://dsalim.dev/sitemap.xml');
});
