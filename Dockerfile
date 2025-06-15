# Stage 1: Composer + Node setup
FROM php:8.2-cli AS build

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev \
    zip nodejs npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip xml bcmath

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy app files
COPY . .

# Make sure .env exists before composer install (Laravel needs it)
RUN cp .env.example .env

# Install PHP dependencies
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction

# Generate app key
RUN php artisan key:generate

# Build frontend
RUN npm install && npm run build

# Run DB migrations (optional if you want them baked in)
# RUN php artisan migrate --seed

### ---

# Stage 2: Production PHP + Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PHP extensions again for runtime
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip xml bcmath

# Set working directory
WORKDIR /var/www/html

# Copy app from build stage
COPY --from=build /app /var/www/html

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port
EXPOSE 80
