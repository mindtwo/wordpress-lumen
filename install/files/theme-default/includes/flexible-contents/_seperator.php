<?php if(get_sub_field('seperator_layout_option') == 'content_width') { ?>
	<section class="container seperator_container">
		<div class="row clearfix" id="<?php if(get_sub_field('hash_key') != '') { echo the_sub_field('hash_key'); }; ?>">
			<div class="col-sm-12">
				<div class="hr"><hr></div>
			</div>
		</div>
	</section>
<?php } else {?>
	<div class="hr" id="<?php if(get_sub_field('hash_key') != '') { echo the_sub_field('hash_key'); }; ?>"><hr></div>
<?php } ?>
