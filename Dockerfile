FROM php:8.0.3-alpine

LABEL maintainer="roberto.diana@gmail.com"
COPY src /var/www/html/src
WORKDIR /var/www/html/



