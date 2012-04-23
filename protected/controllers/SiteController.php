<?php
use IRERP\modules\baseresources\models\Human;
use IRERP\Basics\Descriptors\Page;
use IRERP\Basics\ClientFrameWork;
use IRERP\Basics\Descriptors\DynamicForm;
use IRERP\modules\jahad\models\Test1;
use IRERP\modules\jahad\models\Film;
use IRERP\modules\jahad\models\Human as h1;
use IRERP\modules\jahad\models\Picture;
use IRERP\modules\jahad\models\Magazine;
use IRERP\modules\jahad\models\Matter;
use IRERP\modules\jahad\models\Nationality;
use IRERP\Basics\SmartClient\SmartClientController;
use \IRERP\modules\admin\models\MenuItem,
	\IRERP\modules\jahad\models\TVRD,
	\IRERP\modules\jahad\models\Matter as mats,
	\IRERP\modules\jahad\models\Title,
	\IRERP\modules\jahad\models\MagazineType,
	\IRERP\modules\jahad\models\Size,
	\IRERP\modules\jahad\models\Year,
	\IRERP\modules\jahad\models\MagNo,
	\IRERP\modules\jahad\models\Auidunce,
	\IRERP\modules\jahad\models\Nationality AS USA,
	\IRERP\modules\jahad\models\State,
	\IRERP\modules\jahad\models\Magazine as cddc,
	\IRERP\modules\jahad\models\MagazineVersion,
	\IRERP\modules\jahad\models\Human as gholi_,
	\IRERP\modules\jahad\models\Media,
	\IRERP\modules\jahad\models\Section;

