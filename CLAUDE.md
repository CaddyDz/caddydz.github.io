# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

Jekyll personal site for https://dsalim.dev (portfolio, blog, CV), styled with the Glaz Tailwind CSS template (ported from the separate `glaz` repo in 2026-10; that repo is now only a reference). Jekyll is not installed on the host; Docker is the Jekyll path. Node is used for Tailwind and tests.

## Commands

```shell
npm ci                                   # once; Tailwind, vitest, Playwright, serve
docker compose up -d --build             # Tailwind watcher + Jekyll 4 behind local Traefik: http://dsalim.localhost
npm run watch:css                        # Tailwind watcher on the host instead of the compose service
npm run build:css                        # one-shot minified build to css/style.css (gitignored)
npm run check:site                       # URL invariant + CNAME + leak check on _site/
npm test                                 # vitest (tests/unit)
npm run test:e2e                         # Playwright against _site/ (npx playwright install chromium once)
PLAYWRIGHT_BASE_URL=http://dsalim.localhost npm run test:e2e   # against the running compose stack
```

The compose stack and the `glaz` repo's compose stack both register the Traefik router `dsalim` on `dsalim.localhost`; never run both.

## Deployment

- **Production is GitHub Pages deployed by `.github/workflows/pages.yml`** (Pages source = "GitHub Actions"): `npm run build:css` → `bundle exec jekyll build` (Jekyll 4 from `Gemfile.lock`, `JEKYLL_ENV=production`) → `tests/check-site.sh` → vitest → Playwright → `deploy-pages`. Pull requests run everything except the deploy. Merging to `master` is the deploy.
- Compiled CSS is never committed (`css/style.css` is gitignored). Docker, CI and production all run the same locked Jekyll, so a local render matches production.
- `Gemfile.lock` must be regenerated inside `ruby:3.3-slim` with `--add-platform x86_64-linux aarch64-linux` (command in README), never with the host Ruby.
- `.github/workflows/docker.yml` only builds and pushes the dev/runtime image to Docker Hub on push to `master`. **Do not use `[skip ci]`**: GitHub's skip applies to every push workflow, so it would also skip the Pages deploy (`pages.yml`). The Docker Hub image has no `css/style.css`; it is a runtime shell for the bind-mounted dev loop.
- `_site/`, `.jekyll-cache/`, `node_modules/`, `test-results/`, `playwright-report/` are build output and gitignored.
- `_config.yml` `exclude` lists every tooling file explicitly; `tests/check-site.sh` fails the build if any leaks into `_site/`.

## Hard invariants (CI enforces the first two)

- **Post URLs never change.** They come from front-matter `date` + `categories` (default permalink `/:categories/:year/:month/:day/:title.html`); three posts have front-matter dates that differ from their filenames (chmod, vue3, gh-pr). `tests/expected-pages.txt` lists every live page and `tests/check-site.sh` fails if one disappears (subset check: new posts are fine; add them to the list if you want them guarded).
- **All asset paths are root-relative** (`/css/style.css`, `/js/app.js`, `/img/...`, `/assets/img/...`) so they work from nested post URLs. Nav anchors are `/#about` etc. for the same reason.
- `_includes/head.html` links `/css/style.css` BEFORE the highlight.js theme; the typography plugin's `pre code` reset and `.hljs` have equal specificity, so order decides whether code blocks have colour.
- The inline theme script in `head.html` must stay inline (prevents a flash of the wrong theme).

## Architecture

