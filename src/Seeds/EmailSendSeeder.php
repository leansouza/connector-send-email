<?php

namespace ProcessMaker\Packages\Connectors\Email\Seeds;

use Illuminate\Database\Seeder;
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
        $definition = [
            'key' => self::IMPLEMENTATION_ID,
            'title' => 'Email Send',
            'description' => 'Send an email',
            'language' => 'PHP',
            'code' => $this->getCode(),
        ];
        $exists = Script::where('key', self::IMPLEMENTATION_ID)->first();
        if ($exists) {
            $exists->fill($definition);
            $exists->saveOrFail();
        } else {
            $script = $factory(Script::class)->make($definition);
            $script->saveOrFail();
        }
    }

    private function getCode()
    {
        return file_get_contents(__DIR__ . '/code/EmailSend.php');
    }
}
