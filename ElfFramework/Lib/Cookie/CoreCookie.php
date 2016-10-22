<?php
/**
* cookie核心类
*/
namespace ElfFramework\Lib\Cookie;
use ElfFramework\Config\ConfigHandle\Config;
use ElfFramework\Exception\CommonException;

class CoreCookie
{

	public static function get($key){
		return isset($_COOKIE[$key]) ? $_COOKIE[$key] : '';
	}


	/**
	 * @param string 
	 * @param string
	 * @param int 	seconds
	 * @param string
	 * @return   bool
	 */
	public static function set($key, $value, $exp, $path= '/'){
		if (empty($key)) {
			throw new CommonException("设置cookie的键值不能为空", 1);
		}

		if (!is_string($value) && !is_int($value)) {
			throw new CommonException("设置cookie的值只能为string或int", 1);	
		}

		$exp 	= intval($exp);
		if (empty($exp)) {
			throw new CommonException("设置cookie的过期时间必须大于0", 1);	
		}

		$exp 	= TIMESTAMP + $exp;
		$domain = Config::load('bootstrap');
		$domain = $domain['cookieDomain'];
		$secure = FALSE;
		$httponly=TRUE;
		
		return setcookie($key, $value, $exp, $path, $domain, $secure, $httponly) ? TRUE : FALSE;
	}
}