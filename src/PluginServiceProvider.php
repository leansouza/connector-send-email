<?php

namespace ProcessMaker\Packages\Connectors\Email;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Events\ScreenBuilderStarting;
use ProcessMaker\Nayra\Contracts\Bpmn\ActivityInterface;
use ProcessMaker\Packages\Connectors\Email\Controllers\EmailController;
use ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder;
use ProcessMaker\Traits\PluginServiceProviderTrait;
use ProcessMaker\Facades\WorkflowManager;
use ProcessMaker\Models\Process;

class PluginServiceProvider extends ServiceProvider
{
    use PluginServiceProviderTrait;

    const version = '0.0.12';
    const name = 'connector-send-email';

    /**
     * This service provider listens for the modeler starting event
     * and registers custom javascript with the modeler.
     */
    public function boot()
    {
        // Register routes
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/console.php');

        // Register a javascript library for the modeler
        $this->registerModelerScript(
            'js/email-connector.js',
            'vendor/processmaker/connectors/email'
        );

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/processmaker/connectors/email'),
        ], self::name);

        // Register translations
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');

        // Listen to the events for our core screen types and add our javascript
        Event::listen(ScreenBuilderStarting::class, function ($event) {
            if ($event->type == 'EMAIL') {
                $event->manager->addScript('/vendor/processmaker/connectors/email/js/processes/screen-builder/typeEmail.js');
            }
        });

        Event::listen(ActivityInterface::EVENT_ACTIVITY_ACTIVATED, function ($event) {
            if (!isset($event->token->getDefinition()['config'])) {
                return;
            }
            $config = json_decode($event->token->getDefinition()['config'], true);
            $data = $event->token->processRequest->data;

            $subProcess = $this->notificationSubProcess();
            $definitions = $subProcess->getDefinitions();
            $event = $definitions->getEvent(EmailSendSeeder::SUB_PROCESS_START_EVENT);
            WorkflowManager::triggerStartEvent(
                $subProcess, $event, array_merge($data, $config)
            );
        });

        // Event::listen(ActivityInterface::EVENT_ACTIVITY_ACTIVATED, function ($event) {
        //     Log::info('EVENT_ACTIVITY_ACTIVATED ...............');
        //     app(EmailController::class)->eventSendMail($event);
        // });

        // Event::listen(ActivityInterface::EVENT_ACTIVITY_COMPLETED, function ($event) {
        //     Log::info('EVENT_ACTIVITY_COMPLETED ...............');
        //     app(EmailController::class)->eventSendMail($event);
        // });

        // Register email templates
        $this->loadViewsFrom(__DIR__ . '/views', 'email');

        // Register a seeder that will be executed in php artisan db:seed
        $this->registerSeeder(EmailSendSeeder::class);

        // Complete the connector boot
        $this->completePluginBoot();
    }

    private function notificationSubProcess()
    {
        return Process::where('package_key', EmailSendSeeder::SUB_PROCESS_ID)->firstOrFail();
    }
}
