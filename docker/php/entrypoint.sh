#!/bin/bash

echo "Esperando a la base de datos..."

# Esperar a MySQL
while ! nc -z db 3306; do
  sleep 1
done

echo "Base de datos lista"

# Instalar dependencias
composer install

# Crear .env si no existe
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Generar key si no existe
php artisan key:generate

# Ejecutar migraciones
php artisan migrate --force

# Ejecutar seeders
php artisan db:seed --force

# Permisos
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Crear symlink (sin romper si ya existe)
php artisan storage:link || true

# Iniciar PHP-FPM
php-fpm