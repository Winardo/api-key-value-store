<?php

$_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'en';

define('__LANGUAGE__', $_SERVER['HTTP_ACCEPT_LANGUAGE']); //default language if not set


//--------------------------------------------------------------------------------------------

if(!empty($_SERVER['HTTP_TOKEN'])) $token = $_SERVER['HTTP_TOKEN'];
else $token = ''; //default token if not set

define('__TOKEN__', $token);

?>