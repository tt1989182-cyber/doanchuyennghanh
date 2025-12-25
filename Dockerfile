# Sử dụng PHP 8.2 với Apache
FROM php:8.2-apache

# Cài đặt extension cần thiết cho Laravel và MySQL
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql exif

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy source code vào container
COPY . /var/www/html

# Set thư mục làm việc
WORKDIR /var/www/html

# Cài đặt Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Tạo APP_KEY nếu chưa có
RUN php artisan key:generate --force

# Cache config để tăng tốc
RUN php artisan config:cache

# Railway cấp biến PORT, Apache cần trỏ vào thư mục public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Update Apache config để trỏ đúng thư mục Laravel
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf \
    && a2enmod rewrite

# Expose cổng Railway cấp
EXPOSE $PORT

# Khởi chạy Apache
CMD ["apache2-foreground"]
