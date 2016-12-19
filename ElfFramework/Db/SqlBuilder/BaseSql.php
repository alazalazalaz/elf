<?php
/**
* 桥接sql和pdo
*/
namespace ElfFramework\Db\SqlBuilder;
use ElfFramework\Exception\CommonException;

class BaseSql
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
	protected $_sql 		= '';

	/**
	 * 拼凑好的需要绑定的参数
	 * @var array
	 */
	protected $_param 	= array();

	/**
	 * 是否被build(拼凑)过
	 * @var boolean
	 */
	protected $_builded 	= FALSE;

	/**
	 * sql的类型，可能为insert update等
	 * @var string
	 */
	protected $_sqlType = '';

	/**
	 * 这个变量是临时变量，初始值为空数组。
	 * 这个变量可能为以下数据：
	 * array (size=2)
		  'id' => int 2
		  'population' => int 1 表示当前sql对象列为id的有2个，列为population的有1个。记录临时列的个数是为了防止重复(比如sql:update xx set id=10 where id=1就会重名)
	 * @var array
	 */
	public $_columnLabel = [];


	protected $_debug 	= FALSE;


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
		'join'  	=> [],
		'on'		=> [],
		'where'		=> [],
		'order'		=> '',
		'group'		=> '',
		'having'	=> '',
		'limit'		=> '',
		'onUpdate'  => ''
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


	/**
	 * 这个插入多条的方法封装得真他么的丑
	 * @param  二维数组 $multiFieldsValues 
	 * @return 一维数组 	返回最后插入的ID                    
	 */
	public function executeMulti($multiFieldsValues){
		if (empty($multiFieldsValues) || !is_array($multiFieldsValues)) {
			throw new CommonException('sql拼接错误，executeMulti($multiFieldsValues)函数参数必须是多维数组', 1);
		}

		$param = $this->getParam();
		$this->clearParam();
		$this->bindValue($multiFieldsValues, TRUE);

		$allParam = $this->getParam();
		if (!empty($allParam)) {
			foreach ($allParam as $key => $value) {
				foreach ($value as $k => $v) {
					$label = $param[$k]['column'];
					$allParam[$key][$k]['column'] = $label;
				}
			}

			$this->clearParam();
			$this->setParam($allParam);
			return $this->pdoDriver->executeMulti($this);
		}else{
			throw new CommonException('sql拼接错误，executeMulti($multiFieldsValues)函数解析参数发生错误', 1);
		}
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


	public function setPdoDriver($pdoDriver){
		$this->pdoDriver = $pdoDriver;
	}


	public function getDebug(){
		return $this->_debug;
	}


	protected function _setType($type){
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


	protected function setSql($sql){
		$this->_sql 	= $sql;
	}


	protected function setParam($param){
		$this->_param = array_merge($this->_param, $param);
	}


	protected function clearParam(){
		$this->_param = [];
	}


	protected function _doBuild(){
		$builder = new SqlBuilder();
		$builder->build($this);

		$this->setSql($builder->getSql());

		$this->_builded = TRUE;
	}


	protected function _prepareDivisor($where){
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


	protected function _prepareHavingDivisor($where){
		if (is_string($where)) {
			//使用prepare方法，bindvalue
			$this->part['having'] 	= $where;

		}elseif (is_array($where)) {
			//解析where
			$prepareWhereStr = BuilderHelper::explodeDivisor($where, $this->_columnLabel);

			$this->part['having'] 	= $prepareWhereStr;

			$this->setParam(BindValue::getBindValue());

			BindValue::clearBindValue();

		}else{
			throw new CommonException('sql拼接错误，_prepareDivisor($where)函数参数为字符串或者(因子模式)数组', 1);
		}
	}


	protected function _prepareOnDivisor($onWhere){
		if (is_string($onWhere)) {
			$this->part['on'][] 	= $onWhere;

		}elseif (is_array($onWhere)) {
			//解析where
			$prepareWhereStr = BuilderHelper::explodeOnDivisor($onWhere);

			$this->part['on'][] 	= $prepareWhereStr;

		}else{
			throw new CommonException('sql拼接错误，_prepareDivisor($where)函数参数为字符串或者(因子模式)数组', 1);
		}
	}


	protected function _formatSelect($fieldsArr){
		$fields = '';
		foreach ($fieldsArr as $key => $value) {
			if (is_array($value)) {
				$tmp = '';
				foreach ($value as $k => $v) {
					$tmp[] = trim($k) . ' AS ' . trim($v);
				}
				$tmp = implode(',', $tmp);
				$fieldsArr[$key] = $tmp;
			}
		}
		return implode(',', $fieldsArr);
	}


	/**
	 * @todo 考虑要不要$tableName这个数组接受多个表名，现在只能接受['table'=>'t']，修改为可以接受['table'=>'t1', 'table2'=>'t2'...]
	 * @param  [type] $tableName [description]
	 * @return [type]            [description]
	 */
	protected function _formatTableName($tableName){
		if (is_array($tableName)) {
			$tableName = key($tableName) . ' AS ' . reset($tableName);
		}
		return $tableName;
	}


	protected function _initSqlObjByRowSql($rowSql, $param = ''){
		$this->_builded = TRUE;
		$this->_sql 	= $rowSql;
		$this->_param 	= [];
		$this->_setType($this->_pregSqlType());
		$this->_columnLabel = [];
		if (!empty($param)) {
			$this->_initParamByRowSql($param);
		}
	}


	protected function _initParamByRowSql($param){
		if (!empty($param) && is_array($param)) {
			foreach ($param as $key => $value) {
				$this->_param[] = [
					'column'	=> $key,
					'value'		=> $value
				];
			}
		}
	}


	protected function _pregSqlType(){
		$match = '';

		if (preg_match("/^(insert|select|update|delete)\s+(\\w*)/i", $this->_sql, $match)) {
			if (isset($match[1])) {
				return strtolower($match[1]);
			}
		}

		throw new CommonException('原生sql拼接错误，不存在的sql数据类型，原生sql语句：' . $this->_sql, 1);
	}

}

