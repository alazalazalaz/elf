<?php
/**
* app model
*/
namespace app\model\box;
use app\model\AppModel;

class AaModel extends AppModel
{
	public static $dbConfigName = 'test';

	public static $tablePrefix  = '';

	public static $tableName 	= 'country';

	public static $pk 			= '3';
	
	function __construct()
	{
		
	}


	public function test(){
		echo 3333;
		echo 44444;
	}


	public function te4st(){
		echo 3333;
		echo 44444;
	}
}