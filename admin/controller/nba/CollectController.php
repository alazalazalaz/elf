<?php

/**
* 
*/
namespace app\controller\nba;
use Elf\Controller;
use Elf\Lib\Curl;
use app\controller\nba\BaseController;
use app\controller\AppController;

use app\model\nba\TeamModel;
use app\model\nba\MatchModel;
use app\model\nba\MatchListModel;
use app\model\nba\OddsCompanyModel;
use app\model\nba\MatchOddsModel;
use app\model\nba\MatchOddsAvgModel;


class CollectController extends BaseController
{

	public function beforeaction(){
		
	}


	public function actionIndex(){
		
		$data = [[8,'华盛顿奇才','華盛頓巫師','Washington Wizards','奇才','巫師','Wizards'],[21,'休斯顿火箭','侯斯頓火箭','Houston Rockets','火箭','火箭','Rockets'],[23,'丹佛掘金','丹佛金塊','Denver Nuggets','掘金','金塊','nuggets'],[9,'底特律活塞','底特律活塞','Detroit Pistons','活塞','活塞','Pistons'],[2,'波士顿凯尔特人','波士頓塞爾特人','Boston Celtics','凯尔特人','塞爾特人','Celtics'],[10,'印第安纳步行者','印第安納溜馬','Indiana Pacers','步行者','溜馬','Pacers'],[15,'多伦多猛龙','多倫多速龍','Toronto Raptors','猛龙','速龍','Raptors'],[25,'波特兰开拓者','波特蘭拓荒者','Portland Trail Blazers','开拓者','拓荒者','Trail Blaze'],[30,'夏洛特黄蜂','夏洛特黃蜂','Charlotte Hornets','黄蜂','黃蜂','Hornets'],[1,'洛杉矶湖人','洛杉磯湖人','Los Angeles Lakers','湖人','湖人','Lakers'],[12,'密尔沃基雄鹿','密爾沃基公鹿','Milwaukee Bucks','雄鹿','公鹿','Milwaukee'],[28,'俄克拉荷马城雷霆','奧克拉荷馬雷霆','Oklahoma City Thunder','雷霆','雷霆','Thunder'],[6,'奥兰多魔术','奧蘭多魔術','Orlando Magic','魔术','魔術','Magic'],[20,'犹他爵士','猶他爵士','Utah Jazz','爵士','爵士','Jazz'],[22,'孟菲斯灰熊','孟菲斯灰熊','Memphis Grizzlies','灰熊','灰熊','Grizzlies'],[17,'达拉斯小牛','達拉斯小牛','Dallas Mavericks','小牛','小牛','mavericks'],[18,'圣安东尼奥马刺','聖安東尼奧馬刺','San Antonio Spurs','马刺','馬刺','Spurs'],[14,'芝加哥公牛','芝加哥公牛','Chicago Bulls','公牛','公牛','Bulls'],[27,'金州勇士','金州勇士','Golden State Warriors','勇士','勇士','Warriors'],[3,'迈阿密热火','邁亞密熱火','Miami Heat','热火','熱火','Heat'],[11,'新奥尔良鹈鹕','新奧爾良鵜鶘','New Orleans Pelicans','鹈鹕','鵜鶘','Pelicans'],[29,'洛杉矶快船','洛杉磯快艇','Los Angeles Clippers','快船','快艇','Clippers'],[4,'布鲁克林篮网','布魯克林籃網','Brooklyn Nets','篮网','籃網','Nets'],[5,'纽约尼克斯','紐約人','New York Knicks','尼克斯','紐約人','Knicks'],[7,'费城76人','費城七十六人','Philadelphia 76ers','76人','76人','76ers'],[24,'萨克拉门托国王','薩克拉門托帝王','Sacramento Kings','国王','帝王','sac'],[13,'亚特兰大老鹰','阿特蘭大鷹','Atlanta Hawks','老鹰','老鷹','Hawks'],[26,'菲尼克斯太阳','鳳凰城太陽','Phoenix Suns','太阳','太陽','Suns'],[16,'克里夫兰骑士','克里夫蘭騎士','Cleveland Cavaliers','骑士','騎士','Cavaliers'],[19,'明尼苏达森林狼','明尼蘇達木狼','Minnesota Timberwolves','森林狼','木狼','Timberwolves']];

		$east = [[2,22,5,81.5,18.5,0,104.4,97.5,14,4,5,0,12,2,10,3,7,3,-1,1],[15,16,7,69.6,30.4,4,111.7,104.2,8,4,2,2,9,1,7,6,8,2,5,-1],[16,18,8,69.2,30.8,3.5,110.7,107.5,14,6,5,2,9,4,9,4,9,1,-1,1],[8,14,11,56,44,7,106.2,103.6,7,5,2,2,6,5,8,6,5,5,2,-1],[12,14,10,58.3,41.7,6.5,103.3,104,5,7,2,3,8,4,6,6,6,4,2,-1],[10,15,11,57.7,42.3,6.5,108.3,107.2,11,6,5,1,9,4,6,7,7,3,3,-1],[9,14,11,56,44,7,104,102.7,7,8,2,4,8,3,6,8,4,6,-1,5],[7,13,11,54.2,45.8,7.5,108,108,6,5,0,3,7,6,6,5,5,5,-1,2],[5,12,12,50,50,8.5,103.8,103.6,6,8,2,2,11,5,1,7,4,6,1,-1],[3,11,13,45.8,54.2,9.5,100.2,104.2,7,7,3,2,5,6,6,7,5,5,-1,2],[4,10,14,41.7,58.3,10.5,109.4,111.5,4,6,0,2,5,6,5,8,5,5,2,-1],[6,11,16,40.7,59.3,11,106.9,110.6,6,9,2,2,6,6,5,10,3,7,-1,1],[30,9,15,37.5,62.5,11.5,104.9,106.7,5,10,4,1,8,5,1,10,4,6,-1,2],[13,5,19,20.8,79.2,15.5,102.8,108.6,3,14,0,4,2,9,3,10,3,7,-1,2],[14,4,20,16.7,83.3,16.5,96.6,107,4,8,0,4,2,8,2,12,1,9,1,-1]];

		$west = [[21,19,4,82.6,17.4,0,114,102.7,10,2,3,2,8,3,11,1,9,1,8,-1],[27,21,6,77.8,22.2,0,117.2,106.1,9,4,2,1,8,3,13,3,8,2,6,-1],[18,18,8,69.2,30.8,2.5,101.4,97.5,8,4,4,1,13,2,5,6,8,2,3,-1],[19,15,11,57.7,42.3,5.5,107.5,106.8,12,5,4,1,8,4,7,7,5,5,1,-1],[23,14,11,56,44,6,107,106.9,6,8,1,3,10,2,4,9,5,5,1,-1],[25,13,11,54.2,45.8,6.5,102.8,100.2,8,5,2,1,7,7,6,4,5,5,-1,3],[20,13,13,50,50,7.5,103.2,99.3,8,7,4,3,11,5,2,8,7,3,-1,2],[11,13,13,50,50,7.5,109.4,110.5,9,10,2,1,6,7,7,6,5,5,-1,1],[28,11,13,45.8,54.2,8.5,101.8,98.9,6,9,2,5,9,3,2,10,4,6,-1,1],[1,9,15,37.5,62.5,10.5,105.8,109.1,4,10,2,5,6,7,3,8,3,7,1,-1],[29,8,15,34.8,65.2,11,105,107.7,7,9,4,1,4,7,4,8,3,7,-1,4],[26,9,18,33.3,66.7,12,107.3,115.4,4,9,2,3,4,10,5,8,3,7,-1,2],[22,8,17,32,68,12,98.1,101.6,8,9,4,6,5,9,3,8,1,9,-1,2],[24,8,17,32,68,12,96.4,105.6,6,7,2,2,4,6,4,11,4,6,1,-1],[17,7,19,26.9,73.1,13.5,100.4,103.7,5,12,2,5,5,10,2,9,5,5,-1,2]];


		echo '<pre>';

		foreach ($west as $key => $value) {
			foreach ($data as $k => $v) {
				if ($v[0] == $value[0]) {
					$insertData = [
						'tid'	=> $v[0],
						'name'	=> $v[1],
						'area_id'	=> 1,
						'area_name'	=> '西部',
						'updated'	=> TIMESTAMP
					];
					TeamModel::save($insertData);
					break;
				}
			}
		}
	}

/**
 * @todo 根据每场比赛回查出该队前10或5或20场比赛，算出他的赢盘率主队赢盘率，以及对手数据的赢盘率和客队赢盘率。
 这个是总分盘算法的基础。
 */
 	public function actionBoard(){
 		//查询前后1天的比赛
 		$beginTime = strtotime(date('Y-m-d', TIMESTAMP)) - 86400;
 		$endTime = strtotime(date('Y-m-d', TIMESTAMP)) + 86400*2;
 		$where = [
 			// 'match_state !='	=> MatchModel::STATE_OFF,
 			'match_time >='		=> $beginTime,
 			'match_time <='		=> $endTime,
 		];
 		$list = MatchListModel::find('', $where);
 		if (empty($list)) {
 			$this->_error('当前日期没有比赛:' . date('Y-m-d H:i', $beginTime) . '——' . date('Y-m-d H:i', $endTime));
 		}

 		$gameList = [];
 		foreach ($list as $key => $value) {
 			$gameList[date('Y-m-d', $value['match_time'])][] = $value;
 		}

 		foreach ($gameList as $key => $value) {
 			$string = $key . '<br>';
 			foreach ($value as $k => $v) {
 				$string .= $v['host_name'] . ' ';
 				$string .= $v['host_score'] . '-';
 				$string .= $v['guest_score'] . ' ';
 				$string .= $v['guest_name'] . ' ';
 				$string .= '<a href="algtotal?matchid='.$v['match_id'].'">总</a><br>';
 			}
 			echo $string;
 		}
 	}


