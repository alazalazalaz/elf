<?php

/**
* 
*/
namespace app\controller;
use Elf\Controller;
use app\controller\AppController;

class LotteryController extends AppController
{

	public function beforeaction(){
		
	}


	public function actionindex(){
		
		$this->view('index');
	}


	public function actionrecommend(){


		$this->view('recommend');
	}
	
}
