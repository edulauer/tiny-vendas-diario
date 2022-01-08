FROM php:7.4-apache
RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer 
ENV TZ="America/Sao_Paulo"