 	/**
 	 * 大小球
 	 */
 	public function actionAlgTotal(){
 		$matchId = $this->param('matchid');
 		$match = MatchListModel::findOne('', ['match_id'=> $matchId]);
 		$matchTime = $match['match_time'];
 		$hostId = $match['host_id'];
 		$guestId= $match['guest_id'];

 		$totalNum = 20;

 		$whereHost = [
 			'match_time <'=> $matchTime,
 			'or'	=> [
 				'host_id'	=> $hostId,
 				'guest_id'	=> $hostId
 			]
 		];
 		$hostBeforeMatch = MatchListModel::find('', $whereHost, 'match_time desc', '', $totalNum);
 		$hostTotalWinCount = $hostHostWinCount = $hostGuestWinCount = 0;
 		foreach ($hostBeforeMatch as $key => $value) {
 			if ($value['total_win'] == MatchModel::WIN) {
 				$hostTotalWinCount += 1;
 				if ($value['host_id'] == $match['host_id']) {
 					$hostHostWinCount += 1;
 				}else{
 					$hostGuestWinCount += 1;
 				}
 			}
 			$a = '';
 			$a .= date('Y-m-d H:i', $value['match_time']);
 			$a .= $value['host_name'].'__'.$value['guest_name'];
 			$a .= $value['total_win'].'<br>';
 			echo $a;
 		}
 		$hostTotalWinRate = sprintf('%.1f', $hostTotalWinCount*100 / $totalNum);
 		$hostHostWinRate = sprintf('%.1f', $hostHostWinCount*100 / $totalNum);
 		$hostGuestWinRate = sprintf('%.1f', $hostGuestWinCount*100 / $totalNum);

 		// $whereGuest = [
 		// 	'match_time <'=> $matchTime,
 		// 	'or'	=> [
 		// 		'host_id'	=> $guestId,
 		// 		'guest_id'	=> $guestId
 		// 	]
 		// ];
 		// $guestBeforeMatch = MatchListModel::find('', $whereGuest, '', '', $totalNum);


 		// $hostWinCount = MatchListModel::count($whereHost);
 		// $guestWinCount = MatchListModel::count($whereGuest);

 		if ($hostBeforeMatch) {
 			$string = '';
 			$string .= $match['host_name'] . ' 最近'.$totalNum.'场大球率:<br>';
 			$string .= '总:' . $hostTotalWinRate . '% ';
 			$string .= '主:' . $hostHostWinRate . '% ';
 			$string .= '客:' . $hostGuestWinRate . '% <br>';
 		}
 		echo $string;
 		// echo '<pre>';var_dump($hostBeforeMatch, $guestBeforeMatch);exit;
 	}


