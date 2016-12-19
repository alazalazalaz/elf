<?php

/**
* 存放单例、hash对象
*/
namespace ElfFramework\Lib\Common;
use ReflectionClass;

class Container
{
	
	private static $_singletons = array();

	private static $_reflections= array();
	
	/**
	 * single function
	 * @todo  可以把classname md5一下来存储
	 * @return object return the class single instance
	 */
	public static function factory($className){
		if (empty($className)) {
			return NULL;
		}

		if (!isset(self::$_singletons[$className])) {
			self::$_singletons[$className] = new $className;
		}

		return self::$_singletons[$className];
	}


	public static function createObject($className, $param = ''){
		if (empty($className)) {
			return NULL;
		}

		$objectKey = empty($param) ? substr(md5($className), 0, 10) : substr(md5($className . serialize($param)), 0, 10);
$testStr = '<br>no create';
		if (!isset(self::$_reflections[$objectKey])) {
			$ref = new ReflectionClass($className);
			if (empty($param)) {
				$testStr = '<br>create instance';
				self::$_reflections[$objectKey] 	= $ref->newInstance();
			}else{
				$testStr = '<br>create instance with param';
				self::$_reflections[$objectKey] 	= $ref->newInstanceArgs($param);
			}
		}
echo $testStr;
		return self::$_reflections[$objectKey];
	}

}