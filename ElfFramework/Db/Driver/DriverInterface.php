<?php

/**
* base driver
*/
namespace ElfFramework\Db\Driver;

interface DriverInterface{

	/**
	 * 链接数据库
	 * @return [type] [description]
	 */
	public function connect();

	/**
	 * 执行原生的sql语句
	 * @return [type] [description]
	 */
	// public function query($sql);

	/**
	 * 设置字符集
	 * @param [type] $charset [description]
	 */
	public function setCharset($charset);

}