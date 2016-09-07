<?php
/**
* view
*/
namespace ElfFramework\View;
use ElfFramework\View\SmartyView;
use ElfFramework\View\TwigView;

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

		$tplName = '\ElfFramework\View\\' . $tplName . 'View';

		if (isset(self::$viewInsArray[$tplName])) {
			return self::$viewInsArray[$tplName];
		}else{
			self::$viewInsArray[$tplName] = new $tplName();
			return self::$viewInsArray[$tplName];
		}
	}
	
}