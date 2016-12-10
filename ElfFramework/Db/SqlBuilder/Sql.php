<?php
/**
* 创建sql语句
*/
namespace ElfFramework\Db\SqlBuilder;
use ElfFramework\Exception\CommonException;
use ElfFramework\Db\SqlBuilder\SqlBuilder;
use ElfFramework\Db\SqlBuilder\BuilderHelper;
use ElfFramework\Db\SqlBuilder\BindValue;

class Sql
{

	public $tablePrefix 	= '';
	
	/**
	 * 拼凑好的sql语句
	 * @var string
	 */
	private $_sql 		= '';

	/**
	 * 拼凑好的需要绑定的参数
	 * @var array
	 */
	private $_param 	= array();

	/**
	 * 是否被build(拼凑)过
	 * @var boolean
	 */
	private $_builded 	= FALSE;

	/**
	 * sql的类型，可能为insert update等
	 * @var string
	 */
	private $_sqlType = '';

	/**
	 * 组装为prepare sql的列名，eg: 列id的label为:id0 ,加个0是为了防止多个id重名，比如sql:update xx set id=10 where id=1;
	 * @var array
	 */
	public $_columnLabel = [];


	public $part 	= [
		'select'	=> '',
		'insert'	=> '',
		'update'	=> '',
		'updateAll' => '',
		'delete'	=> '',
		'deleteAll' => '',
		'sets'		=> '',
		'values'	=> ['column'=>'', 'mark'=>''],
		'from'		=> '',
		'where'		=> [],
		'order'		=> '',
		'limit'		=> '',
	];

	public $whereType = [
		'where', 'andWehre', 'orWhere', 'like', 'between'
	];

	CONST SELECT = 'select';

	CONST INSERT = 'insert';

	CONST UPDATE = 'update';

	CONST DELETE = 'delete';

	public function __construct($rowSql = ''){
		if (!empty($rowSql)) {
			$this->_initSqlObjByRowSql($rowSql);
		}
	}


	public function select($fields = '*'){
		if (empty($fields) || !is_string($fields) ) {
			$fields = '*';
		}

		$this->_setType(self::SELECT);

		$this->part['select'] 	= $fields;

		return $this;
	}


	public function from($tableName){
		if (empty($tableName) || !is_string($tableName)) {
			throw new CommonException('sql拼接错误，from($tableName)函数参数必须为字符串', 1);
		}

		$this->part['from'] 	= $tableName;

		return $this;
	}


	public function count(){

	}


	public function insert($tableName){
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
		if (empty($tableName) || !is_string($tableName)) {
			throw new CommonException('sql拼接错误，update($tableName)函数参数必须为字符串', 1);
		}

		$this->_setType(self::UPDATE);

		$this->part['update'] 	= $tableName;

		return $this;
	}


	public function updateAll($tableName){
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

	public function where($where){
		$this->_prepareDivisor($where);

		return $this;
	}


	public function bindValue($value){
		if (!is_array($value)) {
			throw new CommonException('sql拼接错误，order($order)函数参数必须为数组', 1);
		}

		BindValue::setBindValuePure($value);

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


	private function _prepareDivisor($where){
		if (is_string($where)) {
			//使用prepare方法，bindvalue
			$this->part['where'] 	= $where;

		}elseif (is_array($where)) {
			//解析where
			$prepareWhereStr = BuilderHelper::explodeDivisor($where, $this->_columnLabel);

			$this->part['where'] 	= $prepareWhereStr;

			$this->setParam(BindValue::getBindValue());

			BindValue::clearBindValue();

		}else{
			throw new CommonException('sql拼接错误，_prepareDivisor($where)函数参数为字符串或者(因子模式)数组', 1);
		}
	}










	public function setPrefix($prefix = ''){
		$this->tablePrefix = $prefix;
	}


	public function getSql(){
		if (!$this->_builded) {
			$this->_doBuild();
		}

		return $this->_sql;
	}


	public function getParam(){
		// if (!$this->_builded) {
		// 	$this->_doBuild();
		// }

		return $this->_param;
	}


	public function getType(){
		return $this->_sqlType;
	}


	private function _setType($type){
		$type = strtolower($type);
		
		$typeArr = [
			self::INSERT,
			self::SELECT,
			self::UPDATE,
			self::DELETE
		];

		if (in_array($type, $typeArr)) {
			$this->_sqlType 	= $type;
		}else{
			$this->_sqlType 	= NULL;
		}
	}


	private function setSql($sql){
		$this->_sql 	= $sql;
	}


	public function setParam($param){
		$this->_param = array_merge($this->_param, $param);
	}


	private function _doBuild(){
		$builder = new SqlBuilder();
		$builder->build($this);

		$this->setSql($builder->getSql());

		$this->_builded = TRUE;
	}

	private function _initSqlObjByRowSql($rowSql){
		$this->_builded = TRUE;
		$this->_sql 	= $rowSql;
		$this->_param 	= [];
		$this->tablePrefix = '';
		$this->_setType($this->_pregSqlType());
		$this->_columnLabel = [];
	}


	private function _pregSqlType(){
		$match = '';

		if (preg_match("/^(insert|select|update|delete)\s+(\\w*)/i", $this->_sql, $match)) {
			if (isset($match[1])) {
				return strtolower($match[1]);
			}
		}

		throw new CommonException('原生sql拼接错误，不存在的sql数据类型，原生sql语句：' . $this->_sql, 1);
	}
}
