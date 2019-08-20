<?php

namespace Tests\ProcessMaker\Packages\Connectors\Email\Feature;

use ProcessMaker\Models\Process;
use ProcessMaker\Models\ProcessCategory;
use ProcessMaker\Models\ProcessRequest;
use Tests\TestCase;

class SendEmailTest extends TestCase
{
    use RequestHelper;

    function testSendEmailTest()
    {
        // Normally done by the seeder
        factory(ProcessCategory::class)->create(['is_system' => true]);

        $process = factory(Process::class)->create([
            'bpmn' => file_get_contents(__DIR__ . '/../Fixtures/simpleSendEmail.bpmn.bpmn'),
        ]);

        // Create a process and a process request
        $request = factory(ProcessRequest::class)->create(['process_id' => $process->id]);
        
    }
}