<?php

return [
	'default'	=> [
		'class'		=> 'ElfFramework\Db\Driver\Mysql\Pdo',
		'driver'	=> 'default',
		'suffix'	=> 'su_',
		'host'		=> 'localhost',
		'port'		=> '3306',
		'dbname'	=> 'test',
	    'username' => 'root',
	    'password' => '',
	    'charset' => 'utf8',
	],
	'test'	=> [
		'class'		=> 'ElfFramework\Db\Driver\Mysql\Pdo',
		'driver'	=> 'mysql',
		'suffix'	=> 'su_',
		'host'		=> 'localhost',
		'port'		=> '3306',
		'dbname'	=> 'test',
	    'username' => 'root',
	    'password' => '',
	    'charset' => 'utf8',
	]
];

