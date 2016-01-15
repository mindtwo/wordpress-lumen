<?php

namespace WpTheme\CustomPostTypes;

class CustomPostTypeRegister {

    /**
     * @var array
     */
    public $types = [
        \WpTheme\CustomPostTypes\Type\Conversion::class,
        \WpTheme\CustomPostTypes\Type\Faq::class,
        \WpTheme\CustomPostTypes\Type\Job::class,
        \WpTheme\CustomPostTypes\Type\Lexicon::class,
        \WpTheme\CustomPostTypes\Type\Page::class,
        \WpTheme\CustomPostTypes\Type\Post::class,
        \WpTheme\CustomPostTypes\Type\Team::class,
        \WpTheme\CustomPostTypes\Type\Testimonial::class,
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