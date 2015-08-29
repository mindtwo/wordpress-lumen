<?php if(get_sub_field('shortcode') != '') { ?>
	<section id="<?php if(get_sub_field('hash_key') != '') { echo the_sub_field('hash_key'); }; ?>" class="<?php include 'partials/_margins.php'; ?>">
		<?php echo do_shortcode('['.get_sub_field('shortcode').']'); ?>
	</section>
<?php } ?>