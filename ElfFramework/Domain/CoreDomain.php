<?php

/**
* 域名管理
*/
namespace ElfFramework\Domain;
use ElfFramework\Exception\CommonException;

class CoreDomain
{
	private static $isSubDomain = FALSE;

	
	public static function initDomain(){
		
		if (!defined('DOMAIN_NAME')) {
			throw new CommonException("未定义域名，请在/web/index.php中定义(eg:define('DOMAIN_NAME', 'baidu'))");
		}

		$serverNameArray 	= explode('.', $_SERVER['SERVER_NAME']);

		$currentDomain = current($serverNameArray);

		if ($currentDomain == 'www' || $currentDomain == DOMAIN_NAME) {
			define('APP_PATH', BASE_APP_PATH);
			define('APP_NS', BASE_APP_NS);
		}else{
			if (!is_dir(MOD_PATH . $currentDomain)) {
				throw new CommonException("二级域名" . $_SERVER['SERVER_NAME'] . '对应的modules不存在，请建立modules/' . $currentDomain . '目录');		
			}
			define('APP_PATH', MOD_PATH . $currentDomain . DS);
			define('APP_NS', MOD_NS . $currentDomain . '\\');
			self::$isSubDomain = TRUE;
		}
	}


	public static function isSubDomain(){
		return self::$isSubDomain;
	}
	
}
