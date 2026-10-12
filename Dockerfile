FROM serversideup/php:8.4-fpm-nginx

USER root

# Install nodejs & npm untuk build aset
RUN apt-get update && apt-get install -y nodejs npm && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Salin semua source code ke image
COPY . .

# Install dependency composer & build asset Vite
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Berikan izin ke storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Jalankan storage link
RUN php artisan storage:link || true

USER www-data
