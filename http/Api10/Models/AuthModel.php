<?php 

namespace Api10\Models;

use App\Http\Models\BaseModel;
use App\Http\Models\Mysql\User;
use App\Http\Models\Mysql\UserSession;
use App\Http\Helpers\GeneralHelper;

class AuthModel extends BaseModel
{
	public static function getUserSession($token)
	{
		$now = date('Y-m-d H:i:s');
		$session = UserSession::where('token', $token)->where('expiredAt', '>', $now)->first();

		if(empty($session)) return false;

		return [
            'userUUID' => $session->userUUID,
            'username' => $session->username,
        ];
	}

	public static function doLogin($username, $password)
	{		
		$hashPassword = GeneralHelper::encryptPassword($password);

		$user = User::where(['username' => $username, 'password' => $hashPassword, 'status' => 'active'])->first();

		return self::_dataSession($user);
	}

	private static function _dataSession($user)
	{		
		if(empty($user)) 
			return responseJSON(404, null, 'Authentication failed. Invalid username or password.');

		$token = self::_createToken($user); 

		if(empty($token))
			return responseJSON(500, null, 'Something went wrong when requesting token.');	

		$data =  [
			'token' => $token,
		];

		return responseJSON(200, $data, 'Authentication success. Token will be expired in 2 hours.');
	}
	
	private static function _createToken($user)
	{
		$token = sha1('user-'. $user->userId .'-token-' . microtime(true));

		$model = new UserSession();
		$model->token = $token;
		$model->userId = $user->userId;
		$model->userUUID = $user->userUUID;
		$model->username = $user->username;
		$model->createdAt = date('Y-m-d H:i:s');
		$model->expiredAt = date('Y-m-d H:i:s', strtotime('+2 hour'));

		if($model->save())
			return $token;
		else		
			return '';			
	}

}