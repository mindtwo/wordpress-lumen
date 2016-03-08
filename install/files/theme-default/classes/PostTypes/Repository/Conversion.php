<?php

namespace WpTheme\PostTypes\Repository;

use WpTheme\PostTypes\PostTypeRepository;

class Conversion extends PostTypeRepository {
    public function __construct() {

        parent::__construct();

        if( function_exists( 'add_action' ) ) {
            add_action('acf/render_field', [$this, 'action_function_name'], 10, 1);
        }
    }

    public function action_function_name($field) {
        if(array_key_exists('key', $field) && $field['key'] == 'field_56d877f078c73') {
            $nonce = wp_create_nonce('conversion_html');
            echo '<style type="text/css">#acf-field_56d877f078c73 { display:none; }</style>';
            echo '<iframe style="border:1px solid #DDD; width: 100%; height: 500px;" src="' . $this->get_admin_url() . '?action=conversion_html&conversion_id=562&nonce='.$nonce.'"></iframe>';
        }
    }

    protected function get_admin_url() {
        if(function_exists( 'admin_url' )) {
            return admin_url( 'admin-ajax.php' );
        }

        return '/wp-admin/admin-ajax.php';
    }
}