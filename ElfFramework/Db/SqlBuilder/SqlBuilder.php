<?php
/**
* 创建sql语句
*/
namespace ElfFramework\Db\SqlBuilder;
use ElfFramework\Exception\CommonException;
use ElfFramework\Db\SqlBuilder\Sql;
use ElfFramework\Db\SqlBuilder\BuilderHelper;
use ElfFramework\Db\SqlBuilder\BindValue;

class SqlBuilder
{

	public $tablePrefix 	= '';
	
	private $_sqlParts	= array();
	private $_sql 		= '';
	private $_param 	= array();

	private $_sqlObj 	= '';

	protected $init 	= [
		'select'	=> "SELECT %s",
		'insert'	=> "INSERT INTO %s",
		'update'	=> "UPDATE %s",
		'delete'	=> "DELETE ",
		'sets'		=> "SET %s",
		'values'	=> "%s VALUES %s",
		'from'		=> "FROM %s",
		'where'		=> "WHERE %s",
		'and'		=> "AND %s",
		'order'		=> 'ORDER BY %s',
		'limit'		=> 'LIMIT %s'
	];


	protected $bindKeyValue 	= [];


	/**
	 * @param  Sql    $sql [description]
	 * @return [type]      [description]
	 */
	public function build(Sql $sql){
		$this->sqlObj 	= $sql;

		switch ($sql->getType()) {
			case Sql::INSERT:
				$this->_insertSql();
				break;
			case Sql::SELECT:
				$this->_selectSql();
				break;
			case Sql::UPDATE:
				$this->_updateSql();
				break;
			case Sql::DELETE:
				$this->_deleteSql();
				break;
			
			default:
				//@todo
				break;
		}

		$this->setSql();
	}


	private function _selectSql(){
		$this->buildSelect();
		
		$this->buildFrom();

		$this->buildWhere();

		$this->buildOrder();

		$this->buildLimit();
	}


	private function _insertSql(){
		$this->buildInsert();

		$this->buildValues();
	}


	private function _updateSql(){
		$this->buildUpdate();

		$this->buildSets();

		$this->buildValues();
		
		if ($this->sqlObj->part['update']) {
			if (!$this->buildWhere()) {
				throw new CommonException('sql build错误，update语句必须加where条件，若要修改全部请使用updateAll()方法。', 1);
			}
		}elseif ($this->sqlObj->part['updateAll']) {
			$this->buildWhere();
		}

		$this->buildLimit();
	}


	private function _deleteSql(){
		$this->buildDelete();

		$this->buildFrom();

		if ($this->sqlObj->part['delete']) {
			if (!$this->buildWhere()) {
				throw new CommonException('sql build错误，delete语句必须加where条件，若要删除全部请使用deleteAll()方法。', 1);
			}
		}elseif ($this->sqlObj->part['deleteAll']) {
			$this->buildWhere();
		}

	}


	public function buildSelect(){
		$select = $this->sqlObj->part['select'];
		if (empty($select)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['select'], $select);
	}


	public function buildFrom(){
		$from 	= $this->sqlObj->part['from'];
		if (empty($from)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['from'], $from);
	}


	public function buildCount(){

	}


	public function buildInsert(){
		$insert 	= $this->sqlObj->part['insert'];
		if (empty($insert)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['insert'], $insert);
	}


	public function buildSets(){
		$sets 	= $this->sqlObj->part['sets'];
		if (empty($sets)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['sets'], $sets);
	}


	public function buildValues(){
		$values 	= $this->sqlObj->part['values'];
		if (empty($values)) {
			return ;
		}

		if (empty($values['column']) || empty($values['mark'])) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['values'], $values['column'], $values['mark']);
	}


	public function buildUpdate(){
		$update 	= empty($this->sqlObj->part['update']) ? $this->sqlObj->part['updateAll'] : $this->sqlObj->part['update'];
		if (empty($update)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['update'], $update);
	}


	public function buildDelete(){

		$this->_sqlParts[] = sprintf($this->init['delete']);
	}


	public function buildWhere(){
		$where 	= $this->sqlObj->part['where'];

		if (!empty($where)) {
			$this->_sqlParts[] = sprintf($this->init['where'], $where);
			return TRUE;
		}

		return FALSE;
	}


	public function buildOrder(){
		$order 	= $this->sqlObj->part['order'];

		if (!empty($order)) {
			$this->_sqlParts[] = sprintf($this->init['order'], $order);	
		}

		return $this;
	}


	public function buildLimit(){
		$limit 	= $this->sqlObj->part['limit'];

		if (!empty($limit)) {
			$this->_sqlParts[] = sprintf($this->init['limit'], $limit);
		}

		return $this;	
	}


	private function setSql(){
		$this->_sql 	= implode(' ', $this->_sqlParts);
	}

	public function getSql(){
		return $this->_sql;
	}


	private function setParam(array $bindValue){
		$this->_param = array_merge($this->_param, $bindValue);
	}


}