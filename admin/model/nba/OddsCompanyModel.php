<?php
/**
* 赔率公司
*/
namespace app\model\nba;
use Elf\Model;

class OddsCompanyModel extends Model
{
	public static $dbConfigName = 'nba';

	public static $tablePrefix  = 'nba_';

	public static $tableName 	= 'odds_company';

	public static $pk 			= '3';
	
	CONST COMPANY_AM			= 1;//澳门
	CONST COMPANY_YSB 			= 2;//易胜博
	CONST COMPANY_HG			= 3;//皇冠
	CONST COMPANY_BET			= 4;//bet365
	CONST COMPANY_WD			= 5;//韦德
	CONST COMPANY_LJ			= 6;//利记

	function __construct()
	{
		
	}

}