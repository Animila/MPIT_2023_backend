FROM php:8.0-fpm

# Установка необходимых пакетов
RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Установка composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www/api

# Копирование исходного кода
COPY . .

# Установка зависимостей Laravel
COPY ./composer.json ./composer.lock ./
#RUN composer install --prefer-dist --no-ansi --no-interaction --no-scripts --no-progress --no-suggest


# Настройка прав на директории
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Конфигурирование приложения
#RUN php artisan key:generate

EXPOSE 9000

#CMD php artisan migrate && php artisan serve
