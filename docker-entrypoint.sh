#!/bin/sh
set -e

# Copy .env.example to .env if .env doesn't exist
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Ensure SQLite file and directory permissions exist
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    mkdir -p /var/www/html/database
    touch /var/www/html/database/database.sqlite
    chown -R www-data:www-data /var/www/html/database
    chmod -R 777 /var/www/html/database
fi

# Generate APP_KEY if not set or empty
if ! grep -q "APP_KEY=base64:" /var/www/html/.env && [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Set Permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Run database migrations and seeders
php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction

# Clear all caches so new routes and config are immediately live
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Execute CMD
exec "$@"
