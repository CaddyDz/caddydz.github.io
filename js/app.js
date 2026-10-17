import {
	applyTheme,
	nextTheme,
	readStoredTheme,
	setFooterYear,
} from './theme.js';

// Window On Scroll Effect
window.onscroll = function () {
	const header = document.querySelector('header');
	if (!header) return;

	const fixedNav = header.offsetTop;
	const toTop = document.querySelector('#to-top');
	const sections = document.querySelectorAll('section');
	const navLi = document.querySelectorAll('header nav ul li a');

	var current = '';
	sections.forEach((section) => {
		const sectionTop = section.offsetTop;
		if (scrollY >= sectionTop) {
			current = section.getAttribute('id');
		}
	});

	navLi.forEach((li) => {
		li.classList.remove('active');
		if (li.classList.contains(current)) {
			li.classList.add('active');
		}
	});

	if (scrollY > fixedNav) {
		header.classList.add('navbar-fixed');
		toTop?.classList.remove('hidden');
	} else {
		header.classList.remove('navbar-fixed');
		toTop?.classList.add('hidden');
	}
};

// Navbar Hamburger Menu Toggle
const hamburger = document.querySelector('#hamburger');
const navMenu = document.querySelector('#nav-menu');

if (hamburger && navMenu) {
	const setMenu = (open) => {
		hamburger.classList.toggle('hamburger-active', open);
		navMenu.classList.toggle('hidden', !open);
		hamburger.setAttribute('aria-expanded', String(open));
	};

	hamburger.addEventListener('click', () => {
		setMenu(navMenu.classList.contains('hidden'));
	});

	window.addEventListener('click', function (e) {
		if (!hamburger.contains(e.target)) setMenu(false);
	});

	window.addEventListener('keydown', (e) => {
		if (e.key === 'Escape' && !navMenu.classList.contains('hidden')) {
			setMenu(false);
			hamburger.focus();
		}
	});
}

// Theme: system (default) → light → dark → system
const themeToggle = document.querySelector('#theme-toggle');

if (themeToggle) {
	themeToggle.addEventListener('click', () => {
		applyTheme(nextTheme(readStoredTheme()), { toggle: themeToggle });
	});
}

applyTheme(readStoredTheme(), { toggle: themeToggle });

window
	.matchMedia('(prefers-color-scheme: dark)')
	.addEventListener('change', () => {
		if (readStoredTheme() === 'system') {
			applyTheme('system', { toggle: themeToggle });
		}
	});

setFooterYear(document.querySelector('#year'));

// Portfolio lightbox: native <dialog>, replaces jQuery + Magnific Popup.
// The <a href> stays a plain link to the image when JS is off.
const lightbox = document.querySelector('#lightbox');
if (lightbox && typeof lightbox.showModal === 'function') {
	const shot = lightbox.querySelector('img');
	let opener = null;
	document.querySelectorAll('.zoom-gallery a').forEach((a) => {
		a.addEventListener('click', (e) => {
			e.preventDefault();
			opener = a;
			shot.src = a.href;
			shot.alt = a.querySelector('img')?.alt ?? '';
			lightbox.showModal();
		});
	});
	lightbox.addEventListener('click', (e) => {
		if (e.target === lightbox || e.target.closest('[data-close]')) lightbox.close();
	});
	// Return focus to the thumbnail explicitly: Safari does not focus a link on click, so the dialog has nothing to restore.
	lightbox.addEventListener('close', () => {
		shot.removeAttribute('src');
		opener?.focus();
	});
}

// Deep links (/#contact from a post page) land mid-page: set the header / to-top state once.
window.onscroll?.();
