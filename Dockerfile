# syntax=docker/dockerfile:1.2

FROM alpine:3.17
RUN apk add --no-cache jekyll
WORKDIR /srv
COPY . .
CMD [ "jekyll", "serve", "--livereload", "-H", "0.0.0.0" ]
EXPOSE 4000