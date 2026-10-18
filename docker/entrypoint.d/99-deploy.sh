#!/bin/sh
echo "==> Running auto-deploy tasks..."
php /var/www/html/artisan migrate --force || true
php /var/www/html/artisan storage:link || true
echo "==> Auto-deploy tasks complete!"
