<?php
namespace Utils;
class AuthenticationToken
 { 
    private static $_registry;

    public static function setToken($token) 
    { 
    	self::$_registry['token'] = $token; 
    }

    public static function getToken() { 
    	if(!isset(self::$_registry['token']))
    		throw InvalidArgumentException("Authentication Token not set!!!");

    	return self::$_registry['token'];
    }
}

?>