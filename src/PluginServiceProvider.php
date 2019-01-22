<?php

namespace ProcessMaker\Packages\Connectors\Email;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder;
use ProcessMaker\Traits\PluginServiceProviderTrait;

use Illuminate\Support\Facades\Event;
use ProcessMaker\Events\ScreenBuilderStarting;

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
                __DIR__ . '/../resources/js/processes/screen-builder/typeEmail.js' => base_path('resources/js/processes/screen-builder/typeEmail.js'),
            ], 'bpm-package-email-connector');

            $this->loadRoutesFrom(__DIR__ . '/routes.php');

            //Register email templates
            $this->loadViewsFrom(__DIR__ . '/views', 'email');

            //Register a seeder that will be executed in php artisan db:seed
            $this->registerSeeder(EmailSendSeeder::class);

            Event::listen(ScreenBuilderStarting::class, function($event) {
                if ($event->type == 'EMAIL') {
                    \Illuminate\Support\Facades\Log::info("STARTING- type: " . $event->type);
                    $event->manager->addScript(mix('js/processes/screen-builder/typeEmail.js'));
                }
            });

            // Complete the plugin booting
            $this->completePluginBoot();
        }

    }
}
