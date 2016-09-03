<?php
/**
* 
*/
namespace modules\bbs\controller;
use modules\bbs\controller\AppController;
use ElfFramework\Lib\Log\Log;
use ElfFramework\Lib\Cookie\Cookie;
use ElfFramework\Lib\Session\Session;

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