<?php
/**
* model核心类
*/
namespace ElfFramework\Model;
use ElfFramework\Model\ModelFactory;
use ElfFramework\Base\BaseElf;
use ElfFramework\Config\ConfigHandle\Config;
use ElfFramework\Exception\CommonException;

class CoreModel
{
	/**
	 * 数据库链接句柄
	 * @var string
	 */
	// private $db 		= '';

	/**
	 * 数据库配置名
	 * @var string
	 */
	public $dbName 	= 'default';

	/**
	 * 数据库表名前缀
	 */
	public $tableSuffix 	= '';

	/**
	 * 数据库表名
	 * @var string
	 */
	private $tableName 		='';

	/**
	 * 数据库表名，全称(含前缀)
	 * @var string
	 */
	private $fullTableName 	= '';

	private $dbConfig 		= array();

	/**
	 * 初始化db链接
	 */
	function __construct(){
		
	}


	public static function factory(){

		return BaseElf::factory(get_called_class());
	}


	/**
	 * 链接数据库并且返回链式查询的对象
	 * @param  string $dbName 数据库配置名
	 * @return object         链式查询的对象(\ElfFramework\Db\Query)
	 */
	public function db($dbName = ''){
		
		//1.加载db配置
		$dbConfig = $this->loadDbConfig($dbName);

		$this->dbConfig 	= $dbConfig;

		//2.创建查询对象
		



		var_dump($dbConfig, $this->dbName, $this->tableSuffix);die;
	}


	public function findOne(){
		$this->db('test');
	}


	public function tableName(){
		return $this->fullTableName;
	}


	private function loadDbConfig($dbName){
		$this->dbName = empty($dbName) ? $this->dbName : $dbName;
		$dbConfig 	= Config::load('database');

		if (!isset($dbConfig[$this->dbName])) {
			throw new CommonException('数据库配置' . $this->dbName . '不存在');
		}

		$dbConfig 	= $dbConfig[$this->dbName];

		$class 	= isset($dbConfig['class']) 	? $dbConfig['class'] 	: '';
		$driver 	= isset($dbConfig['driver']) 	? $dbConfig['driver'] 	: '';
		$suffix 	= isset($dbConfig['suffix']) 	? $dbConfig['suffix'] 	: '';
		$host 		= isset($dbConfig['host']) 		? $dbConfig['host'] 	: '';
		$port 		= isset($dbConfig['port']) 		? $dbConfig['port'] 	: '';
		$dbname 	= isset($dbConfig['dbname']) 	? $dbConfig['dbname'] 	: '';
		$username 	= isset($dbConfig['username']) 	? $dbConfig['username']	: '';
		$password 	= isset($dbConfig['password']) 	? $dbConfig['password']	: '';
		$charset 	= isset($dbConfig['charset']) 	? $dbConfig['charset'] 	: '';

		if (empty($class)) {
			throw new CommonException('数据库配置' . $this->dbName . '中class不能为空');
		}

		if (empty($driver)) {
			throw new CommonException('数据库配置' . $this->dbName . '中driver不能为空');
		}

		if (empty($host)) {
			throw new CommonException('数据库配置' . $this->dbName . '中host不能为空');
		}

		if (empty($port)) {
			throw new CommonException('数据库配置' . $this->dbName . '中port不能为空');
		}

		if (empty($dbname)) {
			throw new CommonException('数据库配置' . $this->dbName . '中dbname不能为空');
		}

		if (empty($username)) {
			throw new CommonException('数据库配置' . $this->dbName . '中username不能为空');
		}

		return $dbConfig;
	}
}