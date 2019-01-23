<?php
/**
* 赔率
*/
namespace app\model\nba;
use Elf\Model;

class MatchOddsModel extends Model
{
	public static $dbConfigName = 'nba';

	public static $tablePrefix  = 'nba_';

	public static $tableName 	= 'match_odds';

	public static $pk 			= '3';
	
	CONST TYPE_HANDICAP 		= 0;//让分盘
	CONST TYPE_TOTAL 			= 1;//大小盘

	function __construct()
	{
		
	}

}