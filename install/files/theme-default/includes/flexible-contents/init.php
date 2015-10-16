<?php

if( is_home() ) {
	$post_id = get_field('blog_page_id', 'option');
} else {
	$post_id = false;
}

if( have_rows('flexibel-content', $post_id) ) {
	while( have_rows("flexibel-content",$post_id) ) : the_row();
		switch (get_row_layout()) {
			case 'col_three_content':       include('_col_three_content.php');      break;
			case 'col_two_content':         include('_col_two_content.php');        break;
			case 'col_one_content':         include('_col_one_content.php');        break;
			case 'shortcode':               include('_shortcode.php');              break;
			case 'slider':                  include('_slider.php');                 break;
			case 'seperator':               include('_seperator.php');              break;
			case 'service':                 include('_service.php');                break;
			case 'company_teaser':          include('_company_teaser.php');         break;
			case 'latest_news_and_jobs':    include('_latest_news_and_jobs.php');   break;
			case 'customers':               include('_customers.php');              break;
			case 'banner':                  include('_banner.php');                 break;
		}
	endwhile;
}