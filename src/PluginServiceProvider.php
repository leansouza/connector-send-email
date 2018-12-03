<?php
namespace ProcessMaker\Packages\Connectors\Email;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Events\ModelerStarting;

class PluginServiceProvider extends ServiceProvider
{
    /**
     * This service provider listens for the modeler starting event 
     * and registers custom javascript with the modeler.
     */
    public function boot()
    {
        Event::listen(ModelerStarting::class, function($event) {
            $event->manager->addScript(mix('js/email-connector.js', 'vendor/processmaker/connectors/email'));
        });

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/processmaker/connectors/email'),
        ], 'bpm-package-email-connector');
    }
}
