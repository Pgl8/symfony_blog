FROM php:7.4-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev wget unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo

RUN wget https://get.symfony.com/cli/installer -O - | bash

RUN mv ~/.symfony/bin/symfony /usr/local/bin/symfony

WORKDIR /app
COPY . /app

RUN composer install

EXPOSE 8000
CMD symfony server:start