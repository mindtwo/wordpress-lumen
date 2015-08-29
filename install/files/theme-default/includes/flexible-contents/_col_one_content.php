<?php if(get_sub_field('col_1') != '' || get_sub_field('image_col_1') != '') { ?>
<section class="container col_one_content <?php include 'partials/_margins.php'; ?>">
	<div class="row clearfix " id="<?php if(get_sub_field('hash_key') != '') { echo the_sub_field('hash_key'); }; ?>">
		<div class="col-sm-12">
			<?php $image = get_sub_field('image_col_1'); ?>
			<?php include 'partials/_col_image.php'; ?>
			<?php the_sub_field('col_1'); ?>
		</div>
	</div>
</section>
<?php } ?>


