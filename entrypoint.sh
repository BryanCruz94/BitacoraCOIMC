#!/bin/bash

# Establecer permisos
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 777 /var/www/storage

# Refrescar las migraciones de la base de datos y ejecutar los seeders
php artisan migrate:fresh --seed --force

# Ejecutar el comando proporcionado
exec "$@"
