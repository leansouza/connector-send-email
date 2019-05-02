<?php

namespace ProcessMaker\Packages\Connectors\Email\Seeds;

use Illuminate\Database\Seeder;
use ProcessMaker\Models\ScreenType;
use ProcessMaker\Models\Script;

class EmailSendSeeder extends Seeder
{

    const IMPLEMENTATION_ID = 'processmaker-communication-email-send';

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
    }

    private function getCode()
    {
        clearstatcache(false, __DIR__ . '/code/EmailSend.php');
        return file_get_contents(__DIR__ . '/code/EmailSend.php');
    }
}
