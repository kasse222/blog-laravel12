FROM php:8.2-fpm-alpine

# Installer les dépendances système
RUN apk add --no-cache \
    bash \
    zip \
    unzip \
    curl \
    git \
    libpng \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    oniguruma-dev \
    icu-dev \
    libxml2-dev \
    sqlite \
    sqlite-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_sqlite \
        mbstring \
        gd \
        intl \
        xml \
    && rm -rf /var/cache/apk/*

# Installer Composer (depuis l'image officielle)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet (le minimum en prod)
COPY . .

# Donner les bons droits d’accès
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Permettre au conteneur de démarrer avec PHP-FPM
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

