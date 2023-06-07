---
layout: blog
title: "Setup Jekyll runtime with Docker"
date: 2023-04-13
thumbnail: "/assets/img/gh-jekyll-docker.png"
categories: docker jekyll
---
To get a minimal Docker image (~43 MB) for your Jekyll site, write the following Dockerfile:

> Make sure to remove `jekyll` or any other [native Ruby extensions](https://guides.rubygems.org/gems-with-extensions/) from your `Gemfile`

```docker
# syntax=docker/dockerfile:1.2

FROM alpine:3.17
RUN apk add --no-cache jekyll
WORKDIR /srv
COPY . .
CMD [ "sh", "-c", "jekyll serve --trace --livereload --host 0.0.0.0" ]
EXPOSE 4000
```
- The syntax directive tells BuildKit backend to use the Official releases stable channel with patch updates.
- `FROM` sets the minimal `Alpine Linux` version 3.17 from the `DockerHub` registry as the base image (~15 MB).
- Now, `Jekyll` is a native Ruby extension and thus requires installing `GCC`, `G++` and `Make` which increases the build time and the image size significantly (+340 MB) and so the trick is to install a statically linked compiled binary from the [Alpine repository](https://pkgs.alpinelinux.org/package/edge/community/x86/jekyll) which in turns downloads all the dependencies including `Ruby`, `Gem` and `Bundle` resulting in a much smaller image (~46 MB).
- Create and set the working directory to `srv` (server) following Linux system directories naming conventions.
- Copy everything from the host working directory to `srv` (except files & folders as per `.dockerignore`)
- Declare a command to run when spawning a container out of this image
    - Execute [Bourne Shell](https://en.wikipedia.org/wiki/Bourne_shell) passing the command to run as a string using the `-c` flag.
    - Run the [Jekyll build command](https://jekyllrb.com/docs/configuration/options/#build-command-options) with the option:
        - `--trace` Show the full backtrace when an error occurs (stdout to Docker container logs).
    - Run the [serve sub-command](https://jekyllrb.com/docs/configuration/options/#serve-command-options) by Jekyll binary passing options
        - `--livereload` to reload a page automatically on the browser when its content is edited.
        - `--host` to listen at the given hostname `0.0.0.0` which means all available interfaces including Docker container created one.

---

### Build the image from the `Dockerfile` at the current directory
```shell
docker build --no-cache --tag my-jekyll-image .
```
- `--no-cache` to avoid any dangling corrupted build cache.
- `-t` to tag the image by the given name.

---

### Start a container
- Start a CLI detached container with a name mapping Jekyll's serving and live reloading ports to auto refresh the page on file changes bind mounting the current directory on your host system to the container's working directory volume to persist changes.
- `--rm` option removes the container when it stops (avoids name collision on next start).
```shell
docker run --name my-jekyll-container -dp 4000:4000 -p 35729:35729 -v $(pwd):/srv --rm my-jekyll-image
```
> You might need to wait a couple of seconds for the server to start

that's it