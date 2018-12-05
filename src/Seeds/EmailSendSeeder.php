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
            // Debug code to review the code update
            \Illuminate\Support\Facades\Log::info($definition['code']);
            $exists->fill($definition);
            $exists->saveOrFail();
            $exists2 = Script::where('key', self::IMPLEMENTATION_ID)->first();
            \Illuminate\Support\Facades\Log::info("Updated: " . $exists2->id);
            \Illuminate\Support\Facades\Log::info($exists2->code);
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
