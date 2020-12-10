<?php

namespace ProcessMaker\Packages\Connectors\Email;

use ProcessMaker\Facades\WorkflowManager;
use ProcessMaker\Models\FormalExpression;
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
                // Do not send notifications if they aren't of the correct type
                if ($notificationConfig['sendAt'] !== $sendAt) {
                    continue;
                }

                // Do not send notifications if their expression don't evaluate to true
               if ($notificationConfig['expression']) {
                   $tokenData = $this->tokenData($event->token, $notificationConfig);

                   $mustache = new \Mustache_Engine;
                   $evaluatedCondition = $mustache->render($notificationConfig['expression'], $tokenData);

                   $formalExp = new FormalExpression();
                   $formalExp->setLanguage('FEEL');
                   $formalExp->setBody($evaluatedCondition);
                   if (!$formalExp($tokenData)) {
                       continue;
                   }
                   // In our send email subprocess, use the expression with mustache evaluated
                   $notificationConfig['expression'] = $evaluatedCondition;
               }

                $this->createNotification(
                    $notificationConfig,
                    $event->token
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
    private function createNotification($notificationConfig, $token)
    {
        $subProcess = $this->notificationSubProcess();
        $definitions = $subProcess->getDefinitions();
        $event = $definitions->getEvent(EmailSendSeeder::SUB_PROCESS_START_EVENT);
        WorkflowManager::triggerStartEvent(
            $subProcess, $event, $this->tokenData($token, $notificationConfig)
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

    /**
     * Adds _request and other values to the request data to be used by the send process, mustache evaluations, etc.
     *
     * @param $token,
     * @param $notificationConfig
     * @return array
     */
    private function tokenData($token, $notificationConfig): array
    {
        return array_merge($token->processRequest->data, [
            '_request' => $token->processRequest->toArray(),
            '_request_id' => $token->processRequest->id,
            '_task_name' => $token->element_name,
            'notification_config' => $notificationConfig
        ]);
    }

}
