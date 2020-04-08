FROM php:7.2-apache

RUN apt-get update -y && apt-get install -y supervisor

RUN apt-get install -y nano locales-all libzip-dev libgd-dev libpng-dev && /etc/init.d/supervisor start

RUN docker-php-ext-install zip pdo_mysql gd

RUN a2enmod rewrite