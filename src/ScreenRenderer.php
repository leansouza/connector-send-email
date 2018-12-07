<?php
namespace ProcessMaker\Packages\Connectors\Email;

use Spatie\Ssr\Renderer;
use Spatie\Ssr\Engines\Node;

class ScreenRenderer
{
    public static function render($screen_config, $data)
    {
        $engine = new Node('/usr/bin/node', '/tmp');
        $renderer = new Renderer($engine);
        return $renderer
            ->debug()
            ->context('config', $screen_config)
            ->context('data', $data)
            ->entry('/home/vagrant/bpm-plugins/vue-form-ssr/dist/main.js')
            ->render();
    }
}