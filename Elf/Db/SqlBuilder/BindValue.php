<?php
/**
* 这里面的数据取了必须立即清除
*/
namespace Elf\Db\SqlBuilder;
use Elf\Exception\CommonException;

class BindValue
{
	
	private static $bindValue = [];

	public static function setBindValue($label, $value){
		
		self::$bindValue[] = ['column'=> $label, 'value' => $value];
		
	}


	public static function setBindValuePure($keyValueArray = array(), $isMulti = FALSE){
		if (!is_array($keyValueArray)) {
			throw new CommonException('sql拼接错误，setBindValuePure函数必须是关联数组', 1);
		}
		if ($isMulti) {
			foreach ($keyValueArray as $column => $value) {
				$tmp = '';
				foreach ($value as $k => $v) {
					$tmp[] = ['column'=> $k, 'value' => $v];
				}
				if (!empty($tmp)) {
					self::$bindValue[] = $tmp;
				}
			}
		}else{
			foreach ($keyValueArray as $column => $value) {
				self::$bindValue[] = ['column'=> $column, 'value' => $value];
			}
		}
		
	}

	
	public static function getBindValue(){
		return self::$bindValue;
	}


	public static function clearBindValue(){
		self::$bindValue = [];
	}


}
