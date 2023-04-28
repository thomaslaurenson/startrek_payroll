FROM php:8.0-fpm
LABEL MAINTAINER="Thomas Laurenson <thomas@thomaslaurenson.com>"

# Install MSQLi
RUN docker-php-ext-install mysqli

# Install PDO
RUN docker-php-ext-install pdo pdo_mysql
