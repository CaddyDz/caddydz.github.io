import { defineConfig } from 'vitest/config';

export default defineConfig({
	test: {
		environment: 'jsdom',
		include: ['tests/unit/**/*.{test,spec}.{js,mjs}'],
		coverage: {
			provider: 'v8',
			reporter: ['text', 'html'],
			include: ['js/theme.js'],
		},
	},
});
