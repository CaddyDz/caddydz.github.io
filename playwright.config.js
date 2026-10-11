import { defineConfig, devices } from '@playwright/test';

// Serves the prebuilt _site/ (from `docker compose up` locally, or `jekyll build` in CI).
// Set PLAYWRIGHT_BASE_URL (e.g. http://dsalim.localhost) to test a running server instead.
const PORT = 4173;
const baseURL = process.env.PLAYWRIGHT_BASE_URL ?? `http://127.0.0.1:${PORT}`;

export default defineConfig({
	testDir: './tests/integration',
	fullyParallel: true,
	forbidOnly: !!process.env.CI,
	retries: process.env.CI ? 2 : 0,
	reporter: process.env.CI ? 'github' : 'list',
	use: {
		baseURL,
		trace: 'on-first-retry',
	},
	projects: [
		{
			name: 'chromium',
			use: { ...devices['Desktop Chrome'] },
		},
	],
	webServer: process.env.PLAYWRIGHT_BASE_URL
		? undefined
		: {
				// --no-clean-urls: `serve` would otherwise 301 /x.html -> /x, unlike GitHub Pages.
				command: `npx serve _site -l ${PORT} --no-port-switching --no-clean-urls`,
				url: `${baseURL}/`,
				reuseExistingServer: !process.env.CI,
				timeout: 60_000,
			},
});