 	/**
 	 * 抓取每场比赛的赔率
 	 */
 	public function actionOdds(){
 		// set_time_limit(300);
 		//test
//  		$matchList = MatchListModel::find('match_id');
//  		$avgList = MatchOddsAvgModel::find('match_id', [], '', 'match_id');
//  		$newAvgList = [];

//  		foreach ($avgList as $key => $value) {
//  			$newAvgList[] = $value['match_id'];
//  		}

//  		foreach ($matchList as $k => $v) {
//  			if (!in_array($v['match_id'], $newAvgList)) {
//  				$lostData[] = $v['match_id'];
//  			}
//  		}
// var_dump(count($matchList), count($avgList), count($newAvgList), count($lostData), $lostData);exit;
 		//test

 		$sql = OddsCompanyModel::db('nba');
		$company = $sql->select('*')->from('odds_company')->execute()->all('name');

		$beginTime = $endTime = '';
		$this->getSessionTime(2009, $beginTime, $endTime);
		$where = [
			'match_time between'=> [$beginTime, $endTime]
		];
		$matchList = MatchListModel::find('', $where);
// echo '<pre>';var_dump(date('Y-m-d H:i:s', $beginTime), date('Y-m-d H:i:s', $endTime), $matchList);exit;

		foreach ($matchList as $key => $value) {
			$this->odds($value['match_id'], $company, MatchOddsModel::TYPE_HANDICAP);
		}
		
 		echo 'ok';
 	}

 	private function hexTo32Float($strHex) {
	    $v = hexdec($strHex);
	    $x = ($v & ((1 << 23) - 1)) + (1 << 23) * ($v >> 31 | 1);
	    $exp = ($v >> 23 & 0xFF) - 127;
	    return $x * pow(2, $exp - 23);
	}

 	/**
 	 * 抓取比赛列表
 	 */
	public function actionMatch(){
		set_time_limit(300);
		// $url = 'http://nba.win007.com/jsData/matchResult/17-18/l1_1_2017_12.js?version=2019012309';
		$url = 'http://nba.win007.com/jsData/matchResult/04-05/l1_1_2004_11.js?version=2019012309';

		//获取04-17年 13年的数据。
		$beginYear = 18;
		$endYear = 19;
		for ($k=$beginYear; $k < $endYear; $k++) { 
			$a1 = $k;
			$a2 = $a1 + 1;

			for ($i=0; $i < 9; $i++) { 
				$c = 'l1_1_20';
				$a1 = (strlen($a1) == 1) ? '0'.$a1 : $a1;
				$a2 = (strlen($a2) == 1) ? '0'.$a2 : $a2;
				switch ($i) {
					case '0':
						$b = $c . $a1 . '_09';
						break;
					case '1':
						$b = $c . $a1 . '_10';
						break;
					case '2':
						$b = $c . $a1 . '_11';
						break;
					case '3':
						$b = $c . $a1 . '_12';
						break;
					case '4':
						$b = $c . $a2 . '_1';
						break;
					case '5':
						$b = $c . $a2 . '_2';
						break;
					case '6':
						$b = $c . $a2 . '_3';
						break;
					case '7':
						$b = $c . $a2 . '_4';
						break;
					case '8':
						$b = $c . $a2 . '_5';
						break;

					
					default:
						# code...
						break;
				}
				$a = $a1 . '-' . $a2;
				$url = 'http://nba.win007.com/jsData/matchResult/'.$a.'/'.$b.'.js?version=2019012309';
				var_dump($url);
				$re = $this->matchList($url);
				echo '<br>';
				// var_dump($re);
			}
			echo '<br><br>';
		}
		echo '<br>end';
		
		// $re = $this->match(290227);
	}


