<?php

$app->group(['prefix' => API_VERSION . '/auth', 'namespace' => $namespace], function($app){

	$app->post('get-token', 'AuthController@getToken');
	
});

?>