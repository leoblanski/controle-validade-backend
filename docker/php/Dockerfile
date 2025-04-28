FROM php:8.2-fpm-alpine

ARG WORKDIR
WORKDIR $WORKDIR

RUN apk update && \
    apk add --update linux-headers && \
    apk add --no-cache util-linux \
    bash \
    git \
    curl \
    vim \
    nano \
    curl-dev \
    libxml2-dev \
    tzdata \
    icu-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    zlib-dev \
    libtool \
    libzip-dev \
    build-base \
    autoconf

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-stable \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install mysqli pdo pdo_mysql bcmath sockets curl soap zip pcntl gd intl

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY --from=composer:2.5.4 /usr/bin/composer /usr/local/bin/composer

RUN addgroup -g 1001 appuser && \
    adduser -D -u 1001 -G appuser appuser

COPY --chown=appuser:appuser . $WORKDIR

RUN chown -R appuser:appuser $WORKDIR

USER appuser

CMD ["php-fpm"]