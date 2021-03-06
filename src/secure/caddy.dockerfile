FROM caddy:2.3.0-alpine

# Caddy config file
COPY caddy/Caddyfile /etc/caddy/Caddyfile

# Static files
COPY src/ /var/www/html