class SiteController extends SmartClientController
{
	protected $__1="uj";
	public function actionTestStringCode()
	{
		$t=ApplicationHelpers::GetClassAnnots(get_class(new IRERP\modules\jahad\models\Human()), 'GENERAL');
		print_r($t);
		return ;
		
		$a='echo $this->__1;';
		eval($a);
	}
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}


	
	public static function PrintDataSource(IRERP\Basics\Descriptors\DataSource $ds,$spc)
	{
		//print_r('<br/>');
		print_r('<table style="border:1px"><tr><td>');
		print_r($spc.$ds->getID());
		print_r('<br/>');
		print_r($spc.$ds->getfetchURL());
		print_r('<br/>');
		print_r($spc.$ds->getProfile());
		print_r('</tr>');
		foreach ($ds->getFields() as $f)
		{
			print_r($f->ToString());
			//print_r('<br/>');
		}
		foreach ($ds->getDetails() as $dds) SiteController::PrintDataSource($dds, '*****');
		
	}
	public function actionGetNEWDataSource()
	{
		$h = new \IRERP\modules\jahad\models\Human();
		/*$ClassAnnots =\IRERP\Utils\AnnotationHelper::GetClassAnnotations(get_class($h), 'GENERAL');
		foreach ($ClassAnnots['Properties'] as $p=>$k)
		print_r($p.'<br/>');
		
		return;
	//	print_r($ClassAnnots);
//return;*/
		$tmp= \IRERP\Utils\GenerationHelper::GetDataSource(get_class($h), 'General');
		
		$ds=$tmp;
		//print_r($ds);
		//$dynform = new Page($ds);
		print_r($ds->GenerateClientCode(ClientFrameWork::SmartClient));
		// Check That ds Has Detail
		if(count($ds->getDetails())>0)
		$dsss=$ds->getDetails();
		foreach ($dsss as $dss)
		print_r("<br/>********<br/>".$dss->GenerateClientCode(ClientFrameWork::SmartClient)."<br/>**********");
		//print_r($ds);
		//SiteController:: PrintDataSource($ds, '%%%%%%%');
		/*
		$tmp=ApplicationHelpers::GetDataSourceDescriptor(new Human(),'Detail1');
		print_r('<br/>*******************************************<br/>');
		$this->PrintDataSource($tmp['DataSource'],'+');*/
//		print_r($ds->getDetails()); 
		//print_r($tmp/*['DataSource']->GenerateClientCode()*/);
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.tpl'
//<<<<<<< HEAD
//		print_r($_POST['Magazineid']);
//		$this->render('index');
//=======
		$this->actionjQueryUITest();
//>>>>>>> presentation
	}

	public function renderAppFrame($return=false)
	{
		if($this->beforeRender('index'))
		{
			if(($layoutFile=$this->getLayoutFile('//layouts/main-mdi'))!==false)
				$output=$this->renderFile($layoutFile,NULL,true);
	
			$this->afterRender('index',$output);
	
			$output=$this->processOutput($output);
	
			if($return)
				return $output;
			else
				echo $output;
		}
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	public function actionTestDoctrine()
	{
		print_r(\Yii::app());
		
	}
	public function actionInstallDB()
	{
		$DBClasses = array(
			'\IRERP\Basics\Models\BasicNamedClass',
			'\IRERP\models\MenuItem',
			'\IRERP\modules\jahad\models\TVRD',
			'\IRERP\modules\jahad\models\Matter',
			'\IRERP\modules\jahad\models\Title',
			'\IRERP\modules\jahad\models\MagazineType',
			'\IRERP\modules\jahad\models\Size',
			'\IRERP\modules\jahad\models\Year',
			'\IRERP\modules\jahad\models\MagNo',
			'\IRERP\modules\jahad\models\Auidunce',
			'\IRERP\modules\jahad\models\State',
			'\IRERP\modules\jahad\models\Magazine',
			'\IRERP\modules\jahad\models\Human',
			'\IRERP\modules\jahad\models\Media',
			'\IRERP\modules\jahad\models\Section',
			'\IRERP\modules\jahad\models\MagazineVersion',
					'\IRERP\modules\jahad\models\Resulation',
					'\IRERP\modules\jahad\models\Subject',
					'\IRERP\modules\jahad\models\PictureFormat',
					'\IRERP\modules\jahad\models\PictureType',
					'\IRERP\modules\jahad\models\Location',
					'\IRERP\modules\jahad\models\Picture',
		'\IRERP\modules\jahad\models\Film',
		'\IRERP\modules\jahad\models\FilmSystemType',
		'\IRERP\modules\jahad\models\FilmProductionFormat',
		'\IRERP\modules\jahad\models\FilmContentlist',
		'\IRERP\modules\jahad\models\FilmEducationalGoal',
		
		'\IRERP\modules\jahad\models\TVSchool',
		'\IRERP\modules\jahad\models\TVContentList',
		
		'\IRERP\modules\jahad\models\RadioSchool',
		'\IRERP\modules\jahad\models\RadioContentList',
		
		'\IRERP\modules\jahad\models\SlideVision',
		'\IRERP\modules\jahad\models\SlideVisionContentlist',

		'\IRERP\modules\jahad\models\PlayShow',
		'\IRERP\modules\jahad\models\PlayShowContentlist',
		
		);
		
		$em = Yii::app()->doctrine->getEntityManager();
		$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
			'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
		    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
		));
		$tool = new \Doctrine\ORM\Tools\SchemaTool($em);
		$classes=array();
		
		foreach($DBClasses as $class)
			$classes[]=$em->getClassMetadata($class);
		
		print_r($tool->getCreateSchemaSql($classes));
		$tool->updateSchema($classes);
		
		echo 'Everything is OK';
	}

	public function actionInsertTestData()
	{
		$parentMenuItem = new MenuItem();
		$parentMenuItem->setTitle('منوی پدر');
		$parentMenuItem->setIcon('#');
		$parentMenuItem->setCommand('/');
		$parentMenuItem->Save();
		
		$menuItem1 = new MenuItem();
		$menuItem1->setTitle('سیستم');
		$menuItem1->setIcon('#');
		$menuItem1->setCommand(Yii::app()->baseUrl . '/#');
		$menuItem1->setParent($parentMenuItem);
		$menuItem1->Save();

		$menuItem2 = new MenuItem();
		$menuItem2->setTitle('منوها');
		$menuItem2->setIcon('#');
		$menuItem2->setParent($menuItem1);
		$menuItem2->setCommand(Yii::app()->baseUrl . '/menu');
		$menuItem2->Save();
		
		Yii::app()->doctrine->getEntityManager()->flush();
	}
	
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionPhpTest()
	{
		try {
			$json = json_decode('{a : "c"}');
			print_r($json);
			print_r(get_object_vars($json));
		}
		catch(Exception $ex)
		{
			print_r($ex);
			//throw $ex;
		}
	}
	
	public function actionNatTest()
	{
		for($i=0;$i<1000;$i++){
		$n = new Nationality();
		$n->setName('Nati'.$i);
		$n->setDescription('Nati'.$i);
		$n->Save();
		$n->getEntityManager()->flush();
		echo $i.'<br/>';
		}
	}
	
	public function actionjQueryUITest()
	{
    	if ($this->beforeRender('//presentation/1')) {
  			$this->renderPartial('//presentation/1');
	    }
	}
	
	public function actionMatTest()
	{
		$m = new Matter();
		$m1 = $m->GetByID(2);
		$m2=$m->GetByID(3);
		$m3=$m->GetByID(4);
		
		$mag= new Magazine();
		$mag = $mag->GetByID(1);
		$mag->AddMatter($m1);
		$mag->AddMatter($m2);
		$mag->Save();
		$mag->getEntityManager()->flush();
		echo count($mag->getMatters());
	}
	public function actionGeMats()
	{
		$m = new Matter();
		$a = new Magazine();
		$em = $m->getEntityManager();
		$qb= $em->createQueryBuilder();
		$qb	->select('tmp1.Name')
    		->from(get_class($a),' tmp')
    		->leftJoin('tmp.mozu','tmp1');
    		
		/*$qb	->select('tmp')
    		->from(get_class($a),' tmp');*/
    		
    	$query = $qb->getQuery();
    	$tp = $query->getDQL();
    	
    		print_r($tp);
    	$tp= $query->execute();
    	print_r($tp);
    		return;
		
		
		/*$q = \Doctrine_Query::create()
    		->select('tmp1')
    		->from(get_class($a).' tmp')
    		->leftJoin('tmp.mozu tmp1');
*/
		$results = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		print_r($results);
		/*$qb = $em->createQueryBuilder();
		$qb->add('select', 'tmp')
		   ->add('from', get_class($this).' tmp')
		   ->setFirstResult( $startRow )
		   ->setMaxResults( $endRow-$startRow );

		$tmp=0;
		
		
		print_r($m);
		*/
	}
		
		
		
public function actionGetDataSource()
{
	include "protected/components/Generate_SC_Resources.php";
	$a=new Picture();
	print_r(GetSimpleDataSource(get_class($a),null));
}	
}
