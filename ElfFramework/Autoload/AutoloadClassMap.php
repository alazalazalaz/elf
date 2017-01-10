<?php

	
//@todo controller和vendor没弄。
//
return array(

	'ElfFramework\Autoload\CoreAutoload'		=> ELF_PATH . 'Autoload/CoreAutoload.php',	

	'ElfFramework\Controller'					=> ELF_PATH . 'Controller/Controller.php',


	'ElfFramework\Db\Database'					=> ELF_PATH . 'Db/Database.php',
	'ElfFramework\Db\Db'						=> ELF_PATH . 'Db/Db.php',
	'ElfFramework\Db\Driver\Mysql\MysqlPdo'		=> ELF_PATH . 'Db/Driver/Mysql/MysqlPdo.php',
	'ElfFramework\Db\Driver\DriverInterface'	=> ELF_PATH . 'Db/Driver/DriverInterface.php',
	'ElfFramework\Db\Result\Result'				=> ELF_PATH . 'Db/Result/Result.php',
	'ElfFramework\Db\SqlBuilder\BaseSql'		=> ELF_PATH . 'Db/SqlBuilder/BaseSql.php',
	'ElfFramework\Db\SqlBuilder\BindValue'		=> ELF_PATH . 'Db/SqlBuilder/BindValue.php',
	'ElfFramework\Db\SqlBuilder\BuilderHelper'	=> ELF_PATH . 'Db/SqlBuilder/BuilderHelper.php',
	'ElfFramework\Db\SqlBuilder\Sql'			=> ELF_PATH . 'Db/SqlBuilder/Sql.php',
	'ElfFramework\Db\SqlBuilder\SqlBuilder'		=> ELF_PATH . 'Db/SqlBuilder/SqlBuilder.php',
	'ElfFramework\Db\Statement\PdoStatement'	=> ELF_PATH . 'Db/Statement/PdoStatement.php',


	
	'ElfFramework\Domain\CoreDomain'	=> ELF_PATH . 'Domain/CoreDomain.php',

	'ElfFramework\Exception\CommonException'	=> ELF_PATH . 'Exception/CommonException.php',



	'ElfFramework\Lib\Container'		=> ELF_PATH . 'Lib/Common/Container.php',
	'ElfFramework\Lib\Func'				=> ELF_PATH . 'Lib/Common/Func.php',
	'ElfFramework\Lib\Config'			=> ELF_PATH . 'Lib/ConfigHandle/Config.php',
	'ElfFramework\Lib\ConfigArray'		=> ELF_PATH . 'Lib/ConfigHandle/ConfigArray.php',
	'ElfFramework\Lib\Cookie'			=> ELF_PATH . 'Lib/Cookie/Cookie.php',
	'ElfFramework\Lib\Cookie\CoreCookie'=> ELF_PATH . 'Lib/Cookie/CoreCookie.php',
	'ElfFramework\Lib\Session'			=> ELF_PATH . 'Lib/Session/Session.php',
	'ElfFramework\Lib\Session\CoreSession'	=> ELF_PATH . 'Lib/Session/CoreSession.php',
	'ElfFramework\Lib\Hash'				=> ELF_PATH . 'Lib/Hash/Hash.php',
	'ElfFramework\Lib\Log'				=> ELF_PATH . 'Lib/Log/Log.php',
	'ElfFramework\Lib\Request'			=> ELF_PATH . 'Routing/Request.php',
	'ElfFramework\Lib\Response'			=> ELF_PATH . 'Routing/Response.php',

	'ElfFramework\Model'				=> ELF_PATH . 'Model/Model.php',


	'ElfFramework\Routing\CoreRequest'	=> ELF_PATH . 'Routing/CoreRequest.php',
	'ElfFramework\Routing\CoreResponse'	=> ELF_PATH . 'Routing/CoreResponse.php',
	'ElfFramework\Routing\CoreRouting'	=> ELF_PATH . 'Routing/CoreRouting.php',


	'ElfFramework\Startup\CoreInclude'	=> ELF_PATH . 'Startup/CoreInclude.php',
	'ElfFramework\Startup\CoreStartUp'	=> ELF_PATH . 'Startup/CoreStartUp.php',

	'ElfFramework\System\System'		=> ELF_PATH . 'System/System.php',

	'ElfFramework\View\View'			=> ELF_PATH . 'View/View.php',
	'ElfFramework\View\SmartyView'		=> ELF_PATH . 'View/SmartyView.php',
	'ElfFramework\View\ViewInterface'	=> ELF_PATH . 'View/ViewInterface.php',

//vendor
	'Smarty'							=>ELF_PATH . 'Vendor/Smarty/Libs/Smarty.class.php',


);