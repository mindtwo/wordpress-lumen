<?php

namespace WpTheme\PostTypes;

/**
 * Class PostType
 */
abstract class PostType {

    /**
     * Declared in implementation
     *
     * @var string
     */
    protected $post_type = '';

    /**
     * Initialize
     */
    function __construct() {}
}