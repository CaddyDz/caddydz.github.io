# syntax=docker/dockerfile:1.2

FROM ruby:alpine
RUN apk add --no-cache jekyll
WORKDIR /srv
COPY . .
CMD [ "jekyll", "serve", "--livereload", "-H", "0.0.0.0" ]
EXPOSE 4000