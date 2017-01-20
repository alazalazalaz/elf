<?php


/**
* 自动加载
*/
namespace ElfFramework\Autoload;
use ElfFramework\Exception\CommonException;
use ElfFramework\Lib\Config;

class CoreAutoload
{
	private static $autoloadClassMap 	= array();
	
	public function __construct(){
		self::$autoloadClassMap = require 'AutoloadClassMap.php';
		$usersClassMap 		= Config::load('classMap');
		if (!empty($usersClassMap)) {
			self::$autoloadClassMap = array_merge(self::$autoloadClassMap, $usersClassMap);
		}
	}


	public function init(){
		spl_autoload_register(array($this, 'loadClass'));
	}


	private function loadClass($namespaceClassName){
			
		if (isset(self::$autoloadClassMap[$namespaceClassName])) {
			// echo '<br>elf class map';
			require self::$autoloadClassMap[$namespaceClassName];
			return TRUE;
		}


		$fileFullPath 	= ROOT_PATH . str_replace(DS, '\\', $namespaceClassName) . EXT;
		if (file_exists($fileFullPath)) {
			// echo '<br>auto find';
			require $fileFullPath;
			return TRUE;
		}

		// echo 'others =====';

		//注释掉抛出异常，让程序继续跑，因为有可能其他vendor里面有注册自动加载功能。比如smarty。spl_autoload_register按照调用先后顺序，依次执行注册的函数。
		// throw new CommonException('目录：' . $fileFullPath . ' 找不到该文件。');

	}

}