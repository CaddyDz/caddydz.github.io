# Personal website, blog, portfolio and CV

Jekyll site for https://dsalim.dev, styled with the [Glaz](https://orloop.com) Tailwind CSS template, built and deployed by GitHub Actions (`.github/workflows/pages.yml`).

## Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (Jekyll runs in a container; no Ruby needed on the host)
- Node 20+ (Tailwind build, tests)

## Development

```shell
git clone https://github.com/CaddyDz/caddydz.github.io dsalim && cd dsalim
npm ci
docker compose up -d --build
```

Open http://dsalim.localhost (requires a local [Traefik](https://traefik.io) on the external Docker network `traefik`, entrypoint `web`). The Compose stack runs two services:

- `tailwind`: watches `input.css` and writes `css/style.css` (gitignored, never committed)
- `web`: Jekyll 4 (`bundle exec jekyll serve --livereload`) on the bind-mounted repo, port 4000, live reload on 35729

Without Traefik: run the Tailwind watcher on the host (`npm run watch:css`) and

```shell
docker build -t caddydz/caddydz.github.io . && docker run --name dsalim.dev -dp 35729:35729 -p 4000:4000 -v $(pwd):/srv --rm caddydz/caddydz.github.io
```

then open http://localhost:4000.

> The Docker Hub image is a Jekyll runtime only: it does not contain `css/style.css`. Always run it with the repo bind-mounted and the Tailwind watcher running.

## Scripts

| Command | Description |
| --- | --- |
| `npm run build:css` | One-shot minified Tailwind build to `css/style.css` |
| `npm run watch:css` | Tailwind watch mode |
| `npm run check:site` | Verify the built `_site/`: every URL in `tests/expected-pages.txt` exists, CNAME present, no tooling files published |
| `npm test` | Vitest unit tests (`tests/unit/`) |
| `npm run test:e2e` | Playwright integration tests against `_site/` (or `PLAYWRIGHT_BASE_URL=http://dsalim.localhost` for the running stack) |

## Deployment

Merging to `master` runs `pages.yml`: `npm run build:css` → `bundle exec jekyll build` → `tests/check-site.sh` → tests → `actions/deploy-pages`. Pull requests run the same build and tests without deploying. The Pages source must be set to **GitHub Actions** in the repository settings.

`Gemfile.lock` must be regenerated inside the CI image, never with host Ruby:

```shell
docker run --rm -v "$PWD":/srv -w /srv ruby:3.3-slim sh -c "apt-get update -qq && apt-get install -y -qq build-essential >/dev/null && bundle lock --add-platform x86_64-linux aarch64-linux"
```
