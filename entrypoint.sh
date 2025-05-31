#!/bin/bash

echo "⏳ Attente de la base de données MySQL ($DB_HOST)..."

# Boucle jusqu'à ce que MySQL réponde
until mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" -e "SELECT 1;" > /dev/null 2>&1; do
  sleep 2
  echo "⏳ ...en attente de MySQL"
done

echo "✅ MySQL est prêt. Lancement des migrations et seeders..."

# Migrations et seed
php artisan migrate --seed --force

# Démarrer PHP-FPM
exec php-fpm
