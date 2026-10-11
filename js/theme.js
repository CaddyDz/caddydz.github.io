export const THEME_ORDER = ['system', 'light', 'dark'];

export function normalizeTheme(theme) {
	return THEME_ORDER.includes(theme) ? theme : 'system';
}

export function resolveIsDark(theme, prefersDark) {
	const normalized = normalizeTheme(theme);
	return normalized === 'dark' || (normalized === 'system' && prefersDark);
}

export function nextTheme(theme) {
	const normalized = normalizeTheme(theme);
	const idx = THEME_ORDER.indexOf(normalized);
	return THEME_ORDER[(idx + 1) % THEME_ORDER.length];
}

export function themeLabel(theme) {
	const normalized = normalizeTheme(theme);
	return `Theme: ${normalized}`;
}

/**
 * Apply light/dark/system theme to the document.
 * @param {string|null|undefined} theme
 * @param {{ root?: Element, body?: Element, toggle?: Element|null, prefersDark?: boolean, storage?: Storage }} [options]
 */
export function applyTheme(theme, options = {}) {
	const root = options.root ?? document.documentElement;
	const body = options.body ?? document.body;
	const toggle = options.toggle ?? null;
	const prefersDark =
		options.prefersDark ??
		window.matchMedia('(prefers-color-scheme: dark)').matches;
	const storage = options.storage ?? localStorage;

	const normalized = normalizeTheme(theme);
	const dark = resolveIsDark(normalized, prefersDark);

	root.dataset.theme = normalized;
	root.classList.toggle('dark', dark);
	root.classList.toggle('light', normalized === 'light');
	body?.classList.remove('light-mode');

	if (normalized === 'system') storage.removeItem('theme');
	else storage.setItem('theme', normalized);
	storage.removeItem('preferredTheme');

	if (toggle) {
		const label = themeLabel(normalized);
		toggle.setAttribute('aria-label', label);
		toggle.title = `${label} (click to change)`;
	}

	return { theme: normalized, dark };
}

export function readStoredTheme(storage = localStorage) {
	return normalizeTheme(storage.getItem('theme'));
}

export function setFooterYear(el, date = new Date()) {
	if (!el) return null;
	const year = String(date.getFullYear());
	el.textContent = year;
	return year;
}
