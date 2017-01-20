<?php
/**
* db result
*/
namespace Elf\Db\Result;

use Elf\Db\SqlBuilder\Sql;
use Elf\Exception\CommonException;

class Result
{
	
	private $sqlType	= '';

	private $sql 		= '';

	private $param 		= [];

	private $sth 		= '';

	private $pdo 		= '';

	private $result 	= '';

	private $debug 		= FALSE;


	function __construct($pdo, $sqlObj, $sth){
		$this->sql 		= $sqlObj->getSql();
		$this->sqlType 	= $sqlObj->getType();
		$this->param 	= $sqlObj->getParam();
		$this->debug 	= $sqlObj->getDebug();
		$this->sth 		= $sth;
		$this->pdo 		= $pdo;

	}


	public function returnDefaultResult(){
		if ($this->debug) {
			$this->debug();
		}

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


	private function debug(){
		echo '<br>SQL TYPE:';
		echo '<pre>';
		print_r($this->sqlType);
		echo '</pre>';

		echo '<br>SQL:';
		echo '<pre>';
		print_r($this->sql);
		echo '</pre>';

		echo '<br>SQL PARAM:';
		echo '<pre>';
		print_r($this->param);
		echo '</pre>';
	}

}