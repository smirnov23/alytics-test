FROM php:8.3.14-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev libmcrypt-dev \
    && pecl install mcrypt \
    && docker-php-ext-install pgsql pdo_pgsql pdo sockets sodium \
    && docker-php-ext-enable mcrypt
