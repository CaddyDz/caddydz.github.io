# Dev/runtime image: the same locked Jekyll 4 that GitHub Actions builds with, plus a prebuilt
# css/style.css, so `docker run -p 4000:4000 caddydz/caddydz.github.io` serves a styled site on its own.
# In the compose dev loop the bind mount replaces /srv: the `tailwind` service (or `npm run watch:css`)
# writes css/style.css on the host and the image's copy is not used.

# Tailwind scans the templates (tailwind.config.js `content`), so this stage gets the whole context.
FROM node:22-alpine AS css
WORKDIR /src
COPY package.json package-lock.json ./
RUN npm ci --no-audit --no-fund
COPY . .
RUN npm run build:css

FROM ruby:3.3-slim

RUN apt-get update \
	&& apt-get install -y --no-install-recommends build-essential \
	&& rm -rf /var/lib/apt/lists/*

WORKDIR /srv

COPY Gemfile Gemfile.lock ./
RUN bundle install

COPY . .
COPY --from=css /src/css/style.css css/style.css

EXPOSE 4000 35729

CMD ["bundle", "exec", "jekyll", "serve", "--trace", "--livereload", "--host", "0.0.0.0", "--force_polling"]
