<?php
/**
* 赔率平均值
*/
namespace app\model\nba;
use Elf\Model;

class MatchOddsAvgModel extends Model
{
	public static $dbConfigName = 'nba';

	public static $tablePrefix  = 'nba_';

	public static $tableName 	= 'match_odds_avg';

	public static $pk 			= '3';
	
	function __construct()
	{
		
	}

}