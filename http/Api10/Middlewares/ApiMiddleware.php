<?php

namespace Api10\Middlewares;

use Closure;
use Api10\Models\AuthModel;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $__identity__ = $this->_authentication();

        //Empty result of Session or wrong token
        if( $__identity__ === false ) 
            return view('errors.api.error403');

        define('__USER_UUID__'      , $__identity__['userUUID']);
        define('__USERNAME__'       , $__identity__['username']);
        define('__IDENTITY__'       , serialize($__identity__) );

        return $next($request);
    }    

    private function _getToken()
    {
        if(!empty(__TOKEN__))
            $token = __TOKEN__;
        else
            $token = '';

        return $token;
    }

    private function _authentication()
    {
        $token = self::_getToken();
        
        if(empty($token)) return false; //Request with no Header Token

        $session = AuthModel::getUserSession($token);

        if(empty($session)) return false; //Record Token not exist

        return $session;
    }
}
