<?php

if( function_exists('is_wordpress') && !is_wordpress() ) {
    require_once __DIR__ . '/../vendor/autoload.php';

    try {
        ( new Dotenv\Dotenv( __DIR__ . '/../' ) )->load();
    } catch ( Dotenv\Exception\InvalidPathException $e ) {
        //
    }
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

if(!is_wordpress()) {
    $app->withFacades();
    $app->withEloquent();
}

/*
|--------------------------------------------------------------------------
| Load Configuration Files
|--------------------------------------------------------------------------
*/

$configuration_files = [
    'app',
    'auth',
    'broadcasting',
    'cache',
    'comment',
    'database',
    'filesystems',
    'mail',
    'queue',
    'session',
    'sites',
    'view',
    'services',
];

foreach($configuration_files as $config) {
    $app->configure($config);
}

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//    App\Http\Middleware\ExampleMiddleware::class
// ]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(App\Providers\TwigServiceProvider::class);
$app->register(App\Providers\TwigInstallerServiceProvider::class);

$app->singleton('filesystem', function ($app) {
    return $app->loadComponent(
        'filesystems',
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        'filesystem'
    );
});

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

if(!is_wordpress()) {
    $app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
        require __DIR__.'/../app/Http/routes.php';
    });
}

return $app;
