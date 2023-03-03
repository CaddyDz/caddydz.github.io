# syntax=docker/dockerfile:1.2

FROM php:8.1-fpm

# Arguments defined in docker-compose.yml
# These values will be injected by Docker Compose at build time.
ARG USER=caddy-user
ARG UID=1000

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $UID -d /home/$USER $USER
RUN mkdir -p /home/$USER/.composer && \
	chown -R $USER:$USER /home/$USER

# Install system dependencies
RUN apt-get update && apt-get install -y \
	curl \
	libpng-dev \
	libonig-dev \
	libxml2-dev \
	libzip-dev \
	zip \
	unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install bcmath pdo_mysql exif pcntl gd zip

# Copy executable Composer file from the latest official Composer docker image
# in DockerHub to the PHP image we're building here
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Switch to the newly created user (as defined in docker-compose.yml)
# This is necessary for subsequent commands such as `composer install`
# PHP Composer prompts a warning for running it as root
USER $USER

# This mount type allows the build container to access secure files such as
# private keys without baking them into the image.
# Here we are mounting ~/.composer/auth.json which contains Laravel Nova
# credentials, setting the permission for $USER with ID 1000 as defined
# in docker-compose.yml
RUN --mount=type=secret,id=nova,required=true,src=$HOME/.composer/auth.json,target=/home/$USER/.composer \
	composer install --no-interaction --prefer-dist --optimize-autoloader

CMD [ "composer", "install" ]
