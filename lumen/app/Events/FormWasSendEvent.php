<?php

namespace App\Events;

use Illuminate\Http\Request;

class FormWasSendEvent extends Event
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var
     */
    public $title;

    /**
     * @var
     */
    public $conversion_key;

    /**
     * @var
     */
    private $mail_data;

    /**
     * Create a new event instance.
     *
     * @param Request $request
     * @param         $title
     * @param         $conversion_key
     */
    public function __construct(Request $request, $mail_data, $title, $conversion_key)
    {
        $this->request = $request;
        $this->title = $title;
        $this->conversion_key = $conversion_key;
        $this->mail_data = $mail_data;
    }
}
