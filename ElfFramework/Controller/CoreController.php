<?php

/**
* 核心控制器
*/
namespace ElfFramework\Controller;
use ElfFramework\Routing\CoreRequest;

class CoreController
{
	


	public function __construct(){}
	

	public function __destruct(){}

	
	/**
	 * param参数包含了get和post的所有数据
	 * @param  string
	 * @param  string
	 * @return string || int
	 */
	public function param($key, $type = ''){
		$param 	= CoreRequest::data('param');
		switch ($type) {
			case 'int':
				return isset($param[$key]) ? intval($param[$key]) : 0; 
				break;
			case 'string':
				return isset($param[$key]) ? string($param[$key]) : ''; 
				break;
			
			default:
				return isset($param[$key]) ? $param[$key] : '';
				break;
		}
	}


	public function before(){}
	

	public function after(){}


	public function set(){}


	public function display(){}
	
}