	/**
	 * array(14) {
  [0]=>
  string(6) "289788"//match_id
  [1]=>
  string(1) "1"
  [2]=>
  string(18) "'2017-10-18 08:00'"//match_time
  [3]=>
  string(2) "16"//host_id
  [4]=>
  string(1) "2"//guest_id
  [5]=>
  string(3) "102"//host_score
  [6]=>
  string(2) "99"//guest_score
  [7]=>
  string(2) "54"//half_host_score
  [8]=>
  string(2) "38"//half_guest_score
  [9]=>
  string(2) "-1"//
  [10]=>
  string(3) "4.5"//handicap 让分盘 +主让，-主受让
  [11]=>
  string(3) "216"//total 总分盘
  [12]=>
  string(1) "1"
  [13]=>
  string(1) "1"
}
	 */
	private function matchList($url){
		$html = Curl::send($url);
		// $html = $this->_data();

		$pattern = '/arrData = \[(.*)\]/';
		$re = preg_match($pattern, $html, $array);
		if (isset($array[1])) {
			$list = $array[1];
			$list = explode('],[', $list);

			if (!is_array($list)) {
				$this->_error('匹配比赛列表失败-数据结构错误');
			}else{
				//查询球队
				$team = TeamModel::find('tid,name');
				foreach ($team as $k => $v) {
					$teamList[$v['tid']] = $v['name'];
				}
				foreach ($list as $key => $value) {
					$item = explode(',', str_replace("'", '', str_replace(']', '', str_replace('[', '', $value))));
					

					$insertValue = [
						'host_id'		=> $item[3],
						'guest_id'		=> $item[4],
						'host_name'		=> isset($teamList[$item[3]]) ? $teamList[$item[3]] : '',
						'guest_name'	=> isset($teamList[$item[4]]) ? $teamList[$item[4]] : '',
						'match_id'		=> $item[0],
						'match_time'	=> strtotime($item[2]),
						'host_score'	=> empty($item[5]) ? 0 : $item[5],
						'guest_score'	=> empty($item[6]) ? 0 : $item[6],
						'half_host_score'=>empty($item[7]) ? 0 : $item[7],
						'half_guest_score'=>empty($item[8])? 0 : $item[8],
						'handicap'		=> empty($item[10])? 0 : $item[10],
						'total'			=> empty($item[11])? 0 : $item[11],
						'match_state'	=> $item[9],
						'created'		=> TIMESTAMP
					];

					
					if ($insertValue['host_score'] - $insertValue['guest_score'] > $insertValue['handicap']) {
						$handicapWin = MatchModel::WIN;//让分主队赢盘
					}elseif ($insertValue['host_score'] - $insertValue['guest_score'] == $insertValue['handicap']) {
						$handicapWin = MatchModel::DROP;
					}else{
						$handicapWin = MatchModel::LOST;
					}

					if ($insertValue['host_score'] + $insertValue['guest_score'] > $insertValue['total']) {
						$totalWin = MatchModel::WIN;//大球
					}elseif ($insertValue['host_score'] + $insertValue['guest_score'] == $insertValue['total']) {
						$totalWin = MatchModel::DROP;
					}else{
						$totalWin = MatchModel::LOST;
					}

					$insertValue['handicap_win'] = $handicapWin;
					$insertValue['total_win'] 	 = $totalWin;

					$where = ['match_id'=> $insertValue['match_id']];
					$oldMatchData = MatchListModel::find('id',$where);
					// if ($insertValue['host_id'] == 14 && $insertValue['guest_id'] == 2) {
					// 	echo '<pre>';var_dump($insertValue, $value, $list[$key-1]);exit;
					// }
					if ($oldMatchData) {
						//update
						$re = MatchListModel::update($insertValue, $where);
					}else{
						$re = MatchListModel::save($insertValue);
					}

					if (!$re) {
						$this->_error('更新比赛列表失败');
					}
				}
			}
		}else{
			// $this->_error('匹配比赛列表失败');
		}

		return TRUE;
	}

