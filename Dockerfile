FROM php:8.1.4-apache-buster

COPY . /var/www/html

RUN apt-get update -y

RUN apt-get install zip unzip

RUN a2enmod rewrite

COPY docker/vhost-configs/vhost.local.conf /etc/apache2/sites-available/
COPY docker/vhost-configs/vhost.local.conf /etc/apache2/sites-enabled/
RUN rm /etc/apache2/sites-enabled/000-default.conf

# INSTALL COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
# INSTALL xdebug
RUN pecl install xdebug-3.1.3
RUN docker-php-ext-enable xdebug
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.discover_client_host = true" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_port = 9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

EXPOSE 80
ENTRYPOINT [ "/usr/sbin/apache2" ]
CMD ["-D", "FOREGROUND"]
