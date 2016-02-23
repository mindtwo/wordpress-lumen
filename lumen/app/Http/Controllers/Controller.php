<?php

namespace App\Http\Controllers;

use App\Modules\Mailer\MailData;
use Laravel\Lumen\Routing\Controller as BaseController;
use PHPMailer;

class Controller extends BaseController
{
    protected $mail_data;
    protected $mailer;

    public function __construct(MailData $mail_data, PHPMailer $mailer) {
        $this->mail_data = $mail_data;
        $this->mailer = $mailer;
    }

    public function set_mailer_default_options($mail_data) {
        if(array_key_exists('options_mail_type', $mail_data) && $mail_data['options_mail_type'] == 'smtp') {
            $this->mailer->isSMTP();
            $this->mailer->Host = $this->mail_data['options_smtp_host'];
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $this->mail_data['options_smtp_username'];
            $this->mailer->Password = $this->mail_data['options_smtp_password'];
            $this->mailer->SMTPSecure = $this->mail_data['options_smtp_secure'];
            $this->mailer->Port = $this->mail_data['options_smtp_port'];
        } else {
            $this->mailer->isSendmail();
        }
    }
}