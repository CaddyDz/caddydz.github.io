/** @type {import('tailwindcss').Config} */

// Map @tailwindcss/typography's colour variables onto the Glaz theme variables, which already
// flip on html.dark / prefers-color-scheme. The invert set is mapped too, otherwise the
// `dark:prose-invert` variant would override the mapping with Tailwind's default greys.
const palette = {
	'--tw-prose-body': 'var(--paragraph-color)',
	'--tw-prose-headings': 'var(--heading-color)',
	'--tw-prose-lead': 'var(--paragraph-color)',
	'--tw-prose-links': 'var(--heading-color)',
	'--tw-prose-bold': 'var(--heading-color)',
	'--tw-prose-counters': 'var(--disable-color)',
	'--tw-prose-bullets': 'var(--disable-color)',
	'--tw-prose-hr': 'var(--disable-color)',
	'--tw-prose-quotes': 'var(--paragraph-color)',
	'--tw-prose-quote-borders': '#c026d3',
	'--tw-prose-captions': 'var(--disable-color)',
	'--tw-prose-code': 'var(--heading-color)',
	'--tw-prose-th-borders': 'var(--disable-color)',
	'--tw-prose-td-borders': 'var(--disable-color)',
};
const invert = Object.fromEntries(
	Object.entries(palette).map(([k, v]) => [k.replace('--tw-prose-', '--tw-prose-invert-'), v])
);

module.exports = {
	// Explicit globs, no root `**`: _site/ and node_modules/ are never scanned.
	content: [
		'./_layouts/**/*.html',
		'./_includes/**/*.html',
		'./_posts/**/*.md',
		'./_projects/**/*.md',
		'./_data/**/*.yml',
		'./*.html',
		'./*.md',
		'./js/**/*.js',
	],
	darkMode: 'class',
	theme: {
		container: {
			center: true,
			padding: {
				DEFAULT: '1rem',
				sm: '3rem',
				lg: '3rem',
				xl: '3rem',
				'2xl': '3rem',
			},
		},
		extend: {
			// Under `extend` (Glaz had it at theme level, which deleted font-sans/font-mono).
			fontFamily: {
				darker: ['"Darker Grotesque"', 'sans-serif'],
				inter: ['Inter', 'sans-serif'],
			},
			colors: {
				body: 'var(--body-color)',
				heading: 'var(--heading-color)',
				paragraph: 'var(--paragraph-color)',
				disable: 'var(--disable-color)',
				glass: 'var(--glass-color)',
			},
			screens: {
				'2xl': '1320px',
			},
			rotate: {
				360: '360deg',
			},
			typography: ({ theme }) => ({
				DEFAULT: {
					css: {
						...palette,
						...invert,
						'h1, h2, h3, h4': { fontFamily: theme('fontFamily.darker').join(', ') },
						// highlight.js owns code blocks: neutralise the plugin's pre / pre code rules.
						// (/css/style.css must be linked BEFORE the hljs theme in head.html.)
						pre: { backgroundColor: 'transparent', padding: '0', color: 'inherit' },
						'pre code': { backgroundColor: null, padding: null, color: null, fontFamily: null },
						'code::before': { content: 'none' },
						'code::after': { content: 'none' },
					},
				},
			}),
		},
	},
	plugins: [require('@tailwindcss/typography')],
};
