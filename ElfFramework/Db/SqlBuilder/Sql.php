<?php
/**
* 创建sql语句
* 作用：
* 把链式操作的sql拆分成一段一段的纯字符串，再交给SqlBuilder类处理
*/
namespace ElfFramework\Db\SqlBuilder;
use ElfFramework\Exception\CommonException;
use ElfFramework\Db\SqlBuilder\BuilderHelper;
use ElfFramework\Db\SqlBuilder\BindValue;
use ElfFramework\Db\SqlBuilder\BaseSql;

class Sql extends BaseSql
{

	public function __construct(){
		parent::__construct();
	}


	public function select(){
		$fields = func_get_args();

		if (empty($fields)) {
			$fields = '*';
		}

		$fields = $this->_formatSelect($fields);

		$this->_setType(self::SELECT);

		$this->part['select'] 	= $fields;

		return $this;
	}


	public function from($tableName){
		if (is_array($tableName)) {
			$tableName = $this->_formatTableName($tableName);
		}

		if (is_string($tableName) && !empty($tableName)) {
			$this->part['from'] 	= $tableName;

			return $this;
		}
		
		throw new CommonException('sql拼接错误，from($tableName)函数参数必须为字符串或数组', 1);
	}


	public function count(){

	}


	public function insert($tableName){
		if (is_array($tableName)) {
			$tableName = $this->_formatTableName($tableName);
		}

		if (empty($tableName) || !is_string($tableName)) {
			throw new CommonException('sql拼接错误，insert($tableName)函数参数必须为字符串', 1);
		}

		$this->_setType(self::INSERT);

		$this->part['insert'] 	= $tableName;

		return $this;
	}


	public function values($fieldsValues){
		if (empty($fieldsValues) || !is_array($fieldsValues)) {
			throw new CommonException('sql拼接错误，values($fieldsValues)函数参数必须为数组', 1);
		}

		$column = $mark = '';
		BuilderHelper::explodeValues($fieldsValues, $column, $mark, $this->_columnLabel);

		$this->setParam(BindValue::getBindValue());

		BindValue::clearBindValue();

		$this->part['values'] 	= [
			'column'	=> $column,
			'mark'		=> $mark
		];

		return $this;
	}


	/**
	 * update必须加where条件，并且where不能为空，若要更新所有，请使用updateAll，同理delete
	 * @param  [type] $tableName [description]
	 * @return [type]            [description]
	 */
	public function update($tableName){
		if (is_array($tableName)) {
			$tableName = $this->_formatTableName($tableName);
		}

		if (empty($tableName) || !is_string($tableName)) {
			throw new CommonException('sql拼接错误，update($tableName)函数参数必须为字符串', 1);
		}

		$this->_setType(self::UPDATE);

		$this->part['update'] 	= $tableName;

		return $this;
	}


	public function updateAll($tableName){
		if (is_array($tableName)) {
			$tableName = $this->_formatTableName($tableName);
		}

		if (empty($tableName) || !is_string($tableName)) {
			throw new CommonException('sql拼接错误，updateAll($tableName)函数参数必须为字符串', 1);
		}

		$this->_setType(self::UPDATE);

		$this->part['updateAll'] 	= $tableName;

		return $this;
	}


	public function set($fieldsValues){
		if (empty($fieldsValues) || !is_array($fieldsValues)) {
			throw new CommonException('sql拼接错误，set($fieldsValues)函数参数必须为数组', 1);
		}

		$set = '';
		BuilderHelper::explodeSets($fieldsValues, $set, $this->_columnLabel);

		$this->setParam(BindValue::getBindValue());

		BindValue::clearBindValue();

		$this->part['sets'] = $set;

		return $this;
	}


	public function delete(){
		$this->part['delete'] = TRUE;

		$this->_setType(self::DELETE);

		return $this;
	}


	public function deleteAll(){
		$this->part['deleteAll'] = TRUE;

		$this->_setType(self::DELETE);

		return $this;
	}


	public function leftJoin($tableName){

		if (is_array($tableName)) {
			$tableName = $this->_formatTableName($tableName);
		}

		if (is_string($tableName) && !empty($tableName)) {
			$this->part['join'][] 	= [
				'joinType' 	=> 'lj',
				'tableName' => $tableName
			];

			return $this;
		}

		throw new CommonException('sql拼接错误，leftJoin($tableName)函数参数必须为字符串或数组', 1);
	}


