<?php

namespace ProcessMaker\Packages\Connectors\Email;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Events\ScreenBuilderStarting;
use ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder;
use ProcessMaker\Traits\PluginServiceProviderTrait;

class PluginServiceProvider extends ServiceProvider
{

    use PluginServiceProviderTrait;

    const version = '0.0.11';
    const name = 'connector-send-email';

    /**
     * This service provider listens for the modeler starting event
     * and registers custom javascript with the modeler.
     */
    public function boot()
    {
        // Register console commands
        $this->loadRoutesFrom(__DIR__ . '/../routes/console.php');

        // Register a javascript library for the modeler
        $this->registerModelerScript('js/email-connector.js',
            'vendor/processmaker/connectors/email');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/processmaker/connectors/email'),
        ], 'package-email-connector');

        //translations
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        // Listen to the events for our core screen types and add our javascript
        Event::listen(ScreenBuilderStarting::class, function ($event) {
            if ($event->type == 'EMAIL') {
                $event->manager->addScript('/vendor/processmaker/connectors/email/js/processes/screen-builder/typeEmail.js');
            }
        });

        //Register email templates
        $this->loadViewsFrom(__DIR__ . '/views', 'email');

        //Register a seeder that will be executed in php artisan db:seed
        $this->registerSeeder(EmailSendSeeder::class);

        // Complete the plugin booting
        $this->completePluginBoot();

    }
}
