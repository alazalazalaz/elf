<?php
/**
* 路由核心类
*/
namespace Elf\Routing;


class CoreRequest
{

	private static $controller 	= '';		//eg:indexController
	private static $controllerPath = '';	//eg:app/controller/indexController
	private static $action 		= '';		//eg:actionindex
	private static $controllerName = '';	//eg:index
	private static $actionName	= '';		//eg:index
	private static $param 		= array();
	private static $clientIp	= '';
	private static $clientPort	= '';

	CONST CONTROLLER_SUF 		= 'Controller';
	CONST CONTROLLER_DEFAULT 	= 'index';
	CONST ACTION_PRE 			= 'action';
	CONST ACTION_DEFAULT 		= 'Index';

	CONST URL_CONTROLLER_KEY 	= 'c';
	CONST URL_ACTION_KEY 		= 'a';

	/**
	 * 初始化控制器、方法、参数
	 */
	public static function initRequest(){

		$requestUri 	= str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['REQUEST_URI']);

		$re = preg_match('/^\/(\w+)\/(\w+)/', $requestUri, $array);

		self::_initController($re, $requestUri, $array);

		self::_initAction($re, $requestUri, $array);

		self::_initParam($re, $requestUri, $array);

		self::_initIp();

		self::_initPort();
	}


	public static function data($key = ''){
		$data = array(
			'controller' 	=> self::$controller,
			'controllerPath'=> 'controller\\' . self::$controllerPath,
			'action'		=> self::$action,
			'controllerName'=> self::$controllerName,
			'actionName'	=> self::$actionName,
			'param'			=> self::$param,
			'clientIp'		=> self::$clientIp,
			'clientPort'	=> self::$clientPort
		);
		
		if ($key) {
			return isset($data[$key]) ? $data[$key] : '';
		}
		return $data;
	}


	private static function _initController($re, $requestUri, $array){
		if ($re) {
			//domain/a/b/c/d或者//domain/a/b?c=d模式
			if (isset($array[1])) {
				self::_recPath($array[1]);
			}else{
				self::$controller 	= self::$controllerPath = self::CONTROLLER_DEFAULT . self::CONTROLLER_SUF;
			}
		}else{
			//纯domain/?a=xx&b=xxx模式
			$param 	= array_merge($_GET, $_POST);

			if (isset($param[self::URL_CONTROLLER_KEY])) {
				self::_recPath($param[self::URL_CONTROLLER_KEY]);
			}else{
				self::$controller 	= self::$controllerPath = self::CONTROLLER_DEFAULT . self::CONTROLLER_SUF;
			}
		}
	}


	private static function _recPath($string){
		$filePath = str_replace('_', '\\', $string);
		$fileArr  = explode('\\', $filePath);

		$controller = end($fileArr);

		self::$controllerName   = $controller;
		self::$controller 		= $controller . self::CONTROLLER_SUF;
		self::$controllerPath 	= $filePath . self::CONTROLLER_SUF;

	}


	private static function _initAction($re, $requestUri, $array){
		if ($re) {
			//domain/a/b/c/d或者//domain/a/b?c=d模式
			self::$action = isset($array[2]) ? $array[2] : self::ACTION_DEFAULT;
		}else{
			//纯domain/?a=xx&b=xxx模式
			$param 	= array_merge($_GET, $_POST);

			self::$action = isset($param[self::URL_ACTION_KEY]) ? $param[self::URL_ACTION_KEY] : self::ACTION_DEFAULT;
		}

		self::$actionName 	  = self::$action;
		self::$action = self::ACTION_PRE . self::$action;
	}


	private static function _initParam($re, $requestUri, $array){
		$paramRequest 	= array_merge($_GET, $_POST);

		self::$param = array();
		foreach ($paramRequest as $k => $v) {
			self::$param[trim($k)] = trim($v);
		}

		if ($re) {
			//domain/a/b模式
			$requestUri = substr($requestUri, strlen($array[0]));
			if (!$requestUri) {
				return ;
			}

			//domain/a/b?c=xxx模式
			$requestUriArr 	= explode('/', $requestUri);
			if (count($requestUriArr) <= 1) {
				return ;
			}

			if (empty(current($requestUriArr))) {
				array_shift($requestUriArr);
			}

			count($requestUriArr)%2 == 1 ? $requestUriArr[] = '' : $requestUriArr;

			$tmp = TRUE;
			$key = $value = array();
			foreach ($requestUriArr as $v) {
				if ($tmp) {
					$key[] = trim($v);
					$tmp = FALSE;
				}else{
					$value[] = trim($v);
					$tmp = TRUE;
				}
			}
			$param = array_combine($key, $value);

			$param = array_filter($param);

			if (!empty($param)) {
				self::$param = array_merge($param, self::$param);
			}
		}
	}


	private static function _initIp(){
		self::$clientIp = $_SERVER['REMOTE_ADDR'];
	}


	private static function _initPort(){
		self::$clientPort = $_SERVER['REMOTE_PORT'];
	}


	
}
