This package allows you to send emails as a task from [ProcessMaker](https://github.com/ProcessMaker/bpm)

## Installation

1. Install this package via composer in your ProcessMaker root folder
```bash
composer require processmaker/bpm-package-email-connector
```

2. Then publish the necessary assets
```bash
php artisan vendor:publish --tag=bpm-package-email-connector --force
```

3. Then run the seeds to create the required script task
```bash
php artisan db:seed --class="ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder"
```
## Configuration

If don't already have it, your .env will need mail settings. For example:
```bash
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username
MAIL_PASSWORD=password
```

## Development

NOTE: If you make any changes to the email 
you need to build the SSR side of this package 
separately in resources/js/ssr. [See this readme for more info](resources/js/ssr/README.md)