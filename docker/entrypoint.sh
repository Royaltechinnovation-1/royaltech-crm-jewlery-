#!/bin/bash
set -e

cd /app

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache database
touch database/database.sqlite
chown -R www-data:www-data storage bootstrap/cache database || true
chmod -R 775 storage bootstrap/cache database || true

if [ -z "$APP_KEY" ]; then
  echo "ERROR: APP_KEY is not set"
  exit 1
fi

# Render sets PORT; point Apache at it
export PORT="${PORT:-10000}"
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf

php artisan migrate --force
php artisan db:seed --force || true
php artisan config:clear || true
php artisan view:clear || true
php artisan route:clear || true

exec apache2-foreground
