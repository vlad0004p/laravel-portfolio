### Stage 1: Composer build stage
FROM composer:2.7 AS composer-stage

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction --no-scripts

COPY . .

RUN php artisan package:discover --ansi

### Stage 2: Node build stage (for Laravel Mix/Vite)
FROM node:20 AS node-stage

WORKDIR /app

COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

### Stage 3: Final PHP-Apache image
FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy PHP app from composer stage
COPY --from=composer-stage /app /var/www/html

# Copy built frontend assets from node stage (if applicable)
COPY --from=node-stage /app/public /var/www/html/public

# Set the Apache document root to Laravel's /public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Set permissions (optional, adjust as needed)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
