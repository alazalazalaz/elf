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

	public $pdoDriver = '';

	/**
	 * 数据库配置名
	 * @var string
	 */
	public $dbConfigName 	= '';
	
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
	 * 这个变量是临时变量，初始值为空数组。
	 * 这个变量可能为以下数据：
	 * array (size=2)
		  'id' => int 2
		  'population' => int 1 表示当前sql对象列为id的有2个，列为population的有1个。记录临时列的个数是为了防止重复(比如sql:update xx set id=10 where id=1就会重名)
	 * @var array
	 */
	public $_columnLabel = [];


	public $part 	= [
		'tablePrefix'=>'',
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

	public function __construct(){

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
	 *  1，加载配置
		2，连接数据库得到PDO
		(步骤1,2的实现在CoreDb::connect()方法里面)
		3，拼凑SQL
		4，执行
		(步骤3,4的实现在$pdoDriver->execute()方法里面)
	 * @param  string $rowSql 原始SQL语句
	 * @param  array  $param  参数
	 * @return result         详见ElfFramework\Db\Result\Result类的returnDefaultResult()方法
	 */
	public function execute($rowSql = '', $param = []){
		if (empty($rowSql)) {

		}elseif (is_string($rowSql)){
			$this->_initSqlObjByRowSql($rowSql, $param);
		}else{
			throw new CommonException("sql拼接错误，execute($rowSql = '')方法参数只能为空或者原生SQL", 1);
		}

		return $this->pdoDriver->execute($this);
	}


	public function setDbConfigName($dbConfigName){
		$this->dbConfigName = $dbConfigName;
	}

	public function setPdoDriver($pdoDriver){
		$this->pdoDriver = $pdoDriver;
	}

	public function setPrefix($prefix = ''){
		$this->part['tablePrefix'] = $prefix;

		return $this;
	}

	public function getPrefix(){
		return $this->part['tablePrefix'];
	}


	/**
	 * 调用此方法开始编译SQL
	 */
	public function getSql(){
		if (!$this->_builded) {
			$this->_doBuild();
		}

		return $this->_sql;
	}


	public function getParam(){
		if (!$this->_builded) {
			$this->_doBuild();
		}

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


	private function setParam($param){
		$this->_param = array_merge($this->_param, $param);
	}


	private function _doBuild(){
		$builder = new SqlBuilder();
		$builder->build($this);

		$this->setSql($builder->getSql());

		$this->_builded = TRUE;
	}

	private function _initSqlObjByRowSql($rowSql, $param = ''){
		$this->_builded = TRUE;
		$this->_sql 	= $rowSql;
		$this->_param 	= [];
		$this->_setType($this->_pregSqlType());
		$this->_columnLabel = [];
		if (!empty($param)) {
			$this->_initParamByRowSql($param);
		}
	}


	private function _initParamByRowSql($param){
		if (!empty($param) && is_array($param)) {
			foreach ($param as $key => $value) {
				$this->_param[] = [
					'column'	=> $key,
					'value'		=> $value
				];
			}
		}
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
}
