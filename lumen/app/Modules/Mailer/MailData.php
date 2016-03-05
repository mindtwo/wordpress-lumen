<?php

namespace App\Modules\Mailer;

use App\Models\WpOptions;
use Illuminate\Http\Request;

class MailData
{
    private $options;

    public function __construct(WpOptions $options) {
        $this->options = $options;
    }

    public function get(Request $request) {
        $data = $this->options->mailInfo();

        // Get most specific mail
        if(array_key_exists('options_form_email_to',$data)) {
            $mail = $data['options_form_email_to'];
        } elseif(array_key_exists('options_email',$data)) {
            $mail = $data['options_email'];
        }

        return [
            'to' => $mail,
            'to_name' => array_key_exists('options_form_email_to_name',$data) ? $data['options_form_email_to_name'] : false,
            'from' => (array_key_exists('options_form_email_from',$data) && !empty($data['options_form_email_from'])) ? $data['options_form_email_from'] : $mail,
            'from_name' => array_key_exists('options_form_email_from_name',$data) ? $data['options_form_email_from_name'] : false,
            'url' => $data['home'],
            'company_name' => $data['options_company_name'],
            'logo_sever_path' => realpath(base_path() . '/../public/content/themes/' . $data['template'] . '/assets/images/' . $data['options_logo_image_filename']),
            'logo_public_path' => $data['home'] . 'content/themes/' . $data['template'] . '/assets/images/' . $data['options_logo_image_filename'],
            'logo_alt' => $data['options_logo_alt'],
        ];
    }
}