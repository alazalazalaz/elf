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
		$id    = 13;
		$field = 'id,name';
		$where = ['id'=> 6];
		$fieldsValue = ['name'=>666666, 'population' => 888888];
		$insertValue = ['code'=>222, 'name' => 'xiaozhang', 'population' => 100];
		$insertValueMulti = [
			['code' => 111, 'name' => 'hi', 'population' => 1],
			['code' => 222, 'name' => 'hello', 'population' => 2],
			['code' => 333, 'name' => 'world', 'population' => 3]
		];
		
		// $result = AppModel::findOne();
		// $result = AppModel::find($field, $where);
		// $result = AppModel::deleteByPk($id);
		// $result = AppModel::delete($where);
		// $result = AppModel::updateByPk($id, $fieldsValue);
		// $result = AppModel::update($fieldsValue, $where);
		// $result = AppModel::save($insertValue);
		$result = AppModel::saveAll($insertValueMulti);

var_dump($result);exit;

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
