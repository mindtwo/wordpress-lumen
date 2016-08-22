<?php

namespace WpTheme\PostTypes\Repository;

use WpTheme\PostTypes\PostTypeRepository;

class Testimonial extends PostTypeRepository
{
    public function __construct()
    {

        parent::__construct();
        $this->post_type = 'testimonial';

    }


}