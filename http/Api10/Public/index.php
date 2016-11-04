<?php

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
   header( "HTTP/1.1 200 OK" );
   exit();
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

$app = require __DIR__.'/../../../bootstrap/app.php';

$viewpaths = Config('view.paths');
array_push($viewpaths, realpath(base_path('http/Api10/Views')));
Config(['view.paths' => $viewpaths]);

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

$app->group(['namespace' => 'Api10\Controllers'], function ($app) {
    require __DIR__.'/../Routes/routes.php';
});

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$app->run();
