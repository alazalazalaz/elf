<?php
/**
* coreview
*/
namespace ElfFramework\View;
use ElfFramework\Exception\CommonException;
use ElfFramework\View\ViewInterface;

class SmartyView implements ViewInterface
{

	private $_smarty;
	private $_tplPath;
	private $_fileSuffix;

	function __construct()
	{
		$this->_smarty = new \Smarty();
		$this->_smarty->template_dir 		= APP_PATH . 'data' . DS . 'smarty' . DS . 'templates' . DS;
		$this->_smarty->compile_dir 		= APP_PATH . 'data' . DS . 'smarty' . DS . 'templates_c' . DS;
		$this->_smarty->cache_dir 			= APP_PATH . 'data' . DS . 'smarty' . DS . 'cache' . DS;
		$this->_smarty->config_dir 			= '';
		$this->_smarty->left_delimiter 		= '<{';
		$this->_smarty->right_delimiter 	= '}>';
		$this->_smarty->force_compile 		= FALSE;
		$this->_smarty->caching 			= FALSE;
		$this->_smarty->cache_lifetime 		= 3600;
		
		$this->_tplPath 					= APP_PATH . 'view' . DS;
		$this->_fileSuffix 					= '.tpl';
	}


	public function set($key, $value){
		$key = trim($key);
		
		if (empty($key)) {
			throw new CommonException("设置模板变量的key值不能为空", 1);
		}

		$this->_smarty->assign($key, $value);
	}


	public function view($fileName){

		$fullPath = $this->_tplPath . $fileName . $this->_fileSuffix;
		if (!is_file($fullPath)) {
			throw new CommonException("模板文件不存在：" . $fullPath, 1);
		}

		$this->_smarty->display($fullPath);
	}


	public function setTemplateDir($path){
		$this->_smarty->setTemplateDir($path);
	}

}
