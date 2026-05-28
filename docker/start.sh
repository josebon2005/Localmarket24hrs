#!/bin/sh
set -e

PORT=${PORT:-8080}

# Create .env so Laravel's Dotenv doesn't throw (real values come from Railway env vars)
touch /var/www/html/.env

cd /var/www/html

# Run migrations
php artisan migrate --force

# Create storage symlink
php artisan storage:link --force 2>/dev/null || true

# Cache config/routes/views for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Inject $PORT into nginx config and write it as the active config
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf

# Hand off to supervisor (manages both php-fpm and nginx)
exec supervisord -c /etc/supervisord.conf
