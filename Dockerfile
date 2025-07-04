FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory inside the container
WORKDIR /var/www/html

# Copy Laravel files to container
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Set Apache to use Laravel's public directory as the web root
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Install PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    zip unzip libzip-dev libonig-dev libxml2-dev curl git \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Run Composer install
RUN composer install --optimize-autoloader --no-dev

# Expose port 80
EXPOSE 80
