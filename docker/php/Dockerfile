FROM php:8.2-fpm

WORKDIR /var/www

EXPOSE 9000

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
      procps\
      libpng-dev \
      libonig-dev \
      libxml2-dev \
      zip \
      unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd


