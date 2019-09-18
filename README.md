This package allows you to send emails as a task from [ProcessMaker](https://github.com/ProcessMaker/processmaker)

## Installation

1. Install this package via composer in your ProcessMaker root folder
```bash
composer require processmaker/connector-send-email
```

2. Setup the package with the php artisan command
```bash
php artisan connector-send-email:install
```

* Specify your MAIL_DRIVER 
* Specify your MAIL_HOST
* Specify your MAIL_PORT
* Specify your MAIL_USERNAME
* Specify your MAIL_PASSWORD

## For use with GMail SMTP
 * Add `MAIL_ENCRYPTION=ssl` to your .env file
 * [Enable less secure apps for your gmail account](https://support.google.com/accounts/answer/6010255)

## Uninstall
* Use `php artisan connector-send-email:uninstall` to remove the package setup 
* Use `composer remove processmaker/connector-send-email` to remove the package
* If you have 2-factor authentication enabled, you will also need to [create an app password](https://security.google.com/settings/security/apppasswords)

## Development

NOTE: If you make any changes to the email 
you need to build the SSR side of this package 
separately in resources/js/ssr. [See this readme for more info](resources/js/ssr/README.md)
