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
        if($request->has('location')) {
            if(array_search($request->location, $data)) {
                $selected_location = preg_split('/(_[0-9]+_+)/',array_search($request->location, $data), 0, PREG_SPLIT_DELIM_CAPTURE);
                list( $sub_location_mail, $location_mail ) = $this->getLocationMail( $selected_location, $data );
            }
        }

        // Get most specific mail
        if(isset($sub_location_mail) && $sub_location_mail) {
            $mail = $sub_location_mail;
        } elseif(isset($location_mail) && $location_mail) {
            $mail = $location_mail;
        } elseif(array_key_exists('options_form_email_to',$data)) {
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

    /**
     * @param $selected_location
     * @param $data
     *
     * @return array
     */
    protected function getLocationMail( $selected_location, $data ) {
        $sub_location_mail = false;
        $selected_location_tmp = $selected_location;
        array_pop( $selected_location_tmp );
        $key = is_array($selected_location_tmp) ? implode( '', $selected_location_tmp ) . 'contact_email': '';
        if ( count( $selected_location ) == 5 && array_key_exists($key , $data ) ) {
            $sub_location_mail = !empty($data[$key]) ? $data[$key]: false;

            // Get Location Mail
            array_pop( $selected_location_tmp );
            $selected_location = $selected_location_tmp;
        }

        return array( $sub_location_mail, $this->getParentLocationEmail( $selected_location, $data ) );
    }

    /**
     * @param $selected_location
     * @param $data
     *
     * @return mixed
     */
    protected function getParentLocationEmail( $selected_location, $data ) {
        $selected_location_tmp = $selected_location;
        array_pop( $selected_location_tmp );
        $key = implode( '', $selected_location_tmp ) . 'contact_email';
        if ( count( $selected_location ) == 3 && array_key_exists($key , $data ) ) {
            return !empty($data[ $key ]) ? $data[ $key ] : false;
        }

        return false;
    }
}