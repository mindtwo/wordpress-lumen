<?php if (function_exists('pagination_navi')) { ?>
    <?php pagination_navi(); ?>
<?php } else { ?>
    <nav class="wp-prev-next">
        <ul class="clearfix">
            <li class="prev-link"><?php next_posts_link('Ältere Beiträge') ?></li>
            <li class="next-link"></li>
        </ul>
    </nav>
<?php } ?>


