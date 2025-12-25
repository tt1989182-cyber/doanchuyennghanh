FROM php:8.2-apache

# Cài system libs + PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    bcmath \
    gd

# Enable apache rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copy source code
COPY . .

# CÀI COMPOSER
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# CÀI DEPENDENCIES (QUAN TRỌNG NHẤT)
RUN composer install --no-dev --optimize-autoloader

# Tạo thư mục & phân quyền
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80
