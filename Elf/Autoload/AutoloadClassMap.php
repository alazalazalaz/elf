<?php

	
//@todo controller和vendor没弄。
//
return array(

	'Elf\Autoload\CoreAutoload'			=> ELF_PATH . 'Autoload/CoreAutoload.php',	

	'Elf\Controller'					=> ELF_PATH . 'Controller/Controller.php',


	'Elf\Db\Database'					=> ELF_PATH . 'Db/Database.php',
	'Elf\Db\Db'							=> ELF_PATH . 'Db/Db.php',
	'Elf\Db\Driver\Mysql\MysqlPdo'		=> ELF_PATH . 'Db/Driver/Mysql/MysqlPdo.php',
	'Elf\Db\Driver\DriverInterface'		=> ELF_PATH . 'Db/Driver/DriverInterface.php',
	'Elf\Db\Result\Result'				=> ELF_PATH . 'Db/Result/Result.php',
	'Elf\Db\SqlBuilder\BaseSql'			=> ELF_PATH . 'Db/SqlBuilder/BaseSql.php',
	'Elf\Db\SqlBuilder\BindValue'		=> ELF_PATH . 'Db/SqlBuilder/BindValue.php',
	'Elf\Db\SqlBuilder\BuilderHelper'	=> ELF_PATH . 'Db/SqlBuilder/BuilderHelper.php',
	'Elf\Db\SqlBuilder\Sql'				=> ELF_PATH . 'Db/SqlBuilder/Sql.php',
	'Elf\Db\SqlBuilder\SqlBuilder'		=> ELF_PATH . 'Db/SqlBuilder/SqlBuilder.php',
	'Elf\Db\Statement\PdoStatement'		=> ELF_PATH . 'Db/Statement/PdoStatement.php',


	
	'Elf\Domain\CoreDomain'				=> ELF_PATH . 'Domain/CoreDomain.php',

	'Elf\Exception\CommonException'		=> ELF_PATH . 'Exception/CommonException.php',



	'Elf\Lib\Container'					=> ELF_PATH . 'Lib/Common/Container.php',
	'Elf\Lib\Func'						=> ELF_PATH . 'Lib/Common/Func.php',
	'Elf\Lib\Config'					=> ELF_PATH . 'Lib/ConfigHandle/Config.php',
	'Elf\Lib\ConfigArray'				=> ELF_PATH . 'Lib/ConfigHandle/ConfigArray.php',
	'Elf\Lib\Cookie'					=> ELF_PATH . 'Lib/Cookie/Cookie.php',
	'Elf\Lib\Cookie\CoreCookie'			=> ELF_PATH . 'Lib/Cookie/CoreCookie.php',
	'Elf\Lib\Session'					=> ELF_PATH . 'Lib/Session/Session.php',
	'Elf\Lib\Session\CoreSession'		=> ELF_PATH . 'Lib/Session/CoreSession.php',
	'Elf\Lib\Hash'						=> ELF_PATH . 'Lib/Hash/Hash.php',
	'Elf\Lib\Log'						=> ELF_PATH . 'Lib/Log/Log.php',
	'Elf\Lib\Request'					=> ELF_PATH . 'Routing/Request.php',
	'Elf\Lib\Response'					=> ELF_PATH . 'Routing/Response.php',
	'Elf\Lib\File'						=> ELF_PATH . 'Lib/File/File.php',
	'Elf\Lib\Curl'						=> ELF_PATH . 'Lib/Curl/Curl.php',

	'Elf\Model'							=> ELF_PATH . 'Model/Model.php',


	'Elf\Routing\CoreRequest'			=> ELF_PATH . 'Routing/CoreRequest.php',
	'Elf\Routing\CoreResponse'			=> ELF_PATH . 'Routing/CoreResponse.php',
	'Elf\Routing\CoreRouting'			=> ELF_PATH . 'Routing/CoreRouting.php',


	'Elf\Startup\CoreInclude'			=> ELF_PATH . 'Startup/CoreInclude.php',
	'Elf\Startup\CoreStartUp'			=> ELF_PATH . 'Startup/CoreStartUp.php',

	'Elf\System\System'					=> ELF_PATH . 'System/System.php',

	'Elf\View\View'						=> ELF_PATH . 'View/View.php',
	'Elf\View\SmartyView'				=> ELF_PATH . 'View/SmartyView.php',
	'Elf\View\ViewInterface'			=> ELF_PATH . 'View/ViewInterface.php',

//vendor
	'Smarty'							=>ELF_PATH . 'Vendor/Smarty/Libs/Smarty.class.php',


);