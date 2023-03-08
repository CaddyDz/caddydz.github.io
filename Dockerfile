# syntax=docker/dockerfile:1.2

FROM ruby:alpine
RUN apk add --no-cache jekyll
# RUN set -eux; apk add --no-cache gcc g++ make && \
#   gem install jekyll

WORKDIR /srv
COPY . .
# RUN bundle install
CMD [ "jekyll", "serve", "--livereload", "-H", "0.0.0.0" ]
EXPOSE 4000