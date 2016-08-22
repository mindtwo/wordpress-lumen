<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\PostTypes\Repository\Testimonial;
use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeTestimonialSlider extends ShortcodeModule
{

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'location' => false,
            'headline' => trans('cpt-testimonial.slider.headline'),
        ), $atts));

        $testimonials = (new Testimonial())->latest(['posts_per_page' => 12])['posts'];
        return $this->render_view('partials/shortcode-testimonial-slider.php.twig', compact('headline', 'testimonials'));
    }

}