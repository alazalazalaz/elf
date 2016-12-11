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
use ElfFramework\Db\Database;

class AaController extends AppController
{
	
	public function test(){
		


		// $sql = 'update country set population=1 where id=1';
		$sql = 'select * from countdry';

		$model = AppModel::factory();
		$model->findOne();
		// $model->insert([]);
		// $model->update(['code'=>23], ['id'=>6]);
		// $model->delete(['id > ' => 29]);
		// $model->execute('select * from country limit 2');
		// $data = $model->query($sql);

		echo '<pre>';
		var_dump($data);
		// print_r($model);
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
