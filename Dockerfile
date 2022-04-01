FROM php:8.1.4-apache-buster

COPY . /var/www/html

RUN apt-get update -y

RUN apt-get install zip unzip

RUN a2enmod rewrite

COPY docker/vhost-configs/vhost.local.conf /etc/apache2/sites-available/
COPY docker/vhost-configs/vhost.local.conf /etc/apache2/sites-enabled/
RUN rm /etc/apache2/sites-enabled/000-default.conf

# php.ini
ADD docker/php.ini /usr/local/etc/php/conf.d

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# xdebug
RUN pecl install xdebug-3.1.3
RUN docker-php-ext-enable xdebug
COPY docker/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

EXPOSE 80
ENTRYPOINT [ "/usr/sbin/apache2" ]
CMD ["-D", "FOREGROUND"]
