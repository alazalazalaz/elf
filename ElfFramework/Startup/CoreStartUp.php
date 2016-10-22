<?php
/**
 * 项目启动类
 */
namespace ElfFramework\StartUp;

use ElfFramework\Exception\CommonException;
use ElfFramework\Autoload\CoreAutoload;
use ElfFramework\Routing\CoreRouting;
use ElfFramework\Routing\CoreRequest;
use ElfFramework\Domain\CoreDomain;
use ElfFramework\Config\ConfigHandle\Config;
use ElfFramework\Lib\Common\Func;

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
		

//判断系统属性等


		/**
		 * 初始化控制器以及方法
		 */
		self::doRouting();

		
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
}



