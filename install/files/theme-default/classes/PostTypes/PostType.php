<?php

namespace WpTheme\PostTypes;

use ReflectionClass;

/**
 * Class PostType
 */
abstract class PostType
{

    /**
     * Declared in implementation
     *
     * @var string
     */
    protected $post_type = '';

    /**
     * Initialize
     */
    function __construct()
    {
        // Get classname as default post type name
        if (empty($this->post_type)) {
            $this->post_type = $this->set_default_post_type_name();
        }

        $this->register();
    }

    /**
     * Register action
     */
    abstract public function register();

    /**
     * Register action
     */
    protected function set_default_post_type_name()
    {
        $reflect = new ReflectionClass($this);
        return $this->camel_case_to_undercore_case($reflect->getShortName());
    }

    /**
     * Converts a camel case string to a lowercase underscore string
     *
     * @param $input
     *
     * @return string
     */
    protected function camel_case_to_undercore_case($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}