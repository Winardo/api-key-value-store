<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

define('API_VERSION', '1.0');

$namespace = 'Api10\Controllers';

$segment2 = strtolower(uriSegment(2));

$bypassArr = config('config.bypass_routes');

if(!in_array($segment2, $bypassArr))
{	
	$app->middleware([Api10\Middlewares\ApiMiddleware::class]);
}

require '_auth.php';

require '_object.php';
