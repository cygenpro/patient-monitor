FROM php:7.4-apache

COPY . /var/www
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/server.crt /etc/apache2/ssl/server.crt
COPY .docker/server.key /etc/apache2/ssl/server.key

WORKDIR /var/www

RUN apt-get update
RUN apt-get install -y apt-utils net-tools libmcrypt-dev libmcrypt4 vim libpng-dev libonig-dev git libxslt1-dev libzip-dev
RUN apt-get install git zip wget
RUN docker-php-ext-install calendar mbstring pdo pdo_mysql mysqli gd pcntl
RUN docker-php-ext-install zip xsl

RUN pecl install xdebug

RUN docker-php-ext-enable xdebug

RUN echo 'xdebug.default_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_autostart=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_handler=dbgp' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_connect_back=0' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.idekey="DRG_DEBUG"' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_host="host.docker.internal"' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_log="/tmp/xdebug.log"' >> /usr/local/etc/php/php.ini

RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/ssl-cert-snakeoil.key -out /etc/ssl/certs/ssl-cert-snakeoil.pem -subj "/C=AT/ST=Vienna/L=Vienna/O=Security/OU=Development/CN=oms-mw.local"

RUN a2enmod rewrite
RUN a2enmod ssl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chown -R www-data:www-data /var/www/public
RUN chown -R www-data:www-data /var/www/storage
RUN service apache2 restart
