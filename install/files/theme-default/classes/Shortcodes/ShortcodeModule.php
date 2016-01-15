<?php

namespace WpTheme\Shortcodes;

use ReflectionClass;
use Timber;

abstract class ShortcodeModule {

    /**
     * ShortcodeModule constructor.
     */
    public function __construct() {

        $this->register();

    }

    /**
     * Default register
     */
    public function register() {
        $shortcode_name = $this->get_shortcodename_by_classname();
        add_shortcode( $shortcode_name, array( $this , 'handle' ) );
    }

    /**
     * Render flexible content view
     *
     * @param       $view
     * @param array $data
     *
     * @return mixed
     */
    protected function render_view( $view, $data = [] ) {
        $templete = file_get_contents(TEMPLATE_DIR.'/'.$view);
        return Timber::compile_string( $templete, (!is_array($data) ? [$data] : $data ) );
    }

    /**
     * Get a default shortcode name based on the classname
     *
     * @return string
     */
    private function get_shortcodename_by_classname() {

        // Get classname and replace "Shortcode"
        $reflect = new ReflectionClass($this);
        $name = str_replace(['Shortcode',], '', $reflect->getShortName());

        // Transform camel case to lowercase
        return $this->camel_case_to_undercore_case($name);
    }

    /**
     * Converts a camel case string to a lowercase underscore string
     *
     * @param $input
     *
     * @return string
     */
    private function camel_case_to_undercore_case($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

}