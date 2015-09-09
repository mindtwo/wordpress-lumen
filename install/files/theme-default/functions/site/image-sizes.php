<?php

/**
 * Define WordPress image sizes
 */
add_image_size( 'square', 600, 600, true );
add_image_size( 'square-mobile', 300, 300, true );
add_image_size( 'rectangular', 600, 300, true );
add_image_size( 'rectangular-mobile', 400, 200, true );
add_image_size( 'slider-image', 2545, 830, true );
add_image_size( 'slider-image-mobile', 600, 300, array( 'center', 'center' ) );