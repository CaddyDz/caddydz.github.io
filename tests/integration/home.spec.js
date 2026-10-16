import { readFileSync } from 'node:fs';
import { join } from 'node:path';
import { expect, test } from '@playwright/test';

// Homepage content contracts (ported from glaz `portfolio.spec.js`). Strict mode: the name is in exactly
// one heading and "Your Email" is the only label containing "Email", so locators stay unambiguous.
const root = join(__dirname, '..', '..');

// Display order from _config.yml `collections.projects.order`, mapped to each project's `name`.
const projectOrder = readFileSync(join(root, '_config.yml'), 'utf8')
	.match(/order:\n((?:\s+- .+\n?)+)/)[1]
	.split('\n')
	.map((line) => line.replace(/^\s+- /, '').trim())
	.filter(Boolean)
	.map((file) => readFileSync(join(root, '_projects', file), 'utf8').match(/^name: (.+)$/m)[1].trim());

test.beforeEach(async ({ page }) => {
	await page.route(/googletagmanager\.com|google-analytics\.com/, (route) => route.abort());
});

test('hero shows the name, the CV download and the CV source', async ({ page, request }) => {
	await page.goto('/');
	await expect(page.getByRole('heading', { name: 'Salim Djerbouh' })).toBeVisible();

	const download = page.getByRole('link', { name: 'Download CV' });
	await expect(download).toHaveAttribute('href', '/cv.pdf');
	await expect(download).toHaveAttribute('download', '');
	const pdf = await request.get('/cv.pdf');
	expect(pdf.ok()).toBe(true);
	expect((await pdf.body()).subarray(0, 5).toString()).toBe('%PDF-');

	const source = page.getByRole('link', { name: 'CV LaTeX source' });
	await expect(source).toHaveAttribute('href', 'https://github.com/CaddyDz/caddydz.github.io/tree/master/CV');
	await expect(source).toHaveAttribute('target', '_blank');
});

test('projects render in _config.yml order with local, loading screenshots', async ({ page }) => {
	await page.goto('/');
	const projects = page.locator('#portfolio [data-project]');
	await expect(projects).toHaveCount(projectOrder.length);
	expect(await projects.evaluateAll((els) => els.map((el) => el.dataset.project))).toEqual(projectOrder);

	for (const name of projectOrder) {
		const img = page.locator(`[data-project="${name}"] img`);
		await img.scrollIntoViewIfNeeded(); // lazy-loaded
		await expect(img, name).toHaveAttribute('src', /^\/assets\/img\/[\w.-]+\.(png|jpe?g|webp)$/);
		await expect(img, name).toHaveJSProperty('complete', true);
		expect(await img.evaluate((el) => el.naturalWidth), name).toBeGreaterThan(0);
		const link = page.locator(`[data-project="${name}"] .zoom-gallery a`);
		await expect(link, name).toHaveAttribute('href', await img.getAttribute('src'));
	}
});

test('the theme toggle cycles system -> light -> dark -> system and persists', async ({ page }) => {
	await page.goto('/');
	const html = page.locator('html');
	const toggle = page.locator('#theme-toggle');
	const stored = () => page.evaluate(() => localStorage.getItem('theme'));

	await expect(html).toHaveAttribute('data-theme', 'system');
	await expect(toggle).toHaveAttribute('aria-label', 'Theme: system');

	await toggle.click();
	await expect(html).toHaveAttribute('data-theme', 'light');
	await expect(html).toHaveClass(/\blight\b/);
	expect(await stored()).toBe('light');

	await toggle.click();
	await expect(html).toHaveAttribute('data-theme', 'dark');
	await expect(html).toHaveClass(/\bdark\b/);
	expect(await stored()).toBe('dark');

	await page.reload();
	await expect(html).toHaveClass(/\bdark\b/);
	await expect(page.locator('#theme-toggle [data-theme-icon="dark"]')).toBeVisible();

	await toggle.click();
	await expect(html).toHaveAttribute('data-theme', 'system');
	await expect(html).not.toHaveClass(/\b(light|dark)\b/);
	expect(await stored()).toBeNull();
});

test.describe('forced light on a dark OS', () => {
	test.use({ colorScheme: 'dark' });

	test('system follows the OS, a stored light theme overrides it', async ({ page }) => {
		const html = page.locator('html');
		const bg = () => page.evaluate(() => getComputedStyle(document.body).backgroundColor);

		await page.goto('/');
		await expect(html).toHaveClass(/\bdark\b/);
		expect(await bg()).toBe('rgb(0, 0, 0)');

		await page.evaluate(() => localStorage.setItem('theme', 'light'));
		await page.reload();
		await expect(html).toHaveClass(/\blight\b/);
		await expect(html).not.toHaveClass(/\bdark\b/);
		expect(await bg()).toBe('rgb(235, 231, 255)');
	});
});

test('contact form posts to formsubmit with required, labelled fields', async ({ page }) => {
	await page.goto('/');
	const form = page.locator('#contact form');
	await expect(form).toHaveAttribute('method', 'POST');
	await expect(form).toHaveAttribute('action', /^https:\/\/formsubmit\.co\/[0-9a-f]{32}$/);
	await expect(form.locator('input[name="_next"]')).toHaveValue('https://dsalim.dev/#contact');
	await expect(form.locator('input[name="_subject"]')).toHaveValue(/dsalim\.dev/);
	await expect(form.locator('input[name="_honey"]')).toBeHidden();

	for (const [label, name, type] of [
		['Your Name', 'Name', 'text'],
		['Your Email', 'Email', 'email'],
		['Subject', 'Subject', 'text'],
		['Your Message', 'Message', null],
	]) {
		const field = form.getByLabel(label, { exact: true });
		await expect(field, label).toHaveAttribute('name', name);
		await expect(field, label).toHaveAttribute('required', '');
		if (type) await expect(field, label).toHaveAttribute('type', type);
	}
	await expect(form.getByRole('button', { name: 'Send Message' })).toHaveAttribute('type', 'submit');
});
