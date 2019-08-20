<?php

namespace ProcessMaker\Packages\Connectors\Email\Seeds;

use ProcessMaker\Models\Process;
use ProcessMaker\Models\ProcessCategory;
use Illuminate\Database\Seeder;
use ProcessMaker\Models\ScreenType;
use ProcessMaker\Models\Script;

class EmailSendSeeder extends Seeder
{

    const IMPLEMENTATION_ID = 'connector-send-email/processmaker-communication-email-send';
    const SUB_PROCESS_ID = 'connector-send-email/sub-process';

    /**
     * Creates or updates the script implementation.
     *
     * @return void
     */
    public function run()
    {
        //Register screen type EMAIL
        $exists = ScreenType::where('name', 'EMAIL')->first();
        if (!$exists) {
            factory(ScreenType::class)->create([
                'name' => 'EMAIL',
            ]);
        }

        //Definition script send an email
        $definition = [
            'key' => self::IMPLEMENTATION_ID,
            'title' => 'Email Send',
            'description' => 'Send an email',
            'language' => 'PHP',
            'run_as_user_id' => Script::defaultRunAsUser()->id,
            'code' => $this->getCode(),
        ];
        $exists = Script::where('key', self::IMPLEMENTATION_ID)->first();
        if ($exists) {
            $exists->fill($definition);
            $exists->saveOrFail();
        } else {
            $script = factory(Script::class)->make($definition);
            $script->saveOrFail();
        }


        $processCategory = ProcessCategory::where('is_system', true)->firstOrFail();

        Process::updateOrCreate([
            'package_key' => self::SUB_PROCESS_ID,
        ], [
            'name' => 'Email Notification Sub Process',
            'process_category_id' => $processCategory->id,
            'description' => 'Sub Process to Send Email Notifications',
            'bpmn' => file_get_contents(__DIR__ . '/sub-process.bpmn'),
            'user_id' => Script::defaultRunAsUser()->id,
        ]);
    }

    private function getCode()
    {
        clearstatcache(false, __DIR__ . '/code/EmailSend.php');
        return file_get_contents(__DIR__ . '/code/EmailSend.php');
    }
}
