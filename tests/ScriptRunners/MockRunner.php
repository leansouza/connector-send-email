<?php

namespace ProcessMaker\ScriptRunners;

class MockRunner
{
    public function run($code, $data, $config, $timeout, $user) {
        return ['output' => eval(str_replace('<?php', '', $code))];
    }
}