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
use ElfFramework\Routing\CoreRequest;


use app\model\AppModel;

class AaController extends AppController
{
	
	public function test(){

		$model = Model::factory('app');
		$model = $this->loadModel('app');
		// $b = new AppModel();
		// $c = new AppModel();
		// $d = new AppModel();
		// $e = new AppModel();//464

	}
	
	public function before(){

	}

	public function after(){
		
	}
}
