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
- `_config.yml` `exclude` lists every tooling file explicitly; `tests/check-site.sh` fails the build if any leaks into `_site/`.

## Hard invariants (CI enforces the first two)

- **Post URLs never change.** They come from front-matter `date` + `categories` (default permalink `/:categories/:year/:month/:day/:title.html`); three posts have front-matter dates that differ from their filenames (chmod, vue3, gh-pr). `tests/expected-pages.txt` lists every live page and `tests/check-site.sh` fails if one disappears (subset check: new posts are fine; add them to the list if you want them guarded).
- **All asset paths are root-relative** (`/css/style.css`, `/js/app.js`, `/img/...`, `/assets/img/...`) so they work from nested post URLs. Nav anchors are `/#about` etc. for the same reason.
- The inline theme script in `head.html` must stay inline (prevents a flash of the wrong theme).

## Architecture

- **Liquid Glass header:** the `.glass` material in `input.css` (driven by the `--glass-*` variables next to the theme variables) lives in `@layer components` so utilities like `absolute`/`lg:hidden` still win over it.
- **Sections:** `_includes/sections/{hero,trusted,about,resume,portfolio,testimonials,blog,contact}.html`. `about.html` is the Glaz markup pasted verbatim (services cards + 18-tool grid with inline SVGs). **Its SVG gradient/clipPath ids are unique only because it renders once per page: never loop it or include it from another layout.**
- **Data:** personal, resume and testimonial content lives in `_data/*.yml`. Edit it there, not in the includes.
- **OG/Twitter meta** lives in `head.html` under `{% if page.layout == "blog" %}` (a `capture` in a child layout is invisible to the parent). The GA4 tag in `scripts.html` is gated on `jekyll.environment == "production"`.
- **CSS:** `input.css` (Tailwind source + Glaz theme variables, light/dark via `:root.dark`/`:root.light`/`prefers-color-scheme`) → `tailwind.config.js` (explicit `content` globs: `_layouts`, `_includes`, `_posts`, `_projects`, `_data`, root `*.html|*.md`, `js`; `fontFamily` under `extend` so `font-mono` survives; typography palette mapped to the theme variables, invert set included). Body decor images are `/img/decor-*.webp`.
- **JS:** no jQuery, no vendor bundles. `js/theme.js` holds the pure, unit-tested theme functions; keep DOM code in `js/app.js`.
- **Code highlighting is Rouge only, at build time** (no client-side highlighter). Token colours are the `.highlight` rules in `input.css`, driven by the `--code-*` variables (light: GitHub, dark: Palenight); the typography plugin draws the `<pre>` box from `--code-bg`/`--code-fg`. Untagged fences render as plain text.

## Content conventions

### Blog posts (`_posts/YYYY-MM-DD-slug.md`)

Copy the front matter of an existing post (`thumbnail` doubles as the card and OG/Twitter image). `categories` becomes part of the published URL (two categories nest, e.g. `docker jekyll` gives `/docker/jekyll/...`). Changing a post's category or date breaks its existing link and fails `check-site.sh`.

The first paragraph is the excerpt (no `excerpt_separator`); cards render it with `strip_html | truncatewords: 30`. Existing posts follow it with the kramdown attribute line `{: class="post-cards_description"}`, which is now inert (harmless; not needed on new posts). Tag code fences with a language. Jekyll 4 builds with `future: false`, so a future-dated post is invisible until its date.

### Projects (`_projects/<name>.md`)

Front-matter only, no body; copy an existing project for the fields. `name` is used as `data-project` and tests key on it, so keep it unique and id-safe. `demo` is a bare domain and optional: the template prepends `https://` and omits the "Live Preview" row when absent.

Display order is `collections.projects.order` in `_config.yml`. Jekyll 4 honours it natively; `_includes/sections/portfolio.html` still builds an `ordered_projects` array by hand (kept from the Pages-3.10 era, harmless, renders unlisted projects last). Do not revert that loop to plain `site.projects`.

### CV (`CV/`)

XeLaTeX source: `CV/resume.tex` uses the local `resume.cls` and `\input`s sections from `CV/resume/*.tex`. There is no build script in the repo and no TeX toolchain on this machine; `cv.pdf` at the repo root is the committed output and must be regenerated and committed by hand after editing the `.tex` files.

## Tests

- Playwright specs are transpiled to CommonJS (no `"type": "module"` in `package.json`), so use `__dirname`, not `import.meta`.
- `playwright.config.js` serves `_site/` with `serve -c ../tests/serve.json` (`cleanUrls: false`; serve 14 has no `--no-clean-urls` flag). A plain `serve` would 301 `/x.html` to `/x` and hide URL bugs.

## Repo workflow

- History is squash-merged PRs; `.github/workflows/request_review.yml` auto-requests review from `caddydz` on every PR.
- ImgBot opens daily image-optimization PRs (`.imgbotconfig`, aggressive compression). Its own PR body says to verify rendered resolution before merging.
