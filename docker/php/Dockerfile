FROM php:8.2-fpm-alpine

# Installer les dépendances système
RUN apk add --no-cache \
    bash \
    zip \
    unzip \
    curl \
    git \
    mysql-client \
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
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        pdo_sqlite \
        mbstring \
        gd \
        intl \
        xml \
        dom \
    && rm -rf /var/cache/apk/*

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet (exclure `.env`)
COPY . /var/www/html

# Permissions des dossiers Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R ug+rwX /var/www/html/storage /var/www/html/bootstrap/cache

# Entry point
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
