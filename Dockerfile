FROM devilbox/php-fpm-7.4:latest as cli

RUN sed -e 's/max_execution_time = 30/max_execution_time = 100/' -i  /usr/local/etc/php/docker-php.ini

RUN apt-get update && apt-get install -y git unzip curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_ALLOW_SUPERUSER=1

FROM cli
COPY . /app/
WORKDIR /app/

RUN composer install --optimize-autoloader --classmap-authoritative --no-interaction --prefer-dist --no-progress
