<?php
/**
* app model
*/
namespace app\model;
use ElfFramework\Model\Model;

class AppModel extends Model
{
	
	function __construct()
	{
		echo 'im model';
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