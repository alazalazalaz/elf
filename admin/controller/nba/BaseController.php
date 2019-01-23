<?php

/**
* 
*/
namespace app\controller\nba;
use Elf\Controller;

use app\model\nba\MatchListModel;

class BaseController extends Controller
{

	public function beforeaction(){
		
	}


	protected function getSessionData($sessionBeginYear){
		$beginTime = $sessionBeginYear . '-9-1 00:00:00';
		$endTime = intval($sessionBeginYear) + 1 .'-5-1 00:00:00';
		$where = [
			'match_time between'	=> [
				strtotime($beginTime),
				strtotime($endTime)
			]
		];
		$data = MatchListModel::find('', $where);
		return $data;
	}


	protected function getSessionTime($sessionBeginYear, &$beginTime, &$endTime){
		$beginTime = $sessionBeginYear . '-9-1 00:00:00';
		$endTime = intval($sessionBeginYear) + 1 .'-5-1 00:00:00';

		$beginTime = strtotime($beginTime);
		$endTime = strtotime($endTime);
	}
	
}
