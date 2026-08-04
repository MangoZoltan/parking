# syntax=docker/dockerfile:1

FROM php:8.3.30-apache

RUN docker-php-ext-install pdo pdo_mysql

# Use the default production configuration for PHP runtime arguments, see
# https://github.com/docker-library/docs/tree/master/php#configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Copy app files from the app directory.
COPY ./project /var/www/html

# Switch to a non-privileged user (defined in the base image) that the app will run under.
# See https://docs.docker.com/go/dockerfile-user-best-practices/
USER www-data
