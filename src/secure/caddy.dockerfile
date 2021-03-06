FROM caddy:2.3.0-alpine

# Caddy config file
COPY caddy/Caddyfile /etc/caddy/Caddyfile

# Static files
COPY src/ /var/www/html

# Create uploads folder and set permission
RUN mkdir -p /var/www/uploads && \
    chown 82:82 /var/www/uploads

# Set working directory
WORKDIR /var/www/html
