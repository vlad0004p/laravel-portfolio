# Stage 1: Composer + Node + PHP build tools
FROM php:8.2-cli AS build

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev \
    zip nodejs npm

# PHP extensions for Laravel
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip xml bcmath

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project files
COPY . .

# Prepare .env
RUN cp .env.example .env

# Install PHP dependencies
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction

# Generate app key
RUN php artisan key:generate

# Build frontend
RUN npm install && npm run build

# Stage 2: Runtime environment with Apache
FROM php:8.2-apache

# Enable mod_rewrite for Laravel routing
RUN a2enmod rewrite

# Set working directory to /var/www/html
WORKDIR /var/www/html

# Copy app files from previous build stage
COPY --from=build-stage /app /var/www/html

# Set document root to public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update Apache config to use public as the root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

