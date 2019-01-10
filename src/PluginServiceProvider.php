<?php

namespace ProcessMaker\Packages\Connectors\Email;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder;
use ProcessMaker\Traits\PluginServiceProviderTrait;

class PluginServiceProvider extends ServiceProvider
{

    use PluginServiceProviderTrait;

    const version = '0.0.11';

    /**
     * This service provider listens for the modeler starting event 
     * and registers custom javascript with the modeler.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            require(__DIR__ . '/../routes/console.php');
        } else {
            // Register a javascript library for the modeler
            $this->registerModelerScript('js/email-connector.js',
                'vendor/processmaker/connectors/email');

            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/processmaker/connectors/email'),
            ], 'bpm-package-email-connector');

            $this->loadRoutesFrom(__DIR__ . '/routes.php');

            //Register email templates
            $this->loadViewsFrom(__DIR__ . '/views', 'email');

            //Register a seeder that will be executed in php artisan db:seed
            $this->registerSeeder(EmailSendSeeder::class);

            // Complete the plugin booting
            $this->completePluginBoot();
        }

    }

    /**
     * Executed once when the plug-in version was changed.
     *
     */
    protected function updateVersion()
    {
        Artisan::call('vendor:publish',
            [
            '--tag' => 'bpm-package-email-connector',
            '--force' => true,
            ]
        );
    }
}
