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

---

# Stage 2: Runtime environment with Apache
FROM php:8.2-apache

# Install dependencies required to install PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install only runtime PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip xml bcmath

# Set working directory
WORKDIR /var/www/html

# Copy built app from previous stage
COPY --from=build /app /var/www/html

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