	private function match($matchId){
		$url = 'http://nba.win007.com/cn/Tech/TechTxtLive.aspx?matchid=' . $matchId;
		$html = Curl::send($url);

		//匹配比分
		$pattern = '/\ bgcolor="#0E4276">(\d+)<\/td>/';
		$re = preg_match_all($pattern, $html, $array);

		//匹配队伍名称
		$reTeam = preg_match_all('/"o_team">([\W\d]+)<\/a>/', $html, $arrayTeam);

		//匹配比赛时间 /2017([0-9a-zA-Z_.-]+)11/
		$reTime = preg_match_all('/开赛时间:([0-9a-zA-Z_.: -]+) /', $html, $arrayTime);

		//匹配比赛id
		// $reId = preg_match_all('/var sid=(\d+);/', $html, $arrayId);

		if (isset($array[1])) {
			$insertValue = [
				'host_score'	=> 0,
				'guest_score'	=> 0,
				'ot'			=> MatchModel::OT_NO,
			];
			$score = $array[1];

			$totalQuarter = count($score);
			$num = $totalQuarter/2;
			$hostArr = array_slice($score, 0, $num);
			$guestArr = array_slice($score, $num, $totalQuarter);

			foreach ($hostArr as $k1 => $v1) {
				if ($k1 > 3) {
					//加时
					$insertValue['host_o' . intval($k1-3)] = $v1;
					$insertValue['ot'] = MatchModel::OT_YES;
				}else{
					$insertValue['host_q' . intval($k1+1)] = $v1;
				}
				$insertValue['host_score'] += $v1;
			}

			foreach ($guestArr as $k2 => $v2) {
				if ($k2 > 3) {
					//加时
					$insertValue['guest_o' . intval($k2-3)] = $v2;
				}else{
					$insertValue['guest_q' . intval($k2+1)] = $v2;
				}
				$insertValue['guest_score'] += $v2;
			}

			//队名
			$hostName = isset($arrayTeam[1][0]) ? $arrayTeam[1][0] : '';
			$guestName = isset($arrayTeam[1][1]) ? $arrayTeam[1][1] : '';

			if (empty($hostName) || empty($guestName)) {
				$this->_error('匹配队名失败');
			}

			$hostInfo = TeamModel::findOne('', ['name'=> $hostName]);
			if (empty($hostInfo)) {
				$this->_error('匹配主队信息失败');
			}

			$guestInfo = TeamModel::findOne('', ['name'=> $guestName]);
			if (empty($guestInfo)) {
				$this->_error('匹配客队信息失败');
			}

			//开赛时间
			$matchTime = isset($arrayTime[1][0]) ? strtotime($arrayTime[1][0]) : 0;
			if (empty($matchTime)) {
				$this->_error('匹配开赛时间失败');
			}

			//比赛id
			// $matchId = isset($arrayId[1][0]) ? $arrayId[1][0] : 0;
			// if (empty($matchId)) {
			// 	$this->_error('匹配比赛ID失败');
			// }

			$insertValue['host_id'] = $hostInfo['tid'];
			$insertValue['host_name'] = $hostInfo['name'];
			$insertValue['guest_id'] = $guestInfo['tid'];
			$insertValue['guest_name'] = $guestInfo['name'];
			$insertValue['created'] = TIMESTAMP;
			$insertValue['match_time'] = $matchTime;
			$insertValue['match_id'] = $matchId;

			$reInsert = MatchModel::save($insertValue);
			if (!$reInsert) {
				$this->_error('保存数据失败');
			}
		}else{
			$this->_error('匹配比分失败');
		}

		return TRUE;
	}


	/**
	 * 更新该场比赛平均赔率和赔率详情
	 */
	private function odds($matchId, $company, $oddsType){
		// $matchId = '294909';
		if ($oddsType == MatchOddsModel::TYPE_HANDICAP) {
	 		//亚盘赔率
	 		$url = 'http://121.10.245.46:8072/phone/LqHandicap2.aspx?ID='.$matchId.'&an=iosQiuTan&av=6.5&from=2&lang=0&r=1513329116';
	 		//亚盘详情
	 		$detailUrl = 'http://121.10.245.46:8072/phone/LqHandicap2Detail.aspx?an=iosQiuTan&av=6.5&from=2&lang=0&r=1513329123';
		}elseif ($oddsType == MatchOddsModel::TYPE_TOTAL) {
			//大小赔率
			$url = 'http://121.10.245.46:8072/phone/LqOverUnder.aspx?ID='.$matchId.'&an=iosQiuTan&av=6.5&from=2&lang=0&r=1513329126';
			//大小详情
			$detailUrl = 'http://121.10.245.46:8072/phone/LqOverUnderDetail.aspx?an=iosQiuTan&av=6.5&from=2&lang=0&r=1513329127';
		}else{
			$this->_error('error odds type');
		}

 		$data = Curl::send($url);

 		if ($data) {
 			$array = explode('!', $data);
 			foreach ($array as $key => $value) {
 				$item = explode('^', $value);
 				$insertValue = [
 					'c_name'	=> $item[0],
 					'c_id'		=> isset($company[$item[0]]['id']) ? $company[$item[0]]['id'] : 0,
 					'match_id'	=> $matchId,
 					'odds_id'	=> $item[1],
 					'type'		=> $oddsType,
 					'first_left_odds'	=> $item[2],
 					'first_value'		=> $item[3],
 					'first_right_odds'	=> $item[4],
 					'end_left_odds'		=> $item[5],
 					'end_value'			=> $item[6],
 					'end_right_odds'	=> $item[7],
 				];
 				$where = ['odds_id'=> $insertValue['odds_id']];

 				$exit = MatchOddsAvgModel::find('', $where);
 				if ($exit) {
 					MatchOddsAvgModel::update($where, $insertValue);
 				}else{
 					MatchOddsAvgModel::save($insertValue);	
 				}
 				
 				//更新详情
 				$detailSendUrl = $detailUrl . '&OddsID=' . $insertValue['odds_id'];
 				$detailData = Curl::send($detailSendUrl);
 				if ($detailData) {
 					$detailArr = explode('!', $detailData);
 					foreach ($detailArr as $k => $v) {
 						$itemV = explode('^', $v);

 						$insertV = [
 							'c_id'		=> $insertValue['c_id'],
 							'c_name'	=> $insertValue['c_name'],
 							'match_id'	=> $matchId,
 							'odds_id'	=> $insertValue['odds_id'],
 							'left_odds'	=> $itemV[0],
 							'value'		=> $itemV[1],
 							'right_odds'=> $itemV[2],
 							'odds_time'	=> strtotime($itemV[3]),
 						];

 						MatchOddsModel::save($insertV);
 					}
 				}else{
 					echo '<pre>';var_dump($insertValue, $detailSendUrl, $detailData);echo ' detail empty<br>';
 				}
 			}

 		}else{
 			echo '<pre>';var_dump($matchId, $data);echo ' empty<br>';
 		}
 		// echo 'ok';
	}

