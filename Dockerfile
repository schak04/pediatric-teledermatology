# syntax=docker/dockerfile:1.6

# ---- Frontend build ----
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm install --no-audit --no-fund
COPY . .
RUN npm run build

# ---- App ----
FROM php:8.3-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip libzip-dev libicu-dev libpng-dev libjpeg-dev libfreetype6-dev \
        libonig-dev libxml2-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_sqlite zip intl gd mbstring bcmath exif \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-scripts --no-autoloader

COPY . .
COPY --from=assets /app/public/build ./public/build

RUN composer dump-autoload --optimize --no-dev \
    && mkdir -p storage/framework/{cache,sessions,views} storage/logs database \
    && touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache database

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]
