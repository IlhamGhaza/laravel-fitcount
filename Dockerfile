# Base image
FROM php:8.2-fpm-alpine

# Install dependencies
RUN apk add --no-cache \
    bash \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    libxml2-dev \
    freetype-dev \
    git \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install gd pdo pdo_mysql \
    && npm install -g npm@latest \
    && npm install -g vite


# Set working directory
WORKDIR /var/www

# Copy composer.lock and composer.json
COPY composer.json composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies via Composer
RUN composer install --no-autoloader --no-scripts

# Copy the rest of the application code
COPY . .

# Install Node.js dependencies (for Vite)
RUN npm install

# Build assets with Vite
RUN npm run build

# Set correct permissions
RUN chown -R www-data:www-data /var/www

# Expose PHP-FPM port
EXPOSE 9000

# Run the application
CMD ["php-fpm"]
