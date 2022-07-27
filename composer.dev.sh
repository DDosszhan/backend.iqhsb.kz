#!/usr/bin/env bash

PACKAGES_PATH='../../composer-packages'
REPOSITORIES="{
    \"type\": \"path\",
    \"url\": \"$PACKAGES_PATH/*/*\",
    \"options\": {
        \"symlink\": true
    }
}"

jq ".repositories[0] = $REPOSITORIES" composer.json > composer.dev.json
COMPOSER=composer.dev.json composer update
