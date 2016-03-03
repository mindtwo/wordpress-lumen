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
    public $email_html;

    /**
     * Create a new event instance.
     *
     * @param Request $request
     * @param         $email_html
     * @param         $title
     * @param         $conversion_key
     */
    public function __construct(Request $request, $email_html, $title, $conversion_key)
    {
        $this->request = $request;
        $this->title = $title;
        $this->conversion_key = $conversion_key;
        $this->email_html = $email_html;
    }
}
