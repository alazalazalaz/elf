<?php

/**
* 核心控制器
*/
namespace ElfFramework\Controller;

class CoreController
{
	private static $sysFun 	= array(
		'before', 'after', 'set', 'display', 'view', 'getSysFun'
		);


	public function __construct(){}
	

	public function __destruct(){}


	public static function getSysFun(){
		return self::$sysFun;
	}

	
	public function before(){}
	

	public function after(){}


	public function set(){}


	public function display(){}
	
}