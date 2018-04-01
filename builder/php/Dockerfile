FROM php:7.2-rc-cli-alpine3.6

RUN buildDeps='coreutils su-exec>=0.2' HOME='/root' \
	&& set -x \
	&& apk add --update $buildDeps \
	&& apk add --no-cache --repository http://nl.alpinelinux.org/alpine/edge/community shadow \
	&& rm -rf /var/cache/apk/* \
;

RUN mkdir -p /scripts

RUN printf '#!/usr/bin/env sh\n\
HFOLDER=/home/docker\n\
IFILE=$HFOLDER/.initUser\n\
if [ ! -f "$IFILE" ]; then\n\
   \n\
    \n\
    \n\
    USER_ID=${LOCAL_USER_ID:-9001}\n\
    GROUP_ID=${LOCAL_GROUP_ID:-9001}\n\
    \n\
    mkdir -p $HFOLDER\n\
    \n\
    if [ $(getent group $GROUP_ID) ]; then\n\
         groupmod -n docker $(getent group $GROUP_ID | cut -d: -f1)\n\
    else\n\
         addgroup -g $GROUP_ID -S docker\n\
    fi\n\
    \n\
    if id $USER_ID >/dev/null 2>&1; then \n\
         deluser $(awk -v U=$USER_ID -F: '\''$3==U{print $1}'\'' /etc/passwd)\n\
    fi\n\
    adduser -u $USER_ID -D -S -h $HFOLDER -s /sbin/nologin -G docker docker\n\
    \n\
    chown -R $USER_ID:$GROUP_ID $HFOLDER\n\
    \n\
    touch $IFILE\n\
fi\n\
'\
>> /scripts/createUser.sh

RUN chmod u=rwx /scripts/createUser.sh
# Packages
# https://hub.docker.com/r/praekeltfoundation/alpine-buildpack-deps/
RUN apk --update add \
    autoconf \
    build-base \
    curl \
    freetype-dev \
    libjpeg-turbo-dev \
    libmcrypt-dev \
    libmcrypt \
    libltdl \
    libpng-dev \
    jpeg-dev \
    libbz2 \
    libstdc++ \
    libxslt-dev \
    zlib-dev\
    icu-dev \
    make \
    bzip2-dev \
    unzip

RUN set -ex && apk --no-cache add postgresql-dev && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-configure gd --with-png-dir=/usr/include --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install intl gd json bcmath zip bz2 mbstring pcntl xsl iconv pdo pdo_pgsql

ENV PHPREDIS_VERSION 3.1.4

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis

RUN apk del build-base && \
    docker-php-source delete && \
    rm -rf /var/cache/apk/*
    
RUN curl -L https://phar.phpunit.de/phpunit.phar -L -o phpunit.phar \
    && chmod +x phpunit.phar \
    && mv phpunit.phar /usr/local/bin/phpunit \
    && curl -sS https://getcomposer.org/installer | php \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer

RUN mkdir -p /var/log/php/cli
WORKDIR /var/www/app

COPY entrypoint.sh /
RUN chmod u=rwx /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["tail", "-f", "/dev/null"]