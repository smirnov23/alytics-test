FROM php:8.3.14-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev libmcrypt-dev libsodium-dev supervisor cron \
    && docker-php-ext-install pgsql pdo_pgsql pdo sockets sodium \
    && pecl install mcrypt \
    && docker-php-ext-enable mcrypt

COPY system/etc/supervisor/conf.d /etc/supervisor/conf.d
COPY system/etc/cron.d /etc/cron.d
