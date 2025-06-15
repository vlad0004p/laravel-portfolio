# Stage 1: Composer build
FROM composer:2.6 AS build-stage

WORKDIR /app

# Allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy full app to allow artisan commands to work
COPY . .

# Install PHP dependencies without dev packages
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction


# Stage 2: PHP + Apache Runtime
FROM php:8.2-apache

# Install system dependencies and PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip libpng-dev libonig-dev libxml2-dev zip curl git \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel app from build stage
COPY --from=build-stage /app /var/www/html

# Set Apache DocumentRoot to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update Apache config to use new DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set correct permissions for Laravel
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data /var/www/html

# Clear and rebuild Laravel caches
RUN php artisan view:clear && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan cache:clear && \
    php artisan config:cache && \
    php artisan view:cache && \
    php artisan route:cache

# Optional: create storage symlink if needed
RUN php artisan storage:link || true

# Expose Apache port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
