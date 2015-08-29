<?php

$margins = array('margin_top', 'margin_bottom');
foreach($margins as $margin_key){
	if(get_sub_field($margin_key) != '') {
		$margin_value = get_sub_field($margin_key);

		if(is_null($margin_value)) {
			$margin_value = "0";
		}

		if($margin_value != 'default') {
			//var_dump('#'.$margin_value.'#');
			echo ' ' . $margin_key . '_' . $margin_value . ' ';
		}
	};
}

