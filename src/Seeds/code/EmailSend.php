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
        'email' => $config['email'],
        'name' => $config['targetName'],
        'subject' => $config['subject'],
        'screenRef' => $config['screenRef'],
        'json_data' => json_encode($data),
    ]
]);

return [];