	public function rightJoin($tableName){

		if (is_array($tableName)) {
			$tableName = $this->_formatTableName($tableName);
		}

		if (is_string($tableName) && !empty($tableName)) {
			$this->part['join'][] 	= [
				'joinType' 	=> 'rj',
				'tableName' => $tableName
			];

			return $this;
		}
		
		throw new CommonException('sql拼接错误，rightJoin($tableName)函数参数必须为字符串或数组', 1);
	}


	public function innerJoin($tableName){

		if (is_array($tableName)) {
			$tableName = $this->_formatTableName($tableName);
		}

		if (is_string($tableName) && !empty($tableName)) {
			$this->part['join'][] 	= [
				'joinType' 	=> 'ij',
				'tableName' => $tableName
			];

			return $this;
		}
		
		throw new CommonException('sql拼接错误，innerJoin($tableName)函数参数必须为字符串或数组', 1);
	}


	public function join($tableName){
		return $this->innerJoin($tableName);
	}


	public function on($onWhere){
		$this->_prepareOnDivisor($onWhere);

		return $this;
	}


	public function where($where){
		$this->_prepareDivisor($where);

		return $this;
	}


	public function bindValue($value, $isMulti = FALSE){
		if (!is_array($value)) {
			throw new CommonException('sql拼接错误，order($order)函数参数必须为数组', 1);
		}

		BindValue::setBindValuePure($value, $isMulti);

		$this->setParam(BindValue::getBindValue());

		BindValue::clearBindValue();

		return $this;
	}


	public function order($order = ''){
		if (!is_string($order)) {
			throw new CommonException('sql拼接错误，order($order)函数参数必须为字符串', 1);
		}

		$this->part['order'] 	= $order;

		return $this;
	}


	public function group($group = ''){
		if (!is_string($group)) {
			throw new CommonException('sql拼接错误，group($group)函数参数必须为字符串', 1);
		}

		$this->part['group'] 	= $group;

		return $this;
	}


	public function having($where){
		$this->_prepareHavingDivisor($where);

		return $this;
	}


	/**
	 * 和mysql的原生limit用法一直
	 * @param  integer $limit       返回的条目数
	 * @param  integer $offsetLimit 偏移量，从0开始
	 * @return object               返回自身对象
	 */
	public function limit($limit = 1, $offsetLimit = 0){
		$limit 		= intval($limit);
		$offsetLimit= intval($offsetLimit);

		if ($offsetLimit > 0) {
			$this->part['limit'] = $limit . ',' . $offsetLimit;
		}else{
			$this->part['limit'] = $limit;
		}	

		return $this;
	}


	/**
	 * $this->limit()函数的改进版
	 * @param  int $pageSize 每页数据条目数
	 * @param  int $page     页码
	 * @return object        返回自身对象
	 */
	public function limitPage($pageSize, $page){
		$pageSize 	= intval($pageSize);
		$page 		= intval($page);

		if ($pageSize <= 0 || $page <= 0) {
			throw new CommonException('sql拼接错误，limitPage($pageSize, $page)函数参数必须为正整数', 1);
		}

		return $this->limit($pageSize, ($page - 1) * $pageSize);
	}


	public function onUpdate($fieldsValues){
		if (empty($fieldsValues) || !is_array($fieldsValues)) {
			throw new CommonException('sql拼接错误，onUpdate($fieldsValues)函数参数必须为数组', 1);
		}

		$set = '';
		BuilderHelper::explodeSets($fieldsValues, $set, $this->_columnLabel);

		$this->setParam(BindValue::getBindValue());

		BindValue::clearBindValue();

		$this->part['onUpdate'] = $set;

		return $this;
	}


	public function setDbConfigName($dbConfigName){
		$this->dbConfigName = $dbConfigName;
	}


	public function setPrefix($prefix = ''){
		$this->part['tablePrefix'] = $prefix;

		return $this;
	}


	public function getPrefix(){
		return $this->part['tablePrefix'];
	}


	/**
	 * 开始事物
	 * @return [type] [description]
	 */
	public function begin(){
		$this->pdoDriver->begin();
	}


	/**
	 * 提交事物
	 * @return [type] [description]
	 */
	public function commit(){
		$this->pdoDriver->commit();
	}


	/**
	 * 回滚事物
	 * @return [type] [description]
	 */
	public function rollback(){
		$this->pdoDriver->rollback();
	}


	/**
	 * 这个方法纯粹是为了debug方便而已。。。
	 * 使用方法：和其他链式操作一样，执行在execute()函数之前的任意地方就行了。
	 */
	public function debug(){
		$this->_debug = TRUE;

		return $this;
	}



}
