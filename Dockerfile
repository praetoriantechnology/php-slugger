FROM php:8.1-cli

VOLUME [ "/var/www/html"]
RUN mkdir ~/.ssh/
COPY __build/ssh /root/.ssh/
RUN chmod 700 -R ~/.ssh
WORKDIR /var/www/html
# install system deps
RUN apt-get update \
    && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev libpng-dev zlib1g-dev libicu-dev g++ libxml2-dev git zip wget ca-certificates libmpdec-dev libzip-dev curl

# install lib deps
RUN docker-php-ext-configure opcache && docker-php-ext-install opcache
RUN docker-php-ext-configure intl && docker-php-ext-install intl
RUN docker-php-ext-configure xml && docker-php-ext-install xml
RUN docker-php-ext-configure bcmath && docker-php-ext-install bcmath
RUN docker-php-ext-configure zip && docker-php-ext-install zip

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN echo 'xdebug.mode=develop,debug,coverage' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.client_host=host.debug.internal' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.start_with_request=yes' >> /usr/local/etc/php/php.ini
RUN echo 'session.save_path = "/tmp"' >> /usr/local/etc/php/php.ini

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# configure limits
RUN echo 'memory_limit=1024M' > /usr/local/etc/php/conf.d/memory_limit.ini
ENTRYPOINT [ "php" ]
CMD ["-F"]