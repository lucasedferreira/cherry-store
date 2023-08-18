FROM php:8.2.6-apache
RUN apt-get update && apt-get install -y wget gnupg2 libpq5 libpq-dev
RUN docker-php-ext-install pgsql
# COPY src/ /var/www/html