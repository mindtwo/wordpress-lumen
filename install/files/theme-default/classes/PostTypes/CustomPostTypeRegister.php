<?php

namespace WpTheme\PostTypes;

class CustomPostTypeRegister {

    /**
     * @var array
     */
    public $custom_types = [
        \WpTheme\PostTypes\Type\Conversion::class,
        \WpTheme\PostTypes\Type\Faq::class,
        \WpTheme\PostTypes\Type\Job::class,
        \WpTheme\PostTypes\Type\Lexicon::class,
        \WpTheme\PostTypes\Type\Team::class,
        \WpTheme\PostTypes\Type\Testimonial::class,
    ];

    /**
     * Register custom post types
     */
    public function __construct() {
        foreach($this->types as $type) {
            (new $type)->register();
        }
    }

}