FROM php:7.4-fpm-alpine3.13

# Set work directory
WORKDIR /var/www/html

# Pre-setup
RUN docker-php-ext-install mysqli

# Copy PHP files
COPY src/ /var/www/html

# Setup uploads folder
RUN mkdir -p /var/www/uploads && \
    chown www-data:www-data /var/www/uploads

# Downgrade user to non-root
USER www-data
