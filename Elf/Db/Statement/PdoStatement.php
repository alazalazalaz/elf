<?php
/**
* PDOstatement相关类
*/
namespace Elf\Db\Statement;

use PDOStatement as statement;
use PDO;
use Elf\Db\Driver\Mysql\MysqlPdo;
use Elf\Exception\CommonException;

class PdoStatement
{
	public $statement;

	public $driver;
	
	function __construct(statement $statement = null, MysqlPdo $driver = null)
	{
		$this->statement 	= $statement;
		$this->driver 		= $driver;
	}


	public function fetchAll($type = 'assoc'){
		switch ($type) {
			case 'assoc':
				return $this->statement->fetchAll(PDO::FETCH_ASSOC);
				break;
			case 'num':
				return $this->statement->fetchAll(PDO::FETCH_NUM);
				break;
			case 'obj':
				return $this->statement->fetchAll(PDO::FETCH_OBJ);
				break;
			
			default:
				return $this->statement->fetchAll(PDO::FETCH_ASSOC);
				break;
		}
		
	}


	public function bindValue(array $param = array()){
		foreach ($param as $key => $value) {
			$this->statement->bindValue($value['column'], $value['value']);
		}
	}


	public function execute(){
		try {
			if (!$this->statement->execute()) {
				throw new CommonException("execute()执行sql语句失败", 1);
			}
		} catch (PDOException $e) {
			throw new CommonException("execute()执行sql语句发生错误", 1);
		}
	}


	public function rowCount(){
		return $this->statement->rowCount();
	}


}

