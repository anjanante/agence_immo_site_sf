FROM php:7.4-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN a2enmod rewrite

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo mysqli pdo_mysql intl zip gd

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
    mv composer.phar /usr/local/bin/composer


RUN apt-get update \
    && apt-get install -y libpq-dev libpng-dev nodejs npm \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable gd \
    && rm -rf /var/lib/apt/lists/* # Clean up

#Install Yarn
RUN npm install -g yarn

COPY . /var/www/

RUN mkdir -p var/cache var/log \
    && chown -R www-data:www-data var \
    && chmod -R 775 var

# USER www-data

COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

# RUN cd /var/www && \
#     composer install

WORKDIR /var/www/

ENTRYPOINT ["bash", "./docker/docker.sh"]

EXPOSE 80