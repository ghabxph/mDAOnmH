FROM php:7.4-fpm-alpine3.13

# Pre-setup
RUN docker-php-ext-install mysqli

# Copy PHP files
COPY src/ /var/www/html
