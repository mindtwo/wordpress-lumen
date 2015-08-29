<?php

function myplugin_register_widgets() {
	register_widget('CustomSearch_Widget');
}

add_action( 'widgets_init', 'myplugin_register_widgets' );