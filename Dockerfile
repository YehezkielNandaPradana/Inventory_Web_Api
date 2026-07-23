FROM php:8.3-fpm-alpine

# Install system dependencies and build tools
RUN set -ex \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
        libpng-dev \
        libjpeg-turbo-dev \
        libwebp-dev \
        libfreetype6-dev \
        libzip-dev \
        libxslt-dev \
        icu-dev \
        oniguruma-dev \
        libxml2-dev \
        mariadb-connector-c-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        bcmath \
        exif \
        gd \
        zip \
        intl \
        pcntl \
        opcache \
        sockets \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps \
    && apk add --no-cache \
        bash \
        nodejs \
        npm \
        git \
        curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-interaction --prefer-dist

# Copy application source
COPY . .

# Optimize autoloader
RUN composer dump-autoload --optimize \
    && mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p bootstrap/cache \
    && if [ ! -e public/storage ] && [ -d storage/app/public ]; then \
        ln -s /var/www/html/storage/app/public /var/www/html/public/storage; \
    fi \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD php-fpm -t || exit 1

CMD ["php-fpm"]
