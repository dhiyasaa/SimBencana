#!/bin/bash

# Tunggu hingga database siap
echo "Menunggu database siap..."
sleep 10

# Jalankan perintah migrasi
echo "Menjalankan migrasi database..."
php artisan migrate --force

# Jalankan perintah default (Apache)
exec "$@"