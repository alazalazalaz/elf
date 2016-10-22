<?php

/**
* base elf 
*/

namespace ElfFramework\Base;

class BaseElf
{
	private static $_instance = array();
	
	/**
	 * single function
	 * @todo  可以把classname mod5一下来存储
	 * @return object return the class single instance
	 */
	public static function factory($className){
		if (empty($className)) {
			return NULL;
		}

		if (isset(self::$_instance[$className])) {
			return self::$_instance[$className];
		}else{
			self::$_instance[$className] = new $className;
			return self::$_instance[$className];
		}

	}
}

