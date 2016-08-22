<?php

namespace WpTheme\PostTypes\Repository;

use WpTheme\PostTypes\PostTypeRepository;

class Conversion extends PostTypeRepository {
    public function __construct() {

        parent::__construct();
        $this->post_type = 'conversion';

    }
}