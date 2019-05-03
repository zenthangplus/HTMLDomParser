FROM php:7.0
WORKDIR /var/www
ADD . .
RUN chmod +x ./docker/build.sh && ./docker/build.sh
