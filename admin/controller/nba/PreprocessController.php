<?php

/**
* 预处理文件，把原始数据处理成待分析的数据
*/
namespace app\controller\nba;
use Elf\Controller;
use Elf\Lib\Curl;
use app\controller\nba\BaseController;
use app\controller\AppController;

use app\model\nba\TeamModel;
use app\model\nba\MatchModel;
use app\model\nba\MatchListModel;

use Elf\Db\Database;


class PreprocessController extends BaseController
{

	public function beforeaction(){
		
	}


	/**
	 * 1、执行power方法，计算每个队的power
	 * 2、执行actpower方法，利用算好的power来预测每场比赛
	 * 3、执行checkpower方法计算胜率，也可以在mysql直接查询
	 * 4、@todo 拉取每场比赛的初始赔率和临场赔率存入match_list表，
	 *    或者只拉取最新赔率，或者都可以拉取单独存一张表，然后match_list更新最新的赔率
	 * 5、@todo 结合赔率执行步骤3优化算法
	 */
	public function actionIndex(){
		echo 'hello';

	}


	/**
	 * 计算 算法推荐选中的比赛
	 */
	public function actionActpower(){
		$sql = Database::db('nba');
		$data = $sql->select('*')->from('pre_power')->where(['handicap !='=> 0])->execute()->all();
		$hostWin = $guessWin = [];
		$a = isset($_GET['a']) ? $_GET['a'] : 0;

		foreach ($data as $key => $value) {

			$p1 = $value['host_total_power'] - $value['guest_total_power'] - $a;
			$p2 = $value['host_power'] - $value['guest_power'] - $a;
			$handicap = $value['handicap'];
			$handicapWin = $value['handicap_win'];

			if ($p1 > $handicap && $p2>$handicap) {
				$guessWin[] = $value;
				if ($handicapWin == 1) {
					$hostWin[] = $value;
				}
			}
		}

		$string = '';
		$string .= '预测主队赢盘次数：' . count($guessWin) . '<br>';
		$string .= '预测主队赢盘率：' . sprintf('%.2f', count($guessWin)/count($data)) . '%<br>';
		$string .= '预测主队赢盘次数：' . count($hostWin) . '<br>';
		$string .= '预测中实际主队赢盘次数：' . sprintf('%.2f', count($hostWin)/count($guessWin)) . '<br>';

		echo $string;
	}

	/**
	 * 计算power，存入pre_power表
	 */
	public function actionPower(){
		$year = 2004;
		$sessionBegin = $sessionEnd = '';
		$data = $this->getSessionData($year);
		$this->getSessionTime($year, $sessionBegin, $sessionEnd);

		$sql = Database::db('nba');

		foreach ($data as $key => $value) {
			$matchId = $value['match_id'];
			$matchTime = $value['match_time'];
			$hostId = $value['host_id'];
			$guestId = $value['guest_id'];
			$diff = $value['host_score'] - $value['guest_score'];
			$hostName = $value['host_name'];
			$guestName= $value['guest_name'];
			$handicap= $value['handicap'];
			$handicapWin= $value['handicap_win'];
			$hostPower = $guestPower = $hostScore = $guestScore = $hostLoseScore = $guestLoseScore = 0;

			//过去本赛季所有比赛主客队的power
			$db = MatchListModel::db();
			$guestDb = MatchListModel::db();

			$hostMatchs = $db->select('*')
						->from('match_list')
						->where(['host_id'=> $hostId, 'match_time between'=> [$sessionBegin, $matchTime]])
						// ->debug()->execute();
						->execute()->all('match_id');

			$guestMatchs = $guestDb->select('*')
						->from('match_list')
						->where(['guest_id'=> $guestId, 'match_time between'=> [$sessionBegin, $matchTime]])
						// ->debug()->execute();
						->execute()->all('match_id');
			//去掉当前比赛
			unset($hostMatchs[$matchId]);
			unset($guestMatchs[$matchId]);
			if (count($hostMatchs) < 5 && count($guestMatchs < 5)) {
				//场数太少不做统计power
				// echo count($hostMatchs) . '<br>';
				continue;
			}

			foreach ($hostMatchs as $key => $value) {
				$hostScore += $value['host_score'];
				$hostLoseScore += $value['guest_score'];
			}

			$hostPower = sprintf('%.1f', ($hostScore-$hostLoseScore)/count($hostMatchs));
			
			foreach ($guestMatchs as $key => $value) {
				$guestScore += $value['guest_score'];
				$guestLoseScore += $value['host_score'];
			}

			$guestPower = sprintf('%.1f', ($guestScore-$guestLoseScore)/count($guestMatchs));

			//过去所有比赛不分主客队的power
			$hostTotalPower = $this->_hostTotalPower($hostId, $sessionBegin, $matchTime);
			$guestTotalPower = $this->_hostTotalPower($guestId, $sessionBegin, $matchTime);

			$insertValue = [
				'match_id'	=> $matchId,
				'host_id'	=> $hostId,
				'guest_id'	=> $guestId,
				'host_name'	=> $hostName,
				'guest_name'=> $guestName,
				'host_power'=> $hostPower,
				'guest_power'=> $guestPower,
				'host_total_power'	=> $hostTotalPower,
				'guest_total_power'	=> $guestTotalPower,
				'diff'		=> $diff,
				'handicap'	=> $handicap,
				'handicap_win'	=> $handicapWin,
				// 'true_result'=> ($value['host_score']-$value['guest_score']) > 0 ? 1 : 0
			];
			$result = Database::db('nba')
					->insert('pre_power')
					->values($insertValue)
					->execute();
			var_dump($result);
			// echo '<pre>';var_dump($matchId, $hostPower, $hostScore, $hostLoseScore, $insertValue);exit;
		}

		echo 'ok';
	}


	/**
	 * 计算power表中的胜率
	 */
	public function actionCheckPower(){
		$sql = Database::db('nba');
		$data = $sql->select('*')->from('pre_power')->execute()->all();
		$same = $total = 0;

		foreach ($data as $key => $value) {
			if ($value['true_result'] == $value['elf_result'] && $value['true_result'] == 1) {
				$same += 1;
			}
			if ($value['true_result'] == 1) {
				$total += 1;
			}
			
		}
		$re = sprintf('%.1f', $same*100/$total) . '%';
		var_dump($same, $total, $re);
	}


	private function _hostTotalPower($teamId, $sessionBegin, $matchTime){
		$hostTotalPower = $guestTotalPower = 0;
		$hostTotalCount = $guestTotalCount = 0;
		$AScore = $BScore = 0;

		$hostTotalDb = MatchListModel::db();
		$hostTotalWhere = [
			'match_time between'=> [$sessionBegin, $matchTime],
			'or'	=> [
				'host_id'	=> $teamId,
				'guest_id'	=> $teamId
			]
		];
		$hostTotalMatch = $hostTotalDb->select('*')
							->from('match_list')
							->where($hostTotalWhere)
							->execute()
							->all();
		foreach ($hostTotalMatch as $k1 => $v1) {
			if ($v1['host_id'] == $teamId) {
				$AScore += $v1['host_score'];
				$BScore += $v1['guest_score'];
			}else{
				$AScore += $v1['guest_score'];
				$BScore += $v1['host_score'];
			}
		}
		$hostTotalPower = sprintf('%.1f', ($AScore-$BScore)/count($hostTotalMatch));

		return $hostTotalPower;
	}
	
}
