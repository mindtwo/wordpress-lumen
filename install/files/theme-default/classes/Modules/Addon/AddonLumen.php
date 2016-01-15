<?php

namespace WpTheme\Modules\Addon;

use Illuminate\Http\Request;

class AddonLumen {
    /**
     * Load Lumen application
     */
    public function register() {
        try {
            $request = Request::capture();
            $app = require THEME_APPLICATION_DIR.'/lumen/bootstrap/app.php';
            $app->run($request);
            return $app;
        } catch (Exception $e) {}
    }
}