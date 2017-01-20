<?php
/**
* system.php
*/
namespace Elf\System;
use Elf\Lib\Response;

class System
{
	private static $isCli = FALSE;

	private static $elfVersion = 'ELF/1.0';


	public static function init(){
		self::$isCli = (PHP_SAPI == 'cli') ? TRUE : FALSE;

		Response::header('X-Powered-By', self::version());
		
	}


	public static function isCli(){
		return self::$isCli;
	}


	public static function version(){
		return self::$elfVersion;
	}

}