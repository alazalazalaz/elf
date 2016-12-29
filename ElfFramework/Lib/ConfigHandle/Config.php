<?php
/**
* 读取配置文件类
* 暂时只支持配置文件为数组的格式
*/
namespace ElfFramework\Lib;

use ElfFramework\Domain\CoreDomain;
use ElfFramework\Lib\ConfigArray;
use ElfFramework\Exception\CommonException;

class Config
{
	
	private static $configFile = array();


	/**
	 * 单例模式加载
	 * @param  string $configFileName 文件名
	 * @param  string $ext            文件后缀名
	 * @return array                  文件内容
	 */
	public static function load($configFileName , $ext = EXT){
		$key = $file = $configFileName . $ext;

		if (array_key_exists($key, self::$configFile)) {
			return unserialize(self::$configFile[$key]);
		}

		$content 	= self::_getContent($file);
		$content 	= is_array($content) ? $content : NULL;

		return $content;
		// $arrObj = new ConfigArray($file, $content);

		// self::$configFile[$key] 	= serialize($arrObj);

		// return  $arrObj;
	}
	

	/**
	 * 1,如果是子域名，查找子域名的配置
	 * 2,查找app项目的配置
	 * 3,查找系统的配置
	 */
	private static function _getContent($file){
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

		throw new CommonException("找不到配置文件" . $file . "，请在" . APP_NS . "config" . DS . "目录下添加", 1);
		
	}

}