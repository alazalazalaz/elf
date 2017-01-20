<?php

/**
* 
*/
namespace app\controller\box\xxx;
use app\controller\AppController;

use Elf\Lib\Log;
use Elf\Lib\Func;
use Elf\Lib\Cookie;
use Elf\Lib\Session;
use Elf\Lib\Hash;
use Elf\Lib\Request;
use Elf\Lib\Response;
use Elf\Lib\Config;
use Elf\Model;
use Elf\Db\Database;
use Elf\System\System;
use Exception;
use Elf\Exception\CommonException;

use app\model\AppModel;
use app\model\box\AaModel;

use app\lib\zip;

class AaController extends AppController
{

	public function actionTest(){

		new zip();
		
		$this->set('name', 'xxx');
		$this->view('index');

	}
	

	private function test2(){
		$diff = 0;
		return $diff === 0;
	}

	public function before(){

	}

	public function after(){
		
	}
}
