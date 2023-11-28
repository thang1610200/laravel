#Tạo image cho php
FROM php:8.1-fpm-alpine
#cài đặt 1 số thư viện trong php
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl
#cài đặt composer vào thư mục /usr/local/bin và đổi tên thành "composer"
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer