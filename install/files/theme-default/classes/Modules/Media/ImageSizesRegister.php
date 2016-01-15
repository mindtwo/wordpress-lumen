<?php

namespace WpTheme\Modules\Media;

class ImageSizesRegister {

    /**
     * Initialize
     */
    public function __construct() {
        add_action( 'init', [$this, 'register'] );
    }

    /**
     * Define WordPress image sizes
     * add_image_size ( string $name, int $width, int $height, bool|array $crop = false );
     */
    public function register() {
        add_image_size ( 'square', 600, 600, true );
        add_image_size ( 'square-mobile', 300, 300, true );
        add_image_size ( 'rectangular', 600, 300, true );
        add_image_size ( 'rectangular-mobile', 400, 200, true );
        add_image_size ( 'slider-image', 2545, 830, true );
        add_image_size ( 'slider-image-mobile', 800, 300, array ( 'center', 'center' ) );
    }

}
