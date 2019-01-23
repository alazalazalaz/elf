<?php

/**
* 
*/
namespace app\controller\box\xxx;
use app\controller\AppController;

use Elf\Lib\Log;
use Elf\Lib\Func;
use Elf\Lib\Cookie;
use Elf\Lib\Session;
use Elf\Lib\Hash;
use Elf\Lib\Request;
use Elf\Lib\Response;
use Elf\Lib\Config;
use Elf\Model;
use Elf\Db\Database;
use Elf\System\System;
use Exception;
use Elf\Exception\CommonException;

use app\model\AppModel;
use app\model\box\AaModel;

use app\lib\zip;
use Elf\Lib\File;

class AaController extends AppController
{

	public function actionTest(){

		new zip();

		$file = APP_PATH . 'data/lala/bababa/test.html';
		$content = 'ddddddddd';

		$folder = APP_PATH . 'data';
		// $folder = 'E:\www\wamp\www\elf-git\elf';
		// File::writeFile($file, $content);

		// $con = File::readFile($file);

		// $con = File::deleteFile($file);

		// $con = file::scanDir($folder);
		// 
		echo Func::time() . "<br>";

		$con = File::all_files($folder);
		echo Func::time() . "<br>";
@todo 写个Tree.php把file转换为tree的结构
echo '<pre>';
print_r($con);
echo '</pre>';


		exit;		
		$this->set('name', 'xxx');
		$this->view('index');

	}
	

	private function test2(){
		$diff = 0;
		return $diff === 0;
	}

	public function before(){

	}

	public function after(){
		
	}
}
