<?php

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://172.17.0.1',
    'verify' => false,
    'defaults' => ['verify' => false]
    ]);

$response = @$client->request('POST', '/plugins/email/send', [
    'form_params' => [
        'email' => $config['email'],
        'name' => $config['targetName'],
        'subject' => $config['subject'],
        'template' => $config['template'],
    ]
]);
$json = json_decode((string) $response->getBody());

var_dump($json);

return [];
