<?php

use GuzzleHttp\Client;

// Rest client
$client = new Client([
    'base_uri' => getenv('HOST_URL'),
    'verify' => false,
    'defaults' => ['verify' => false]
    ]);

// Call to send an email
$response = $client->request('POST', '/plugins/email/send', [
    'form_params' => [
        'email' => isset($data[$config['email']]) ? $data[$config['email']] : $config['email'],
        'name' => isset($data[$config['name']]) ? $data[$config['name']] : $config['targetName'],
        'subject' => isset($data[$config['subject']]) ? $data[$config['subject']] : $config['subject'],
        'screenRef' => isset($data[$config['screenRef']]) ? $data[$config['screenRef']] : $config['screenRef'],
        'json_data' => json_encode($data),
    ]
]);

return [];
