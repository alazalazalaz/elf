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


	/**
	 * 查询所有记录
	 * @param  string|null $fields 待查询字段，$fields = '*'或者NULL表示查询所有
	 * @param  array       $where 查询条件, eg: $where = ['id >' => 4, 'pw !=' => ''];
	 * @param  string 
	 * @param  string 
	 * @param  int||array  eg:$limit = 1 或者 $limit = [1, 20] 或者 $limit = [1]
	 * @return 二维数组或者空     返回所有结果
	 */
	public static function find($fields = NULL, array $where = [], $order = '', $group = '', $limit = []){
		if (empty($fields) || !is_string($fields) ) {
			$fields = '*';
		}

		$db = self::db(static::$dbConfigName);

		$db->select($fields)->from(static::$tableName)->from(static::$tableName)->where($where);

		if (!empty($order)) {
			$db->order($order);
		}

		if (!empty($group)) {
			$db->group($group);
		}

		if (!empty($limit)) {
			if (is_array($limit)) {
				if (isset($limit[0]) && isset($limit[1])) {
					$db->limit($limit[0], $limit[1]);
				}elseif (isset($limit[0])) {
					$db->limit($limit[0]);
				}
			}else{
				$db->limit($limit);
			}
		}

		$result = $db->execute()->all();

		return $result;
	}


	public static function findByPage($fields = NULL, array $where = [], $order = '', $group = '', $page = 1){
		if (empty($fields) || !is_string($fields) ) {
			$fields = '*';
		}

		$page = intval($page);

		$db = self::db(static::$dbConfigName);

		$db->select($fields)->from(static::$tableName)->from(static::$tableName)->where($where);

		if (!empty($order)) {
			$db->order($order);
		}

		if (!empty($group)) {
			$db->group($group);
		}

		$db->limitPage(static::$pageSize, $page);

		$result = $db->execute()->all();

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