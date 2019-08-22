<?php

namespace ProcessMaker\Packages\Connectors\Email;

use ProcessMaker\Facades\WorkflowManager;
use ProcessMaker\Models\Process;
use ProcessMaker\Nayra\Bpmn\Events\ActivityActivatedEvent;
use ProcessMaker\Nayra\Bpmn\Events\ActivityCompletedEvent;
use ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder;

class Notifications
{
    const TASK_START = 'task-start';
    const TASK_COMPLETED = 'task-end';

    /**
     * Create notification in event activity activated
     *
     * @param ActivityActivatedEvent $event
     */
    public function created(ActivityActivatedEvent $event)
    {
        if (!isset($event->token->getDefinition()['config'])) {
            return;
        }
        $config = json_decode($event->token->getDefinition()['config'], true);

        if (isset($config['email_notifications']) &&
            $config['email_notifications']['sendAt'] === self::TASK_START
        ) {
            $this->createNotification(
                $config,
                $event->token->processRequest->data
            );
        }
    }

    /**
     * Create notification in event activity completed
     *
     * @param ActivityCompletedEvent $event
     */
    public function completed(ActivityCompletedEvent $event)
    {
        if (!isset($event->token->getDefinition()['config'])) {
            return;
        }
        $config = json_decode($event->token->getDefinition()['config'], true);

        if (isset($config['email_notifications']) &&
            $config['email_notifications']['sendAt'] === self::TASK_COMPLETED
        ) {
            $this->createNotification(
                $config,
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