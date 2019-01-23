<?php
/**
* app model
*/
namespace app\model\nba;
use Elf\Model;

class MatchListModel extends Model
{
	public static $dbConfigName = 'nba';

	public static $tablePrefix  = 'nba_';

	public static $tableName 	= 'match_list';

	public static $pk 			= '3';
	
	function __construct()
	{
		
	}

}