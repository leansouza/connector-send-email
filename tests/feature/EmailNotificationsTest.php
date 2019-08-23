<?php

namespace Tests\ProcessMaker\Packages\Connectors\Email\Feature;

use Mockery;
use ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder;
use ProcessMaker\Models\Screen;
use ProcessMaker\Models\Process;
use ProcessMaker\Models\ProcessRequest;
use Tests\Feature\Shared\RequestHelper;
use Tests\TestCase;

class MockGuzzleResponse {
    public function __construct($phpunitResponse)
    {
        $this->response = $phpunitResponse;
    }

    public function getStatusCode()
    {
        return $this->response->status();
    }

    public function getBody()
    {
        return $this->response->getContent();
    }
}

class EmailNotificationsTest extends TestCase
{
    use RequestHelper;

    function testEmailNotifications()
    {
        $guzzle = Mockery::mock('overload:GuzzleHttp\Client');
        $guzzle->shouldReceive('request')->andReturnUsing(function($verb, $route, $params) {
            $result = $this->json($verb, $route, $params['form_params']);
            return new MockGuzzleResponse($result);
        });

        config()->set('mail.driver', 'array');
        config()->set('script-runners.php.runner', 'MockRunner');

        (new \ProcessSystemCategorySeeder)->run();
        (new EmailSendSeeder)->run();

        $bpmn = file_get_contents(__DIR__ . '/../fixtures/ProcessWithEmailNotificationsEnabled.bpmn');

        $pmConfig = ['email_notifications' => [
            'enableNotifications' => true,
            'notifications' => [[
                'email' => 'foobar@test.com',
                'targetName' => 'Mr Foobar',
                'textBody' => "Here is a plain text body with some_data: {{ some_data }}",
                'screenRef' => 123,
                'expression' => 'some_data != "def"',
                'sendAt' => 'task-start',
                'type' => 'text' // vs. 'screen'
            ]]
        ]];
        $jsonString = json_encode($pmConfig);
        $jsonString = str_replace('"', '&#34;', $jsonString);

        $bpmn = str_replace('[pmConfig]', $jsonString, $bpmn);
        $process = factory(Process::class)->create(['bpmn' => $bpmn]);
        $startRoute = route('api.process_events.trigger', [$process->id, 'event' => 'node_1']);
        $response = $this->apiCall('POST', $startRoute, ['some_data' => 'abc']);
        $response->assertStatus(201);

        $messages = $this->getEmails();
        $tos = array_keys($messages[0]->getTo());
        $this->assertContains('foobar@test.com', $tos);
        $this->assertContains('Here is a plain text body with some_data: abc', $messages[0]->getBody());
    }

    private function getEmails()
    {
        $messages = app()->make('swift.transport')->driver()->messages();
        // Clear all emails
        app()->make('swift.transport')->driver()->flush();
        return $messages;
    }

    function testEmailNotificationsWithScreen()
    {
        $guzzle = Mockery::mock('overload:GuzzleHttp\Client');
        $guzzle->shouldReceive('request')->andReturnUsing(function($verb, $route, $params) {
            $result = $this->json($verb, $route, $params['form_params']);
            return new MockGuzzleResponse($result);
        });

        config()->set('mail.driver', 'array');
        config()->set('script-runners.php.runner', 'MockRunner');

        (new \ProcessSystemCategorySeeder)->run();
        (new EmailSendSeeder)->run();

        $bpmn = file_get_contents(__DIR__ . '/../fixtures/ProcessWithEmailNotificationsEnabled.bpmn');

        $customEmailScreen = factory(Screen::class)->create([
            'config' => file_get_contents(__DIR__ . '/../fixtures/screen.json')
        ]);

        // test enableNotifications
        $pmConfig = ['email_notifications' => [
            'enableNotifications' => true,
            'notifications' => [[
                'email' => 'foobar@test.com',
                'targetName' => 'Mr Foobar',
                'textBody' => "Here is a plain text body with some_data: {{ some_data }}",
                'screenRef' => $customEmailScreen->id,
                'expression' => 'some_data != "def"',
                'sendAt' => 'task-start',
                'type' => 'screen'
            ]]
        ]];
        $jsonString = json_encode($pmConfig);
        $jsonString = str_replace('"', '&#34;', $jsonString);

        $bpmn = str_replace('[pmConfig]', $jsonString, $bpmn);
        $process = factory(Process::class)->create(['bpmn' => $bpmn]);
        $startRoute = route('api.process_events.trigger', [$process->id, 'event' => 'node_1']);
        $text1 = 'Here text 1';
        $text2 = 'Here text 2';
        $text3 = 'Here text 3';
        $response = $this->apiCall('POST', $startRoute, ['some_data' => 'abc', 'text_custom_1' => $text1, 'text_custom_2' => $text2, 'text_custom_3' => $text3]);
        $response->assertStatus(201);

        $messages = $this->getEmails();
        $tos = array_keys($messages[0]->getTo());
        $this->assertContains('foobar@test.com', $tos);
        $this->assertContains($text1, $messages[0]->getBody());
        $this->assertContains($text2, $messages[0]->getBody());
        $this->assertContains($text3, $messages[0]->getBody());
    }
}