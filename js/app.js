import {
	applyTheme,
	nextTheme,
	readStoredTheme,
	setFooterYear,
	shouldResyncTheme,
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
	hamburger.addEventListener('click', () => {
		hamburger.classList.toggle('hamburger-active');
		navMenu.classList.toggle('hidden');
	});

	window.addEventListener('click', function (e) {
		if (!hamburger.contains(e.target)) {
			hamburger.classList.remove('hamburger-active');
			navMenu.classList.add('hidden');
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

// Back/Forward (bfcache) restores the page as it was left, and other tabs can change the theme meanwhile.
for (const type of ['pageshow', 'storage']) {
	window.addEventListener(type, (e) => {
		if (shouldResyncTheme(e)) applyTheme(readStoredTheme(), { toggle: themeToggle });
	});
}

setFooterYear(document.querySelector('#year'));

// Portfolio lightbox: native <dialog>, replaces jQuery + Magnific Popup.
// The <a href> stays a plain link to the image when JS is off.
const lightbox = document.querySelector('#lightbox');
if (lightbox && typeof lightbox.showModal === 'function') {
	const shot = lightbox.querySelector('img');
	document.querySelectorAll('.zoom-gallery a').forEach((a) => {
		a.addEventListener('click', (e) => {
			e.preventDefault();
			shot.src = a.href;
			shot.alt = a.querySelector('img')?.alt ?? '';
			lightbox.showModal();
		});
	});
	lightbox.addEventListener('click', (e) => {
		if (e.target === lightbox || e.target.closest('[data-close]')) lightbox.close();
	});
	lightbox.addEventListener('close', () => shot.removeAttribute('src'));
}

// Deep links (/#contact from a post page) land mid-page: set the header / to-top state once.
window.onscroll?.();
