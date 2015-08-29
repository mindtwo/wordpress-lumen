<?php if($image) { ?>
	<picture>
		<!--[if IE 9]><audio><![endif]-->
		<source data-srcset="<?php echo $image['sizes']['rectangular-mobile']; ?>" media="--small">
		<source data-srcset="<?php echo $image['sizes']['rectangular']; ?>" media="--large">
		<!--[if IE 9]></audio><![endif]-->
		<img src="<?php echo $image['sizes']['rectangular-mobile']; ?>" class="lazyload" alt="<?php echo $image['alt']; ?>">
	</picture>
	<?php unset($image); ?>
<?php } ?>
