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
	 * 数据库配置名称(可选)
	 * @var string
	 */
	public static $dbConfigName 	= 'default';
	
	/**
	 * 数据库表名前缀(可选)
	 */
	public static $tablePrefix 		= '';

	/**
	 * 数据库表名(必须在model中声明)
	 * @var string
	 */
	public static $tableName 		= '';
	
	/**
	 * 该表的主键(可选)
	 * @var string
	 */
	public static $pk 				= 'id';


	/**
	 * 分页的条目数
	 * @var integer
	 */
	public static $pageSize 		= 10;


	function __construct(){
		parent::__construct();
	}


	/**
	 * 创建模型对象
	 * eg: $modelObj = TestModel::factory($param1, $param2, $param3...);
	 * @return object
	 */
	public static function factory(){

		return Container::createObject(get_called_class(), func_get_args());
	}


	/**
	 * 插入一条数据
	 * @param  一维数组  $fieldsValues eg: $fieldsValues = ['name' => 'xxx', 'pw' => 'xxx'];
	 * @return int       返回最后插入的ID
	 */
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


	/**
	 * 同时插入多条数据(这个方法真他么丑)
	 * @param  二维数组 	$multiFieldsValues 
	 * eg:
	 * $multiFieldsValues = [
			['code' => 111, 'name' => 'hi', 'population' => 1],
			['code' => 333, 'name' => 'world', 'population' => 3]
		];
	 *
	 * @return 一维数组 	返回最后插入的ID    
	 */
	public static function saveAll(array $multiFieldsValues){
		if (empty($multiFieldsValues)) {
			return FALSE;
		}

		$result = self::db(static::$dbConfigName)
						->insert(static::$tableName)
						->values(current($multiFieldsValues))
						->executeMulti($multiFieldsValues);
		return $result;
	}


	public function insertUpdate(){

	}


	/**
	 * 查询所有记录
	 * @param  string|null $fields 待查询字段，$fields = '*'或者NULL表示查询所有
	 * @param  array       $where 查询条件, eg: $where = ['id >' => 4, 'pw !=' => ''];
	 * @return 二维数组或者空     返回所有结果
	 */
	public static function find($fields = NULL, array $where = []){
		if (empty($fields) || !is_string($fields) ) {
			$fields = '*';
		}

		$result = self::db(static::$dbConfigName)
						->select($fields)
						->from(static::$tableName)
						->where($where)
						->execute()
						->all();
		return $result;
	}


	/**
	 * 查询一条记录
	 * @param  string|null $fields 待查询字段，$fields = '*'或者NULL表示查询所有
	 * @param  array       $where 查询条件, eg: $where = ['id >' => 4, 'pw !=' => ''];
	 * @return 一维数组或者空     返回所有结果
	 */
	public static function findOne($fields = NULL, $where = []){
		if (empty($fields) || !is_string($fields) ) {
			$fields = '*';
		}

		$result = self::db(static::$dbConfigName)
						->select($fields)
						->from(static::$tableName)
						->where($where)
						->limit(1)
						->execute()
						->one();
		return $result;
	}


	/**
	 * @todo 待修改或者废除
	 * @param  [type] $fields [description]
	 * @param  array  $where  [description]
	 * @param  [type] $page   [description]
	 * @return [type]         [description]
	 */
	public static function findByPage($fields = NULL, $where = [], $page){
		if (empty($fields) || !is_string($fields) ) {
			$fields = '*';
		}

		$result = self::db(static::$dbConfigName)
						->select($fields)
						->from(static::$tableName)
						->where($where);

						->execute()
						->all();
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


	public static function count(array $where = []){
		$result = self::db(static::$dbConfigName)
						->select('count(*)')
						->from(static::$tableName)
						->where($where)
						->execute()
						->one();
		return isset($result['count(*)']) ? $result['count(*)'] : 0;
	}

	
}