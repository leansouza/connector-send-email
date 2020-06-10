<?php

namespace ProcessMaker\Packages\Connectors\Email\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use ProcessMaker\Models\Comment;
use ProcessMaker\Models\GroupMember;
use ProcessMaker\Models\ProcessRequest;
use ProcessMaker\Models\Screen;
use ProcessMaker\Models\User;
use ProcessMaker\Packages\Connectors\Email\ScreenRenderer;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $config;
    protected $properties;

    /**
     * Create a new job instance.
     *
     * @param $properties
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Get the tags that should be assigned to the job.
     *
     * @return array
     */
    public function tags()
    {
        return ['package-email', $this->config['subject']];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->properties = $this->prepareEmailProperties($this->config);

        Mail::send([], [], function (Message $message) {
            $message->to($this->properties['email'])
                ->subject($this->properties['subject'])
                ->setBody(view('email::layout', array_merge($this->properties, ['message' => $message]))->render(), 'text/html');
        });

        if (isset($data['notification_config'])) {
            Comment::create([
                'type' => 'LOG',
                'user_id' => null,
                'commentable_type' => ProcessRequest::class,
                'commentable_id' => $data['_request_id'],
                'subject' => 'Email Notification Sent',
                'body' => __(
                    'System has sent a notification to :emails for :task',
                    [
                        "emails" => join(", ", $config['email']),
                        "task" => $data['_task_name']
                    ]
                )
            ]);
        }
    }

    /**
     * Prepare the email: render the body, subject, email address
     *
     * @param array $config
     *
     * @return array
     */
    private function prepareEmailProperties($config)
    {
        if ($this->properties) {
            return $this->properties;
        }

        //Load data
        $data = json_decode($config['json_data'], true);

        //Mustache
        $mustache = new \Mustache_Engine;

        //Mustache data notification
        if (isset($data['notification_config'])) {
            foreach ($data['notification_config'] as $key => $value) {
                if (is_array($value)) {
                    $data['notification_config'][$key] = $mustache->render(implode(", ", $value), $data);
                } else {
                    $data['notification_config'][$key] = $mustache->render((string) $value, $data);
                }
            }
        }

        //Validate data
        $groups = !empty($config['groups']) ? $this->getData($config['groups'], $data) : [];
        $users = !empty($config['users']) ? $this->getData($config['users'], $data) : [];
        $additionalEmails = !empty($config['addEmails']) ? $this->getData($config['addEmails'], $data) : [];
        $type =!empty($config['type']) ? $mustache->render($config['type'], $data) : 'screen';

        //Load mails
        $usersGroups = GroupMember::whereIn('group_id', $groups)
            ->where('member_type', User::class)
            ->pluck('member_id')
            ->toArray();
        $users = array_merge($users, $usersGroups);
        $emails = User::whereIn('id', $users)
            ->pluck('email')
            ->toArray();

        //Add additional emails
        foreach ($additionalEmails as $item) {
            $item = $mustache->render($item, $data);
            foreach (explode(",", $item) as $email) {
                $emails[] = trim($email);
            }
        }

        //load Body
        if ($type === 'screen') {
            //screen definition
            $screen = Screen::find($mustache->render($config['screenRef'], $data));
            $rendered = ScreenRenderer::render($screen->config, $data);
            $config['body'] = $rendered;
        } else if ($type !== 'html') {
            //Plain text
            $config['body'] = htmlentities($mustache->render($config['textBody'], $data), ENT_QUOTES, 'UTF-8');
        }

        //change mustache
        $config['subject'] = $mustache->render($config['subject'], $data);
        $config['email'] = array_filter($emails);

        $this->properties = $config;

        return $this->properties;
    }

    private function getData($config, $data)
    {
        //Mustache
        $mustache = new \Mustache_Engine;
        if (is_array($config)) {
            return $config;
        }
        $data = $mustache->render($config, $data);

        if (!is_array($data)) {
            $data = explode(',', $data);
        }

        return $data;
    }
}
