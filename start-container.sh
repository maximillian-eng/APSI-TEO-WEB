#!/bin/sh
set -e

echo "==> Clearing build-time caches..."
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan event:clear 2>/dev/null || true

echo "==> Caching config with runtime env vars..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Creating SQLite database if needed..."
touch database/database.sqlite

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Seeding database..."
php artisan db:seed --force

echo "==> Creating storage symlink..."
php artisan storage:link 2>/dev/null || true

echo "==> Starting server..."
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
