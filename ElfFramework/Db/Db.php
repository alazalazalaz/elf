<?php
/**
* Db管理数据库和模型之间的关联，做一些既不是模型相关的事又不是执行sql相关的事。
*/
namespace ElfFramework\Db;

use ElfFramework\Db\Database;

class Db
{
	
	function __construct()
	{

	}



	public function db($dbConfigName = ''){
		$dbConfigName = empty($dbConfigName) ? $this->dbConfigName : $dbConfigName;

		$sql = Database::db($dbConfigName);

		if ($this->tablePrefix) {
			$sql->setPrefix($this->tablePrefix);
		}

		return $sql;
	}


}