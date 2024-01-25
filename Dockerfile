# FROM php:8.1-fpm-alpine

# ARG user
# ARG uid

# WORKDIR /var/www/html

# RUN apk add --no-cache \
#       freetype \
#       libjpeg-turbo \
#       libpng \
#       freetype-dev \
#       libjpeg-turbo-dev \
#       libpng-dev \
#     && docker-php-ext-configure gd \
#       --with-freetype=/usr/include/ \
#       --with-jpeg=/usr/include/ \
#     && docker-php-ext-install -j$(nproc) gd \
#     && docker-php-ext-enable gd \
#     && apk del --no-cache \
#       freetype-dev \
#       libjpeg-turbo-dev \
#       libpng-dev \
#     && rm -rf /tmp/*

# RUN apk add libzip-dev

# RUN apk add --update nodejs npm

# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user

# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# COPY composer.json composer.lock ./
# RUN composer install --no-dev --optimize-autoloader --no-scripts

# RUN docker-php-ext-install pdo pdo_mysql zip bcmath

FROM php:8.2-fpm

ARG user=thang
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    nginx \
    build-essential \
    openssl

RUN docker-php-ext-install gd pdo pdo_mysql sockets

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www/html

# If you need to fix ssl
#COPY ./openssl.cnf /etc/ssl/openssl.cnf

COPY composer.json composer.lock ./
RUN composer update
#RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .

RUN chown -R $uid:$uid /var/www/html