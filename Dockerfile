# Tahap 1: Build
FROM php:8.3-fpm-alpine as build

# Instal dependensi sistem, ekstensi PHP yang diperlukan, dan Node.js
RUN apk add --no-cache \
    zip \
    libzip-dev \
    freetype \
    libjpeg-turbo \
    libpng \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    oniguruma-dev \
    gettext-dev \
    curl \
    git \
    nodejs \
    npm \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install bcmath gettext opcache exif

# Instal Composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

# Set direktori kerja
WORKDIR /var/www/html

# Salin file aplikasi
COPY . .

# Instal dependensi PHP dan Node.js
RUN composer install --no-dev --prefer-dist \
    && npm install \
    && npm run build

# Ubah kepemilikan dan izin
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Tahap 2: Production
FROM php:8.3-fpm-alpine

# Instal Nginx
RUN apk add --no-cache nginx

# Salin file dari tahap build
COPY --from=build /var/www/html /var/www/html

# Salin konfigurasi Nginx dan PHP
COPY ./deploy/nginx.conf /etc/nginx/http.d/default.conf
COPY ./deploy/php.ini "$PHP_INI_DIR/conf.d/app.ini"

# Set direktori kerja
WORKDIR /var/www/html

# Jalankan Nginx dan PHP-FPM
CMD ["sh", "-c", "nginx && php-fpm"]
