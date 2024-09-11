#!/bin/bash

# PROD IF MIGRATIONS
php bin/console doctrine:migrations:migrate
php bin/console cache:clear


# DEV ONLY
# php bin/console doctrine:database:drop --force
# php bin/console doctrine:database:create
# php bin/console doctrine:schema:create
# php bin/console doctrine:fixtures:load -n
# rm *.zip