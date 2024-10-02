# Use the official PHP image with Apache
FROM php:8.1-apache

# Install required extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_pgsql zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set the ServerName to suppress warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set the working directory
WORKDIR /var/www/html

# Copy the application code into the container
COPY . .

# Set proper permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies and optimize autoloader
RUN composer install --no-dev --optimize-autoloader

# Dump Composer's autoload files
RUN composer dump-autoload

# Expose port 80 for Apache
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
