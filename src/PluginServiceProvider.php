<?php
namespace ProcessMaker\Packages\Connectors\Email;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Events\ModelerStarting;
use Seeds\EmailSendSeeder;

class PluginServiceProvider extends ServiceProvider
{
    const version = '0.0.1';

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

        if (!$this->isUpdated()) {
            $this->updateVersion();
        }
    }

    /**
     * Executed when the version was changed.
     *
     */
    protected function updateVersion()
    {
        $seed = new EmailSendSeeder;
        $seed->run();
    }

    /**
     * Check if the plugin was updated
     */
    protected function isUpdated()
    {
        $key = str_replace('\\', '_' , static::class);
        return static::version === Cache::get($key, '0.0.0');
    }
}
