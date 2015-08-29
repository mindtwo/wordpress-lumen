<?php if(get_sub_field('slides_wrapper', $post_id)){ ?>
	<section class="carousel" id="<?php if(get_sub_field('hash_key') != '') { echo the_sub_field('hash_key'); }; ?>">
		<!-- Main slider mask -->
		<div class="mask">
			<div class="slideset">
				<?php while(has_sub_field('slides_wrapper', $post_id)){ ?>
					<?php $image = get_sub_field('image'); ?>
					<?php $image_responsive = get_sub_field('image_responsive'); ?>

					<div class="slide win-width">
						<?php if(get_sub_field('headline') || get_sub_field('subline')) { ?>
							<div class="slider-caption">
								<?php if(get_sub_field('headline')) { ?>
									<strong><?php the_sub_field('headline'); ?></strong><br>
								<?php } ?>
								<?php if(get_sub_field('subline')) { ?>
									<strong class="red"><?php the_sub_field('subline'); ?></strong>
								<?php } ?>
							</div>
						<?php } ?>

						<picture>
							<!--[if IE 9]><audio><![endif]-->
							<source data-srcset="<?php echo ($image_responsive) ? $image_responsive['sizes']['slider-image-mobile'] : $image['sizes']['slider-image-mobile']; ?>" media="--small">
							<source data-srcset="<?php echo $image['sizes']['slider-image']; ?>" media="--large">
							<!--[if IE 9]></audio><![endif]-->
							<img src="<?php echo ($image_responsive) ? $image_responsive['sizes']['slider-image-mobile'] : $image['sizes']['slider-image-mobile']; ?>" class="lazyload" alt="<?php echo $image['alt']; ?>">
						</picture>
					</div>
				<?php } ?>
			</div>
		</div>
		<!-- Pagination will generate here -->
		<nav class="pagination"></nav>
	</section>
<?php } ?>