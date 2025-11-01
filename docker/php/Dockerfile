# PHP-FPM 8.3 with common extensions for Laravel + Postgres
FROM php:8.3-fpm-alpine

# Install dependencies
RUN apk add --no-cache     bash git unzip icu-dev oniguruma-dev libzip-dev zlib-dev     libpng libpng-dev jpeg-dev freetype-dev     postgresql-dev     linux-headers autoconf make g++

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg  && docker-php-ext-install -j$(nproc) gd intl mbstring exif pcntl zip opcache pdo pdo_pgsql bcmath

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configure PHP
RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory-limit.ini  && echo "opcache.enable=1" > /usr/local/etc/php/conf.d/opcache.ini  && echo "opcache.validate_timestamps=1" >> /usr/local/etc/php/conf.d/opcache.ini  && echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/opcache.ini
# Extensión Redis para PHP
RUN pecl install redis \
 && docker-php-ext-enable redis
# Instalar Node y npm dentro del contenedor PHP
RUN apk add --no-cache nodejs npm

# Create non-root user (UID 1000) for file permissions (works well on Linux/WSL)
RUN addgroup -g 1000 app && adduser -D -G app -u 1000 app
USER app

WORKDIR /var/www/html
