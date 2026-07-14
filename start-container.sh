#!/bin/bash

set -e

echo "==> Clearing build-time caches (env vars not available at build time)..."
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

    echo "==> Seeding database..."
    php artisan db:seed --force
  fi

  php artisan storage:link 2>/dev/null || true

  echo "==> Starting FrankenPHP server..."
fi

docker-php-entrypoint --config /Caddyfile --adapter caddyfile 2>&1
