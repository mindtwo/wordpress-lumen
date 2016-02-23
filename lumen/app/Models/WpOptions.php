<?php

namespace App\Models;

use Cache;

class WpOptions extends WpModel {
    protected $table = 'options';
    protected $primaryKey = 'option_id';
    public $timestamps = false;

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeMailInfo($query){
        return $query->where('option_name', 'like', 'options_locations%')
                     ->orWhere('option_name', 'home')
                     ->orWhere('option_name', 'template')
                     ->orWhere('option_name', 'options_company_name')
                     ->orWhere('option_name', 'options_logo_image_filename')
                     ->orWhere('option_name', 'options_logo_alt')
                     ->orWhere('option_name', 'options_form_email_from_name')
                     ->orWhere('option_name', 'options_form_email_from')
                     ->orWhere('option_name', 'options_form_email_to_name')
                     ->orWhere('option_name', 'options_form_email_to')
                     ->orWhere('option_name', 'options_mail_type')
                     ->orWhere('option_name', 'options_smtp_host')
                     ->orWhere('option_name', 'options_smtp_username')
                     ->orWhere('option_name', 'options_smtp_password')
                     ->orWhere('option_name', 'options_smtp_secure')
                     ->orWhere('option_name', 'options_smtp_port');
    }

    /**
     * @return mixed
     */
    public function mailInfo() {
        return Cache::rememberForever('mail_info_'.$_SERVER['HTTP_HOST'], function() {
            return $this->query()->mailInfo()->select('option_name','option_value')->get()->pluck('option_value', 'option_name')->toArray();
        });
    }
}