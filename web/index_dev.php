<?php
/**
 * 入口文件
 */



define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(dirname(dirname(__FILE__))) . DS); 	//eg:\
define('BASE_APP_PATH', ROOT_PATH  . 'app' . DS);					//eg:\app\
define('MOD_PATH', ROOT_PATH  . 'modules' . DS);					//eg:\modules\
define('DATA_PATH', ROOT_PATH . 'data' . DS);						//eg:\data\
define('EXT', '.php');
define('ENV_ONLINE', FALSE);

define('BASE_APP_NS', 'app\\');
define('MOD_NS', 'modules\\');
define('ELF_NS', 'elf\\');

define('TIMESTAMP', time());
date_default_timezone_set('PRC');

/**
 * APP_PATH，APP_NS这两个宏定义会自动在CoreDomain里面根据域名来定义
 */
// define('APP_NS', 'value'); 										//eg:\modules\bbs\ OR \app\
// define('APP_PATH', 'value');										//eg:\modules\bbs\ OR \app\



/**
 * 配置当前域名
 * eg:www.baidu.com 请配置为baidu
 */
define('DOMAIN_NAME', 'elf');



/**
 * 加载框架
 */

// $framePath = '../../myFrame/ElfFramework'; 							//请在这里配置框架的相对路径
$framePath = '../ElfFramework';

define('ELF_PATH', realpath($framePath) . DS);

require ELF_PATH . 'Elf.php';

use ElfFramework\StartUp\CoreStartUp;
CoreStartUp::exec();