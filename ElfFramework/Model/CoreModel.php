<?php
/**
* model核心类(每张表是一个模型)
*/
namespace ElfFramework\Model;
use ElfFramework\Lib\Common\Container;
use ElfFramework\Exception\CommonException;
use ElfFramework\Db\Db;
use PDOException;
use ElfFramework\Config\ConfigHandle\Config;

class CoreModel extends Db
{
	/**
	 * 数据库配置名称
	 * @var string
	 */
	public $dbConfigName 	= 'default';
	
	/**
	 * 数据库表名前缀
	 */
	public $tablePrefix 	= '';

	/**
	 * 数据库表名
	 * @var string
	 */
	public $tableName 		='';

	/**
	 * 数据库表名，全称(含前缀)
	 * @var string
	 */
	private $tableFullName 	= '';
	

	/**
	 * 初始化db链接
	 */
	function __construct(){
		parent::__construct();
	}


	public static function factory(){

		return Container::factory(get_called_class());
	}


	public function insert(array $fieldsValues){
		$fieldsValues = [
			'code'			=> 234,
			'population' 	=> 'xx'
		];

		$sql = $this->sql()->insert($this->tableName)->values($fieldsValues);

		var_dump($sql->getParam());
		var_dump($sql->getSql());
		var_dump($sql->getType());

		$result = $this->connect()->execute($sql);

		var_dump($result);exit;
	}

	public function insertMulti(array $fields, array $values){
		// $fields = ['code', 'population'];
		// $vlaues = [
		// 	[111, 222],
		// 	[333, 444]
		// ];

		// $sql = $this->sql()->insert($this->tableName)->valuesMulti($fields, $vlaues);

	}

	public function insertUpdate(){

	}


	public function update(array $fieldsValues,array $where){
		if (empty($fieldsValues)) {
			return TRUE;
		}

		$fieldsValues = [
			'name'	=> 'tt',
			'population' => 1
		];

		$where = [
			'id >'		=> 20,
			'population >'	=> 0
		];

		$sql = $this->sql()->updateAll('su_country_search')->set($fieldsValues);

// var_dump($sql->getParam());
// var_dump($sql->getSql());
// var_dump($sql->getType());exit;

		$result = $this->connect()->execute($sql);
		var_dump($result);exit;
	}

// @todo 
// 把链式操作结合在 connect()后，取消$this->sql()这个对象。
// 同时把配置文件和模型的表名前缀结合在链式操作中去 (这个放在connnect这个方法里面操作，
// 如果是控制器调用数据库操作比如 Db::connect()就不能加载模型的表名前缀，只能加载配置文件的)。

	public function findOne($field = '', $where = array()){
		if (empty($field) || !is_string($field)) {
			$field = '*';
		}

		$sql = $this->sql();

		$sql->select($field)
			->from($this->tableName)
			->where(['id <'=>10, 'population >'=> 0]);

		// var_dump($sql->getParam());
		// var_dump($sql->getSql());
		// var_dump($sql->getType());

		$result = $this->connect()->execute($sql)->all();


var_dump($result);exit;
	}


	public function delete($where){
		if (empty($where)) {
			return FALSE;
		}

		$sql = $this->sql()->delete()->from($this->tableName)->where($where);

		$result = $this->connect()->execute($sql);

		var_dump($sql->getParam());
		var_dump($sql->getSql());
		var_dump($sql->getType());
var_dump($result);exit;
	}



	public function execute($rowSql){

		$result = $this->connect()->execute($rowSql)->all();

		// var_dump($sql->getParam());
		// var_dump($sql->getSql());
		// var_dump($sql->getType());
var_dump($result);exit;
	}




	public function query($sql){
		if (empty($sql) || !is_string($sql)) {
			return NULL;
		}

		return $this->connect()->query($sql);
	}


	public function tableName(){

		return $this->tableName;
	}
	
}