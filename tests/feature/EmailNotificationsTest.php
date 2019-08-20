<?php

namespace Tests\ProcessMaker\Packages\Connectors\Email\Feature;
use Tests\TestCase;
use Mockery;
use ProcessMaker\Packages\Connectors\Email\Seeds\EmailSendSeeder;
use Tests\Feature\Shared\RequestHelper;

class EmailNotificationsTest extends TestCase
{
    use RequestHelper;

    function testEmailNotifications()
    {
        (new EmailSendSeeder)->run();
        
    }
}