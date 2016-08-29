<?php
/**
* 一些通用方法
*/
namespace ElfFramework\Lib\Common;

class Func
{

	/**
	 * @return string 返回当前消耗的内存
	 */
	public static function getMemUse(){
		$size = memory_get_usage();
   
		$unit=array('b','kb','mb','gb','tb','pb'); 

		return round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
	}
	
}