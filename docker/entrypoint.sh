#!/bin/sh
set -e

cd /app

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache database
touch database/database.sqlite
chmod -R 775 storage bootstrap/cache database || true

if [ -z "$APP_KEY" ]; then
  echo "ERROR: APP_KEY is not set. Generate one with: php artisan key:generate --show"
  exit 1
fi

php artisan migrate --force
php artisan db:seed --force || true
php artisan config:clear || true
php artisan view:clear || true

exec frankenphp run --config /etc/caddy/Caddyfile
