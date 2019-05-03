#!/usr/bin/env bash
apt-get update && apt-get -y install zip unzip
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
composer install
