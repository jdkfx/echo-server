FROM php:8.1.1-apache
RUN docker-php-ext-install sockets
RUN apt-get update && apt-get install -y telnet