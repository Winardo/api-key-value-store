<?php

$app->group(['prefix' => API_VERSION . '/object', 'namespace' => $namespace], function($app){

	$app->get('/{key}', 'ObjectController@getValue');
	$app->post('/', 'ObjectController@saveValue');
	
});

?>