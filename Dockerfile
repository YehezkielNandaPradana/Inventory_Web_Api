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

COPY .docker/php/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 9000

HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD php-fpm -t || exit 1

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]
