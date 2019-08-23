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
use Tests\MockGuzzleResponse;

class SendEmailTest extends TestCase
{
    use RequestHelper;

    public function testSimpleMail()
    {
        $this->headerMockery();
        $config = [
            'subject' => 'My subject test',
            'type' => 'text',
            'textBody' => 'Here is a plain text body',
            'addEmails' => ['foobar@test.com'],
            'json_data' => "[]",
            'name' => 'Test Mail'
        ];

        $response = $this->json('POST', '/plugins/email/send', $config);

        $messages = $this->getEmails()[0];
        $this->assertCount(1, $messages->getTo());
        $this->assertArrayHasKey($config['addEmails'][0], $messages->getTo());
        $this->assertContains($config['subject'], $messages->getSubject());
        $this->assertContains($config['textBody'], $messages->getBody());
    }

    public function testMultipleMails()
    {
        $this->headerMockery();
        $user = factory(User::class)->create();
        $groupMember = factory(GroupMember::class)->create();

        $config = [
            'subject' => 'My subject test',
            'type' => 'text',
            'textBody' => 'Here is a plain text body',
            'users' => [$user->id],
            'groups' => [$groupMember->group_id],
            'addEmails' => ['foobar1@test.com', 'foobar2@test.com'],
            'json_data' => "[]",
            'name' => 'Test Mail'
        ];

        $response = $this->json('POST', '/plugins/email/send', $config);

        $messages = $this->getEmails()[0];
        $this->assertCount(4, $messages->getTo());
        $this->assertArraySubset(['foobar1@test.com' => null, 'foobar2@test.com' => null, $user->email => null, $groupMember->member()->pluck('email')->first() => null],
            $messages->getTo());
        $this->assertContains($config['subject'], $messages->getSubject());
        $this->assertContains($config['textBody'], $messages->getBody());
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
        return $messages;
    }
}