<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('Wildkat', realpath(dirname(__FILE__) . '/../extensions/Wildkat'));
Yii::setPathOfAlias('BasePath', realpath(dirname(__FILE__) . '/../..'));
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'IranERP',

	// preloading 'log' and 'irclassloader' components
	'preload'=>array(
		'log',
		'ir_ClassLoader',
	),
	

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'your gii password here',	// TODO set your gii admin password here
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'jahad',
		'reporting',
		'baseresources',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'ir_ClassLoader' => array(
			'class' => 'application.extensions.IRext.IRLoader.IR_ClassLoader',
		),
		'viewRenderer'=>array(
		  'class'=>'application.extensions.yiiext.renderers.smarty.ESmartyViewRenderer',
		    'fileExtension' => '.tpl',
		    //'pluginsDir' => 'application.smartyPlugins',
		    //'configDir' => 'application.smartyConfig',
		),
        'doctrine' => array(
            'class' => 'Wildkat\YiiExt\DoctrineOrm\DoctrineContainer',
            'dbal' => array(
                'default' => array(
                    'driver' => 'pdo_mysql',
                    'host' => 'localhost',
                    'dbname' => 'JAHADDoctrine',		// TODO set your dbname here
                    'user' => 'root',
                    'password' => 'tiras55555',	// TODO set your db password here
                ),
            ),
            'cache' => array(
                'default' => array(
                    'driver' => 'ArrayCache',
                    'namespace' => '__app',
                ),
            ),
            'entityManager' => array(
                'default' => array(
                    'connection' => 'default',
                    'metadataCache' => 'default',
                    'queryCache' => 'default',
                    'entityPath' => 'application.models',
                    'mappingDriver' => 'AnnotationDriver',
                    'mappingPaths' => array(
                        'ext.Wildkat.YiiExt.DoctrineOrm.mapping'
                    ),
                    'proxyDir' => 'application.data',
                    'proxyNamespace' => 'Proxy',
                ),
            ),
        ),
		// uncomment the following to enable URLs in path-format
			'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
        		'<controller:Download>/<Save:Save>/<filename:.*>'=>'Download/SaveToClient',
        		'<controller:Download>/<filename:.*>'=>'Download',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        		'<module:\w+>/<controller:\w+>/<jds:jds>/<parentclass:\w+>/<propname:\w+>'=>'<module>/<controller>/GeneralSimpleJoin', // For Jahad Project
        		'<module:\w+>/<controller:\w+>/<jds:jds>/<parentclass:\w+>/<propname:\w+>/<params:\w+>'=>'<module>/<controller>/GeneralSimpleJoin', // For Jahad Project
        		'<module:\w+>/<controller:\w+>/<jdsenum:jdsenum>/<parentclass:\w+>/<propname:\w+>'=>'<module>/<controller>/GeneralSimpleJoinENUM', // For Jahad Project
        		'<module:\w+>/<controller:\w+>/<advjds:advjds>/<profile:\w+>/<parentclass:\w+>/<propname:\w+>'=>'<module>/<controller>/GeneralAdvanceJoin',
        		'<module:\w+>/<controller:\w+>/<enumfiller:enumfiller>/<profile:\w+>/<parentclass:\w+>/<propname:\w+>'=>'<module>/<controller>/EnumFiller',
        
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=JAHADDoctrine', // TODO change dbname here
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'tiras55555',  // TODO set your db passwrd here
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace', // Enabled trace messages
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'direction' => 'rtl',
		'clientEngine' => 'SmartClient',
		'CacheFolder' => dirname(__FILE__).DIRECTORY_SEPARATOR.
						'..'.DIRECTORY_SEPARATOR.
						'runtime'.DIRECTORY_SEPARATOR.
						'cache'.DIRECTORY_SEPARATOR,
		'ApplicationMode'=>'Development'
	),
);
