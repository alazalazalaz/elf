<?php
/**
* 这里面的数据取了必须立即清除
*/
namespace ElfFramework\Db\SqlBuilder;
use ElfFramework\Exception\CommonException;

class BindValue
{
	
	private static $bindValue = [];

	public static function setBindValue($label, $value, $symbol){
		
		$normalSymbol = ['=', '!=', '>=', '<=', '>', '<', 'like', 'not like'];
		if (in_array($symbol, $normalSymbol)) {

			self::$bindValue[] = ['column'=> $label, 'value' => $value];

		}elseif ($symbol == 'between' || $symbol == 'not between') {

			if (!is_array($value) || count($value)<2) {
				throw new CommonException('sql拼接错误，between函数必须包含两个参数', 1);
			}
			self::$bindValue[] = ['column'=> $label . '_start', 'value' => $value[0]];
			self::$bindValue[] = ['column'=> $label . '_end', 'value' => $value[1]];

		}

		// elseif ($symbol == 'like' || $symbol == 'not like') {

		// 	self::$bindValue[] = ['column'=> ':' . $column, 'value' => '%' . $value . '%'];

		// }

		// elseif ($symbol == 'left like') {

		// 	self::$bindValue[] = ['column'=> ':' . $column, 'value' => '%' . $value];

		// }elseif ($symbol == 'right like') {

		// 	self::$bindValue[] = ['column'=> ':' . $column, 'value' => $value . '%'];
			
		// }
	}


	public static function setBindValuePure($keyValueArray = array()){
		if (!is_array($keyValueArray)) {
			throw new CommonException('sql拼接错误，setBindValuePure函数必须是关联数组', 1);
		}
		foreach ($keyValueArray as $column => $value) {
			self::$bindValue[] = ['column'=> $column, 'value' => $value];
		}
	}

	
	public static function getBindValue(){
		return self::$bindValue;
	}


	public static function clearBindValue(){
		self::$bindValue = [];
	}


}
