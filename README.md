This package allows you to send emails as a task from [ProcessMaker](https://github.com/ProcessMaker/bpm)

## Installation

1. Install this package via composer in your ProcessMaker root folder
```bash
composer require processmaker/pm4-connector-send-email
```

2. Setup the package with the php artisan command
```bash
php artisan pm4-connector-send-email:install
```

* Specify your MAIL_DRIVER 
* Specify your MAIL_HOST
* Specify your MAIL_PORT
* Specify your MAIL_USERNAME
* Specify your MAIL_PASSWORD

## Uninstall
* Use `php artisan pm4-connector-send-email:uninstall` to remove the package setup 
* Use `composer remove processmaker/pm4-connector-send-email` to remove the package

## Development

NOTE: If you make any changes to the email 
you need to build the SSR side of this package 
separately in resources/js/ssr. [See this readme for more info](resources/js/ssr/README.md)