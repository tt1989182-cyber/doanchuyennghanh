FROM php:8.2-cli

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

WORKDIR /var/www/html

# Copy code
COPY . .

# Cài composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Cài vendor
RUN composer install --no-dev --optimize-autoloader

# Tạo thư mục & quyền
RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 🚀 LẮNG NGHE ĐÚNG PORT RAILWAY
CMD php artisan serve --host=0.0.0.0 --port=${PORT}
