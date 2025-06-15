FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev curl \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Copy application
COPY . .

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies with error handling
RUN composer install --no-dev --optimize-autoloader --no-interaction || \
    (echo "Composer install failed, trying without optimization..." && \
     composer install --no-dev --no-interaction)

# Set Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Create Laravel directories with full paths
RUN mkdir -p /var/www/html/storage/logs \
             /var/www/html/storage/framework/cache \
             /var/www/html/storage/framework/sessions \
             /var/www/html/storage/framework/views \
             /var/www/html/bootstrap/cache

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create a startup script for better debugging
RUN cat > /startup.sh << 'EOF'
#!/bin/bash
set -e

echo "=== STARTUP DEBUG ==="
echo "Current directory: $(pwd)"
echo "User: $(whoami)"
echo "PHP version: $(php -v | head -n1)"

echo "=== CHECKING LARAVEL ==="
if [ -f "artisan" ]; then
    echo "✓ artisan file found"
    php artisan --version || echo "✗ artisan failed"
else
    echo "✗ artisan file not found"
fi

echo "=== CHECKING ENVIRONMENT ==="
if [ -f ".env" ]; then
    echo "✓ .env file found"
else
    echo "✗ .env file not found"
fi

echo "=== CHECKING PERMISSIONS ==="
ls -la storage/ | head -5
ls -la bootstrap/cache/ | head -3

echo "=== TESTING APACHE CONFIG ==="
apache2ctl configtest

echo "=== TESTING PHP ==="
php -r "echo 'PHP test: OK\n';"

echo "=== STARTING APACHE ==="
exec apache2-foreground
EOF

RUN chmod +x /startup.sh

EXPOSE 80

# Use the startup script
CMD ["/startup.sh"]
