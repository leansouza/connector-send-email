<?php

namespace ProcessMaker\Packages\Connectors\Email\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use ProcessMaker\Http\Controllers\Controller;
use ProcessMaker\Packages\Connectors\Email\EmailMessage;

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
        $res = Mail::to($config['email'])->send(new EmailMessage($config));
        return response()->json($res);
    }
}
