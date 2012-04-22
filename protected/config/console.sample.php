<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
Yii::setPathOfAlias('Wildkat', realpath(dirname(__FILE__) . '/../extensions/Wildkat'));
Yii::setPathOfAlias('BasePath', realpath(dirname(__FILE__) . '/../..'));

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
        'doctrine' => array(
            'class' => 'Wildkat\YiiExt\DoctrineOrm\DoctrineContainer',
            'dbal' => array(
                'default' => array(
                    'driver' => 'pdo_mysql',
                    'host' => 'localhost',
                    'dbname' => '',		// TODO set your dbname here
                    'user' => 'root',
                    'password' => '',	// TODO set your db password here
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
                    'mappingDriver' => 'YamlDriver',
                    'mappingPaths' => array(
                        'ext.Wildkat.YiiExt.DoctrineOrm.mapping'
                    ),
                    'proxyDir' => 'data',
                    'proxyNamespace' => 'Proxy',
                ),
            ),
        ),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
	),
);