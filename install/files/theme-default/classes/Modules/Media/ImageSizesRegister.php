<?php

namespace WpTheme\Modules\Media;

class ImageSizesRegister
{

    /**
     * Initialize
     */
    public function __construct()
    {
        add_action('init', [$this, 'register']);

        add_filter('image_size_names_choose', [$this, 'add_image_sizes_to_mediathek']);

    }

    /**
     * Define WordPress image sizes
     * add_image_size ( string $name, int $width, int $height, bool|array $crop = false );
     */
    public function register()
    {
        add_image_size('square', 600, 600, true);
        add_image_size('square-mobile', 300, 300, true);
        add_image_size('rectangular', 750, 350, true);
        add_image_size('rectangular-mobile', 400, 200, true);
        add_image_size('slider-image', 2545, 830, true);
        add_image_size('slider-image-mobile', 800, 300, array('center', 'center'));
    }

    public function add_image_sizes_to_mediathek($sizes)
    {
        $addsizes = array(
            "rectangular" => 'Rectangular'
        );
        $newsizes = array_merge($sizes, $addsizes);
        return $newsizes;
    }
}
