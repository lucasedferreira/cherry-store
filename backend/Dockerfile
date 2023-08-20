FROM php:8.2.6-apache
RUN apt-get update && apt-get install -y wget gnupg2 libpq5 libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql pgsql
RUN apt install zip unzip
COPY --from=composer/composer:2-bin /composer /usr/bin/composer
WORKDIR /var/www
COPY composer.json .
RUN composer install && composer update
EXPOSE 9000
# RUN php index.php
# RUN php -S 0.0.0.0:8080