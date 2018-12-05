<?php

namespace ProcessMaker\Packages\Connectors\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailMessage extends Mailable
{

    use Queueable,
        SerializesModels;

    public $config;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('about@processmaker.com')
                ->subject($this->config['subject'])
                ->view('email::welcome')
                ->with(
                    [
                        'url' => url('/'),
                        'logo' => url('/img/processmaker_icon.png'),
                        'name' => $this->config['name'],
        ]);
    }
}
