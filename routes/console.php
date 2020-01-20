<?php

Artisan::command('connector-send-email:install', function () {
    Artisan::call('vendor:publish',
        [
            '--tag' => 'connector-send-email',
            '--force' => true
        ]
    );
    Artisan::call('db:seed',
        [
            '--class' => 'ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder',
            '--force' => true
        ]
    );
    /* In case to add parameters to .env file */
    $envPath = base_path('.env');
    if (file_exists($envPath)) {
        $envContent = file_get_contents($envPath);

        $addEnv = function($name, $ask, $default = null, $method = 'ask') use (&$envContent) {
            if (!isset($_ENV[$name])) {
                $value = $this->$method($ask, $default);
                $envContent .= "\n{$name}={$value}";
                return $value;
            }
            return $_ENV[$name];
        };

        $path = $addEnv('NODE_BIN_PATH', __("Enter path to your Node.js executable"), '/usr/bin/node');
        exec($path. " --version", $_out, $returnValue);
        if ($returnValue !== 0) {
            $this->error(__("Node executable at {$path} not found or can not be run"));
            return;
        }
        $addEnv('MAIL_DRIVER', __("Enter your MAIL DRIVER"), 'smtp');
        $addEnv('MAIL_HOST', __("Enter your MAIL HOST"), 'smtp.yourmail.com');
        $addEnv('MAIL_PORT', __("Enter your MAIL PORT"), '2525');
        $addEnv('MAIL_USERNAME', __("Enter your MAIL USERNAME"));
        $addEnv('MAIL_PASSWORD', __("Enter your MAIL PASSWORD (hidden)"), null, 'secret');

        file_put_contents($envPath, $envContent);
    }

    $this->info('Restart queue workers');
    Artisan::call('horizon:terminate');

    $this->info('Connector send email plugin has been installed');
})->describe('Installs the send mail connector');

Artisan::command('connector-send-email:uninstall', function () {
    /* In case to delete parameters to .env file */
    $envPath = base_path('.env');
    if (file_exists($envPath)) {
        $handle = fopen($envPath, "r");
        $envContent = "";

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if (
                    strpos($line, "MAIL_DRIVER")    === false &&
                    strpos($line, "MAIL_HOST")      === false &&
                    strpos($line, "MAIL_PORT")      === false &&
                    strpos($line, "MAIL_USERNAME")  === false &&
                    strpos($line, "MAIL_PASSWORD")  === false ||
                    strpos($line, "#")  === 0
                ){
                    $envContent .= $line;
                }
            }
            fclose($handle);
        }
        file_put_contents($envPath, $envContent);
    }
    // Remove screen type EMAIL
    ProcessMaker\Models\ScreenType::where('name', 'EMAIL')->delete();
    // Remove the service task script
    ProcessMaker\Models\Script::where('key', 'connector-send-email/processmaker-communication-email-send')->delete();

    // Remove the vendor assets
    Illuminate\Support\Facades\File::deleteDirectory(public_path('vendor/processmaker/connectors/email'));
    $this->info('Connector send email plugin Uninstalled');
})->describe('Uninstalls Connector send email plugin');