<?php

return [
	'default'	=> [
		'class'		=> 'Elf\Db\Driver\Mysql\MysqlPdo',
		'prefix'	=> 'su_',
		'host'		=> 'localhost',
		'port'		=> '3306',
		'dbname'	=> 'mysql',
	    'username' => 'root',
	    'password' => '',
	    'charset' => 'utf8',
	],
	'test'	=> [
		'class'		=> 'Elf\Db\Driver\Mysql\MysqlPdo',
		'prefix'	=> 'pre_',
		'host'		=> 'localhost',
		'port'		=> '3306',
		'dbname'	=> 'test',
	    'username' => 'root',
	    'password' => '',
	    'charset' => 'utf8',
	]
];

