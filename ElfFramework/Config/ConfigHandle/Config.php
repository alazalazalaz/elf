<?php
/**
* 读取配置文件类
*/
namespace ElfFramework\Config\ConfigHandle;

use ElfFramework\Domain\CoreDomain;

class Config
{
	
	private static $configFile = array();


	public static function load($configFileName , $ext = EXT){
		$file = $configFileName . $ext;

		if (array_key_exists($file, self::$configFile)) {
			return self::$configFile[$file];
		}

		$content 	= self::doLoad($file);
		self::$configFile[$file] 	= is_array($content) ? $content : NULL;
		return  self::$configFile[$file];
	}
	

	/**
	 * 1,查找子域名的配置
	 * 2,查找app项目的配置
	 * 3,查找系统的配置
	 */
	private static function doLoad($file){
		if (CoreDomain::isSubDomain()) {
			$path 	= APP_PATH . 'config' . DS . $file;
			if (is_file($path)) {
				return require $path;
			}
		}

		$path = BASE_APP_PATH . 'config' . DS . $file;
		if (is_file($path)) {
			return require $path;
		}

		$path = ELF_PATH . 'config' . DS . $file;
		if (is_file($path)) {
			return require $path;
		}

		return NULL;
	}

}