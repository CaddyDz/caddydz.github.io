---
layout: blog
title: "Setup Jekyll runtime with Docker"
date: 2023-04-13
thumbnail: "/assets/img/gh-jekyll-docker.png"
categories: docker jekyll
---
To get a minimal Docker image (~46 MB) for your Jekyll site, write the following Dockerfile:

> Make sure to remove `jekyll` or any other [native Ruby extensions](https://guides.rubygems.org/gems-with-extensions/) from your `Gemfile`

```docker
# syntax=docker/dockerfile:1.2

FROM alpine:3.17
RUN apk add --no-cache jekyll
WORKDIR /srv
COPY . .
CMD [ "jekyll", "serve", "--livereload", "-H", "0.0.0.0" ]
EXPOSE 4000
```

This sets the very minimal `Alpine Linux` version 3.17 from the `DockerHub` registry as the base image (~15 MB).

Now, `Jekyll` is a native Ruby extension and thus requires installing `GCC`, `G++` and `Make` which increases the build time and the image size significantly (+340 MB) and so the trick is to install a ready binary from the [Alpine repository](https://pkgs.alpinelinux.org/package/edge/community/x86/jekyll) which in turns downloads all the dependencies including `Ruby`, `Gem` and `Bundle` resulting in a much smaller image (~46 MB)

### Build the image
```shell
docker build --no-cache -t my-jekyll-image .
```
### Start a container
Start a detached container mapping Jekyll's serving port and live reloading port to auto refresh the page on file changes mounting the current directory on your host system to the container's working directory
```shell
docker run --name my-jekyll-container -dp 4000:4000 -p 35729:35729 -v $(pwd):/srv my-jekyll-image
```
> You might need to wait a couple of seconds for the server to start

that's it