<?php
/**
 * 项目启动类
 */
namespace ElfFramework\StartUp;

use ElfFramework\Exception\CommonException;
use ElfFramework\Exception\CommonError;
use ElfFramework\Autoload\CoreAutoload;
use ElfFramework\Routing\CoreRouting;
use ElfFramework\Routing\CoreRequest;
use ElfFramework\Domain\CoreDomain;
use ElfFramework\Lib\Config;
use ElfFramework\Lib\Func;
use ElfFramework\System\System;
use ElfFramework\Lib\Response;

class CoreStartUp
{
	
	public static function exec(){

		/**
		 * 加载异常类
		 */
		self::initException();

		/**
		 * 分析域名来决定解析到app项目还是module里的其他项目
		 */
		self::initDomain();

		/**
		 * 初始化request
		 */
		self::initRequest();

		/**
		 * 加载autoload类
		 */
		$loadObj 	= new CoreAutoload();
		$loadObj->init();

		/**
		 * 初始化cookie
		 */
		// self::initCookie();

		/**
		 * 初始化session
		 */
		self::initSession();
		

		/**
		 * 初始化系统属性
		 */
		self::initSystem();


		/**
		 * 开启php output buffering，
		 * ob_start(); 直到脚本结束或者手动ob_flush()，php才把数据提交到SAPI
		 * ob_start(NULL, 4096); echo的数据大于4k(刚好一个内存分页大小) php自动把数据提交到SAPI，性能应该更好？但是自动提交后如果代码有header之类的函数就要报错。
		 * 所以这里选择不加自动提交。(运行这个框架的php.ini的配置output buffering 4096相当于是废的，和output buffering OFF都一样是无效的。)
		 */
		ob_start();


		/**
		 * 初始化控制器以及方法
		 */
		self::doRouting();


		/**
		 * 发送头部信息
		 */
		Response::sendHttpHeader();
		
		self::test();

		

		// new \elf\lib\AAA\test;
	}

	private static function doRouting(){
		CoreRouting::doRouting();
	}


	private static function initRequest(){
		CoreRequest::initRequest();
	}


	private static function initException(){
		$obj = new CommonException();
		$obj->init();
	}


	/**
	 * 分析域名，定义APP_PATH变量，以及判断访问的项目目录是在BASE_APP_PATH还是在modules里面
	 */
	private static function initDomain(){
		CoreDomain::initDomain();
	}


	private static function test(){

	}


	private static function initSession(){
		$bootstrap 	= Config::load('bootstrap');

		$domain 	= $bootstrap['cookieDomain'];
		session_set_cookie_params(0, '/', $domain, FALSE, TRUE);

		$sessionName= $bootstrap['sessionName'];
		session_name($sessionName);
	}


	private static function initSystem(){
		System::init();
	}
}



