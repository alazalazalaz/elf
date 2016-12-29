<?php
/**
* app model
*/
namespace app\model;
use ElfFramework\Model;

class AppModel extends Model
{
	
	public static $dbConfigName = 'test';

	public static $tablePrefix  = '';

	public static $tableName 	= 'country';

	public static $pk 			= 'id';


	public function __construct(){


	}

}