#!/bin/sh
set -e

# Copy .env.example to .env if .env doesn't exist
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Ensure SQLite file exists if using sqlite
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    mkdir -p /var/www/html/database
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
fi

# Generate APP_KEY if not set or empty
if ! grep -q "APP_KEY=base64:" /var/www/html/.env && [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Set Permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Run database migrations
php artisan migrate --force --no-interaction

# Cache config, routes, and views
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Execute CMD
exec "$@"
