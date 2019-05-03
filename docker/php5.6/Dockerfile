FROM php:5.6
WORKDIR /var/www
ADD . .
RUN chmod +x ./docker/build.sh && ./docker/build.sh
