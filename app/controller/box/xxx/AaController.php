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
use ElfFramework\Model\Model;
use ElfFramework\Config\ConfigHandle\Config;
use app\model\AppModel;

class AaController extends AppController
{
	
	public function test(){

		$model = AppModel::factory();
		$data = $model->select();

		echo '<pre>';
		var_dump($data);
		print_r($model);
		echo '</pre>';exit;

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
