<?php

namespace ProcessMaker\Packages\Connectors\Email\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use ProcessMaker\Http\Controllers\Controller;
use ProcessMaker\Models\Screen;
use ProcessMaker\Packages\Connectors\Email\ScreenRenderer;

class EmailController extends Controller
{
    /**
     * Send and email.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return Response
     */
    public function send(Request $request)
    {
        $config = $request->input();
        $screen = Screen::find($config['screenRef']);
        $data = json_decode($config['json_data']);
        
        $rendered = ScreenRenderer::render($screen->config, $data);
        $config['body'] = $rendered;

        $res = Mail::send([], [], function (\Illuminate\Mail\Message $message) use ($config) {
            $message->to($config['email'])
                ->subject($config['subject'])
                ->setBody(view('email::layout', $config)->render(), 'text/html');
        });
        return response()->json($res);
    }
}
