FROM php:8.2-apache

# Cài các extension cần cho Laravel + Filemanager
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

# Enable rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html
COPY . .

# Phân quyền
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
