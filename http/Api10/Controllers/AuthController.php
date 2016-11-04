<?php

namespace Api10\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Api10\Models\AuthModel;

class AuthController extends BaseController
{

    /**
     * Get User Session Token
     *
     * @param Request $request
     */
    public function getToken(Request $request)
    {
        $jsonParse = json_decode($request->getContent(), true);
        if(!$jsonParse)
            return responseJSON(400, null, 'Authentication failed. Invalid Json request.');

        if(empty($jsonParse['username']))
            return responseJSON(400, null, 'Authentication failed. Required parameter missing: username.');
        else if(empty($jsonParse['password']))
            return responseJSON(400, null, 'Authentication failed. Required parameter missing: password.');
        else
            return AuthModel::doLogin($jsonParse['username'], $jsonParse['password']);
    }

}
