<?php

namespace Tests\ProcessMaker\Packages\Connectors\Email\Feature;
use Tests\TestCase;
use Mockery;
use ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder;
use Tests\Feature\Shared\RequestHelper;
use ProcessMaker\Models\Process;
use ProcessMaker\Models\ProcessRequest;

class EmailNotificationsTest extends TestCase
{
    use RequestHelper;

    function testEmailNotifications()
    {
        (new \ProcessSystemCategorySeeder)->run();
        (new EmailSendSeeder)->run();

        // task-start or task-end

        $bpmn = file_get_contents(__DIR__ . '/../fixtures/ProcessWithEmailNotificationsEnabled.bpmn');

        $pmConfig = ['email_notifications' => [
            'email' => 'foobar@test.com',
            'targetName' => 'Mr Foobar',
            'textBody' => "",
            'screenRef' => 123,
            'expression' => 'some_data != "def"',
            'sendAt' => 'task-start',
        ]];

        $bpmn = str_replace('[pmConfig]', htmlspecialchars(json_encode($pmConfig)), $bpmn);
        $process = factory(Process::class)->create(['bpmn' => $bpmn]);
        $startRoute = route('api.process_events.trigger', [$process->id, 'event' => 'node_1']);
        $response = $this->apiCall('POST', $startRoute, ['some_data' => 'abc']);
        $response->assertStatus(201);
        $request = ProcessRequest::find($response->json()['id']);
    }
}