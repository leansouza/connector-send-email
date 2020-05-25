<?php

namespace ProcessMaker\Packages\Connectors\Email\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use ProcessMaker\Http\Controllers\Controller;
use ProcessMaker\Packages\Connectors\Email\Jobs\SendEmail;

class EmailController extends Controller
{
    /**
     * Send and email by request
     *
     * @param Request $request
     * @return Response
     */
    public function send(Request $request)
    {
        $config = $request->input();

        //created queue job
        dispatch(new SendEmail($config));

        return response()->json();
    }
}