- **Layouts:** `_layouts/base.html` is the shell (head, header, `{{ content }}`, footer, to-top, scripts). `_includes/header.html` is the Liquid Glass header: two always-fixed glass capsules (nav; socials + theme toggle), a glass circle hamburger and a glass sheet menu on mobile. The material is the `.glass` component in `input.css` (blur + saturate, translucent fill, specular top edge, shaded bottom edge, glint pseudo-element) driven by the `--glass-*` variables defined next to the theme variables. Those rules live in `@layer components` so utilities like `absolute`/`lg:hidden` still win. `_layouts/default.html` (homepage, `layout: base`) just includes the sections in order plus the `<dialog id="lightbox">`. `_layouts/blog.html` (posts, `layout: base`) renders `{{ content }}` inside `.prose dark:prose-invert` and reuses the blog grid as "Other posts".
- **Sections:** `_includes/sections/{hero,trusted,about,resume,portfolio,testimonials,blog,contact}.html`. `about.html` is the Glaz markup pasted verbatim (services cards + 18-tool grid with inline SVGs). **Its SVG gradient/clipPath ids are unique only because it renders once per page: never loop it or include it from another layout.**
- **Data:** `_data/profile.yml` (name, tagline, email, phones, socials, CV links, bio, resume summary, contact blurb/form action), `_data/resume.yml` (employment, education), `_data/testimonials.yml`. Edit content there, not in the includes.
- **OG/Twitter meta** lives in `head.html` under `{% if page.layout == "blog" %}` (a `capture` in a child layout is invisible to the parent). The highlight.js CSS/JS and the GA4 tag (`production` only) are gated the same way in `head.html` / `scripts.html`.
- **CSS:** `input.css` (Tailwind source + Glaz theme variables, light/dark via `:root.dark`/`:root.light`/`prefers-color-scheme`) → `tailwind.config.js` (explicit `content` globs: `_layouts`, `_includes`, `_posts`, `_projects`, `_data`, root `*.html|*.md`, `js`; `fontFamily` under `extend` so `font-mono` survives; typography palette mapped to the theme variables, invert set included). Body decor images are `/img/decor-*.webp`.
- **JS:** `js/app.js` (ES module: scroll-spy keyed on nav `<a>` class == section id, hamburger, theme toggle cycling system → light → dark, footer year, `<dialog>` lightbox for `.zoom-gallery a`) imports `js/theme.js` (pure functions, unit-tested). No jQuery, no vendor bundles.
- **Code highlighting happens twice.** Rouge renders `highlighter-rouge` markup at build time, then highlight.js (CDN, post pages only) re-highlights it client-side; `ignoreUnescapedHTML` suppresses the warning that causes.

## Content conventions

### Blog posts (`_posts/YYYY-MM-DD-slug.md`)

Front matter used by the layouts:

```yaml
layout: blog
title: "..."
date: YYYY-MM-DD
thumbnail: "/assets/img/<name>.png"   # card image and OG/Twitter image
categories: <one word>
```

`categories` becomes part of the published URL (two categories nest, e.g. `docker jekyll` gives `/docker/jekyll/...`). Changing a post's category or date breaks its existing link and fails `check-site.sh`.

The first paragraph is the excerpt (no `excerpt_separator`); cards render it with `strip_html | truncatewords: 30`. Existing posts follow it with the kramdown attribute line `{: class="post-cards_description"}`, which is now inert (harmless; not needed on new posts). Tag code fences with a language. Jekyll 4 builds with `future: false`, so a future-dated post is invisible until its date.

### Projects (`_projects/<name>.md`)

Front-matter only, no body. Fields: `name` (used as `data-project`, tests key on it; keep it unique and id-safe), `image` (root-relative), `image_alt`, `title`, `demo` (bare domain, optional; the template prepends `https://` and omits the "Live Preview" row when absent), `stack` (list), `description`.

Display order is `collections.projects.order` in `_config.yml`. Jekyll 4 honours it natively; `_includes/sections/portfolio.html` still builds an `ordered_projects` array by hand (kept from the Pages-3.10 era, harmless, renders unlisted projects last). Do not revert that loop to plain `site.projects`.

### CV (`CV/`)

XeLaTeX source: `CV/resume.tex` uses the local `resume.cls` and `\input`s sections from `CV/resume/*.tex`. There is no build script in the repo and no TeX toolchain on this machine; `cv.pdf` at the repo root is the committed output and must be regenerated and committed by hand after editing the `.tex` files. `CV/` and `cv.pdf` are excluded from the Docker image via `.dockerignore`.

## Tests

- `tests/unit/theme.test.js` (vitest + jsdom): the theme state machine in `js/theme.js`.
- `tests/integration/pages.spec.js` (Playwright, Chromium): every page in `tests/expected-pages.txt` returns 200 with no failed same-origin request, has a visible `h1`, the header nav and the theme toggle. Specs are transpiled to CommonJS (no `"type": "module"` in `package.json`), so use `__dirname`, not `import.meta`.
- `playwright.config.js` serves `_site/` with `serve --no-clean-urls` (a plain `serve` would 301 `/x.html` to `/x` and hide URL bugs).

## Repo workflow

- History is squash-merged PRs; `.github/workflows/request_review.yml` auto-requests review from `caddydz` on every PR.
- ImgBot opens daily image-optimization PRs (`.imgbotconfig`, aggressive compression). Its own PR body says to verify rendered resolution before merging.
