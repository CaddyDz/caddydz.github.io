# Personal website, blog, portfolio and CV

## Installation Instructions
### Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
#### Runtime only
1. Run a container (downloads image from the default registry [Docker Hub](https://hub.docker.com/) ~49.45 MB)
- macOS
```shell
docker run --name dsalim.dev -dp 4000:4000 --rm caddydz/caddydz.github.io && open http://localhost
```
- Windows
```shell
docker run --name dsalim.dev -dp 4000:4000 --rm caddydz/caddydz.github.io && start "http://localhost"
```
#### Development
1. Clone the repository
```shell
git clone https://github.com/CaddyDz/caddydz.github.io Caddy
```
2. Change into the directory
```shell
cd Caddy
```
3. Build the Docker image
```shell
docker build --no-cache -t caddydz/caddydz.github.io .
```
4. Run a container binding the project into its volume
```shell
docker run --name dsalim.dev -dp 35729:35729 -p 4000:4000 -v $(pwd):/srv --rm caddydz/caddydz.github.io
```
> Port 35729 is bound for live reload
5. Open http://localhost:4000 in a browser