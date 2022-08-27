FROM php:8.1-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y libpq-dev postgresql-client \
    && pecl install xdebug \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo 'xdebug.mode=coverage' >> /usr/local/etc/php/php.ini

