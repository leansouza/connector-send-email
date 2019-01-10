<?php

Artisan::command('pm4-connector-send-email:install', function () {
    Artisan::call('vendor:publish',
        [
            '--tag' => 'bpm-package-email-connector',
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

        $MAIL_DRIVER =  $this->ask(__("Enter your MAIL DRIVER"), 'smtp');
        $envContent .= "\nMAIL_DRIVER=$MAIL_DRIVER";

        $MAIL_HOST =  $this->ask(__("Enter your MAIL HOST"), 'smtp.yourmail.com');
        $envContent .= "\nMAIL_HOST=$MAIL_HOST";

        $MAIL_PORT =  $this->ask(__("Enter your MAIL PORT"), '2525');
        $envContent .= "\nMAIL_PORT=$MAIL_PORT";

        $MAIL_USERNAME =  $this->ask(__("Enter your MAIL USERNAME"), 'username');
        $envContent .= "\nMAIL_USERNAME=$MAIL_USERNAME";

        $MAIL_PASSWORD =  $this->secret(__("Enter your MAIL PASSWORD (hidden)"), 'password');
        $envContent .= "\nMAIL_PASSWORD=$MAIL_PASSWORD";

        file_put_contents($envPath, $envContent);
    }

    $this->info('Connector send email plugin has been installed');
})->describe('Installs the send mail connector');

Artisan::command('pm4-connector-send-email:uninstall', function () {
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
                    strpos($line, "MAIL_PASSWORD")  === false
                ){
                    $envContent .= $line;
                }
            }
            fclose($handle);
        }
        file_put_contents($envPath, $envContent);
    }
    // Remove the service task script
    ProcessMaker\Models\Script::where('key', 'processmaker-communication-email-send')->delete();

    // Remove the vendor assets
    Illuminate\Support\Facades\File::deleteDirectory(public_path('vendor/processmaker/connectors/email'));
    $this->info('Connector send email plugin Uninstalled');
})->describe('Uninstalls Connector send email plugin');