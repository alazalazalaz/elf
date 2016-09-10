<?php
/**
* model
*/
namespace ElfFramework\Model;

class Model
{
	CONST MODEL_SUF 	= 'Model';
	
	function __construct()
	{
		# code...
	}


	public static function factory($modelName){
		$filePath = str_replace('_', DS, $modelName);
		$filePath = APP_PATH . 'model/' . $filePath;
		var_dump($filePath);exit;

	}
}