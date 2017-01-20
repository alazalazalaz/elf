<?php
/**
* pdo driver
*/
namespace Elf\Db\Driver\Mysql;

use Elf\Db\Driver\DriverInterface;
use Elf\Exception\CommonException;
use PDO;
use PDOException;
use Elf\Db\Statement\PdoStatement;
use Elf\Db\Result\Result;
use Elf\Db\SqlBuilder\Sql;
use Elf\Lib\Log;

class MysqlPdo implements DriverInterface
{
	/**
	 * mysql链接
	 * @var object
	 */
	private $_pdo;

	/**
	 * 主机名
	 * @var string
	 */
	private $_host 		= '';

	private $_port 		= '';

	private $_dbname 	= '';

	private $_username 	= '';


	private $_password	= '';

	private $_charset 	= '';
	


	function __construct($config){
		$this->_host 		= isset($config['host']) 		? $config['host'] 		: '';
		$this->_port 		= isset($config['port']) 		? $config['port'] 		: '';
		$this->_dbname 		= isset($config['dbname']) 		? $config['dbname'] 	: '';
		$this->_username 	= isset($config['username']) 	? $config['username'] 	: '';
		$this->_password 	= isset($config['password']) 	? $config['password'] 	: '';
		$this->_charset 	= isset($config['charset']) 	? $config['charset'] 	: '';

		if (empty($this->_host) || empty($this->_dbname) || empty($this->_username) || empty($this->_charset)) {
			throw new CommonException("数据库参数错误");
		}
	}


	public function connect(){
		$dsn = 'mysql:host=' . $this->_host . ';dbname=' . $this->_dbname . ';port=' . $this->_port . ';charset=' . $this->_charset;

		if (!$this->_pdo) {
			$this->_pdo 	= new PDO($dsn, $this->_username, $this->_password);

			$this->setCharset($this->_charset);
			$this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}
	

	/**
	 * 使用pdo的exec方法执行
	 * @return [type] [description]
	 */
	public function exec(){

	}


	/**
	 * prepare的方式执行
	 * @param  [type] $prepareSql [description]
	 * @param  array  $param      [description]
	 * @return [type]             [description]
	 */
	public function execute($sqlObj){
		$sql 	= $sqlObj->getSql();
		$param 	= $sqlObj->getParam();
		
		if (empty($sql)) {
			throw new CommonException("$sqlObj对象中获取sql语句失败", 1);	
		}

		$sth = self::prepare($sql, $param);

		if (!empty($param) && is_array($param)) {
			$sth->bindValue($param);
		}
		
		$sth->execute();
		
		$result = new Result($this->getPdo(), $sqlObj, $sth);
		return $result->returnDefaultResult();
	}


	public function executeMulti($sqlObj){
		$sql 	= $sqlObj->getSql();
		$param 	= $sqlObj->getParam();

		if (empty($sql)) {
			throw new CommonException("$sqlObj对象中获取sql语句失败", 1);	
		}

		$sth = self::prepare($sql, $param);

		foreach ($param as $key => $value) {
			$sth->bindValue($value);
			$sth->execute();
			$lastIdArr[] = $this->getPdo()->lastInsertId();
		}		

		return $lastIdArr;
	}


	public function prepare($sql, $param){
		try {
			$sth = $this->getPdo()->prepare($sql);
			return new PdoStatement($sth);
		} catch (PDOException $e) {
			log::write('ERROR:	' . $e->getMessage() . "\r\nSQL:	" . $sql . "\r\nPARAM:	" . var_export($param, TRUE), 3, 'errorSql');
			throw new CommonException($e->getMessage() . '  <br>ERROR SQL:' . $sql, 1);
		}
	}


	public function begin(){
		try {
			$this->getPdo()->beginTransaction();
		} catch (PDOException $e) {
			throw new CommonException($e->getMessage(), 1);
		}
	}


	public function commit(){
		try {
			$this->getPdo()->commit();
		} catch (PDOException $e) {
			throw new CommonException($e->getMessage(), 1);
		}
	}


	public function rollback(){
		try {
			$this->getPdo()->rollback();
		} catch (PDOException $e) {
			throw new CommonException($e->getMessage(), 1);
		}
	}


	/**
	 * 设置字符集
	 * @param [type] $charset [description]
	 */
	public function setCharset($charset){
		if (empty($charset)) {
			return FALSE;
		}

		$this->getPdo()->exec("set names $charset");
	}


	public function getPdo(){
		if (!$this->_pdo) {
			$this->connect();
		}

		return $this->_pdo;
	}

}