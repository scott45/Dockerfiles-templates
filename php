FROM php:7.3.0RC1-cli-stretch

LABEL AUTHOR="Scott Businge <businge.scott@andela.com>"
LABEL app="app-name"

# install composer and required libraries
RUN apt-get update && apt-get install -y libpq-dev git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# copy files/folders into image
ADD ./folder /var/www
ADD ./folder /var/www/html

# copy scripts into image
ADD ./scripts/migrate.sh /var/www 

WORKDIR /var/www

RUN chmod +x migrate.sh

RUN composer install -n --prefer-dist

CMD [ "./migrate.sh" ]