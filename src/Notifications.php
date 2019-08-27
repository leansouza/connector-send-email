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
        $this->sendNotificationAt($event, self::TASK_START);
    }

    /**
     * Create notification in event activity completed
     *
     * @param ActivityCompletedEvent $event
     */
    public function completed(ActivityCompletedEvent $event)
    {
        $this->sendNotificationAt($event, self::TASK_COMPLETED);
    }

    /**
     * Check if we need to send a notification at the start
     * or end of the task event
     *
     * @param $event
     * @param $sendAt
     */
    private function sendNotificationAt($event, $sendAt)
    {
        if (!isset($event->token->getDefinition()['config'])) {
            return;
        }
        $config = json_decode($event->token->getDefinition()['config'], true);

        if (isset($config['email_notifications'])) {
            foreach ($config['email_notifications']['notifications'] as $notificationConfig) {
                if ($notificationConfig['sendAt'] !== $sendAt) {
                    continue;
                }
                $this->createNotification(
                    $notificationConfig,
                    $event->token->processRequest->data
                );
            }
        }
    }

    /**
     * Create notification with sub-process
     *
     * @param $notificationConfig
     * @param $data
     */
    private function createNotification($notificationConfig, $data)
    {
        $subProcess = $this->notificationSubProcess();
        $definitions = $subProcess->getDefinitions();
        $event = $definitions->getEvent(EmailSendSeeder::SUB_PROCESS_START_EVENT);
        WorkflowManager::triggerStartEvent(
            $subProcess, $event, array_merge($data, ['notification_config' => $notificationConfig])
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