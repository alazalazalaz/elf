<?php

/**
* 
*/
namespace app\controller\box\xxx;
use app\controller\AppController;
use ElfFramework\Lib\Log\Log;
use ElfFramework\Lib\Common\Func;


class AaController extends AppController
{
	
	public function test(){

		$mes = "aaabbbccc";
		Log::write($mes, '', 'sdfsdf');
		


	}
	
	public function before(){

	}

	public function after(){
		
	}
}
