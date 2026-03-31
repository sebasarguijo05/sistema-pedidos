FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip netcat-openbsd \
    libpng-dev libonig-dev libxml2-dev libzip-dev

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Copiar entrypoint
COPY docker/php/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh
RUN chown -R www-data:www-data /var/www

ENTRYPOINT ["/entrypoint.sh"]