<?php
/**
* view
*/
namespace Elf\View;
use Elf\View\SmartyView;
use Elf\View\TwigView;

class View
{

	private static $viewInsArray 	= array();

	private static $tplName 		= array(
		'Smarty','Twig'
	);

	public static function instance($tplName){
		$tplName 	= ucwords(strtolower($tplName));
		if (!in_array($tplName, self::$tplName)) {
			throw new CommonException("模板类型'" . $tplName . "'不存在", 1);
		}

		$tplName = '\Elf\View\\' . $tplName . 'View';

		if (isset(self::$viewInsArray[$tplName])) {
			return self::$viewInsArray[$tplName];
		}else{
			self::$viewInsArray[$tplName] = new $tplName();
			return self::$viewInsArray[$tplName];
		}
	}
	
}