<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/../../../../src/ScreenRenderer.php';
use ProcessMaker\Packages\Connectors\Email\ScreenRenderer;

function env($k, $v) { return $v; }

$config = file_get_contents(__DIR__ . '/config.json');

$data = [
    "users" => [
        ["name" => "John Shuster", "position" => "skip"],
        ["name" => "Tyler George", "position" => "vice"],
        ["name" => "Mark Hamilton", "position" => "second"],
        ["name" => "John Landstiner", "position" => "lead"],
    ]
];

// echo json_encode($data);
echo ScreenRenderer::render(json_decode($config), $data) . "\n";
