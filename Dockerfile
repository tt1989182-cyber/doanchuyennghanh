# Sử dụng PHP 8.2 với Apache
FROM php:8.2-apache

# Cài đặt các extension cần thiết cho Laravel + MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy toàn bộ source code vào container
COPY . /var/www/html

# Set thư mục làm việc
WORKDIR /var/www/html

# Cài đặt dependencies
RUN composer install --no-dev --optimize-autoloader

# Tạo APP_KEY nếu chưa có
RUN php artisan key:generate --force

# Cache config để tăng tốc
RUN php artisan config:cache

# Railway sẽ tự cấp biến $PORT, Apache sẽ dùng để expose
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Update Apache config để trỏ vào thư mục public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf \
    && a2enmod rewrite

# Expose port từ Railway
EXPOSE $PORT

# Start Apache
CMD ["apache2-foreground"]
