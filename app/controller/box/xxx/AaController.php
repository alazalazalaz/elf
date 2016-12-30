<?php

/**
* 
*/
namespace app\controller\box\xxx;
use app\controller\AppController;

use ElfFramework\Lib\Log;
use ElfFramework\Lib\Func;
use ElfFramework\Lib\Cookie;
use ElfFramework\Lib\Session;
use ElfFramework\Lib\Hash;
use ElfFramework\Lib\Request;
use ElfFramework\Lib\Response;
use ElfFramework\Lib\Config;
use ElfFramework\Model;
use ElfFramework\Db\Database;

use app\model\AppModel;
use app\model\box\AaModel;

use app\lib\zip;

class AaController extends AppController
{

	public function actionTest(){

		new zip();

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

		Response::header('Cache-Control', 'no-cache, must-revalidate');
		Response::headerByCode(500);
@todo
1、熟悉ob_start ob_end_clean 这一套函数
2、优化设置头部的函数response，应该内容不多，解决用设置了头部后调用smarty的模板会报错（原因是smarty抢先于header对浏览器输出内容了）的问题
3、解决报异常和错误（shutdownHandle的时候不用管）的时候，浏览器应该只显示报错，而不应该显示之前打印的东西。
		// $result = AppModel::findOne($where, $where);
		// $result = AppModel::find($field, $where, '');
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

		// $result = Database::db('test')
		// 					->debug()
		// 					->delete()
		// 					->from('country')
		// 					->where(['id >' => 8])
		// 					->limit(1)
		// 					->execute();
// var_dump($result);

		// $this->set('name', 'xxx');
		// $this->view('index');

// @todo 使用flush来关闭xdebug
// var_dump(xdebug_memory_usage(), xdebug_peak_memory_usage());exit;
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
