#!/bin/sh

set -e

echo "📡 Attente de MySQL sur $DB_HOST:$DB_PORT..."
until nc -z "$DB_HOST" "$DB_PORT"; do
  echo "⏳ MySQL pas prêt... on attend 1s"
  sleep 1
done
echo "✅ MySQL prêt !"

cd /var/www/html

if [ ! -f artisan ]; then
  echo "❌ Fichier artisan manquant — arrêt du script."
  exit 1
fi

echo "🎛 Configuration de l'application Laravel..."

echo "🧹 Nettoyage config & cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear || true
php artisan view:clear || true

echo "🔁 Génération des caches Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "📦 Découverte des packages..."
php artisan package:discover --ansi || true

echo "🔗 Lien symbolique de stockage..."
php artisan storage:link || true

echo "🔐 Attribution des permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwX storage bootstrap/cache

echo "🗃️ Exécution des migrations Laravel..."
php artisan migrate --force || true

echo "🚀 Lancement de php-fpm..."
exec php-fpm
