<?php

    /**
     * Load header
     */
    get_header();

	// Load is_home() "Blog Front Page" postdata
	if (is_home()) {
		$page = get_is_home_pagedata();
	}

	// Interate css classes
	$interate_classes = array(
		0 => array(
			'col-lg-5 col-md-5 col-sm-5 col-xs-3',
			'col-lg-7 col-md-7 col-sm-7 col-xs-9 text-holder',
		),
		1 => array(
			'col-lg-5 col-md-5 col-sm-5 col-xs-3 col-lg-push-7 col-md-push-7 col-sm-push-7',
			'col-lg-7 col-md-7 col-sm-7 col-xs-9 col-lg-pull-5 col-md-pull-5 col-sm-pull-5 text-holder',
		),
	);

?>
<section class="banner">
	<!-- Banner Background -->
	<div class="bg-stretch"><img src="<?php theme_images_path(); ?>bg-banner-<?php theme_site_name(); ?>.jpg" <?php if(get_the_title()){ ?>alt="<?php the_title(); ?>"><?php } ?></div>
	<header class="headings container layout_headline">
			<?php if(is_tag()){ ?>
				<h1>Tag "<?php single_tag_title(); ?>":</h1>
			<?php } elseif(is_category()){ ?>
				<h1>Kategorie "<?php single_cat_title(); ?>":</h1>
			<?php } elseif(is_home()) {  ?>
				<?php if(!empty($page['content'])) {echo '<p>' . $page['content'] . '</p>';} ?>
			<?php }  ?>
	</header>
</section>


<div id="content" class="container">
	<div class="row">
		<div class="col-lg-12 category_list">

			<strong>Kategorien: </strong>
			<ul>
				<?php wp_list_categories( array(
					'show_option_all'    => '',
					'orderby'            => 'name',
					'order'              => 'ASC',
					'style'              => 'list',
					'show_count'         => 0,
					'hide_empty'         => 1,
					'use_desc_for_title' => 1,
					'child_of'           => 0,
					'feed'               => '',
					'feed_type'          => '',
					'feed_image'         => '',
					'exclude'            => '',
					'exclude_tree'       => '',
					'include'            => '',
					'hierarchical'       => 1,
					'title_li'           => '',
					'show_option_none'   => '',
					'number'             => null,
					'echo'               => 1,
					'depth'              => 0,
					'current_category'   => 0,
					'pad_counts'         => 0,
					'taxonomy'           => 'category',
					'walker'             => null
				) ); ?>
			</ul>
		</div>
	</div>
	<hr>
    <div class="post-holder row">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php $tmp_classes = $interate_classes[0]; $interate_classes = array_reverse($interate_classes); ?>
            <article id="post_<?php the_ID(); ?>" <?php post_class('clearfix blog-post row'); ?> role="article" itemprop="blogPosts" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="<?php echo $tmp_classes[0]; ?>">
					<?php include(THEME_INCLUDES . 'partials/blog-thumbnail.php'); ?>
                </div>
                <div class="<?php echo $tmp_classes[1]; ?>">
	                <time itemprop="datePublished" content="<?php echo get_the_date('Y-m-d'); ?>">
		                <span class="fa fa-clock-o"></span> <?php echo get_the_date('j. F Y'); ?>
	                </time>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                    <a class="read-more" href="<?php the_permalink(); ?>">Mehr: <?php the_title(); ?></a>
                </div>
            </article>
        <?php endwhile; else : ?>
            <article class="blog-post row">
                <h2>Oops, Es wurde kein Inhalt gefunden!</h2>
            </article>
        <?php endif; ?>
    </div>

    <?php require_once(THEME_INCLUDES . 'general/pager.inc.php'); ?>
</div>
<?php get_footer(); ?>
