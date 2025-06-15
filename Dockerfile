# Let's start with a very basic setup to isolate the issue
FROM php:8.2-apache

# Install only essential extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy everything
COPY . /var/www/html/

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN composer install --no-dev --optimize-autoloader || echo "Composer install failed"

# Create basic test files
RUN echo "<?php phpinfo(); ?>" > /var/www/html/public/phpinfo.php
RUN echo "<h1>Basic HTML Test</h1><p>If you see this, Apache is working</p>" > /var/www/html/public/test.html

# Set Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Create storage directories
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Show structure for debugging
RUN echo "=== Directory Structure ===" && \
    ls -la /var/www/html/ && \
    echo "=== Public Directory ===" && \
    ls -la /var/www/html/public/

EXPOSE 80
CMD ["apache2-foreground"]
