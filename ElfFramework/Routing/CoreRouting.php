<?php
/**
* 路由核心类
*/
namespace ElfFramework\Routing;
use ReflectionClass;
use ElfFramework\Exception\CommonException;
use ElfFramework\Controller\CoreController;
use ElfFramework\Domain\CoreDomain;

class CoreRouting
{

	/**
	 * 控制器预留的方法
	 * @var array
	 */
	private static $sysFun 	= array(
		'before', 'after', 'set', 'display', 'view', 'param'
	);


	public static function doRouting(){
		$controller 	= CoreRequest::data('controller');
		$action 		= CoreRequest::data('action');
		$controllerPath = APP_NS . CoreRequest::data('controllerPath');

		$ref = new ReflectionClass($controllerPath);

		//必须是controller的子类
		if (!$ref->isSubclassOf('ElfFramework\\Controller\\Controller')) {
			throw new CommonException('控制器' . $controller . '必须是controller的子类');
		}

		//不能为抽象类
		if ($ref->isAbstract()) {
			throw new CommonException('控制器' . $controller . '不能是抽象类');
		}

		//不能为接口
		if ($ref->isInterface()) {
			throw new CommonException('控制器' . $controller . '不能是接口');
		}
		
		if (!$ref->hasMethod($action)) {
			throw new CommonException('控制器' . $controller . '找不到方法：' . $action . '()');	
		}

		if (!$ref->getMethod($action)->isPublic()) {
			throw new CommonException('控制器' . $controller . '的方法' . $action . '()属性应该为public');		
		}

		if (in_array($action, self::$sysFun)) {
			throw new CommonException('控制器' . $controller . '的方法' . $action . '()不能为系统预留函数');		
		}

		$obj = $ref->newInstance();

		$obj->before();

		call_user_func(array($obj, $action));

		$obj->after();

	}



	
}


