<?php
/**
* db result
*/
namespace ElfFramework\Db\Result;

use ElfFramework\Db\SqlBuilder\Sql;
use ElfFramework\Exception\CommonException;

class Result
{
	
	private $sqlType	= '';

	private $sql 		= '';

	private $param 		= [];

	private $sth 		= '';

	private $pdo 		= '';

	private $result 	= '';


	function __construct($pdo, $sqlObj, $sth){
		$this->sql 		= $sqlObj->getSql();
		$this->sqlType 	= $sqlObj->getType();
		$this->param 	= $sqlObj->getParam();
		$this->sth 		= $sth;
		$this->pdo 		= $pdo;

	}


	public function returnDefaultResult(){

		switch ($this->sqlType) {
			case Sql::INSERT:
				return $this->pdo->lastInsertId();
				break;
			case Sql::SELECT:
				$this->result = $this->sth->fetchAll('assoc');
				return $this;
				break;
			case Sql::UPDATE:
				return $this->sth->rowCount();
				break;
			case Sql::DELETE:
				return $this->sth->rowCount();
				break;
			
			
			default:
				echo 'todo';exit;
				break;
		}


	}


	public function all($column = ''){
		if (empty($column)) {
			return $this->result;
		}

		$data = [];
		if (!empty($this->result)) {
			foreach ($this->result as $k => $v) {
				if (array_key_exists($column, $v)) {
					$data[$v[$column]] = $v;
				}else{
					throw new CommonException("结果集中不存在列名：$column", 1);
				}
			}
		}

		return $data;
	}


	public function one(){
		if (!empty($this->result)) {
			if (isset($this->result[0])) {
				return $this->result[0];
			}
		}
		return [];
	}

}