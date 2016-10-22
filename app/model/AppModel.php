<?php
/**
* app model
*/
namespace app\model;
use ElfFramework\Model\Model;

class AppModel extends Model
{
	
	// public $dbName = 'test';

	// public $tableSuffix = 'appsu_';

	public function select(){
		return $this->findOne();
	}
}