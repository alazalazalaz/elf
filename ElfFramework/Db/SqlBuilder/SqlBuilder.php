<?php
/**
* 创建sql语句
*/
namespace ElfFramework\Db\SqlBuilder;
use ElfFramework\Exception\CommonException;
use ElfFramework\Db\SqlBuilder\Sql;
use ElfFramework\Db\SqlBuilder\BuilderHelper;

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
		'leftJoin'  => 'LEFT JOIN %s',
		'rightJoin' => 'RIGHT JOIN %s',
		'innerJoin' => 'INNER JOIN %s',
		'on'		=> 'ON %s',
		'where'		=> "WHERE %s",
		'and'		=> "AND %s",
		'order'		=> 'ORDER BY %s',
		'group'		=> 'GROUP BY %s',
		'having'	=> 'HAVING %s',
		'limit'		=> 'LIMIT %s',
		'onUpdate'  => 'ON DUPLICATE KEY UPDATE %s'
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
				throw new CommonException('error sql type', 1);
				break;
		}

		$this->setSql();
	}


	private function _selectSql(){
		$this->_buildSelect();
		
		$this->_buildFrom();

		$this->_buildJoin();

		$this->_buildWhere();

		$this->_buildGroup();

		$this->_buildHaving();

		$this->_buildOrder();

		$this->_buildLimit();
	}


	private function _insertSql(){
		$this->_buildInsert();

		$this->_buildValues();

		$this->_buildOnUpdate();
	}


	private function _updateSql(){
		$this->_buildUpdate();

		$this->_buildSets();

		// $this->_buildValues();

		if ($this->sqlObj->part['update']) {
			if (!$this->_buildWhere()) {
				throw new CommonException('sql build错误，update语句必须加where条件，若要修改全部请使用updateAll()方法。', 1);
			}
		}elseif ($this->sqlObj->part['updateAll']) {
			$this->_buildWhere();
		}

		$this->_buildLimit();
	}


	private function _deleteSql(){
		$this->buildDelete();

		$this->_buildFrom();

		if ($this->sqlObj->part['delete']) {
			if (!$this->_buildWhere()) {
				throw new CommonException('sql build错误，delete语句必须加where条件，若要删除全部请使用deleteAll()方法。', 1);
			}
		}elseif ($this->sqlObj->part['deleteAll']) {
			$this->_buildWhere();
		}

		$this->_buildLimit();
	}


	private function _buildSelect(){
		$select = $this->sqlObj->part['select'];
		if (empty($select)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['select'], $select);
	}


	private function _buildFrom(){
		$from 	= $this->sqlObj->part['from'];
		$prefix = $this->sqlObj->part['tablePrefix'];
		if (empty($from)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['from'], $prefix . $from);
	}


	private function buildCount(){

	}


	private function _buildInsert(){
		$insert 	= $this->sqlObj->part['insert'];

		$prefix = $this->sqlObj->part['tablePrefix'];
		if (empty($insert)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['insert'], $prefix . $insert);
	}


	private function _buildSets(){
		$sets 	= $this->sqlObj->part['sets'];
		if (empty($sets)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['sets'], $sets);
	}


	private function _buildValues(){
		$values 	= $this->sqlObj->part['values'];
		if (empty($values)) {
			return ;
		}

		if (empty($values['column']) || empty($values['mark'])) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['values'], $values['column'], $values['mark']);
	}


	private function _buildUpdate(){
		$update 	= empty($this->sqlObj->part['update']) ? $this->sqlObj->part['updateAll'] : $this->sqlObj->part['update'];

		$prefix = $this->sqlObj->part['tablePrefix'];
		if (empty($update)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['update'], $prefix . $update);
	}


	private function buildDelete(){

		$this->_sqlParts[] = sprintf($this->init['delete']);
	}


	private function _buildWhere(){
		$where 	= $this->sqlObj->part['where'];

		if (!empty($where)) {
			$this->_sqlParts[] = sprintf($this->init['where'], $where);
			return TRUE;
		}

		return FALSE;
	}


	private function _buildGroup(){
		$group 	= $this->sqlObj->part['group'];

		if (!empty($group)) {
			$this->_sqlParts[] = sprintf($this->init['group'], $group);	
		}

		return $this;
	}


	private function _buildHaving(){
		$having 	= $this->sqlObj->part['having'];

		if (!empty($having)) {
			$this->_sqlParts[] = sprintf($this->init['having'], $having);	
		}

		return $this;
	}
	

	private function _buildOrder(){
		$order 	= $this->sqlObj->part['order'];

		if (!empty($order)) {
			$this->_sqlParts[] = sprintf($this->init['order'], $order);	
		}

		return $this;
	}


	private function _buildLimit(){
		$limit 	= $this->sqlObj->part['limit'];

		if (!empty($limit)) {
			$this->_sqlParts[] = sprintf($this->init['limit'], $limit);
		}

		return $this;	
	}


	private function _buildJoin(){
		$join 	= $this->sqlObj->part['join'];
		$on 	= $this->sqlObj->part['on'];

		if (empty($join) || empty($on)) {
			return ;
		}

		if (!is_array($join) || !is_array($on)) {
			return ;
		}

		foreach ($join as $key => $value) {
			$tableFullName = $this->sqlObj->part['tablePrefix'] . $value['tableName'];
			switch ($value['joinType']) {
				case 'lj':
					$this->_sqlParts[] = sprintf($this->init['leftJoin'], $tableFullName);
					break;
				case 'rj':
					$this->_sqlParts[] = sprintf($this->init['rightJoin'], $tableFullName);
					break;
				case 'ij':
					$this->_sqlParts[] = sprintf($this->init['innerJoin'], $tableFullName);
					break;
				
				default:
					throw new CommonException('sql build错误，join语句暂时只支持leftJoin, rightJoin, innerJoin三种类型', 1);
					break;
			}
					
			$this->_sqlParts[] = sprintf($this->init['on'], $on[$key]);
		}
		
	}


	private function _buildOnUpdate(){
		$sets 	= $this->sqlObj->part['onUpdate'];

		if (empty($sets)) {
			return ;
		}

		$this->_sqlParts[] = sprintf($this->init['onUpdate'], $sets);

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