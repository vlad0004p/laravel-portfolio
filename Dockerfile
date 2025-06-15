# Stage 1: Build dependencies
FROM composer:2 AS vendor

WORKDIR /app

# Copy the full Laravel project, not just composer.json
COPY . .

RUN composer install --no-dev --prefer-dist --no-progress --no-interaction

# Stage 2: Build application
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PHP extensions (typical for Laravel)
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl

WORKDIR /var/www/html

COPY --from=vendor /app /var/www/html

# Set proper permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copy Apache vhost config if needed (optional)
# COPY vhost.conf /etc/apache2/sites-available/000-default.conf
