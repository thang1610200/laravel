# FROM php:8.1.0-apache
# WORKDIR /var/www/html

# RUN a2enmod rewrite

# RUN apt-get update -y && apt-get install -y \
#     libicu-dev \
#     libmariadb-dev \
#     unzip zip \
#     zlib1g-dev \
#     libpng-dev \
#     libjpeg-dev \
#     libfreetype6-dev \
#     libjpeg62-turbo-dev \
#     libpng-dev 

# RUN apt-get install -y curl \
#     && curl -fsSL https://deb.nodesource.com/setup_21.x \
#     && apt-get install -y nodejs

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# RUN docker-php-ext-install gettext intl pdo_mysql gd

# RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd

FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
      freetype \
      libjpeg-turbo \
      libpng \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/*

RUN apk add libzip-dev

RUN apk add --update nodejs npm

RUN docker-php-ext-install pdo pdo_mysql zip bcmath