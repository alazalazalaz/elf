<?php

/**
* 
*/
namespace app\controller\box\xxx;
use app\controller\AppController;
use ElfFramework\Lib\Log\Log;
use ElfFramework\Lib\Common\Func;
use ElfFramework\Lib\Cookie\Cookie;
use ElfFramework\Lib\Session\Session;
use ElfFramework\Lib\Hash\Hash;
// use ElfFramework\Vendor\Smarty\CoreSmarty;
use ElfFramework\View\CoreView;

class AaController extends AppController
{
	
	public function test(){
		$a = new CoreView();
		echo 333;
	}
	
	public function before(){

	}

	public function after(){
		
	}
}
