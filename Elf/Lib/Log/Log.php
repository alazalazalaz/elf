<?php

/**
* 日志类
*/
namespace Elf\Lib;
use Elf\Exception\CommonException;
use Elf\Routing\CoreRequest;

class Log
{

	/**
	 * @param  string
	 * @param  int
	 * @param  string
	 * @param  string
	 * @return NULL
	 */
	public static function write($message, $level = 3, $file = '', $path = ''){

		$level 	= empty($level) ? 3 : $level;
		$file 	= self::_createFileName($file);
		$path 	= self::_createPathName($path);

		if (!self::_createPath($path)) {
			throw new CommonException("创建LOG目录失败,path:" . $path, 1);
		}

		$message 	= self::_formateMessage($message);

		error_log($message, $level, $path . $file);
	}


	private static function _createFileName($file){
		if ($file) {
			$file .= '-' . date('Ymd-H', TIMESTAMP) . '.log';
		}else{
			$file = date('Ymd-H', TIMESTAMP) . '.log';
		}

		return $file;
	}


	private static function _createPathName($path){
		$defaultDir = APP_PATH . 'tmp' . DS . 'log' . DS;

		if (!empty($path)) {
			return $path;
		}
		return $defaultDir . date('Y-m', TIMESTAMP) . DS . date('d', TIMESTAMP) . DS;
	}


	private static function _createPath($path){

		if (empty($path)) {
			return FALSE;
		}

		if (is_dir($path)) {
			return TRUE;
		}

		if (!mkdir($path, '0777', TRUE)) {
			return FALSE;
		}

		return TRUE;
	}


	private static function _formateMessage($message){
		$content = "\r\n-------------------------------------------------------\r\n".
			"time 		:" . date('Ymd-H:i:s', TIMESTAMP) . "(". TIMESTAMP .")" . "\r\n".
			"file 		:" . APP_PATH . "\r\n".
			"request 	:" . CoreRequest::data('controllerPath') . "\\" . CoreRequest::data('action') . "\r\n".
			"content 	:\r\n" . $message . "\r\n" . 
			"-------------------------------------------------------\r\n";
		return $content;
	}
}