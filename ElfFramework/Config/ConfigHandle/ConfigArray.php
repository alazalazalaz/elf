<?php

/**
* config类型为数组对象
* @todo  以后可以写config类型为string或者其他的对象，可以建立一个interface，让所有类型继承它，实现共同接口
*/
namespace ElfFramework\Config\ConfigHandle;
use ElfFramework\Exception\CommonException;

class ConfigArray
{

	private $file;
	private $content;
	
	public function __construct($file, $content = ''){
		$this->file 	= $file;
		$this->content 	= $content;
	}


	/**
	 * @param mixed $keys string || string.string
	 * @return  mixed string || NULL
	 */
	public function get($keys){

		$keysArray = explode('.', $keys);
		$keysArray = array_values(array_filter($keysArray));
		
		if (empty($keysArray)) {
			throw new CommonException("配置文件". APP_NS . "config" . DS . $this->file . "键值不能为空". $keys, 1);
		}else{
			$tmpContent 	= $this->content;
			$keyString 		= '';
			foreach ($keysArray as $v) {
				$tmpContent = isset($tmpContent[$v]) ? $tmpContent[$v] : NULL;
				$keyString .= $v . ".";
				if (!$tmpContent) {
					throw new CommonException("配置文件". APP_NS . "config" . DS . $this->file . "没有对应的键值". $keyString, 1);
				}
			}
			return $tmpContent;
		}

	}


	public function getAll(){
		return $this->content;
	}

}