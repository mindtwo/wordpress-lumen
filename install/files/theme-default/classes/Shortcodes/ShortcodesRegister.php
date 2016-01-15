<?php

namespace WpTheme\Shortcodes;

class ShortcodesRegister {

    /**
     * @var array
     */
    public $shortcodes = [
        \WpTheme\Shortcodes\Module\ShortcodeBox::class,
        \WpTheme\Shortcodes\Module\ShortcodeButton::class,
        \WpTheme\Shortcodes\Module\ShortcodeFlexibleContents::class,
        \WpTheme\Shortcodes\Module\ShortcodeForm::class,
        \WpTheme\Shortcodes\Module\ShortcodeGlobalJavascriptVars::class,
        \WpTheme\Shortcodes\Module\ShortcodeHr::class,
        \WpTheme\Shortcodes\Module\ShortcodeLatestPosts::class,
        \WpTheme\Shortcodes\Module\ShortcodeResponsiveImage::class,
        \WpTheme\Shortcodes\Module\ShortcodesAcfOptions::class,
        \WpTheme\Shortcodes\Module\ShortcodesBootstrap::class,
    ];

    /**
     * Register shortcodes
     */
    public function __construct() {
        // Move wpautop filter to AFTER shortcode is processed
        remove_filter( 'the_content', 'wpautop' );
        add_filter( 'the_content', 'wpautop', 99 );
        add_filter( 'the_content', 'shortcode_unautop', 100 );

        // The same as above, but for acf
        remove_filter( 'acf_the_content', 'wpautop' );
        add_filter( 'acf_the_content', 'wpautop', 99 );
        add_filter( 'acf_the_content', 'shortcode_unautop', 100 );

        // Register shortcodes
        foreach($this->shortcodes as $shortcode) {
            new $shortcode;
        }

        // Debug: Show all active shortcodes:
        // global $shortcode_tags;
        // echo "<pre>"; print_r($shortcode_tags); echo "</pre>";
        // die();
    }

}