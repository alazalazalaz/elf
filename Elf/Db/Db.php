<?php
/**
* Db管理数据库和模型之间的关联，做一些既不是模型相关的事又不是执行sql相关的事。
*/
namespace Elf\Db;

use Elf\Db\Database;

class Db
{
	
	function __construct()
	{

	}



	public static function db($dbConfigName = ''){
		$dbConfigName = empty($dbConfigName) ? static::$dbConfigName : $dbConfigName;

		$sql = Database::db($dbConfigName);

		if (static::$tablePrefix) {
			$sql->setPrefix(static::$tablePrefix);
		}

		return $sql;
	}


}