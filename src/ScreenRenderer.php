<?php
namespace ProcessMaker\Packages\Connectors\Email;

class ScreenRenderer
{
    public static function render($screen_config, $data)
    {
        $path = config('app.processmaker_scripts_home');
        $configFile = tempnam($path, 'ssr-config');
        $dataFile   = tempnam($path, 'ssr-data');
        $outputFile = tempnam($path, 'ssr-output');

        file_put_contents($configFile, json_encode($screen_config));
        file_put_contents($dataFile, json_encode($data));

        $node = env('NODE_BIN_PATH', '/usr/bin/node');
        $entry = __DIR__ . '/../resources/js/ssr/entry.js';
        $cmd = join(' ', [
            $node,
            $entry,
            $configFile,
            $dataFile,
            $outputFile,
            '2>&1'
        ]);

        exec($cmd, $out, $err);
        if ($err) {
            throw new \Exception("Error from NodeJS: " . implode("\n", $out));
        }

        $result = file_get_contents($outputFile);
        unlink($configFile);
        unlink($dataFile);
        unlink($outputFile);

        return $result;
    }
}
