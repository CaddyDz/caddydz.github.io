# Local dev image: the same locked Jekyll 4 that GitHub Actions builds with.
# css/style.css is NOT built here; run the Tailwind watcher (compose `tailwind` service
# or `npm run watch:css` on the host). The bind mount delivers it to Jekyll.
FROM ruby:3.3-slim

RUN apt-get update \
	&& apt-get install -y --no-install-recommends build-essential \
	&& rm -rf /var/lib/apt/lists/*

WORKDIR /srv

COPY Gemfile Gemfile.lock ./
RUN bundle install

COPY . .

EXPOSE 4000 35729

CMD ["bundle", "exec", "jekyll", "serve", "--trace", "--livereload", "--host", "0.0.0.0", "--force_polling"]
