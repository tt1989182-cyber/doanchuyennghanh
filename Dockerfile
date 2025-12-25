FROM php:8.2-apache

# Cài extension cần thiết
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

# Copy source code
COPY . .

# Tạo thư mục nếu chưa tồn tại + phân quyền
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80
