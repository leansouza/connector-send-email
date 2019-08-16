<?php

namespace ProcessMaker\Packages\Connectors\Email\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use ProcessMaker\Http\Controllers\Controller;
use ProcessMaker\Models\GroupMember;
use ProcessMaker\Models\Screen;
use ProcessMaker\Models\User;
use ProcessMaker\Packages\Connectors\Email\Jobs\SendEmail;
use ProcessMaker\Packages\Connectors\Email\ScreenRenderer;

class EmailController extends Controller
{
    /**
     * Send and email.
     *
     * @param Request $request
     * @return Response
     */
    public function send(Request $request)
    {
        $config = $request->input();

        //Validate data
        $users  = !empty($config['groups']) ? $config['groups'] : [];
        $groups  = !empty($config['users']) ? $config['users'] : [];
        $additionalEmails =!empty( $config['addEmails']) ? $config['addEmails'] : [];
        $type =!empty( $config['type']) ? $config['type'] : 'screen';

        //Load data
        $data = json_decode($config['json_data']);

        //Load mails
        $usersGroups = GroupMember::whereIn('group_id', $groups)->where('member_type', User::class)->pluck('member_id')->toArray();
        $users = array_merge($users, $usersGroups);
        $emails = User::whereIn('id', $users)->pluck('email')->toArray();

        //change mustache
        $mustache = new \Mustache_Engine;

        //Add additional emails
        foreach ($additionalEmails as $item) {
            $emails[] = $mustache->render($item, $data);
        }

        //load Body
        if ($type === 'screen') {
            //screen definition
            $screen = Screen::find($config['screenRef']);
            $data = json_decode($config['json_data']);

            $rendered = ScreenRenderer::render($screen->config, $data);
            $config['body'] = $rendered;
        } else {
            //Plain text
            $config['body'] = htmlentities($mustache->render($config['textBody'], $data), ENT_QUOTES, 'UTF-8');
        }

        //change mustache
        $config['subject'] = $mustache->render($config['subject'], $data);
        $config['email'] = $emails;
        $config['name'] = $mustache->render($config['name'], $data);

        //created queue job
        dispatch(new SendEmail($config));

        return response()->json();
    }
}
