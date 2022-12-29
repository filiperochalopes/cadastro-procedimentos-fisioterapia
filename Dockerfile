FROM php:8.1-apache-bullseye

RUN mkdir -p /var/www/html/
WORKDIR /var/www/html/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN pecl install xdebug \
    && apt update \
    && apt install libzip-dev -y \
    && docker-php-ext-enable xdebug \
    && a2enmod rewrite \
    && docker-php-ext-install pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

COPY . .

ENV PHP_MEMORY_LIMIT=-1

RUN mkdir -p /var/www/html/twigcache
RUN chown -R www-data:www-data /var/www/html/twigcache/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json composer.json

ENV PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/var/www/html/vendor/bin

EXPOSE 80