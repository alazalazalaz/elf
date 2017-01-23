<?php
/**
* File.php
*/
namespace Elf\Lib;
use Elf\Lib\Func;
use DirectoryIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

use FilesystemIterator;

class File
{

	public static function writeFile($file, $content = '', $forceWrite = TRUE){
		$file 			= self::_changeSlashToLeft($file);
		realpath($file);
		$dir  			= dirname($file);

		if (file_exists($file)) {
			if (!$forceWrite) {
				return FALSE;
			}
		}else{
			if (!is_dir($dir)) {
				mkdir($dir, 0777, TRUE);
			}
		}

		return file_put_contents($file, $content);
	}


	public static function readFile($file){
		$file 			= self::_changeSlashToLeft($file);
		realpath($file);

		if (!file_exists($file)) {
			return FALSE;
		}

		$content = '';
		$handle  = fopen($file, 'r');
		while (!feof($handle)) {
			$content .= fread($handle, 8000);
		}

		return $content;
	}


	public static function deleteFile($file){
		$file 			= self::_changeSlashToLeft($file);
		realpath($file);

		if (!file_exists($file)) {
			return TRUE;
		}

		return unlink($file);
	}


	public static function scanDir($folder, $fileType = '*.*'){
		$folder = self::_changeSlashToLeft($folder);
		realpath($folder);

		if (!is_dir($folder)) {
			return FALSE;
		}

		$folder = self::_addSlash($folder);
		$folder = $folder . '/' . $fileType;

		$data = glob($folder);

		if (empty($data)) {
			return NULL;
		}

		$result = [];
		foreach ($data as $value) {
			$fileSize = filesize($value);
			$result[] = [
				'fullPath'	=> $value,
				'fileName'	=> basename($value),
				'fileSize'	=> $fileSize,
				'fileSizeFormate'	=> Func::formateByte($fileSize)
			];
		}

		return $result;
	}


	public static function scanFile($folder){
		$folder = self::_changeSlashToLeft($folder);
		realpath($folder);

		if (!is_dir($folder)) {
			return FALSE;
		}

		$data = $result = '';
		self::_baseScan($folder, FALSE);
		
		$result = self::_formateFileInfo($data);

		return $result;
	}

// @todo 
// 新增scanDirRecusion函数
// 重新封装scanDirTree，让函数直接返回结果，而不是靠&$result
// 封装返回的结果，参考scanDir函数
// 封装$fileType,让使用者输入*.*会有过滤作用。
// 写一个生成tree状的lib

	public static function scanAllFile($folder){

		$folder = self::_changeSlashToLeft($folder);
		realpath($folder);

		if (!is_dir($folder)) {
			return FALSE;
		}

		//php_version
		$data = $result = '';
		// $data = self::_baseScan($folder, TRUE);


		$data = self::_baseScanByIterator($folder);
		
		$result = self::_formateFileInfo($data);

		return $result;
	}


	/**
	 * "老方法"递归遍历文件夹
	 * 缺点是不能遍历出以点"."作为名称开始的文件夹以及文件(eg: .git文件夹和.gitignorge文件)
	 * @param  string  $folder    文件夹路径
	 * @param  boolean $recursive 是否递归遍历子文件夹里的文件
	 * @return []
	 */
	private static function _baseScan($folder, $recursive = TRUE){
		$folder = self::_addSlash($folder);
		$folder = $folder . '/*';

		$data = glob($folder);

		if (empty($data)) {
			return NULL;
		}

		$result = [];
		foreach ($data as $value) {
			if (is_dir($value) && $recursive === TRUE) {
				$tmp = self::_baseScan($value, TRUE);
				$result = array_merge($result, (array)$tmp);
			}elseif(is_file($value)){
				$result[] = $value;
			}
		}

		return $result;
	}


	/**
	 * php>5.3.0提供的新方法遍历文件，文件数目为1K左右时，效率和内存与_baseScan()方法差不多。
	 * @param  string  $folder    文件夹路径
	 * @return []
	 */
	private static function _baseScanByIterator($folder){
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder), RecursiveIteratorIterator::LEAVES_ONLY);

		$result = [];
		foreach ($iterator as $fileinfo) {
			$tmpPath = $fileinfo->getPathname();
			if (is_file($tmpPath)) {
				$result[] = $tmpPath;
			}
		}
		return $result;
	}

	private static function _formateFileInfo($data){
		$result = [];

		if (!empty($data)) {
			foreach ($data as $value) {
				$fileSize = filesize($value);
				$result[] = [
					'fullPath'	=> $value,
					'fileName'	=> basename($value),
					'fileSize'	=> $fileSize,
					'fileSizeFormated'	=> Func::formateByte($fileSize)
				];
			}
		}

		return $result;
	}


	private static function _changeSlashToLeft($path){
		return str_replace(DS, '/', $path);
	}
	

	private static function _addSlash($folder){
		return implode('/', array_filter(explode('/', $folder)));
	}


	//=------------------------------------
	public static function all_files($directory, $options = null)
    {
        if ( !is_dir($directory) ) return FALSE;

        $options = $options ? $options : FilesystemIterator::SKIP_DOTS;

        $items = new FilesystemIterator($directory, $options);

        $_all_files = array();

        foreach ( $items as $item ) {
            if ( $item->isDir() ) {
                if ( $_temp = self::all_files($item->getPathname(), $options) ) {
                    $_all_files = array_merge($_all_files, $_temp);
                }
            } else {
                $_all_files[] = array(
                    'path' => $item->getPath(),
                    'file' => $item->getPathname(),
                    'name' => $item->getFilename(),
                    'size' => $item->getSize(),
                );
            }
        }
        return $_all_files;
    }

// @todo
// 麻蛋，是个假的tree
    public static function all_files_tree($directory, $options = null)
    {
        if ( !is_dir($directory) ) return FALSE;

        $options = $options ? $options : FilesystemIterator::SKIP_DOTS;

        $items = new FilesystemIterator($directory, $options);

        $_all_files = array();

        foreach ( $items as $item ) {
            if ( $item->isDir() ) {
                $_temp = self::all_files($item->getPathname(), $options);

                $_all_files[str_replace($directory,'',$item->getPathname())] = $_temp ? $_temp : array();
            } else {
                $_all_files[] = array(
                    'path' => $item->getPath(),
                    'file' => $item->getPathname(),
                    'name' => $item->getFilename(),
                    'size' => $item->getSize(),
                );
            }
        }
        return $_all_files;
    }
	
}
