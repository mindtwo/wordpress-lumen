<?php
if (get_field('sidebar')) {
    $sidebar = get_field('sidebar');
} else {
    $sidebar = 'Sidebar Blog';
}

if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar)) : else :


endif;