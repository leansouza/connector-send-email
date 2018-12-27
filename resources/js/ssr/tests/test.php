<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/../../../../src/ScreenRenderer.php';
use ProcessMaker\Packages\Connectors\Email\ScreenRenderer;

$config = <<<HERE
[{"name": "Email", "items": [{"label": "Text", "config": {"color": "blue", "label": "A Header Text Here", "fontSize": "1.5em", "textAlign": "center", "fontWeight": "bold"}, "component": "FormText", "inspector": [{"type": "FormInput", "field": "label", "config": {"label": "Text Label", "helper": "The text to display"}}, {"type": "FormSelect", "field": "fontWeight", "config": {"label": "Font Weight", "helper": "The weight of the text", "options": [{"value": "normal", "content": "Normal"}, {"value": "bold", "content": "Bold"}]}}, {"type": "FormInput", "field": "color", "config": {"label": "Text Color", "helper": "Accepts all HTML colors and hex codes"}}, {"type": "FormSelect", "field": "textAlign", "config": {"label": "Text Alignment", "helper": "The Alignment of the text", "options": [{"value": "center", "content": "Center"}, {"value": "left", "content": "Left"}, {"value": "right", "content": "Right"}, {"value": "justify", "content": "Justify"}]}}, {"type": "FormSelect", "field": "fontSize", "config": {"label": "Font Size", "helper": "The size of the text in em", "options": [{"value": "0.5em", "content": "0.5"}, {"value": "1em", "content": "1"}, {"value": "1.5em", "content": "1.5"}, {"value": "2em", "content": "2"}]}}], "editor-component": "FormText"}, {"label": "Record List", "config": {"form": null, "name": "users", "label": "A Record List HERE", "fields": [{"value": "position", "content": "Position"}, {"value": "name", "content": "Name"}], "editable": false}, "component": "FormRecordList", "inspector": [{"type": "FormInput", "field": "name", "config": {"name": "List Name", "label": "List Name", "helper": "The data name for this list", "validation": "required"}}, {"type": "FormInput", "field": "label", "config": {"label": "List Label", "helper": "The label describes this record list"}}, {"type": "OptionsList", "field": "fields", "config": {"label": "Fields List", "helper": "List of fields to display in the record list"}}], "editor-component": "FormText"}]}]
HERE;

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