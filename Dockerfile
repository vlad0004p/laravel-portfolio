# Stage 1: Node.js build for assets
FROM node:18-alpine AS node-build

WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Stage 2: Composer build
FROM composer:2.6 AS composer-build

WORKDIR /app
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . .
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction --optimize-autoloader

# Stage 3: PHP + Apache Runtime
FROM php:8.2-apache

# Install system dependencies and PHP extensions for Laravel + PostgreSQL
RUN apt-get update && apt-get install -y \
    libzip-dev unzip libpng-dev libonig-dev libxml2-dev zip curl git \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel app from composer build stage
COPY --from=composer-build /app /var/www/html

# Copy built assets from node build stage
COPY --from=node-build /app/public/build /var/www/html/public/build

# Set Apache DocumentRoot to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update Apache config to use new DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Create Laravel required directories
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache

# Set correct permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Expose Apache port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
