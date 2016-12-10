<?php

/**
* 数据库相关类，用于实现各种driver、调用query build并且被CoreModel继承。
*/

namespace ElfFramework\Db;

use ElfFramework\Config\ConfigHandle\Config;
use ElfFramework\Exception\CommonException;
use ElfFramework\Db\Driver\Mysql\Pdo;
use ElfFramework\Db\Driver\DriverInterface;
use ElfFramework\Lib\Common\Container;

class CoreDb
{
	/**
	 * 数据库链接句柄
	 * @var string
	 */
	// private $db 		= '';

	/**
	 * 数据库配置名(默认为default)
	 * @var string
	 */
	public $dbConfigName 	= 'default';

	private $dbConfig 		= array();

	public function __construct(){
		
	}

	/**
	 * 链接数据库并且返回数据库驱动对象
	 * @param  string $dbConfigName 数据库配置名
	 * @return object         链式查询的对象(\ElfFramework\Db\Query)
	 */
	public function connect($dbConfigName = ''){
		
		//1.加载db配置
		$dbConfig = $this->loadDbConfig($dbConfigName);

		$this->dbConfig 	= $dbConfig;

		//@todo 2.创建查询对象
		
		//2.返回db驱动对象(根据config中class的配置返回各种驱动对象，各种驱动的方法都遵循driverInterface接口)
		$driverObj = Container::createObject($this->dbConfig['class'], $this->dbConfig);
		$driverObj->connect();

		return $driverObj;
	}


	private function loadDbConfig($dbConfigName){
		$this->dbConfigName = empty($dbConfigName) ? $this->dbConfigName : $dbConfigName;
		$dbConfig 	= Config::load('database');

		if (!isset($dbConfig[$this->dbConfigName])) {
			throw new CommonException('数据库配置' . $this->dbConfigName . '不存在');
		}

		$dbConfig 	= $dbConfig[$this->dbConfigName];

		$class 		= isset($dbConfig['class']) 	? $dbConfig['class'] 	: '';
		$prefix 	= isset($dbConfig['prefix']) 	? $dbConfig['prefix'] 	: '';
		$host 		= isset($dbConfig['host']) 		? $dbConfig['host'] 	: '';
		$port 		= isset($dbConfig['port']) 		? $dbConfig['port'] 	: '';
		$dbConfigName 	= isset($dbConfig['dbname']) 	? $dbConfig['dbname'] 	: '';
		$username 	= isset($dbConfig['username']) 	? $dbConfig['username']	: '';
		$password 	= isset($dbConfig['password']) 	? $dbConfig['password']	: '';
		$charset 	= isset($dbConfig['charset']) 	? $dbConfig['charset'] 	: '';

		if (empty($class)) {
			throw new CommonException('数据库配置' . $this->dbConfigName . '中class不能为空');
		}

		if (empty($host)) {
			throw new CommonException('数据库配置' . $this->dbConfigName . '中host不能为空');
		}

		if (empty($port)) {
			throw new CommonException('数据库配置' . $this->dbConfigName . '中port不能为空');
		}

		if (empty($dbConfigName)) {
			throw new CommonException('数据库配置' . $this->dbConfigName . '中dbConfigName不能为空');
		}

		if (empty($username)) {
			throw new CommonException('数据库配置' . $this->dbConfigName . '中username不能为空');
		}

		if (empty($charset)) {
			throw new CommonException('数据库配置' . $this->dbConfigName . '中charset不能为空');
		}

		return $dbConfig;
	}
	
}

