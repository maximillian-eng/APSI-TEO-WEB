#!/bin/bash

set -e

echo "==> Environment check..."
echo "DB_CONNECTION=${DB_CONNECTION:-not set}"
echo "DB_HOST=${DB_HOST:-not set}"
echo "APP_KEY is ${APP_KEY:+set}${APP_KEY:-not set}"

if [ -z "$APP_KEY" ]; then
  echo "==> APP_KEY not set, generating one..."
  php artisan key:generate --force
fi

echo "==> Clearing build-time caches..."
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan event:clear 2>/dev/null || true

echo "==> Caching config/routes/views with runtime env vars..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

if [ "$IS_LARAVEL" = "true" ]; then
  if [ "$RAILPACK_SKIP_MIGRATIONS" != "true" ]; then
    echo "==> Running migrations..."
    php artisan migrate --force
  fi

  php artisan storage:link 2>/dev/null || true

  echo "==> Starting FrankenPHP server..."
fi

docker-php-entrypoint --config /Caddyfile --adapter caddyfile 2>&1
