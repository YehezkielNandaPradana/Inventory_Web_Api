#!/bin/bash

set -e

# When running as root, ensure Laravel writable directories are owned by www-data.
# This is required because the project is bind-mounted from the host,
# and www-data may not have write access to storage/ and bootstrap/cache/.
if [ "$(id -u)" = "0" ]; then
    chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
fi

# Install Composer dependencies if vendor is missing.
# This handles fresh repository clones where vendor was not pulled.
if [ ! -d "vendor" ]; then
    echo "[entrypoint] vendor directory not found. Installing Composer dependencies..."
    composer install --no-interaction --prefer-dist --no-progress
fi

# Ensure public/storage symlink exists for web dashboard assets.
if [ ! -e public/storage ] && [ -d storage/app/public ]; then
    echo "[entrypoint] Creating storage symlink..."
    php artisan storage:link || true
fi

exec "$@"
