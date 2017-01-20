<?php

/**
* session核心类
* @todo  如果是cli模式下怎么办？
*/
namespace Elf\Lib\Session;
use Elf\Exception\CommonException;
use Elf\Lib\Hash;

class CoreSession
{
	
	public static $isStart = FALSE;

	public static function start($sessionId = ''){
		if (self::$isStart) {
			return TRUE;
		}

		if (session_status() === \PHP_SESSION_ACTIVE) {
			throw new CommonException("session已经启动", 1);
		}

		if (!session_start($sessionId)) {
			throw new CommonException("session启动失败，sessionId:" . $sessionId, 1);
		}

		self::$isStart = TRUE;
	}


	public static function getId(){
		return session_id();
	}


	public static function getName(){
		return session_name();
	}


	/**
	 * @param  string eg:session::get('user') || session::get('user.uid')
	 * @return string || NULL
	 */
	public static function get($keys){
		if (!self::$isStart) {
			throw new CommonException("session未启动", 1);
		}
		
		$session = isset($_SESSION) ? $_SESSION : array();

		return Hash::get($session, $keys);
	}


	public static function set($key, $value){
		if (!self::$isStart) {
			throw new CommonException("session未启动", 1);
		}

		return $_SESSION = Hash::set($_SESSION, $key, $value);
	}
	
}