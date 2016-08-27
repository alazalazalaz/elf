<?php


/**
* 自动加载
*/
namespace ElfFramework\Autoload;
use ElfFramework\Exception\CommonException;

class CoreAutoload
{
	private static $classMap 	= array();

	
	public function __construct(){
		self::$classMap = require 'AutoloadClassMap.php';
	}


	public function init(){
		spl_autoload_register(array($this, 'loadClass'));
	}


	private function loadClass($namespaceClassName){

		$fileFullPath 	= $this->getFilePathByNs($namespaceClassName);
		
		if (file_exists($fileFullPath)) {
			require $fileFullPath;
			return TRUE;
		}

		if (isset(self::$classMap[$namespaceClassName])) {
			require self::$classMap[$namespaceClassName];
			return TRUE;
		}

		throw new CommonException('目录：' . $fileFullPath . ' 找不到该文件。');

	}


	private function getFilePathByNs($namespaceClassName){
		$array 	= explode('\\', $namespaceClassName);
		$firstNs= array_shift($array);

		if ($firstNs == 'ElfFramework') {
			return ELF_PATH . implode(DS, $array) . EXT;
		}else{
			return ROOT_PATH . str_replace(DS, '\\', $namespaceClassName) . EXT;
		}
	}


}