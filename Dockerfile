# Используем официальный образ PHP с FPM
FROM php:8.2-fpm

# Устанавливаем системные зависимости и необходимые расширения PHP
RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Разрешаем запуск Composer от root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Устанавливаем зависимости для Laravel
WORKDIR /var/www
COPY . /var/www

# Убеждаемся, что все файлы принадлежат нужному пользователю
RUN chown -R www-data:www-data /var/www

# Устанавливаем зависимости
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Даем разрешение на запись в storage и cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Экспонируем порт
EXPOSE 9000

# Запускаем PHP-FPM
CMD ["php-fpm"]
