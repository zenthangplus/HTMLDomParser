#!/usr/bin/env bash

##############################################################
# Script to run PHP unit on multiple PHP versions using Docker
##############################################################

phpVersion=$1

if ! [[ -x "$(command -v docker)" ]]
then
    echo "Docker doesn't exists or not executable."
    exit
fi

if ! [[ $phpVersion =~ ^[0-9]\.[0-9]+$ ]]
then
    echo "Invalid PHP version, please select a right format. Example: 5.6, 7.2"
    exit
fi

echo "Select PHP $phpVersion to run PHPUnit"
docker run --rm -v $(pwd):/var/www -w /var/www php:$phpVersion vendor/bin/phpunit
