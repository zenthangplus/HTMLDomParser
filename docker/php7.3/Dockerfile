FROM php:7.3
WORKDIR /var/www
ADD . .
RUN chmod +x ./docker/build.sh && ./docker/build.sh
