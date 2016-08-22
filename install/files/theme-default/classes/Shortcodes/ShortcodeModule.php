<?php

namespace WpTheme\Shortcodes;

use Laravel\Lumen\Application;
use ReflectionClass;
use Timber;

abstract class ShortcodeModule
{

    protected $app;
    protected $options;

    /**
     * Shortcode Module constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {

        $this->app = $app;
        $this->register();

    }

    /**
     * Default register
     */
    public function register()
    {
        $shortcode_name = $this->get_shortcodename_by_classname();
        add_shortcode($shortcode_name, array($this, 'handle'));
    }

    /**
     * Make ACF Options available to shortcode templates
     */
    public function get_acf_options()
    {
        return $this->app->make('AddonACF')->get_option_fields();
    }

    /**
     * Make ACF Options available to shortcode templates
     */
    public function get_site_fields()
    {
        return $this->app->make('AddonACF')->get_site_fields();
    }


    /**
     * Render flexible content view
     *
     * @param       $view
     * @param array $data
     *
     * @return mixed
     */
    protected function render_view($view, $data = [])
    {
        $path = TEMPLATE_DIR . '/' . $view;
        $data['options'] = $this->get_acf_options();
        $data['sites'] = $this->get_site_fields();
        $data['blog_id'] = get_current_blog_id();
        return Timber::compile($path, (!is_array($data) ? [$data] : $data));
    }

    /**
     * Remove multiple spaces from the buffer.
     *
     * @var string $buffer
     * @return string
     */
    function compress_output($buffer)
    {
        // Remove html comments
        $buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);

        $search = array(
            '/\>[^\S]+/s',  // strip whitespaces after tags, except space
            '/[^\S]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s',       // shorten multiple whitespace sequences
            '/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'
        );

        $replace = array(
            '>',
            '<',
            '\\1',
            ' '
        );

        $buffer = preg_replace($search, $replace, $buffer);
        return trim($buffer);
    }

    /**
     * Get a default shortcode name based on the classname
     *
     * @return string
     */
    private function get_shortcodename_by_classname()
    {

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
    private function camel_case_to_undercore_case($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    /**
     * Clean up Shortcode Content
     */
    protected function parse_shortcode_content($content)
    {
        // Parse nested shortcodes and add formatting.
        $content = trim(do_shortcode(shortcode_unautop($content)));

        // Remove '' from the start of the string.
        if (substr($content, 0, 4) == '') {
            $content = substr($content, 4);
        }

        // Remove '' from the end of the string.
        if (substr($content, -3, 3) == '') {
            $content = substr($content, 0, -3);
        }

        // Remove any instances of ''.
        $content = str_replace(array('<p></p>'), '', $content);
        $content = str_replace(array('<p> </p>'), '', $content);

        return $content;
    }

}