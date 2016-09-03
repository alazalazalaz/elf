<?php
/**
* hash类
*/
namespace ElfFramework\Lib\Hash;
use ElfFramework\Exception\CommonException;

class Hash
{
	
	
	/**
	 * eg:Hash::get($data, 'user') || Hash::get($data, 'user.uid') 
	 * @param  array
	 * @param  string
	 * @param  string
	 * @return string || $default
	 */
	public static function get(array $data, $keys = '', $default = ''){
		$keyArray 	= explode('.', $keys);
		$keyArray 	= array_filter($keyArray);
		if (empty($keyArray)) {
			return $data;
		}

		foreach ($keyArray as $v) {
			$data 	= isset($data[$v]) ? $data[$v] : $default;
			if (!$data) {
				return $default;
			}
		}
		return $data;
	}


	/**
	 * eg:Hash::set($data, 'aaa.bbb.ccc', 'value') => $data['aaa']['bbb']['ccc']='value'
	 * @param array
	 * @param string
	 * @param string
	 * @return  $data 
	 */
	public static function set(array $data, $keys, $value = ''){
		$keyArray 	= explode('.', $keys);
		$keyArray 	= array_filter($keyArray);
		if (empty($keyArray)) {
			return $data;
		}

		$firstKey 	= array_shift($keyArray);
		if ($keyArray) {
			$keyString = implode('.', $keyArray);
			if (isset($data[$firstKey]) && !empty($data[$firstKey])) {

				if (!is_array($data[$firstKey])) {
					throw new CommonException("无法在非数组结构中插入键值" . $keyString, 1);
				}

				$data[$firstKey] = self::set((array)$data[$firstKey], $keyString, $value);
				return $data;
			}else{
				$data[$firstKey] = self::set(array(), $keyString, $value);
				return $data;
			}

		}else{
			$data[$firstKey] = $value;
			return $data;
		}

	}

}
