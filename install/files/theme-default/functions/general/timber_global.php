<?php

/* functions.php */
add_filter( 'timber_context', 'mytheme_timber_context'  );

function mytheme_timber_context( $context ) {
	$context['options'] = get_fields('option');
	return $context;
}