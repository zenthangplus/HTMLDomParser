FROM php:7.1
WORKDIR /var/www
ADD . .
RUN chmod +x ./docker/build.sh && ./docker/build.sh
