FROM php:8.2-rc-apache-bullseye

WORKDIR /var/www/html/

RUN pecl install xdebug \
    && apt update \
    && apt install libzip-dev -y \
    && docker-php-ext-enable xdebug \
    && a2enmod rewrite \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json composer.json
COPY composer.lock composer.lock

RUN groupadd -r user && useradd -r -g user user
USER user
RUN composer install --no-dev

COPY . .

EXPOSE 80