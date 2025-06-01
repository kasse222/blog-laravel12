#!/bin/sh
echo "📡 Attente de MySQL sur $DB_HOST:$DB_PORT..."
until nc -z -v -w30 "$DB_HOST" "$DB_PORT"; do
  echo "⏳ MySQL pas prêt... on attend"
  sleep 1
done
echo "✅ MySQL prêt !"

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec php-fpm
