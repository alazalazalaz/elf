<?php
/**
 * 加载框架基本文件(强行加载，不用走autoload)
 */


/**
 * 加载自动加载类
 */
require ELF_PATH . 'Autoload/CoreAutoload.php';


/**
 * 加载异常错误类
 */
require ELF_PATH . 'Exception/CommonException.php';


/**
 * 加载系统配置文件
 */
// require BASE_APP_PATH . 'config/system.php';


/**
 * 加载路由
 */
require ELF_PATH . 'Routing/CoreRouting.php';
require ELF_PATH . 'Routing/CoreRequest.php';

/**
 * 加载域名类
 */
require ELF_PATH . 'Domain/CoreDomain.php';


/**
 * 加载核心控制器
 */
require ELF_PATH . 'Controller/CoreController.php';
require ELF_PATH . 'Controller/Controller.php';

require ELF_PATH . 'Lib/ConfigHandle/Config.php';

