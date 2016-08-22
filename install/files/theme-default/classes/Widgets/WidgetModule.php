<?php

namespace WpTheme\Widgets;

use Laravel\Lumen\Application;
use ReflectionClass;
use Timber;
use WP_Widget;

abstract class WidgetModule extends WP_Widget {

    protected $app;
    protected $widget_name;
    protected $widget_description;
    protected $options;
    protected $fields = [];

    /**
     * Widget Module constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app) {
        $this->app = $app;
        $this->register();

        parent::__construct(
            $this->get_widget_name_by_classname(),
            $this->widget_name,
            [
                'classname' => get_class($this),
                'description' => $this->widget_description,
            ]
        );
    }


    /**
     * @return mixed
     */
    abstract public function register();

    /**
     * Render backend widget form
     *
     * @param array $instance
     *
     * @return array
     */
    public function form( $instance ) {
        if(!empty($this->fields)) {
            foreach($this->fields as $field) {
                $func_name = 'render_' . $field['type'];
                if(is_callable(array($this, $func_name))){
                    $this->$func_name($instance, $field);
                }
            }
        }
        return $instance;
    }


    /**
     * Update field data on widget save
     *
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        if(!empty($this->fields)) {
            foreach($this->fields as $field) {
                $instance[$field['name']] = ( ! empty( $new_instance[$field['name']] ) ) ? $new_instance[$field['name']] : '';
            }
        }
        return $instance;
    }


    /**
     * Render form input in WordPress backend
     *
     * @param $instance
     * @param $field
     */
    protected function render_input_text($instance, $field) {
        $field = array_merge($field, [
            'id' => $this->get_field_id( $field['name'] ),
            'name' => $this->get_field_name( $field['name'] ),
            'title' => array_key_exists('title', $field) ? esc_attr( $field['title']) : ucwords(strtolower($field['name'])),
            'value' => array_key_exists($field['name'], $instance) ? esc_attr( $instance[$field['name']]) : '' ,
        ]);

        echo $this->render_view('backend/partials/widget-form-input-text.php.twig', compact('field'));
    }

    /**
     * Render form input number in WordPress backend
     *
     * @param $instance
     * @param $field
     */
    protected function render_input_number($instance, $field) {
        $field = array_merge($field, [
            'id' => $this->get_field_id( $field['name'] ),
            'name' => $this->get_field_name( $field['name'] ),
            'min' => 0,
            'max' => 10,
            'title' => array_key_exists('title', $field) ? esc_attr( $field['title']) : ucwords(strtolower($field['name'])),
            'value' => array_key_exists($field['name'], $instance) ? esc_attr( $instance[$field['name']]) : '' ,
        ]);

        echo $this->render_view('backend/partials/widget-form-input-number.php.twig', compact('field'));
    }


    /**
     * Render form textarea in WordPress backend
     *
     * @param $instance
     * @param $field
     */
    protected function render_textarea($instance, $field) {
        $field = array_merge($field, [
            'id' => $this->get_field_id( $field['name'] ),
            'name' => $this->get_field_name( $field['name'] ),
            'title' => array_key_exists('title', $field) ? esc_attr( $field['title']) : ucwords(strtolower($field['name'])),
            'value' => array_key_exists($field['name'], $instance) ? esc_attr( $instance[$field['name']]) : '' ,
        ]);

        echo $this->render_view('backend/partials/widget-form-textarea.php.twig', compact('field'));
    }


    /**
     * Add a backend widget field
     *
     * @param       $name
     * @param array $args
     */
    protected function add_field($name, $args=[]) {
        $default_title = ucwords(strtolower(str_replace('_', ' ', $name)));
        $args = array_merge([
            'type' => 'input_text',
            'name' => strtolower(str_replace(' ', '_', $name)),
            'title' => array_key_exists('title', $args) ? esc_attr( $args['title']) : $default_title,
        ], $args);
        array_push($this->fields, $args);
    }


    /**
     * Make ACF options available to shortcode templates
     *
     * @return mixed
     */
    protected function get_acf_options() {
        return $this->app->make('AddonACF')->get_option_fields();
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
        $path = TEMPLATE_DIR.'/'.$view;
        $data['options'] = $this->get_acf_options();
        return Timber::compile( $path, (!is_array($data) ? [$data] : $data ) );
    }

    /**
     * Compile content string
     *
     * @param       $string
     * @param array $data
     *
     * @return mixed
     */
    protected function compile_string( $string, $data = [] ) {
        $data['options'] = $this->get_acf_options();
        return Timber::compile_string( $string, (!is_array($data) ? [$data] : $data ) );
    }



    /**
     * Get a default shortcode name based on the classname
     *
     * @return string
     */
    protected function get_widget_name_by_classname() {

        // Get classname and replace "Widget"
        $reflect = new ReflectionClass($this);
        $name = str_replace('Widget', '', $reflect->getShortName());

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
    protected function camel_case_to_undercore_case($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}