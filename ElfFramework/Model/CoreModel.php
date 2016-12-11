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
	public static $dbConfigName 	= 'default';
	
	/**
	 * 数据库表名前缀
	 */
	public static $tablePrefix 		= '';

	/**
	 * 数据库表名
	 * @var string
	 */
	public static $tableName 		='';
	
	/**
	 * 该表的主键
	 * @var string
	 */
	public static $pk 				= '';

	/**
	 * 初始化db链接
	 */
	function __construct(){
		parent::__construct();
	}


	public static function factory(){

		return Container::factory(get_called_class());
	}


	public static function save(array $fieldsValues){
		if (empty($fieldsValues)) {
			return FALSE;
		}

		$result = self::db(static::$dbConfigName)
						->insert(static::$tableName)
						->values($fieldsValues)
						->execute();
		return $result;
	}

@todo 
方法：插入多条数据
已修改的地方有:
sql::bindValue()方法
BindValue::setBindValuePure()方法
	public static function saveAll(array $multiFieldsValues){
		if (empty($multiFieldsValues)) {
			return FALSE;
		}

		$result = self::db(static::$dbConfigName)
						->insert(static::$tableName)
						// ->bindValue($multiFieldsValues, TRUE)
						// ->executeMulti();
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


	public static function find(string $field = NULL, array $where = []){
		if (empty($field)) {
			$field = '*';
		}

		$result = self::db(static::$dbConfigName)
						->select($field)
						->from(static::$tableName)
						->where($where)
						->execute()
						->all();
		return $result;
	}


	public static function findOne(string $field = NULL, $where = array()){
		if (empty($field)) {
			$field = '*';
		}

		$result = self::db(static::$dbConfigName)
						->select($field)
						->from(static::$tableName)
						->where($where)
						->limit(1)
						->execute()
						->one();
		return $result;
	}


	public static function deleteByPk($pkValue){
		$pkValue = intval($pkValue);

		if (empty($pkValue)) {
			return FALSE;
		}

		$result = self::db(static::$dbConfigName)
						->delete()
						->from(static::$tableName)
						->where([static::$pk => $pkValue])
						->limit(1)
						->execute();
		return $result;					
	}


	public static function delete(array $where){
		if (empty($where)) {
			return FALSE;
		}

		$result = self::db(static::$dbConfigName)
						->delete()
						->from(static::$tableName)
						->where($where)
						->execute();
		return $result;
	}


	public static function updateByPk($pkValue, array $fieldsValues){
		$pkValue = intval($pkValue);

		if (empty($pkValue)) {
			return FALSE;
		}

		if (empty($fieldsValues)) {
			return FALSE;
		}

		$result = self::db(static::$dbConfigName)
						->update(static::$tableName)
						->set($fieldsValues)
						->where([static::$pk => $pkValue])
						->execute();
		return $result;
	}


	public static function update(array $fieldsValues, array $where){
		if (empty($fieldsValues)) {
			return FALSE;
		}

		if (empty($where)) {
			return FALSE;
		}

		$result = self::db(static::$dbConfigName)
						->update(static::$tableName)
						->set($fieldsValues)
						->where($where)
						->execute();
		return $result;
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
	
}