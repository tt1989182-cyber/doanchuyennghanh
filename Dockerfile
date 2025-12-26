FROM php:8.2-apache

# ===============================
# 1. Cài extension cần cho Laravel
# ===============================
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# ===============================
# 2. Bật Apache rewrite
# ===============================
RUN a2enmod rewrite

# ===============================
# 3. Cấu hình Apache trỏ về /public
# ===============================
RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

# ===============================
# 4. Set thư mục làm việc
# ===============================
WORKDIR /var/www/html

# ===============================
# 5. Copy source code
# ===============================
COPY . .

# ===============================
# 6. Cài Composer
# ===============================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ===============================
# 7. Cài dependency Laravel
# ===============================
RUN composer install --no-dev --optimize-autoloader

# ===============================
# 8. Phân quyền cho Laravel
# ===============================
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ===============================
# 9. Cache config (KHÔNG cần .env)
# ===============================
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

# ===============================
# 10. Expose port
# ===============================
EXPOSE 80
