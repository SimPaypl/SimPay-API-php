# syntax=docker/dockerfile:1

FROM devilbox/php-fpm-7.4:latest AS cli

RUN sed -e 's/max_execution_time = 30/max_execution_time = 100/' -i  /usr/local/etc/php/docker-php.ini

RUN apt-get update && apt-get install -y git unzip curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_ALLOW_SUPERUSER=1

FROM cli
WORKDIR /app/

# Install dependencies from manifests only (layer cached across source changes);
# autoloader is generated after sources are copied
COPY composer.json composer.lock /app/
RUN --mount=type=cache,target=/root/.composer/cache \
    composer install --no-scripts --no-autoloader --no-interaction --prefer-dist --no-progress

COPY . /app/

RUN composer dump-autoload --optimize --classmap-authoritative --no-interaction
