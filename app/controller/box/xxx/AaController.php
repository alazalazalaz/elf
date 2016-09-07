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

class AaController extends AppController
{
	
	public function test(){
		$this->set('  ', '333333');
		$this->view('index');
	}
	
	public function before(){

	}

	public function after(){
		
	}
}
