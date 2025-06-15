# Stage 1: Build dependencies
FROM composer:2.6 AS build-stage

WORKDIR /app

# Allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy only composer files first to leverage Docker cache
COPY composer.json composer.lock ./

# Install PHP dependencies without dev tools
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction

# Copy the rest of the app files
COPY . .

# Stage 2: Runtime environment
FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy app files from build stage
COPY --from=build-stage /app /var/www/html

# Set correct permissions (Apache user)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Set document root if needed (for Laravel public folder)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update Apache config for new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose Apache HTTP port
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
