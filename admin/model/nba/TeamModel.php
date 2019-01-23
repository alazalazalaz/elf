<?php
/**
* app model
*/
namespace app\model\nba;
use Elf\Model;

class TeamModel extends Model
{
	public static $dbConfigName = 'nba';

	public static $tablePrefix  = 'nba_';

	public static $tableName 	= 'team';

	public static $pk 			= '3';
	
	function __construct()
	{
		
	}

}