<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
 
	// preloading 'log' component
	'preload'=>array('log'),
	
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.phpmailer.*',
		'application.helpers.logging.*',
	),

	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=abusereportr',
			'emulatePrepare' => true,
			'username' => 'abusereportr',
			'password' => 'T9wHWVGSeYBuMrSX',
			'charset' => 'utf8',
		),
		/*'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=abusereporter',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'info, error, warning',
				),
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'trace, info, error, warning',
					'categories'=>'system.db.*',
				),
				array(
					'class'=>'CEmailLogRoute',
		            'levels'=>'error, warning',
					'except'=>'system.db.*',
					'emails'=>'asim@yho.me',
				),
				array(
					'class'=>'CProfileLogRoute',
		            'report'=>'summary',
				),
			),
		),
	),
);