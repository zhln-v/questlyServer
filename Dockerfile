# Используем официальный образ PHP с FPM
FROM php:8.2-fpm

# Устанавливаем необходимые расширения
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libpq-dev && docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd pdo pdo_pgsql

# Копируем файл composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем зависимости для Laravel
WORKDIR /var/www
COPY . /var/www
RUN composer install --no-interaction --prefer-dist

# Даем разрешение на запись в папку storage
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Экспонируем порт
EXPOSE 9000
CMD ["php-fpm"]
