<?php

if(!Illuminate\Support\Facades\App::runningInConsole()) {
    set_local_in_http_env();
}

// Routs
$app->post('/form-contact', 'FormContactController@store');
$app->post('/form-application', 'FormApplicationController@store');
//$app->post('/form-callback', 'FormCallbackController@store');


