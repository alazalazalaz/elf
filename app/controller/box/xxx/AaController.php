<?php

/**
* 
*/
namespace app\controller\box\xxx;
use app\controller\AppController;

class AaController extends AppController
{
	
	public function test(){

		$size = memory_get_usage();
   
		$unit=array('b','kb','mb','gb','tb','pb'); 

		echo @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];

		echo $size;


	}
	
	public function before(){

	}

	public function after(){
		
	}
}
