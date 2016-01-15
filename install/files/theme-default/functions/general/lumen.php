<?php

/**
 * Load Lumen application
 */
try {
    $request = Illuminate\Http\Request::capture();
    $app = require THEME_APPLICATION_DIR.'/lumen/bootstrap/app.php';
    $app->run($request);
} catch (Exception $e) {}