<?php
/**
* app model
*/
namespace app\model\nba;
use Elf\Model;

class MatchModel extends Model
{
	public static $dbConfigName = 'nba';

	public static $tablePrefix  = 'nba_';

	public static $tableName 	= 'match';

	public static $pk 			= '3';

	CONST OT_YES				= 1;//加时
	CONST OT_NO 				= 0;//不加时
	
	CONST WIN 					= 1;//赢盘
	CONST DROP 					= 0;//走盘
	CONST LOST 					= -1;//输盘

	CONST STATE_ON 				= 1;//进行中
	CONST STATE_OFF				= -1;//已结束
	CONST STATE_INIT 			= 0;//未开始
	
	function __construct()
	{
		
	}

}