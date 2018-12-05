<?php

namespace ProcessMaker\Packages\Connectors\Email;

use Illuminate\Support\ServiceProvider;
use ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder;
use ProcessMaker\Traits\PluginServiceProviderTrait;

class PluginServiceProvider extends ServiceProvider
{

    use PluginServiceProviderTrait;

    const version = '0.0.7';

    /**
     * This service provider listens for the modeler starting event 
     * and registers custom javascript with the modeler.
     */
    public function boot()
    {
        // Register a javascript library for the modeler
        $this->registerModelerScript('js/email-connector.js',
            'vendor/processmaker/connectors/email');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/processmaker/connectors/email'),
            ], 'bpm-package-email-connector');

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        //Register email templates
        $this->loadViewsFrom(__DIR__ . '/views', 'email');

        // Complete the plugin booting
        $this->completePluginBoot();
    }

    /**
     * Executed once when the plug-in version was changed.
     *
     */
    protected function updateVersion()
    {
        $seed = new EmailSendSeeder;
        $seed->run();
    }
}