	private function _error($msg){
		echo $msg;exit;
	}


	private function _data(){
		$data = <<<EOF
string(10162) "﻿var arrLeague = [1,'美国男子职业篮球联赛','美國男子職業籃球聯賽','National Basketball Association','2017-2018','#FF0000','/files/Sclass/1.jpg','NBA','NBA','NBA',1,'31'];
var arrTeam = [[1,'洛杉矶湖人','洛杉磯湖人','Los Angeles Lakers','湖人','湖人','Lakers'],[2,'波士顿凯尔特人','波士頓塞爾特人','Boston Celtics','凯尔特人','塞爾特人','Celtics'],[3,'迈阿密热火','邁亞密熱火','Miami Heat','热火','熱火','Heat'],[4,'布鲁克林篮网','布魯克林籃網','Brooklyn Nets','篮网','籃網','Nets'],[5,'纽约尼克斯','紐約人','New York Knicks','尼克斯','紐約人','Knicks'],[6,'奥兰多魔术','奧蘭多魔術','Orlando Magic','魔术','魔術','Magic'],[7,'费城76人','費城七十六人','Philadelphia 76ers','76人','76人','76ers'],[8,'华盛顿奇才','華盛頓巫師','Washington Wizards','奇才','巫師','Wizards'],[9,'底特律活塞','底特律活塞','Detroit Pistons','活塞','活塞','Pistons'],[10,'印第安纳步行者','印第安納溜馬','Indiana Pacers','步行者','溜馬','Pacers'],[11,'新奥尔良鹈鹕','新奧爾良鵜鶘','New Orleans Pelicans','鹈鹕','鵜鶘','Pelicans'],[12,'密尔沃基雄鹿','密爾沃基公鹿','Milwaukee Bucks','雄鹿','公鹿','Milwaukee'],[13,'亚特兰大老鹰','阿特蘭大鷹','Atlanta Hawks','老鹰','老鷹','Hawks'],[14,'芝加哥公牛','芝加哥公牛','Chicago Bulls','公牛','公牛','Bulls'],[15,'多伦多猛龙','多倫多速龍','Toronto Raptors','猛龙','速龍','Raptors'],[16,'克里夫兰骑士','克里夫蘭騎士','Cleveland Cavaliers','骑士','騎士','Cavaliers'],[17,'达拉斯小牛','達拉斯小牛','Dallas Mavericks','小牛','小牛','mavericks'],[18,'圣安东尼奥马刺','聖安東尼奧馬刺','San Antonio Spurs','马刺','馬刺','Spurs'],[19,'明尼苏达森林狼','明尼蘇達木狼','Minnesota Timberwolves','森林狼','木狼','Timberwolves'],[20,'犹他爵士','猶他爵士','Utah Jazz','爵士','爵士','Jazz'],[21,'休斯顿火箭','侯斯頓火箭','Houston Rockets','火箭','火箭','Rockets'],[22,'孟菲斯灰熊','孟菲斯灰熊','Memphis Grizzlies','灰熊','灰熊','Grizzlies'],[23,'丹佛掘金','丹佛金塊','Denver Nuggets','掘金','金塊','nuggets'],[24,'萨克拉门托国王','薩克拉門托帝王','Sacramento Kings','国王','帝王','sac'],[25,'波特兰开拓者','波特蘭拓荒者','Portland Trail Blazers','开拓者','拓荒者','Trail Blaze'],[26,'菲尼克斯太阳','鳳凰城太陽','Phoenix Suns','太阳','太陽','Suns'],[27,'金州勇士','金州勇士','Golden State Warriors','勇士','勇士','Warriors'],[28,'俄克拉荷马城雷霆','奧克拉荷馬雷霆','Oklahoma City Thunder','雷霆','雷霆','Thunder'],[29,'洛杉矶快船','洛杉磯快艇','Los Angeles Clippers','快船','快艇','Clippers'],[30,'夏洛特黄蜂','夏洛特黃蜂','Charlotte Hornets','黄蜂','黃蜂','Hornets'],[151,'上海哔哩哔哩','上海大鯊魚','Shanghai bilibili','上海哔哩哔哩','上海大鯊魚','ShangHai'],[157,'广州证券','廣州龍獅','Guangzhou Longlions','广州','廣州','Guangzhou'],[852,'墨尔本猛虎','墨爾本聯','Melbourne Tigers','墨尔本猛虎','墨爾本聯','Melbourne Tigers'],[853,'布里斯班子弹','布里斯本子彈','Brisbane Bullets','布里斯班','布里斯本子彈','Brisbane Bullets'],[1813,'悉尼国王','悉尼皇帝','Sydney Kings','悉尼国王','悉尼皇帝','Kings'],[2144,'海法马卡比','海法馬卡比','Maccabi Heat Haifa','海法马卡比','海法馬卡','Heat Haifa']];
var ymList = [[2017,10],[2017,11],[2017,12],[2018,1],[2018,2],[2018,3],[2018,4]];
var lastUpdateTime = '2017-12-11 14:01:58';
var arrData = [[289788,1,'2017-10-18 08:00',16,2,102,99,54,38,-1,4.5,216,1,1],[289789,1,'2017-10-18 10:30',27,21,121,122,71,62,-1,9.5,231,1,1],[289790,1,'2017-10-19 07:00',8,7,120,115,56,59,-1,6.5,217.5,1,1],[289856,1,'2017-10-19 07:00',9,30,102,90,56,45,-1,2.5,202,1,1],[289857,1,'2017-10-19 07:00',10,4,140,131,65,63,-1,3,216.5,1,1],[289858,1,'2017-10-19 07:00',6,3,116,109,58,55,-1,-3.5,205.5,1,1],[289859,1,'2017-10-19 07:30',2,12,100,108,53,58,-1,1.5,203,1,1],[289860,1,'2017-10-19 08:00',22,11,103,91,54,52,-1,2,204.5,1,1],[289861,1,'2017-10-19 08:30',17,13,111,117,47,58,-1,5.5,199,1,1],[289862,1,'2017-10-19 09:00',20,23,106,96,49,58,-1,2.5,205,1,1],[289791,1,'2017-10-19 09:30',18,19,107,99,53,49,-1,1,203.5,1,1],[289863,1,'2017-10-19 10:00',24,21,100,105,48,52,-1,-7.5,216.5,1,1],[289864,1,'2017-10-19 10:00',26,25,76,124,35,60,-1,-2.5,219,1,1],[289865,1,'2017-10-20 07:30',15,14,117,100,58,37,-1,13.5,206.5,1,1],[289792,1,'2017-10-20 08:00',28,5,105,84,53,42,-1,12,215.5,1,1],[289793,1,'2017-10-20 10:30',1,29,92,108,42,53,-1,-6.5,219,1,1],[289794,1,'2017-10-21 07:00',12,16,97,116,49,55,-1,1,209.5,1,1],[289866,1,'2017-10-21 07:00',30,13,109,91,49,56,-1,4.5,205.5,1,1],[289867,1,'2017-10-21 07:00',8,9,115,111,58,65,-1,6.5,211.5,1,1],[289868,1,'2017-10-21 07:00',7,2,92,102,50,46,-1,3,216.5,1,1],[289869,1,'2017-10-21 07:00',10,25,96,114,52,62,-1,-5.5,218.5,1,1],[289870,1,'2017-10-21 07:30',4,6,126,121,58,55,-1,2,226.5,1,1],[289871,1,'2017-10-21 08:00',19,20,100,97,46,42,-1,4.5,197,1,1],[289872,1,'2017-10-21 08:30',17,24,88,93,46,46,-1,6,202,1,1],[289795,1,'2017-10-21 09:30',11,27,120,128,64,61,-1,-9,221,1,1],[289873,1,'2017-10-21 10:00',26,1,130,132,73,70,-1,3.5,221,1,1],[289874,1,'2017-10-22 07:30',15,7,128,94,62,49,-1,9,219,1,1],[289875,1,'2017-10-22 08:00',3,10,112,108,63,50,-1,9.5,214,1,1],[289876,1,'2017-10-22 08:00',14,18,77,87,38,41,-1,-10.5,200.5,1,1],[289877,1,'2017-10-22 08:00',16,6,93,114,45,56,-1,11.5,216,1,1],[289878,1,'2017-10-22 08:00',5,9,107,111,64,51,-1,-1,204.5,1,1],[289879,1,'2017-10-22 08:00',21,17,107,91,62,39,-1,11.5,216,1,1],[289880,1,'2017-10-22 08:00',22,27,111,101,56,51,-1,-8.5,213,1,1],[289881,1,'2017-10-22 08:30',12,25,113,110,60,55,-1,3,208.5,1,1],[289882,1,'2017-10-22 09:00',23,24,96,79,42,34,-1,12.5,212.5,1,1],[289883,1,'2017-10-22 09:00',20,28,96,87,44,34,-1,-4,200,1,1],[289884,1,'2017-10-22 10:30',29,26,130,88,58,44,-1,13.5,219.5,1,1],[289885,1,'2017-10-23 03:30',4,13,116,104,56,53,-1,1,220,1,1],[289886,1,'2017-10-23 07:00',28,19,113,115,54,61,-1,4,211.5,1,1],[289887,1,'2017-10-23 09:30',1,11,112,119,55,68,-1,-5,222,1,1],[289888,1,'2017-10-24 07:00',9,7,86,97,43,56,-1,3.5,213.5,1,1],[289889,1,'2017-10-24 07:30',3,13,104,93,62,44,-1,10.5,205,1,1],[289890,1,'2017-10-24 08:00',12,30,103,94,53,54,-1,6.5,203.5,1,1],[289891,1,'2017-10-24 08:00',21,22,90,98,57,50,-1,8,213.5,1,1],[289892,1,'2017-10-24 08:30',17,27,103,133,62,65,-1,-13.5,217,1,1],[289893,1,'2017-10-24 08:30',18,15,101,97,50,50,-1,2.5,201.5,1,1],[289894,1,'2017-10-24 09:00',23,8,104,109,55,56,-1,5,224.5,1,1],[289895,1,'2017-10-24 10:00',26,24,117,115,59,51,-1,-2.5,206.5,1,1],[289896,1,'2017-10-25 07:00',6,4,125,121,61,61,-1,4.5,228.5,1,1],[289897,1,'2017-10-25 07:00',16,14,119,112,65,68,-1,15.5,205.5,1,1],[289898,1,'2017-10-25 07:30',2,5,110,89,54,33,-1,7,208,1,1],[289899,1,'2017-10-25 08:00',19,10,107,130,61,61,-1,10.5,218,1,1],[289900,1,'2017-10-25 10:00',25,11,103,93,47,48,-1,5,216.5,1,1],[289901,1,'2017-10-25 10:30',29,20,102,84,42,41,-1,5,196,1,1],[289902,1,'2017-10-26 07:00',7,21,104,105,54,56,-1,-3,221,1,1],[289903,1,'2017-10-26 07:00',30,23,110,93,62,39,-1,-2.5,211.5,1,1],[289904,1,'2017-10-26 07:00',9,19,122,101,63,44,-1,2.5,209,1,1],[289905,1,'2017-10-26 07:30',4,16,112,107,55,52,-1,-8,224,1,1],[289906,1,'2017-10-26 08:00',3,18,100,117,51,56,-1,-3,196.5,1,1],[289907,1,'2017-10-26 08:00',28,10,114,96,54,48,-1,13.5,218,1,1],[289908,1,'2017-10-26 08:30',17,22,103,94,57,49,-1,-3,197,1,1],[289909,1,'2017-10-26 10:00',26,20,97,88,48,41,-1,-7.5,205,1,1],[289910,1,'2017-10-26 10:30',27,15,117,112,61,53,-1,12.5,230,1,1],[289911,1,'2017-10-26 10:30',1,8,102,99,45,49,-1,-5.5,228.5,1,1],[289912,1,'2017-10-27 08:00',14,13,91,86,37,39,-1,2,200.5,1,1],[289913,1,'2017-10-27 08:00',12,2,89,96,44,43,-1,4.5,206.5,1,1],[289914,1,'2017-10-27 08:00',22,17,96,91,54,35,-1,8,195.5,1,1],[289915,1,'2017-10-27 10:00',25,29,103,104,53,62,-1,2,216.5,1,1],[289916,1,'2017-10-27 10:30',24,11,106,114,70,56,-1,1,204.5,1,1],[289917,1,'2017-10-28 07:00',6,18,114,87,61,34,-1,-5.5,207,1,1],[289918,1,'2017-10-28 07:00',30,21,93,109,46,56,-1,-2.5,214.5,1,1],[289919,1,'2017-10-28 07:30',5,4,107,86,47,42,-1,2,222.5,1,1],[289920,1,'2017-10-28 07:30',13,23,100,105,52,53,-1,-7.5,210,1,1],[289921,1,'2017-10-28 08:00',19,28,119,116,59,59,-1,-2,218,1,1],[289922,1,'2017-10-28 10:30',1,15,92,101,51,45,-1,-6,221,1,1],[289923,1,'2017-10-28 10:30',27,8,120,117,53,67,-1,12,230.5,1,1],[289924,1,'2017-10-29 07:00',11,16,123,101,65,52,-1,-2.5,220,1,1],[289925,1,'2017-10-29 08:00',22,21,103,89,54,49,-1,2,202,1,1],[289926,1,'2017-10-29 08:00',14,28,69,101,31,50,-1,-8.5,203.5,1,1],[289927,1,'2017-10-29 08:00',3,2,90,96,45,47,-1,-1,204.5,1,1],[289928,1,'2017-10-29 08:30',17,7,110,112,56,57,-1,-1,205,1,1],[289929,1,'2017-10-29 09:00',20,1,96,81,56,45,-1,11,202,1,1],[289930,1,'2017-10-29 10:00',25,26,114,107,61,57,-1,12,218,1,1],[289931,1,'2017-10-29 10:30',29,9,87,95,55,45,-1,8,206,1,1],[289932,1,'2017-10-30 03:30',13,12,106,117,48,61,-1,-6,199.5,1,1],[289933,1,'2017-10-30 04:30',10,18,97,94,53,48,-1,-6.5,208.5,1,1],[289934,1,'2017-10-30 06:00',30,6,120,113,61,49,-1,4,210.5,1,1],[289935,1,'2017-10-30 06:00',4,23,111,124,63,60,-1,-5.5,222.5,1,1],[289936,1,'2017-10-30 06:00',24,8,83,110,32,63,-1,-7.5,208.5,1,1],[289937,1,'2017-10-30 07:00',16,5,95,114,54,62,-1,10.5,212.5,1,1],[289938,1,'2017-10-30 08:30',27,9,107,115,57,52,-1,14.5,221,1,1],[289939,1,'2017-10-31 07:30',5,23,116,110,65,43,-1,-4.5,211.5,1,1],[289940,1,'2017-10-31 07:30',2,18,108,94,54,49,-1,3.5,193.5,1,1],[289941,1,'2017-10-31 07:30',3,19,122,125,62,60,-1,-3,216.5,1,1],[289942,1,'2017-10-31 08:00',22,30,99,104,57,51,-1,5.5,194.5,1,1],[289943,1,'2017-10-31 08:00',21,7,107,115,56,58,-1,7,215,1,1],[289944,1,'2017-10-31 08:00',11,6,99,115,64,60,-1,7.5,223,1,1],[289945,1,'2017-10-31 09:00',20,17,104,89,44,53,-1,8.5,190.5,1,1],[289946,1,'2017-10-31 10:00',25,15,85,99,35,54,-1,4,211,1,1],[289947,1,'2017-10-31 10:30',29,27,113,141,57,74,-1,-6,223,1,1]];
EOF;
	return $data;
	}
	
}
