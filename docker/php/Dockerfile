FROM php:8.2-fpm-alpine

# Installation des dépendances système
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
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring gd intl xml

# Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définition du répertoire de travail
WORKDIR /var/www/html

# Copie des fichiers de l'application
COPY . .

# Attribution des droits
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
