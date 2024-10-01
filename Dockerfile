FROM php:8.1-apache

# Install required extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite \
    && docker-php-ext-install pdo_pgsql zip

# Set DocumentRoot to Laravel's public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www|/var/www/html/public|g' /etc/apache2/apache2.conf

# Copy the app code into the container
COPY . /var/www/html

# Set proper permissions for Laravel
RUN chown -R www-data:www-data /var/www/html /var/www/html/storage /var/www/html/bootstrap/cache

# Set working directory
WORKDIR /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies and optimize autoloader
RUN composer install --no-dev --optimize-autoloader

# Ensure the correct permissions for storage and cache directories
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Run migrations and seeder commands (optional, only if needed on every build)
# RUN php artisan migrate --force && php artisan db:seed --force

# Expose port 80 for Apache
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
