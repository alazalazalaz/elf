<?php
/**
* 
*/
namespace modules\bbs\controller;
use modules\bbs\controller\AppController;
use Elf\Lib\Log;
use Elf\Lib\Cookie;
use Elf\Lib\Session;

class WelcomeController extends AppController
{
	
	public function say(){
		require ELF_PATH . 'Vendor' . DS . 'Smarty' . DS . 'Libs' . DS . "Smarty.class.php";
		$smarty = new \Smarty();
		$smarty->template_dir = APP_PATH . 'data' . DS . 'smarty' . DS . 'templates' . DS;
		$smarty->compile_dir = APP_PATH . 'data' . DS . 'smarty' . DS . 'templates_c' . DS;
		$smarty->config_dir = '';
		$smarty->cache_dir = APP_PATH . 'data' . DS . 'smarty' . DS . 'cache' . DS;
var_dump($smarty);exit;
	}
}