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
use app\model\box\AaModel;
use ElfFramework\Db\Database;

class AaController extends AppController
{
	
	public function test(){
		$id    = 13;
		$field = 'id,name';
		$where = ['id >'=> 6];
		$fieldsValue = ['name'=>666666, 'population' => 888888];
		$insertValue = ['code'=>222, 'name' => 'xiaozhang', 'population' => 100];
		$insertValueMulti = [
			['code' => 111, 'name' => 'hi', 'population' => 1],
			['code' => 222, 'name' => 'hello', 'population' => 2],
			['code' => 333, 'name' => 'world', 'population' => 3]
		];

		// $result = AppModel::findOne($where, $where);
		// $result = AppModel::find($field, $where);
		// $result = AppModel::deleteByPk($id);
		// $result = AppModel::delete($where);
		// $result = AppModel::updateByPk($id, $fieldsValue);
		// $result = AppModel::update($fieldsValue, $where);
		// $result = AppModel::save($insertValue);
		// $result = AppModel::saveAll($insertValueMulti);
		// $result = AppModel::count($where);
		// 
		// $obj = AppModel::factory();
		// $result = $obj->findOne();
		// 
		// $result = Database::db('test')
		// 					->execute('select * from pre_country AS c where c.id >= :id', [':id' => 35])
		// 					->all('id');
		

		// $result = Database::db('test')
		// 					->debug()
		// 					->execute('select * from pre_country where id IN (:id0, :id1)', [':id0' => 1, ':id1' => 2])
		// 					->all();
		 					
		// $result = Database::db('test')
		// 					->debug()
		// 					->select('*')
		// 					->from('country')
		// 					->where([
		// 							'id' => 1
		// 							])
		// 					->execute()
		// 					->all();

// 
		// $result = Database::db('test')
		// 					->debug()
		// 					->insert('country')
		// 					->values(['id' => 1, 'name' => 'aaa', 'population' => 2])
		// 					->onUpdate(['name' => 'bbbc'])
		// 					->execute();
// 							

		// $result = Database::db('test')
		// 					->debug()
		// 					->select('c.id', ['c.name' => 'n'], ['c.population' => 'po'], 's.search')
		// 					->from(['country' => 'c'])
		// 					->leftJoin(['country_search' => 's'])->on(['c.id' => 's.id'])
		// 					->where(['c.id <' => 35])
		// 					->order('po')
		// 					->execute()
		// 					->all();

		$result = Database::db('test')
							->debug()
							->delete()
							->from('country')
							->where(['id >' => 8])
							->limit(1)
							->execute();
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
