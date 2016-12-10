<?php
/**
* dbmanage管理数据库和模型之间的关联，做一些既不是模型相关的事又不是执行sql相关的事。
*/
namespace ElfFramework\Db;

use ElfFramework\Db\SqlBuilder\Sql;
use ElfFramework\Db\CoreDb;
use ElfFramework\Config\ConfigHandle\Config;

class Db extends CoreDb
{
	
	function __construct()
	{
		parent::__construct();
	}





	public function connect($dbConfigName = ''){
		$dbConfigName 	= empty($dbConfigName) ? $this->dbConfigName : $dbConfigName;

		return parent::connect($dbConfigName);
	}


	/**
	 * @todo  待修改
	 * @param  string $tablePrefix  [description]
	 * @param  string $dbConfigName [description]
	 * @return [type]               [description]
	 */
	public function sql($tablePrefix = '', $dbConfigName = ''){
		$tablePrefix 	= empty($tablePrefix) ? $this->tablePrefix : $tablePrefix;

		if (empty($tablePrefix)) {
			//加载配置文件里面的表前缀
			$dbConfig 	= Config::load('database');
			$tablePrefix = isset($dbConfig[$dbConfigName]['prefix']) ? $dbConfig[$dbConfigName]['prefix'] : '';
		}

		$sql = new Sql();
		$sql->setPrefix($tablePrefix);

		return $sql;
	}


}