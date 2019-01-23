<?php

/**
* CURL类
*/
namespace Elf\Lib;
use Elf\Exception\CommonException;
use Elf\Routing\CoreRequest;

class Curl
{

	public static function send($url){
		// header("Content-Type: text/html; charset=UTF-8");
		$header = array(
		"content-type: application/x-www-form-urlencoded; 
		charset=gb2312"
		);
		$ch = curl_init();

		// curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
		curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_ENCODING, '');
		// curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);//post值 $curlPost = 'a=1&b=2';//模拟POST数据

		$html = curl_exec($ch);
		curl_close($ch);
		return $html;
	}
}