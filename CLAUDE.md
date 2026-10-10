# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

Jekyll personal site for https://dsalim.dev (portfolio, blog, CV). No Gemfile, no package.json, no tests, no linter. Jekyll is not installed locally; Docker is the only dev path.

## Commands

```shell
# Build the dev image (Alpine + apk jekyll)
docker build --no-cache -t caddydz/caddydz.github.io .

# Serve with live reload, repo mounted into the container
docker run --name dsalim.dev -dp 35729:35729 -p 4000:4000 -v $(pwd):/srv --rm caddydz/caddydz.github.io
# then open http://localhost:4000

# Runtime only (pulls the published image, no local build)
docker run --name dsalim.dev -dp 4000:4000 --rm caddydz/caddydz.github.io

# Behind the local Traefik (external network `traefik`, entrypoint `web`): http://dsalim.localhost
docker compose up -d --build
```

`docker-compose.yml` and the plain `docker run` both publish port 35729 for live reload, so run only one at a time.

## Deployment

- **Production is GitHub Pages**, building `master` at `/` with the legacy Jekyll builder (custom domain via `CNAME`). Nothing in the repo deploys the site; merging to `master` is the deploy.
- `.github/workflows/docker.yml` only builds and pushes the dev/runtime image to Docker Hub on push to `master`. Put `[skip ci]` in the commit message to skip it.
- The Alpine `jekyll` package in the Docker image (4.x) and the GitHub Pages Jekyll (3.10) are independent; a local render is not a guarantee of the Pages render. Concrete example: `collections.projects.order` is a Jekyll 4 key that Pages ignores, which is why `_layouts/default.html` applies it by hand (see Projects below). Test anything version-sensitive against the `github-pages` gem before trusting it.
- `_site/` and `.jekyll-cache/` are build output and gitignored.

## Architecture

- **`index.md` is an empty shell.** The whole homepage lives in `_layouts/default.html`: nav, intro, resume, portfolio, testimonials, blog list, contact. It loops `site.projects` for the portfolio cards and again at the bottom to render one Bootstrap modal per project, and loops `site.posts` for the blog cards.
- **`_layouts/blog.html` wraps posts.** It captures OG/Twitter meta from `page.title`, `page.excerpt`, `page.thumbnail` and passes it into `_includes/head.html` as `og_meta`. The post body is followed by an "Other Posts" list and the shared contact include.
- **Frontend is vendored, no bundler.** jQuery 2.2.4, Bootstrap 4, Popper and the theme scripts live in `js/`; styling is one file, `css/app.css`. Bootstrap/normalize CSS, highlight.js, Font Awesome kit and fonts load from CDNs in `head.html` / `scripts.html`.
- **Code highlighting happens twice.** Rouge renders `highlighter-rouge` markup at build time, then highlight.js (CDN) re-highlights it client-side; `ignoreUnescapedHTML` suppresses the warning that causes.

## Content conventions

### Blog posts (`_posts/YYYY-MM-DD-slug.md`)

Front matter used by the layouts:

```yaml
layout: blog
title: "..."
date: YYYY-MM-DD
thumbnail: "/assets/img/<name>.png"   # also the OG/Twitter image
categories: <one word>
```

`categories` becomes part of the published URL under the default permalink (`/<category>/YYYY/MM/DD/<slug>.html`; two categories nest, e.g. `docker jekyll` gives `/docker/jekyll/...`). Changing a post's category breaks its existing link.

The first paragraph is the excerpt (no `excerpt_separator` is configured) and every existing post follows it with the kramdown attribute line `{: class="post-cards_description"}` so it styles correctly on the homepage card. Existing posts tag code fences with a language.

### Projects (`_projects/<name>.md`)

Front-matter only, no body. Fields: `name` (used as the modal DOM id `<name>Modal`, so keep it unique and id-safe), `image`, `image_alt`, `title`, `demo` (bare domain, the template prepends `https://`), `stack` (list), `description`.

Display order is `collections.projects.order` in `_config.yml`. Jekyll 4 honours that key natively but GitHub Pages (Jekyll 3.10) ignores it, so `_layouts/default.html` builds an `ordered_projects` array itself from `site.collections` and both project loops (cards and modals) iterate that array. Unlisted projects render last. **Do not revert those loops to plain `site.projects`**; that silently reverts production to filename order.

### CV (`CV/`)

XeLaTeX source: `CV/resume.tex` uses the local `resume.cls` and `\input`s sections from `CV/resume/*.tex`. There is no build script in the repo and no TeX toolchain on this machine; `cv.pdf` at the repo root is the committed output and must be regenerated and committed by hand after editing the `.tex` files. `CV/` and `cv.pdf` are excluded from the Docker image via `.dockerignore`.

## Repo workflow

- History is squash-merged PRs; `.github/workflows/request_review.yml` auto-requests review from `caddydz` on every PR.
- ImgBot opens daily image-optimization PRs (`.imgbotconfig`, aggressive compression). Its own PR body says to verify rendered resolution before merging.
