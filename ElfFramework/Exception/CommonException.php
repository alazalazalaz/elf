<?php

/**
* 异常和错误类
*/

namespace ElfFramework\Exception;

use Exception;
use ElfFramework\Lib\Func;

class CommonException extends Exception
{

	public function init(){
		set_exception_handler(array($this, 'exceptionHandle'));
		set_error_handler(array($this, 'errorHandle'));
		register_shutdown_function(array($this, 'shutdownHandle'));
	}


	public function exceptionHandle(Exception $e){
		//这里判断是否有定义开启debug等，如果没有，则返回error 500错误。
		
	 	$msg 		= $e->getMessage();
	 	$traceList 	= $e->getTrace();
	 	$file 		= $e->getFile();
	 	$line 		= $e->getLine();

		$this->_displayError($msg, $traceList, $file, $line);
	}


	public function errorHandle($errNo, $errMessage, $errFile, $errLine, $errContext = ''){

		list($errorLevel, $logLevel) 	= self::_mapErrorCode($errNo);
		$msg 		= $errMessage;
	 	$traceList 	= array();
	 	$file 		= $errFile;
	 	$line 		= $errLine;

		$this->_displayError($msg, $traceList, $file, $line, 'error', $errorLevel);
	}


	public function shutdownHandle(){
var_dump(Func::getMemUse());
		$lastError = error_get_last();
		if ($lastError) {
			// ob_get_level() and ob_clean();
			$this->errorHandle($lastError['type'], $lastError['message'], $lastError['file'], $lastError['line']);
		}
	}


	private function _mapErrorCode($errNo){
		$error = $log = null;
		switch ($errNo) {
			case E_PARSE:
			case E_ERROR:
			case E_CORE_ERROR:
			case E_COMPILE_ERROR:
			case E_USER_ERROR:
				$error = 'Fatal Error';
				$log = LOG_ERR;
				break;
			case E_WARNING:
			case E_USER_WARNING:
			case E_COMPILE_WARNING:
			case E_RECOVERABLE_ERROR:
				$error = 'Warning';
				$log = LOG_WARNING;
				break;
			case E_NOTICE:
			case E_USER_NOTICE:
				$error = 'Notice';
				$log = LOG_NOTICE;
				break;
			case E_STRICT:
				$error = 'Strict';
				$log = LOG_NOTICE;
				break;
			case E_DEPRECATED:
			case E_USER_DEPRECATED:
				$error = 'Deprecated';
				$log = LOG_NOTICE;
				break;
		}
		return array($error, $log);
	}


	private function _displayError($msg, $traceList, $file, $line, $type = 'exception', $level = ''){
		switch ($type) {
			case 'error':
				$type = 'Error('.$level.'):';
				break;
			
			default:
				$type = 'Exception:';
				break;
		}

		foreach ($traceList as $key => $value) {
			$traceList[$key]['line'] 	= isset($value['line']) ? $value['line'] : '';
			$traceList[$key]['function'] 	= isset($value['function']) ? $value['function'] : '';
			$traceList[$key]['file'] 	= isset($value['file']) ? $value['file'] : '';
			$traceList[$key]['class'] 	= isset($value['class']) ? $value['class'] : '';
		}
		
		include "ErrorPage.php";
	}

}

