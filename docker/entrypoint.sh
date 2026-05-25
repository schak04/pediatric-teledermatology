#!/usr/bin/env bash
set -e

cd /var/www/html

if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi
chown -R www-data:www-data storage bootstrap/cache database

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

if [ ! -L public/storage ]; then
    php artisan storage:link || true
fi

exec "$@"
