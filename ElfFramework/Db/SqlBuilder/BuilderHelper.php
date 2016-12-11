<?php
/**
* 一些辅助性函数，给sql.php和sqlbuilder.php使用
*/
namespace ElfFramework\Db\SqlBuilder;
use ElfFramework\Db\SqlBuilder\SqlBuilder;
use ElfFramework\Db\SqlBuilder\Sql;
use ElfFramework\Db\SqlBuilder\BindValue;
use ElfFramework\Exception\CommonException;

class BuilderHelper
{

	private static $_bindValue = [];


	/**
	 * 匹配一个字符串中是否有= >= <= > < != 这些符号，如果没有，默认为=(暂时不考虑like)
	 * @param  [string] $key  'id >=' || 'id'
	 * @param  [string] &$column id
	 * @param  [string] &$symbol >=
	 * @return [type] 
	 */
	public static function pregSymbol($key, $value, &$column, &$symbol, &$label, &$columnLabelArr){
		$column = $symbol = $label = '';

		if (empty($key)) {
			return;
		}
		
		$match = '';
		
		if (preg_match("/^(\\w*)\s*(!=|>=|<=|>|<|=|like|not like|between|not between)$/i", strtolower($key), $match)) {
			$column = $match[1];
			$symbol = $match[2];

			$label 	= self::createLabel($column, $columnLabelArr);

			// if ($symbol == 'left like' || $symbol == 'right like') {
			// 	$symbol = 'like';
			// }
			if ($symbol == 'between' || $symbol == 'not between') {
				//单独处理下between的symbol
				$label = $label . '_start' . ' and ' . $label . '_end';
			}
		}else{
			$column = $key;
			$symbol = '=';
			$label 	= self::createLabel($column, $columnLabelArr);
		}

		BindValue::setBindValue($label, $value, $symbol);
	}


	/**
	 * 这他喵的是个递归函数
	 * @param  array  $divisor [description]
	 * @return [type]          [description]
	 */
	public static function explodeDivisor(array $divisor, &$columnLabelArr, $currentLink = ' AND ', $leftBr = '', $rightBr = ''){
		// if (empty($divisor) || count($divisor)<1) {
		// 	throw new CommonException('sql拼接错误，where([key=>value])函数不能为空', 1);
		// }

		$prepareArr = [];
		$prepareStr = '';

		foreach ($divisor as $key => $value) {
			if (is_object($value)) {
				throw new CommonException('sql拼接错误，where([key=>value])函数的value不能是一个对象', 1);
			}

			$key = strtolower(trim($key));

			if ($key == 'or') {
				$prepareArr[]= self::explodeDivisor($value, ' OR ', '(', ')');	
			}elseif ($key == '0') {
				$prepareArr[]= self::explodeDivisor($value, ' AND ', '(', ')');	
			}else{
				//匹配操作符，如果没有，默认加上等号=
				$column 	= $symbol 	= 	$label = '';
				self::pregSymbol($key, $value, $column, $symbol, $label, $columnLabelArr);
				$prepareArr[]= $column . ' ' . $symbol . ' ' . $label;
			}
		}

		//用因子连接符链接起来
		$prepareStr = $leftBr . implode($currentLink, $prepareArr) . $rightBr;
		return $prepareStr;
	}


	public static function explodeValues($fieldsValues, &$column, &$mark, &$columnLabelArr){
		$column = $mark = '';
		if (empty($fieldsValues) || !is_array($fieldsValues)) {
			return ;
		}

		$keyValueArray = [];
		foreach ($fieldsValues as $key => $value) {
			if (is_object($value)) {
				throw new CommonException('sql拼接错误，values([key=>value])语句的value不能是一个对象', 1);
			}

			$label = '';
			$label = self::createLabel($key, $columnLabelArr);
			$keyValueArray[$label] = $value;
		}

		$column = '(' . implode(',', array_keys($fieldsValues)) . ')';
		$mark	= '(' . implode(',', array_keys($keyValueArray)) . ')';

		BindValue::setBindValuePure($keyValueArray);

	}


	public static function explodeSets($fieldsValues, &$sets, &$columnLabelArr){
		$sets = '';
		if (empty($fieldsValues) || !is_array($fieldsValues)) {
			return ;
		}

		$keyValueArray = $labels = [];
		foreach ($fieldsValues as $key => $value) {
			if (is_object($value)) {
				throw new CommonException('sql拼接错误，set([key=>value])语句的value不能是一个对象', 1);
			}

			$label = '';
			$label = self::createLabel($key, $columnLabelArr);
			$keyValueArray[$label] = $value;
			$labels[] = $key . '=' . $label;
		}

		$sets = implode(',', $labels);

		BindValue::setBindValuePure($keyValueArray);
	}


	private static function createLabel($column, &$columnLabelArr){

		if (array_key_exists($column, $columnLabelArr)) {
			$label = ':' . $column . $columnLabelArr[$column];
			$columnLabelArr[$column] = $columnLabelArr[$column] + 1;
		}else{
			$columnLabelArr[$column] = 1;
			$label = ':' . $column . '0';
		}

		return $label;
	}
	
	
}