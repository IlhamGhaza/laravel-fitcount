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

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy composer files first
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy package.json and package-lock.json
COPY package*.json ./

# Install Node.js dependencies
RUN npm ci

# Copy the rest of the application
COPY . .

# Build assets
RUN npm run build

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Create storage link
RUN php artisan storage:link

# Expose application port
EXPOSE 8000

# Set entrypoint
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
