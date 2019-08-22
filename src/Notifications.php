<?php

namespace ProcessMaker\Packages\Connectors\Email;

use ProcessMaker\Facades\WorkflowManager;
use ProcessMaker\Models\Process;
use ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder;

class Notifications
{
    /**
     * Create notification in event activity activated
     *
     * @param $event
     * @param $type
     */
    public function created($event)
    {
        if (!isset($event->token->getDefinition()['config'])) {
            return;
        }

        $config = json_decode($event->token->getDefinition()['config'], true);

        if (isset($config['email_notifications']) && $config['email_notifications']['sendAt'] === 'task-start') {
            $this->createNotification(
                json_decode($event->token->getDefinition()['config'], true),
                $event->token->processRequest->data
            );
        }
    }

    /**
     * Create notification in event activity completed
     *
     * @param $event
     * @param $type
     */
    public function completed($event)
    {
        if (!isset($event->token->getDefinition()['config'])) {
            return;
        }

        $config = json_decode($event->token->getDefinition()['config'], true);
        
        if (isset($config['email_notifications']) && $config['email_notifications']['sendAt'] === 'task-end') {
            $this->createNotification(
                json_decode($event->token->getDefinition()['config'], true),
                $event->token->processRequest->data
                );
        }
    }

    /**
     * Create notification with sub-process
     *
     * @param $config
     * @param $data
     */
    private function createNotification($config, $data)
    {
        $subProcess = $this->notificationSubProcess();
        $definitions = $subProcess->getDefinitions();
        $event = $definitions->getEvent(EmailSendSeeder::SUB_PROCESS_START_EVENT);
        WorkflowManager::triggerStartEvent(
            $subProcess, $event, array_merge($data, $config)
        );
    }

    /**
     * Load sub process send email
     *
     * @return mixed
     */
    private function notificationSubProcess()
    {
        return Process::where('package_key', EmailSendSeeder::SUB_PROCESS_ID)->firstOrFail();
    }

}