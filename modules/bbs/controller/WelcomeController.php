<?php
/**
* 
*/
namespace modules\bbs\controller;
use modules\bbs\controller\AppController;
use ElfFramework\Lib\Log\Log;

class WelcomeController extends AppController
{
	
	public function say(){
		$mes = "aaabbbccc";
		Log::write($mes, '');
	}
}