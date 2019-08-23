<?php

namespace Tests\ProcessMaker\Packages\Connectors\Email\Feature;

use Mockery;
use ProcessMaker\Models\GroupMember;
use ProcessMaker\Models\User;
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

    public function testEmailNotifications()
    {
        $this->headerMockery();

        $pmConfig = ['email_notifications' => [
            'enableNotifications' => true,
            'notifications' => [[
                'addEmails' => ['foobar@test.com', 'bar@baz.com'],
                'users' => [],
                'groups' => [],
                'subject' => "Test Subject",
                'textBody' => "Here is a plain text body with some_data: {{ some_data }}",
                'screenRef' => null,
                'expression' => 'some_data != "def"',
                'sendAt' => 'task-start',
                'type' => 'text' // vs. 'screen'
            ]]
        ]];

        $process = $this->createProcess(
            file_get_contents(__DIR__ . '/../fixtures/ProcessWithEmailNotificationsEnabled.bpmn'),
            $pmConfig
        );

        $startRoute = route('api.process_events.trigger', [$process->id, 'event' => 'node_1']);
        $response = $this->apiCall('POST', $startRoute, ['some_data' => 'abc']);
        $response->assertStatus(201);

        $messages = $this->getEmails();
        $tos = array_keys($messages->getTo());
        $this->assertCount(2, $messages->getTo());
        $this->assertContains('foobar@test.com', $tos);
        $this->assertContains('bar@baz.com', $tos);
        $this->assertContains('Here is a plain text body with some_data: abc', $messages->getBody());
    }

    public function testEmailNotificationsWithScreen()
    {
        $this->headerMockery();

        $customEmailScreen = factory(Screen::class)->create([
            'config' => file_get_contents(__DIR__ . '/../fixtures/screen.json')
        ]);

        // test enableNotifications
        $pmConfig = ['email_notifications' => [
            'enableNotifications' => true,
            'notifications' => [[
                'addEmails' => ['foobar@test.com', 'bar@baz.com'],
                'users' => [],
                'groups' => [],
                'subject' => "Test Subject",
                'textBody' => "Here is a plain text body with some_data: {{ some_data }}",
                'screenRef' => $customEmailScreen->id,
                'expression' => 'some_data != "def"',
                'sendAt' => 'task-start',
                'type' => 'screen'
            ]]
        ]];

        $process = $this->createProcess(
            file_get_contents(__DIR__ . '/../fixtures/ProcessWithEmailNotificationsEnabled.bpmn'),
            $pmConfig
        );

        $startRoute = route('api.process_events.trigger', [$process->id, 'event' => 'node_1']);
        $text1 = 'Here text 1';
        $text2 = 'Here text 2';
        $text3 = 'Here text 3';
        $response = $this->apiCall('POST', $startRoute, ['some_data' => 'abc', 'text_custom_1' => $text1, 'text_custom_2' => $text2, 'text_custom_3' => $text3]);
        $response->assertStatus(201);

        $messages = $this->getEmails();
        $tos = array_keys($messages->getTo());
        $this->assertCount(2, $messages->getTo());
        $this->assertContains('foobar@test.com', $tos);
        $this->assertContains('bar@baz.com', $tos);
        $this->assertContains($text1, $messages->getBody());
        $this->assertContains($text2, $messages->getBody());
        $this->assertContains($text3, $messages->getBody());
    }

    public function testEmailMultipleEmails()
    {
        $this->headerMockery();
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $groupMember1 = factory(GroupMember::class)->create();
        $groupMember2 = factory(GroupMember::class)->create();

        // test enableNotifications
        $pmConfig = ['email_notifications' => [
            'enableNotifications' => true,
            'notifications' => [[
                'addEmails' => ['foobar@test.com', 'bar@baz.com'],
                'users' => [$user1->id, $user2->id],
                'groups' => [$groupMember1->group_id, $groupMember2->group_id],
                'subject' => "Test Subject",
                'textBody' => "Here is a plain text body with some_data: {{ some_data }}",
                'screenRef' => '',
                'expression' => 'some_data != "def"',
                'sendAt' => 'task-start',
                'type' => 'text'
            ]]
        ]];

        $process = $this->createProcess(
            file_get_contents(__DIR__ . '/../fixtures/ProcessWithEmailNotificationsEnabled.bpmn'),
            $pmConfig
        );

        $startRoute = route('api.process_events.trigger', [$process->id, 'event' => 'node_1']);
        $response = $this->apiCall('POST', $startRoute, ['some_data' => 'abc']);
        $response->assertStatus(201);

        $messages = $this->getEmails();
        $tos = array_keys($messages->getTo());
        $this->assertCount(6, $messages->getTo());
        $this->assertContains('foobar@test.com', $tos);
        $this->assertContains('bar@baz.com', $tos);
        $this->assertContains($user1->email, $tos);
        $this->assertContains($user2->email, $tos);
        $this->assertContains($groupMember1->member()->pluck('email')->first(), $tos);
        $this->assertContains($groupMember2->member()->pluck('email')->first(), $tos);
        $this->assertContains('Here is a plain text body with some_data: abc', $messages->getBody());
    }

    private function createProcess($bpmn, $config)
    {
        $jsonString = str_replace('"', '&#34;', json_encode($config));

        $bpmn = str_replace('[pmConfig]', $jsonString, $bpmn);
        return factory(Process::class)->create(['bpmn' => $bpmn]);
    }

    private function headerMockery()
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
    }

    private function getEmails()
    {
        $messages = app()->make('swift.transport')->driver()->messages();
        // Clear all emails
        app()->make('swift.transport')->driver()->flush();
        return isset($messages[0]) ? $messages[0] : [];
    }
}