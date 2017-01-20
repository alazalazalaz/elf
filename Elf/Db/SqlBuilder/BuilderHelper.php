<?php
/**
* 一些辅助性函数，给sql.php和sqlbuilder.php使用
*/
namespace Elf\Db\SqlBuilder;
use Elf\Db\SqlBuilder\Sql;
use Elf\Db\SqlBuilder\BindValue;
use Elf\Exception\CommonException;

class BuilderHelper
{

	private static $_bindValue = [];


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
				throw new CommonException('sql拼接错误，explodeDivisor([key=>value])函数的value不能是一个对象', 1);
			}

			$key = strtolower(trim($key));

			if ($key == 'or') {
				$prepareArr[]= self::explodeDivisor($value, $columnLabelArr, ' OR ', '(', ')');	
			}elseif ($key == '0' || $key == 'and') {
				$prepareArr[]= self::explodeDivisor($value, $columnLabelArr, ' AND ', '(', ')');	
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

			$key = trim($key);
			$column = $columnSymbol = '';
			self::pregSetSymbol($key, $value, $column, $columnSymbol);

			$label = '';
			$label = self::createLabel($column, $columnLabelArr);
			$keyValueArray[$label] = $value;
			$labels[] = $columnSymbol . $label;
		}

		$sets = implode(',', $labels);

		BindValue::setBindValuePure($keyValueArray);
	}


	/**
	 * 这他喵的是个递归函数
	 * @param  array  $divisor [description]
	 * @return [type]          [description]
	 */
	public static function explodeOnDivisor(array $divisor, $currentLink = ' AND ', $leftBr = '', $rightBr = ''){
		// if (empty($divisor) || count($divisor)<1) {
		// 	throw new CommonException('sql拼接错误，where([key=>value])函数不能为空', 1);
		// }

		$prepareArr = [];
		$prepareStr = '';

		foreach ($divisor as $key => $value) {
			if (is_object($value)) {
				throw new CommonException('sql拼接错误，explodeOnDivisor([key=>value])函数的value不能是一个对象', 1);
			}

			$key = strtolower(trim($key));

			if ($key == 'or') {
				$prepareArr[]= self::explodeOnDivisor($value, ' OR ', '(', ')');	
			}elseif ($key == '0') {
				$prepareArr[]= self::explodeOnDivisor($value, ' AND ', '(', ')');	
			}else{
				//匹配操作符，如果没有，默认加上等号=
				$column 	= $symbol 	= 	$label = '';
				self::pregOnSymbol($key, $column, $symbol);
				$prepareArr[]= $column . ' ' . $symbol . ' ' . $value;
			}
		}

		//用因子连接符链接起来
		$prepareStr = $leftBr . implode($currentLink, $prepareArr) . $rightBr;
		return $prepareStr;
	}


	private static function createLabel($column, &$columnLabelArr){
		$column = str_replace('.', '_', $column);

		if (array_key_exists($column, $columnLabelArr)) {
			$label = ':' . $column . $columnLabelArr[$column];
			$columnLabelArr[$column] = $columnLabelArr[$column] + 1;
		}else{
			$columnLabelArr[$column] = 1;
			$label = ':' . $column . '0';
		}

		return $label;
	}
	


	/**
	 * 匹配一个字符串中是否有= >= <= > < != 这些符号，如果没有，默认为=(暂时不考虑like)
	 * @param  [string] $key  'id >=' || 'id'
	 * @param  [string] &$column id
	 * @param  [string] &$symbol >=
	 * @return [type] 
	 */
	private static function pregSymbol($key, $value, &$column, &$symbol, &$labelString, &$columnLabelArr){
		$column = $symbol = $label = $labelString = '';

		if (empty($key)) {
			return;
		}
		
		$match = '';
		
		if (preg_match("/^(\\w+\.?\\w+)\\s*(!=|>=|<=|>|<|=|like|not like|between|not between|in|not in)$/i", strtolower($key), $match)) {
			$column = $match[1];
			$symbol = $match[2];

			$labelString = $label 	= self::createLabel($column, $columnLabelArr);

			// if ($symbol == 'left like' || $symbol == 'right like') {
			// 	$symbol = 'like';
			// }
			if ($symbol == 'between' || $symbol == 'not between') {
				//单独处理下between的symbol
				$labelStart  = $label . '_start';
				$labelEnd 	 = $label . '_end';
				$labelString = $labelStart . ' and ' . $labelEnd;

				if (!is_array($value) || count($value)!=2) {
					throw new CommonException('sql拼接错误，where()函数关键字between必须是一维数组并且数组中有且只有两个值', 1);
				}

				BindValue::setBindValue($labelStart, $value[0]);
				BindValue::setBindValue($labelEnd, $value[1]);

				return;
			}elseif ($symbol == 'in' || $symbol == 'not in') {

				if(!is_array($value) || count($value) < 1){
					throw new CommonException('sql拼接错误，where()函数关键字in必须是一维数组并且数组中至少有一个值', 1);
				}

				foreach ($value as $k => $v) {
					$labelStringArr[] = $label . $k;
					BindValue::setBindValue($label . $k, $v);
				}

				$labelString = '(' . implode(',', $labelStringArr) . ')';

				return;
			}
			
		}else{
			$column = $key;
			$symbol = '=';
			$labelString = $label 	= self::createLabel($column, $columnLabelArr);
		}

		BindValue::setBindValue($label, $value);
	}


	private static function pregOnSymbol($key, &$column, &$symbol){
		$column = $symbol = '';

		if (empty($key)) {
			return;
		}
		
		$match = '';
		
		if (preg_match("/^(\\w+\.?\\w+)\\s*(!=|>=|<=|>|<|=)$/i", strtolower($key), $match)) {
			$column = $match[1];
			$symbol = $match[2];

		}else{
			$column = $key;
			$symbol = '=';
		}
	}


	private static function pregSetSymbol($key, $value, &$column = '', &$columnSymbol = ''){
		$column = $columnSymbol = '';

		if (preg_match("/^(\\w+\.?\\w+)\\s*(-|\+)$/i", strtolower($key), $match)) {
			$column = $match[1];
			$symbol = $match[2];
			$columnSymbol = $column . '=' . $column . $symbol;

		}else{
			$column = $key;
			$columnSymbol = $column . '=';
		}

	}
	
}