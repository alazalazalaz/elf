<?php

/**
* 存放单例、hash对象
*/
namespace Elf\Lib;
use ReflectionClass;

class Container
{
	
	private static $_singletons = array();

	private static $_reflections= array();
	
	/**
	 * single function
	 * @return object return the class single instance
	 */
	public static function factory($className){

		if (empty($className)) {
			return NULL;
		}

		$md5ClassName = md5($className);

		if (!isset(self::$_singletons[$md5ClassName])) {
			self::$_singletons[$md5ClassName] = new $className;
		}

		return self::$_singletons[$md5ClassName];
	}


	public static function createObject($className, $param = ''){
		if (empty($className)) {
			return NULL;
		}

		$objectKey = empty($param) ? substr(md5($className), 0, 10) : substr(md5($className . serialize($param)), 0, 10);
$testStr = '<br>no create ' . $className;
		if (!isset(self::$_reflections[$objectKey])) {
			$ref = new ReflectionClass($className);
			if (empty($param)) {
				$testStr = '<br>create instance' . $className;
				self::$_reflections[$objectKey] 	= $ref->newInstance();
			}else{
				$testStr = '<br>create instance ' . $className . ' with param';
				self::$_reflections[$objectKey] 	= $ref->newInstanceArgs($param);
			}
		}
echo $testStr;
		return self::$_reflections[$objectKey];
	}

}