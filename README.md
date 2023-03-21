# Personal website, blog, portfolio and CV

## Installation Instructions
### Prerequisites
- Docker Desktop
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
docker build --no-cache -t caddy-img .
```
4. Run a container binding the project into its volume
```shell
docker run -dp 4000:4000 -v $(pwd):/srv test
```
5. Open http://localhost:4000 in a browser