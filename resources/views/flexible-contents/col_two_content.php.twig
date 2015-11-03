<?php
$classes = col_two_container_layout_option_classes();
$headlines = array(get_sub_field('headline_col_1'), get_sub_field('headline_col_2'));
$headline_types = array(get_sub_field('headline_col_1_type'), get_sub_field('headline_col_2_type'));
$contents = array(get_sub_field('col_1'), get_sub_field('col_2'));
$images = array(get_sub_field('image_col_1'), get_sub_field('image_col_2'));


// Get the right image/text order for mobile devices
if(get_sub_field('image_col_2') && !get_sub_field('image_col_1')) {
	$headlines = array_reverse($headlines);
	$headline_types = array_reverse($headline_types);
	$contents = array_reverse($contents);
	$images = array_reverse($images);

	$add_classes_col1 = array_merge(str_replace('col-md-', 'col-md-pull-', $classes[1]),$classes[0]);
	$add_classes_col2 = array_merge(str_replace('col-md-', 'col-md-push-', $classes[0]),$classes[1]);
	$classes = array(implode(' ', $add_classes_col2), implode(' ', $add_classes_col1));
} else {
	$classes = array(implode(' ', $classes[0]), implode(' ', $classes[1]));
}

?>
<?php if(get_sub_field('col_1') != '' || get_sub_field('col_2') != '') { ?>
	<section class="container col_two_content <?php include 'partials/_margins.php'; ?>">
		<div class="row clearfix" id="<?php if(get_sub_field('hash_key') != '') { echo the_sub_field('hash_key'); }; ?>">
			<?php if(get_sub_field('col_1') != '' || get_sub_field('image_col_1') != '') { ?>

				<div class="<?php echo $classes[0]; ?>">
					<?php
						if(strpos(get_sub_field('col_two_container_layout_option'), 'headline') !== false) {
							$headline_type = $headline_types[0];
							$headline      = $headlines[0];
							include 'partials/_headline.php';
						}
					?>
					<?php $image = $images[0]; ?>
					<?php include 'partials/_col_image.php'; ?> 
					<?php echo $contents[0]; ?>
				</div>
			<?php } ?>
			<?php if(get_sub_field('col_2') != '' || get_sub_field('image_col_2') != '') { ?>
				<div class="<?php echo $classes[1]; ?>">
					<?php
					if(strpos(get_sub_field('col_two_container_layout_option'), 'headline') !== false) {
						$headline_type = $headline_types[1];
						$headline      = $headlines[1];
						include 'partials/_headline.php';
					}
					?>
					<?php $image = $images[1]; ?>
					<?php include 'partials/_col_image.php'; ?>
					<?php echo $contents[1]; ?>
				</div>
			<?php } ?>
		</div>
	</section>
<?php } ?>
