<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'NOC Abuse Reportr',
	'sourceLanguage'=>'en_gb',

	// preloading 'log' component
	'preload'=>array('log'),
	
	// active theme
	'theme'=>'abound',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.phpmailer.*',
		'application.helpers.logging.*',
		//'application.modules.rights.*', 
		//'application.modules.rights.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'allowme',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','10.28.79.15','::1'),
		),
		/*'rights'=>array(
						'superuserName'=>'sysadmin', 						// Name of the role with super user privileges. 
						'authenticatedName'=>'Authenticated', 				// Name of the authenticated user role. 
						'userIdColumn'=>'id', 								// Name of the user id column in the database. 
						'userNameColumn'=>'username', 						// Name of the user name column in the database.
						'userClass'=>'Users',								// Name of the user model class.
						'enableBizRule'=>true, 								// Whether to enable authorization item business rules.
						'enableBizRuleData'=>false, 						// Whether to enable data for business rules. 
						'displayDescription'=>true, 						// Whether to use item description instead of name. 
						'flashSuccessKey'=>'RightsSuccess', 				// Key to use for setting success flash messages.
						'flashErrorKey'=>'RightsError', 					// Key to use for setting error flash messages. 
						'install'=>false, 									// Whether to install rights.
						 'baseUrl'=>'/rights', 								// Base URL for Rights. Change if module is nested.
						 'layout'=>'rights.views.layouts.main', 			// Layout to use for displaying Rights.
						 'appLayout'=>'application.views.layouts.main', 	// Application layout.
						 'cssFile'=>'rights.css', 							// Style sheet file to use for Rights.
						 'install'=>false, 									// Whether to enable installer.
						 'debug'=>false,								    // Whether to enable debug mode.
			),*/
			//'rights'=>array( 'install'=>true,),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
		),
		'authManager'=>array(
            'class'=>'CPhpAuthManager',
            ),
		'urlManager'=>array(
			'urlFormat'=>'path',
			//'showScriptName'=>false,
			//'caseSensitive'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'site/action/<id:\d+>' => 'site/action'
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=abusereportr',
			'emulatePrepare' => true, 
			'username' => 'abusereportr',
			'password' => 'T9wHWVGSeYBuMrSX',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors  asdfsad fsad f
			'errorAction'=>'site/error',
		),
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

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'nocmanager@nxnoc.com',
	),
);