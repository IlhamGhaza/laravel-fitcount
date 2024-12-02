# Base image with PHP 8.3 and Alpine
FROM php:8.3-cli-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    bash \
    zip \
    unzip \
    mysql-client \
    icu-dev \
    libxml2-dev \
    oniguruma-dev \
    libzip-dev \
    tzdata && \
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

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install Node.js and npm
RUN apk add --no-cache nodejs npm

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
RUN npm install && npm run build

# Expose application port
EXPOSE 8000

# Set entrypoint
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
