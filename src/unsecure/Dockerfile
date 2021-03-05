FROM php:7.4-fpm-alpine3.13

# Set work directory
WORKDIR /var/www/html

# Pre-setup
RUN docker-php-ext-install mysqli && \
    mkdir -p uploads && chown www-data:www-data uploads

# Copy PHP files
COPY src/ /var/www/html

# Downgrade user to non-root
USER www-data
