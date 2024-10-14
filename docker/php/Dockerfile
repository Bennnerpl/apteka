FROM php:8.3-fpm

RUN apt-get update
RUN apt-get -y install mariadb-client
RUN apt-get -y install git zlib1g-dev libpng-dev libicu-dev libldap-dev libonig-dev libxml2-dev libzip-dev

RUN docker-php-ext-install opcache
RUN docker-php-ext-install intl
RUN docker-php-ext-install ldap
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install soap
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql

RUN apt-get install -y libfreetype6-dev libmcrypt-dev libjpeg-dev libpng-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --enable-gd
RUN docker-php-ext-install gd