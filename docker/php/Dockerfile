FROM php:fpm

# PDO installation
RUN docker-php-ext-install pdo_mysql

# Zip installation
RUN apt-get update
RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

# Composer and its dependencies
RUN apt-get install -y zip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /webroot
