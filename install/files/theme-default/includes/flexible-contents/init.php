<?php
$post_id = false;

if( is_home() ) {
	$post_id = get_field('blog_page_id', 'option');
}

if( isset($footer) && $footer ) {
	$post_id = 'option';
}

if( have_rows('flexibel-content', $post_id) )
{
	while( have_rows("flexibel-content",$post_id) ) : the_row();
		if( get_row_layout() == "col_three_content" )
		{
			include('_col_three_content.php');
		}
		elseif( get_row_layout() == "col_two_content" )
		{
			include('_col_two_content.php');
		}
		elseif( get_row_layout() == "col_one_content" )
		{
			include('_col_one_content.php');
		}
		elseif( get_row_layout() == "shortcode" )
		{
			include('_shortcode.php');
		}
		elseif( get_row_layout() == "slider" )
		{
			include('_slider.php');
		}
		elseif( get_row_layout() == "seperator" )
		{
			include('_seperator.php');
		}
	endwhile;
}