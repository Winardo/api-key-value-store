<?php

namespace App\Http\Helpers;

use DB;

class GeneralHelper {

	public static function encryptPassword($str)
	{
		$salt = config('config.default_salt');		

		return sha1($salt . trim($str));		
	}
	
}

?>