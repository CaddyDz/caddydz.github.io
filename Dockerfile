# syntax=docker/dockerfile:1.2

FROM alpine:3.17
RUN apk add --no-cache jekyll
WORKDIR /srv
COPY . .
CMD [ "sh", "-c", "jekyll serve --trace --livereload --host 0.0.0.0" ]
EXPOSE 4000