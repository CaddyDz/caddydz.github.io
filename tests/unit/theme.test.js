import { afterEach, beforeEach, describe, expect, it, vi } from 'vitest';
import {
	THEME_ORDER,
	applyTheme,
	nextTheme,
	normalizeTheme,
	readStoredTheme,
	resolveIsDark,
	setFooterYear,
	shouldResyncTheme,
	themeLabel,
} from '../../js/theme.js';

describe('normalizeTheme', () => {
	it('keeps valid themes', () => {
		expect(normalizeTheme('light')).toBe('light');
		expect(normalizeTheme('dark')).toBe('dark');
		expect(normalizeTheme('system')).toBe('system');
	});

	it('falls back to system for invalid values', () => {
		expect(normalizeTheme(null)).toBe('system');
		expect(normalizeTheme(undefined)).toBe('system');
		expect(normalizeTheme('nope')).toBe('system');
	});
});

describe('resolveIsDark', () => {
	it('forces dark/light regardless of OS', () => {
		expect(resolveIsDark('dark', false)).toBe(true);
		expect(resolveIsDark('dark', true)).toBe(true);
		expect(resolveIsDark('light', true)).toBe(false);
		expect(resolveIsDark('light', false)).toBe(false);
	});

	it('follows OS preference in system mode', () => {
		expect(resolveIsDark('system', true)).toBe(true);
		expect(resolveIsDark('system', false)).toBe(false);
	});
});

describe('nextTheme', () => {
	it('cycles system → light → dark → system', () => {
		expect(nextTheme('system')).toBe('light');
		expect(nextTheme('light')).toBe('dark');
		expect(nextTheme('dark')).toBe('system');
	});

	it('covers the full order', () => {
		expect(THEME_ORDER).toEqual(['system', 'light', 'dark']);
		let theme = 'system';
		const seen = new Set();
		for (let i = 0; i < THEME_ORDER.length; i += 1) {
			theme = nextTheme(theme);
			seen.add(theme);
		}
		expect(seen.size).toBe(3);
	});
});

describe('themeLabel', () => {
	it('returns accessible labels', () => {
		expect(themeLabel('system')).toBe('Theme: system');
		expect(themeLabel('light')).toBe('Theme: light');
		expect(themeLabel('dark')).toBe('Theme: dark');
	});
});

describe('applyTheme', () => {
	let root;
	let body;
	let toggle;
	let storage;

	beforeEach(() => {
		root = document.createElement('html');
		body = document.createElement('body');
		toggle = document.createElement('button');
		storage = {
			store: {},
			getItem(key) {
				return Object.prototype.hasOwnProperty.call(this.store, key)
					? this.store[key]
					: null;
			},
			setItem(key, value) {
				this.store[key] = String(value);
			},
			removeItem(key) {
				delete this.store[key];
			},
		};
	});

	afterEach(() => {
		vi.restoreAllMocks();
	});

	it('applies dark class for dark theme', () => {
		const result = applyTheme('dark', {
			root,
			body,
			toggle,
			prefersDark: false,
			storage,
		});

		expect(result).toEqual({ theme: 'dark', dark: true });
		expect(root.dataset.theme).toBe('dark');
		expect(root.classList.contains('dark')).toBe(true);
		expect(root.classList.contains('light')).toBe(false);
		expect(storage.getItem('theme')).toBe('dark');
		expect(toggle.getAttribute('aria-label')).toBe('Theme: dark');
	});

	it('applies light class for light theme', () => {
		applyTheme('light', { root, body, toggle, prefersDark: true, storage });

		expect(root.dataset.theme).toBe('light');
		expect(root.classList.contains('dark')).toBe(false);
		expect(root.classList.contains('light')).toBe(true);
		expect(storage.getItem('theme')).toBe('light');
	});

	it('clears storage in system mode and follows OS', () => {
		storage.setItem('theme', 'dark');
		storage.setItem('preferredTheme', 'light-mode');

		applyTheme('system', { root, body, toggle, prefersDark: true, storage });

		expect(root.dataset.theme).toBe('system');
		expect(root.classList.contains('dark')).toBe(true);
		expect(storage.getItem('theme')).toBeNull();
		expect(storage.getItem('preferredTheme')).toBeNull();
	});
});

describe('readStoredTheme', () => {
	it('reads and normalizes storage', () => {
		const storage = {
			getItem: vi.fn(() => 'light'),
		};
		expect(readStoredTheme(storage)).toBe('light');

		storage.getItem = vi.fn(() => 'invalid');
		expect(readStoredTheme(storage)).toBe('system');
	});
});

describe('setFooterYear', () => {
	it('writes the current year', () => {
		const el = document.createElement('span');
		const year = setFooterYear(el, new Date('2026-08-21T00:00:00Z'));
		expect(year).toBe('2026');
		expect(el.textContent).toBe('2026');
	});

	it('no-ops for missing element', () => {
		expect(setFooterYear(null)).toBeNull();
	});
});

describe('shouldResyncTheme', () => {
	it('resyncs on a bfcache restore only', () => {
		expect(shouldResyncTheme({ type: 'pageshow', persisted: true })).toBe(true);
		expect(shouldResyncTheme({ type: 'pageshow', persisted: false })).toBe(false);
	});

	it('resyncs when another tab writes or clears the theme key', () => {
		expect(shouldResyncTheme({ type: 'storage', key: 'theme' })).toBe(true);
		expect(shouldResyncTheme({ type: 'storage', key: null })).toBe(true);
		expect(shouldResyncTheme({ type: 'storage', key: 'other' })).toBe(false);
	});

	it('ignores other events', () => {
		expect(shouldResyncTheme({ type: 'load' })).toBe(false);
	});
});
