<?php if(get_sub_field('col_1') != '' || get_sub_field('col_2') != '' || get_sub_field('col_3') != '') { ?>
<section class="container col_three_content <?php include 'partials/_margins.php'; ?>">
	<div class="row clearfix" id="<?php if(get_sub_field('hash_key') != '') { echo the_sub_field('hash_key'); }; ?>">
		<?php if(get_sub_field('col_1') != '' || get_sub_field('image_col_1') != '') { ?>
			<div class="col-md-4">
				<?php
				if(strpos(get_sub_field('col_three_container_layout_option'), 'headline')) {
					$headline_type = get_sub_field( 'headline_col_3_type' );
					$headline      = get_sub_field( 'headline_col_3' );
					include 'partials/_headline.php';
				}
				?>
				<?php $image = get_sub_field('image_col_1'); ?>
				<?php include 'partials/_col_image.php'; ?>
				<?php the_sub_field('col_1'); ?>
			</div>
		<?php } ?>
		<?php if(get_sub_field('col_2') != '' || get_sub_field('image_col_2') != '') { ?>
			<div class="col-md-4">
				<?php
				if(strpos(get_sub_field('col_three_container_layout_option'), 'headline')) {
					$headline_type = get_sub_field( 'headline_col_3_type' );
					$headline      = get_sub_field( 'headline_col_3' );
					include 'partials/_headline.php';
				}
				?>
				<?php $image = get_sub_field('image_col_2'); ?>
				<?php include 'partials/_col_image.php'; ?>
				<?php the_sub_field('col_2'); ?>
			</div>
		<?php } ?>
		<?php if(get_sub_field('col_3') != '' || get_sub_field('image_col_3') != '') { ?>
			<div class="col-md-4">
				<?php
				if(strpos(get_sub_field('col_three_container_layout_option'), 'headline')) {
					$headline_type = get_sub_field( 'headline_col_3_type' );
					$headline      = get_sub_field( 'headline_col_3' );
					include 'partials/_headline.php';
				}
				?>
				<?php $image = get_sub_field('image_col_3'); ?>
				<?php include 'partials/_col_image.php'; ?>
				<?php the_sub_field('col_3'); ?>
			</div>
		<?php } ?>
	</div>
</section>
<?php } ?>
