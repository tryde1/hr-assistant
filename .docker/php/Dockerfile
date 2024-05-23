FROM php:8.3-fpm

COPY ./composer.lock ./composer.json /var/www/html/

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libicu-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip opcache intl
RUN curl -sLS https://deb.nodesource.com/setup_21.x | bash - && \
      apt-get install -y nodejs && \
      npm install -g npm
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www/html
COPY .docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY --chown=www:www . /var/www/html

RUN composer install

USER www

EXPOSE 9000
CMD ["php-fpm"]
