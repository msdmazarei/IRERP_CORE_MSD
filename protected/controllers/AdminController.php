<?php
use IRERP\modules\baseresources\models\Human;
use IRERP\Basics\Descriptors\Page;
use IRERP\Basics\ClientFrameWork;
use IRERP\Basics\Descriptors\DynamicForm;
use IRERP\Basics\SmartClient\SmartClientController;


class AdminController extends SmartClientController
{
	public function actionGenerateDb()
	{
		$em = Yii::app()->doctrine->getEntityManager();
		$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
			'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
		    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
		));
		$tool = new \Doctrine\ORM\Tools\SchemaTool($em);
		$classes=array();
		$DBClasses=array();
		$modules=array(
						'jahad'=>'\\IRERP\\modules\\jahad\\models\\',
						'baseresources'=>'\\IRERP\\modules\\baseresources\\models\\',
						'admin'=>'\\IRERP\\modules\\admin\\models\\'
		);
		
		$DBClasses[]='\\IRERP\\Basics\\Models\\BasicNamedClass';
		//$DBClasses[]='\\IRERP\\modules\\models\\MenuItem';
		
		$BasicPath = \Yii::app()->basePath;
		$ModulePath= $BasicPath.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR;
		foreach ($modules as $modname=>$modModels)
		{
			$ModelPath=$ModulePath.$modname.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR;
			$allmodels=scandir($ModelPath);
			foreach ($allmodels as $modelfilename)
			{
			if(is_file($ModelPath.$modelfilename))
				$DBClasses[]=$modModels.str_replace('.php', '', $modelfilename);
			}
			
		}
		foreach($DBClasses as $class)
			$classes[]=$em->getClassMetadata($class);
		print_r($tool->getCreateSchemaSql($classes));
		$tool->updateSchema($classes);
	}
	public function actionUpdateSchema()
	{
		$em = Yii::app()->doctrine->getEntityManager();
		$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
			'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
		    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
		));
		$tool = new \Doctrine\ORM\Tools\SchemaTool($em);
		$classes=array();
		$DBClasses=array();
		$modules=array(
						'jahad'=>'\\IRERP\\modules\\jahad\\models\\',
						'baseresources'=>'\\IRERP\\modules\\baseresources\\models\\',
						'admin'=>'\\IRERP\\modules\\admin\\models\\',
		);
		
		$DBClasses[]='\\IRERP\\Basics\\Models\\BasicNamedClass';
		//$DBClasses[]='\\IRERP\\models\\MenuItem';
		
		$BasicPath = \Yii::app()->basePath;
		$ModulePath= $BasicPath.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR;
		foreach ($modules as $modname=>$modModels)
		{
			$ModelPath=$ModulePath.$modname.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR;
			$allmodels=scandir($ModelPath);
			foreach ($allmodels as $modelfilename)
			{
			if(is_file($ModelPath.$modelfilename))
				$DBClasses[]=$modModels.str_replace('.php', '', $modelfilename);
			}
			
		}
		foreach($DBClasses as $class)
			$classes[]=$em->getClassMetadata($class);
		print_r($tool->getUpdateSchemaSql($classes));
	}

	public function actionCreateSchema()
	{
		$em = Yii::app()->doctrine->getEntityManager();
		$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
			'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
		    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
		));
		$tool = new \Doctrine\ORM\Tools\SchemaTool($em);
		$classes=array();
		$DBClasses=array();
		$modules=array(
						'jahad'=>'\\IRERP\\modules\\jahad\\models\\',
						'baseresources'=>'\\IRERP\\modules\\baseresources\\models\\',
						'admin'=>'\\IRERP\\modules\\admin\\models\\',
		
		);
		
		$DBClasses[]='\\IRERP\\Basics\\Models\\BasicNamedClass';
		$DBClasses[]='\\IRERP\\models\\MenuItem';
		
		$BasicPath = \Yii::app()->basePath;
		$ModulePath= $BasicPath.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR;
		foreach ($modules as $modname=>$modModels)
		{
			$ModelPath=$ModulePath.$modname.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR;
			$allmodels=scandir($ModelPath);
			foreach ($allmodels as $modelfilename)
			{
			if(is_file($ModelPath.$modelfilename))
				$DBClasses[]=$modModels.str_replace('.php', '', $modelfilename);
			}
			
		}
		foreach($DBClasses as $class)
			$classes[]=$em->getClassMetadata($class);
		print_r($tool->getCreateSchemaSql($classes));
	}
	
}