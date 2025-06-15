FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev curl nodejs npm \
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

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install and build frontend assets
RUN npm install && npm run build

# Set Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Create Laravel directories
RUN mkdir -p /var/www/html/storage/logs \
             /var/www/html/storage/framework/cache \
             /var/www/html/storage/framework/sessions \
             /var/www/html/storage/framework/views \
             /var/www/html/bootstrap/cache

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create startup script using echo instead of heredoc
RUN echo '#!/bin/bash' > /startup.sh && \
    echo 'set -e' >> /startup.sh && \
    echo '' >> /startup.sh && \
    echo 'echo "=== STARTUP DEBUG ==="' >> /startup.sh && \
    echo 'echo "Current directory: $(pwd)"' >> /startup.sh && \
    echo 'echo "User: $(whoami)"' >> /startup.sh && \
    echo 'echo "PHP version: $(php -v | head -n1)"' >> /startup.sh && \
    echo '' >> /startup.sh && \
    echo 'echo "=== CHECKING LARAVEL ==="' >> /startup.sh && \
    echo 'if [ -f "artisan" ]; then' >> /startup.sh && \
    echo '    echo "✓ artisan file found"' >> /startup.sh && \
    echo '    php artisan --version || echo "✗ artisan failed"' >> /startup.sh && \
    echo 'else' >> /startup.sh && \
    echo '    echo "✗ artisan file not found"' >> /startup.sh && \
    echo 'fi' >> /startup.sh && \
    echo '' >> /startup.sh && \
    echo 'echo "=== CHECKING ENVIRONMENT ==="' >> /startup.sh && \
    echo 'if [ -f ".env" ]; then' >> /startup.sh && \
    echo '    echo "✓ .env file found"' >> /startup.sh && \
    echo 'else' >> /startup.sh && \
    echo '    echo "✗ .env file not found"' >> /startup.sh && \
    echo 'fi' >> /startup.sh && \
    echo '' >> /startup.sh && \
    echo 'echo "=== RUNNING LARAVEL SETUP ==="' >> /startup.sh && \
    echo 'php artisan config:cache' >> /startup.sh && \
    echo 'php artisan route:cache' >> /startup.sh && \
    echo 'php artisan view:cache' >> /startup.sh && \
    echo '' >> /startup.sh && \
    echo 'echo "=== CHECKING PERMISSIONS ==="' >> /startup.sh && \
    echo 'ls -la storage/ | head -5' >> /startup.sh && \
    echo 'ls -la bootstrap/cache/ | head -3' >> /startup.sh && \
    echo '' >> /startup.sh && \
    echo 'echo "=== TESTING APACHE CONFIG ==="' >> /startup.sh && \
    echo 'apache2ctl configtest' >> /startup.sh && \
    echo '' >> /startup.sh && \
    echo 'echo "=== STARTING APACHE ==="' >> /startup.sh && \
    echo 'exec apache2-foreground' >> /startup.sh

RUN chmod +x /startup.sh

EXPOSE 80

CMD ["/startup.sh"]
