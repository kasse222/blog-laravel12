#!/bin/bash

set -e

echo "⏳ Attente de la base de données MySQL ($DB_HOST)..."

# Boucle jusqu'à ce que MySQL réponde
until mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" -e "SELECT 1;" > /dev/null 2>&1; do
  echo "⏳ ...en attente de MySQL"
  sleep 2
done

echo "✅ MySQL est prêt. Lancement des migrations et seeders..."

php artisan migrate --seed --force

echo "🚀 Lancement de PHP-FPM..."
exec php-fpm
