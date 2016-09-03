<?php
/**
* coreview
*/
namespace ElfFramework\View;
require ELF_PATH . 'Vendor' . DS . 'Smarty' . DS . 'Libs' . DS . "Smarty.class.php";

class CoreView
{

	private $_smarty;
	/**
	 * @todo 构建tpl的path
	 * @var [type]
	 */
	private $_tplPath 	= APP_PATH . 'view' . DS;

	function __construct()
	{
		$this->_smarty = new \Smarty();
		$this->_smarty->template_dir 		= APP_PATH . 'data' . DS . 'smarty' . DS . 'templates' . DS;
		$this->_smarty->compile_dir 		= APP_PATH . 'data' . DS . 'smarty' . DS . 'templates_c' . DS;
		$this->_smarty->config_dir 		= '';
		$this->_smarty->cache_dir 			= APP_PATH . 'data' . DS . 'smarty' . DS . 'cache' . DS;
		$this->_smarty->left_delimiter 	= '{';
		$this->_smarty->right_delimiter 	= '}';
		$this->_smarty->force_compile 		= FALSE;
		$this->_smarty->caching 			= FALSE;
		$this->_smarty->cache_lifetime 	= 3600;
		
	}


	public function set($key, $value){
		$this->_smarty->assign($key, $value);
	}


	public function view($fileName){

		$smarty->display($this->_tplPath . $fileName);
	}
}
