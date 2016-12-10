<?php
/**
* app model
*/
namespace app\model;
use ElfFramework\Model\Model;

class AppModel extends Model
{
	
	public $dbConfigName = 'test';

	public $tablePrefix  = '';

	public $tableName 	 = 'country';


	// public $dbName = 'test';

	// public $tableSuffix = 'appsu_';

	public function select(){
		return $this->findOne();
		// return $this->insert();
	}


	public function test(){

	}
}