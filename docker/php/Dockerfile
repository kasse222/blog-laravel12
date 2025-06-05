FROM php:8.2-fpm-alpine

# Installer les dépendances système
RUN apk add --no-cache \
    bash zip unzip curl git mysql-client \
    libpng libpng-dev libjpeg-turbo-dev libwebp-dev freetype-dev \
    oniguruma-dev icu-dev libxml2-dev sqlite sqlite-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) pdo_mysql pdo_sqlite mbstring gd intl xml dom \
    && rm -rf /var/cache/apk/*

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . /var/www/html

# Copier le .env de production
COPY .env.prod /var/www/html/.env

# Installer les dépendances sans scripts artisan
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Assurer les permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R ug+rwX /var/www/html/storage /var/www/html/bootstrap/cache

RUN docker-php-ext-install opcache


# Point d’entrée
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
