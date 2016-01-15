<?php

namespace WpTheme\Modules;

class ModulesRegister {

    /**
     * @var array
     */
    public $types = [
        \WpTheme\Modules\Ajax\AjaxRegister::class,
    ];

    /**
     * Register modules
     */
    public function __construct() {
        foreach($this->types as $type) {
            new $type;
        }
    }

}