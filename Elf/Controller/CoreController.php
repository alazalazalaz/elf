<?php

/**
* 核心控制器
*/
namespace Elf\Controller;
use Elf\Routing\CoreRequest;
use Elf\View\View;

class CoreController
{
	

	public function __construct(){}
	

	public function __destruct(){}

	
	/**
	 * param参数包含了get和post的所有数据
	 * @param  string
	 * @param  string
	 * @param string || int  [<default value>]
	 * @return string || int
	 */
	public function param($key, $type = '', $default = ''){
		$param 	= CoreRequest::data('param');
		switch ($type) {
			case 'int':
				$default = isset($default) ? intval($default) : 0;
				return isset($param[$key]) ? intval($param[$key]) : $default;
				break;
			case 'string':
				$default = isset($default) ? $default : '';
				return isset($param[$key]) ? string($param[$key]) : $default;
				break;
			
			default:
				$default = isset($default) ? $default : '';
				return isset($param[$key]) ? $param[$key] : $default;
				break;
		}
	}


	public function beforeaction(){}
	

	public function afteraction(){}


	public function set($key, $value){
		$viewObj 	= View::instance('smarty');
		$viewObj->set($key, $value);
	}


	public function view($file){
		$viewObj 	= View::instance('smarty');
		$viewObj->view($file);
	}


	public function setTemplateDir($path){
		$viewObj 	= View::instance('smarty');
		$viewObj->setTemplateDir($file);
	}
	
}