FROM php:8.0-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    vim \
    bsd-mailx \
    libsasl2-modules \
    default-mysql-client \
    && docker-php-ext-install mysqli pdo_mysql zip opcache

RUN DEBIAN_FRONTEND=noninteractive apt-get install postfix -y

WORKDIR /var/www

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin

RUN composer global require "laravel/installer"

WORKDIR /var/www/Laravel_Forum-B
