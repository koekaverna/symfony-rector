# syntax=docker/dockerfile:experimental
#####################
### Scratch image ###
#####################
FROM php:8.1.7-fpm-alpine3.15 AS development

RUN set -x \
    && apk add --no-cache --virtual .build-deps icu-dev \
    && docker-php-ext-install -j$(nproc) intl \
    && apk add --no-cache icu-libs \
    && apk del .build-deps

ENV REDIS_VERSION 5.3.7
RUN set -x \
    && mkdir -p /usr/src/php/ext/redis \
    && curl "https://pecl.php.net/get/redis/${REDIS_VERSION}" \
        | tar xvz --directory=/usr/src/php/ext/redis --strip=1 \
    && docker-php-ext-install -j$(nproc) redis \
    && rm -rf /usr/src/php/ext/redis

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN echo memory_limit=512M >> /usr/local/etc/php/conf.d/php.ini

COPY --from=registry.gitlab.com/eyecon/devops/docker/composer:2.1 /usr/bin/composer /usr/local/bin/composer
