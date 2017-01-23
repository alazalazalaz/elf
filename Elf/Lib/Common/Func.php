<?php
/**
* 一些通用方法
*/
namespace Elf\Lib;

class Func
{

	/**
	 * @return string 返回当前消耗的内存
	 */
	public static function getMemUse(){
		$size = memory_get_usage();
   
		return self::formateByte($size);
	}


	/**
	 * 格式化字节
	 * @param  int $size 字节数
	 * @return string
	 */
	public static function formateByte($size){
		if (empty($size) || !intval($size)) {
			return 0;
		}

		$unit=array('B','KB','MB','GB','TB','PB'); 

		return round($size/pow(1024,($i=floor(log($size,1024)))),2).$unit[$i];
	}


	public static function time(){
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	
}