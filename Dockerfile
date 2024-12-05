FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
    nginx \
    git \
    curl \
    zip \
    unzip \
    mysql-client \
    icu-dev \
    libxml2-dev \
    oniguruma-dev \
    libzip-dev \
    tzdata \
    nodejs \
    npm && \
    docker-php-ext-install \
    intl \
    pdo \
    pdo_mysql \
    mbstring \
    tokenizer \
    xml \
    bcmath \
    zip && \
    docker-php-ext-enable intl

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

RUN php artisan storage:link

COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
