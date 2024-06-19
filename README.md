## Install the project
* git clone
* composer install && npm install
* setup database && .env file
* php artisan migrate && php artisan db:seed
* Add google api key to your .env file

## Database dump
* Database dump is present in database folder

## Launching the project
* php artisan serve (or your preferred way) && npm run dev

## Launching linter
* composer lint

## Launching PHP tests
* php -dxdebug.mode=off artisan test --parallel
