FROM php:8.4-cli

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev libonig-dev libxml2-dev libsqlite3-dev \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring exif pcntl bcmath gd \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY composer.json composer.lock artisan bootstrap/ app/ config/ database/ routes/ ./
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --ignore-platform-reqs --no-dev --optimize-autoloader --no-scripts

COPY . .

RUN COMPOSER_ALLOW_SUPERUSER=1 composer dump-autoload --optimize \
    && mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT"]
