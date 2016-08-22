<?php

namespace WpTheme\Shortcodes;

use Illuminate\Support\ServiceProvider;

class ShortcodesRegister extends ServiceProvider {

    /**
     * @var array
     */
    public $shortcodes = [
        \WpTheme\Shortcodes\Module\ShortcodeBox::class,
        \WpTheme\Shortcodes\Module\ShortcodeFontAwesome::class,
        \WpTheme\Shortcodes\Module\ShortcodeYoutube::class,
        \WpTheme\Shortcodes\Module\ShortcodeVimeo::class,
        \WpTheme\Shortcodes\Module\ShortcodeIframe::class,
        \WpTheme\Shortcodes\Module\ShortcodeButton::class,
        \WpTheme\Shortcodes\Module\ShortcodeFlexibleContents::class,
        \WpTheme\Shortcodes\Module\ShortcodeForm::class,
        \WpTheme\Shortcodes\Module\ShortcodeGlobalJavascriptVars::class,
        \WpTheme\Shortcodes\Module\ShortcodeHr::class,
        \WpTheme\Shortcodes\Module\ShortcodeLatestPosts::class,
        \WpTheme\Shortcodes\Module\ShortcodeResponsiveImage::class,
        \WpTheme\Shortcodes\Module\ShortcodeTestimonialSlider::class,
        \WpTheme\Shortcodes\Module\ShortcodesAcfOptions::class,
        \WpTheme\Shortcodes\Module\ShortcodesBootstrap::class,
        // \WpTheme\Shortcodes\Module\ShortcodesAcfShortcodes::class,
    ];

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot() {
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
            $this->app->make($shortcode);
        }

        // Debug: Show all active shortcodes:
        // global $shortcode_tags;
        // echo "<pre>"; print_r($shortcode_tags); echo "</pre>";
        // die();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        foreach($this->shortcodes as $shortcode) {
            $this->app->singleton($shortcode, $shortcode);
        }
    }
}