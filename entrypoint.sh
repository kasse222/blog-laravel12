#!/bin/sh

set -e

echo "📡 Attente de MySQL sur $DB_HOST:$DB_PORT..."
until nc -z "$DB_HOST" "$DB_PORT"; do
  echo "⏳ MySQL pas prêt... on attend 1s"
  sleep 1
done
echo "✅ MySQL prêt !"

echo "🎛 Configuration de l'application Laravel..."

# Vérifier que les fichiers clés existent
if [ -f artisan ]; then
  php artisan config:clear
  php artisan cache:clear

  php artisan config:cache
  php artisan route:cache
  php artisan view:cache

  # Optionnel : créer les liens symboliques
  php artisan storage:link || true

  # Droits (optionnel)
  chown -R www-data:www-data storage bootstrap/cache
  chmod -R ug+rwX storage bootstrap/cache
else
  echo "⚠️ Artisan non trouvé ! Ce n'est peut-être pas un conteneur Laravel complet."
fi

exec php-fpm
