<?php
namespace IRERP\Basics;


use \Yii, \ReflectionClass, \CException,\IRERP\Basics,
	\Doctrine\Common\Annotations\AnnotationReader,
	\IRERP\Basics\Annotations\MapModelController;

abstract class EntityController extends \IRController
{
	/**
	 * 
	 * Model class that is handled by this controller. must be set via @MapModelView annotation
	 * @var string
	 */
	protected $entityClassname;
	
	public function getEntityClassname() { return $this->entityClassname; }
	public function setEntityClassname($className) {
		if (!class_exists($className))
			new CException(Yii::t('yii', 'Entity classname {class} does not exist or could not be autoloaded', array('{class}'=>$className)),-1000);
		
		$this->entityClassname = $className;
	}

	protected $viewVars = array();
	
	public function getViewVars() { return $this->viewVars; }
	
	
	public function __construct($id, $module=NULL)
	{
		parent::__construct($id, $module);
		
		$reader = new AnnotationReader();
		$modelMap = $reader->getClassAnnotation(new ReflectionClass(get_class($this)), '\IRERP\Basics\Annotations\MapModelController');
		if ($modelMap !== NULL) {
			try
			{
				$this->setEntityClassname($modelMap->value);
			}
			catch (CException $ex)
			{
				if ($ex->getCode() !== -1000)
					throw $ex;
				else
					$this->setEntityClassname($this->getFullEntityClassname());
			}
		}
		else
			$this->setEntityClassname($this->getFullEntityClassname());
	}
	private function getFullEntityClassname()
	{
		if ($module = $this->getModule())
		$className = 'IRERP\\modules\\' . $module->getId() . '\\' . 'models' . '\\' . str_replace('Controller', '', get_class($this));
		else
		$className = 'IRERP\\models\\' . str_replace('Controller', '', get_class($this));
	
		return $className;
	}
	
	public function actionGeneralSimpleJoinENUM(){
		$totalurl = \Yii::app()->getRequest()->getUrl();
		$questionmark=strpos($totalurl, '?');
		if($questionmark==NULL) $questionmark = strlen($totalurl);
		$totalurl= substr($totalurl, 0,$questionmark);
		
		$currentcontrollerAddress = \Yii::app()->getRequest()->getBaseUrl().'/'.$this->getUniqueId();
		$aUrl = split('/', $totalurl);
		$aController= split('/', $currentcontrollerAddress);
		
		$jdsindex=count($aController);
		$typ = $aUrl[$jdsindex];
		if($typ!='jdsenum') return;
		
		$ParentClassName = $aUrl[$jdsindex+1];
		$ChildClassName = $this->getEntityClassname(); //get_class(new Matter());
		$PropertyName = $aUrl[$jdsindex+2];// $this->getActionParam('propname');
		$ParentClassName=urldecode(str_replace('_', '%', $ParentClassName));
		$PropertyName=urldecode(str_replace('_', '%', $PropertyName));
	
		
		$JoinDS = new JoinTb();
		$JoinDS->setClass($ParentClassName);
		$JoinDS->setProp($PropertyName);
		$JoinDS->setWhereString('tmp1.id = :tmp1id');
		$JoinDS->setWhereParam(array('tmp1id'=>$this->getActionParam('HelpField')));
		$JoinDS->setPropClass($ChildClassName);
		$JoinDS->setHelpFieldType('Value');
		$JoinDS->setHelpField($this->getActionParam('HelpField'));
		/*print_r($JoinDS);
		die;*/
		/**
		 * 
		 */
		$req = Yii::app()->getRequest();
		$actionParams = $this->getActionParams();
		$accepts = isset($actionParams['isc_dataFormat']) ? $actionParams['isc_dataFormat'] : 'html';
		
		/*if ($req->getIsPutRequest())
			$this->UpdateRecord();
		else */if ($req->getIsDeleteRequest())
			$this->sjRemoveRecordENUM($JoinDS);
		else if ($req->getIsPostRequest()) {
			$this->sjAddRecordENUM($JoinDS);
		}
		else	// Is a GET request
			if ($accepts == 'json')
				$this->fetchResponse($JoinDS);
			else {
				//No Need For JoinTb
				//Join Model dont need to view 
		//		$this->renderView();
			}
//		$this->actionIndex($JoinDS);
	}
	public function actionGeneralSimpleJoin()
	{
		$totalurl = \Yii::app()->getRequest()->getUrl();
		$questionmark=strpos($totalurl, '?');
		if($questionmark==NULL) $questionmark = strlen($totalurl);
		$totalurl= substr($totalurl, 0,$questionmark);
		
		$currentcontrollerAddress = \Yii::app()->getRequest()->getBaseUrl().'/'.$this->getUniqueId();
		$aUrl = split('/', $totalurl);
		$aController= split('/', $currentcontrollerAddress);
		
		$jdsindex=count($aController);
		$typ = $aUrl[$jdsindex];
		if($typ!='jds') return;
		
		$ParentClassName = $aUrl[$jdsindex+1];
		$ChildClassName = $this->getEntityClassname(); //get_class(new Matter());
		$PropertyName = $aUrl[$jdsindex+2];// $this->getActionParam('propname');
		$ParentClassName=urldecode(str_replace('_', '%', $ParentClassName));
		$PropertyName=urldecode(str_replace('_', '%', $PropertyName));
	
		
		$JoinDS = new JoinTb();
		$JoinDS->setClass($ParentClassName);
		$JoinDS->setProp($PropertyName);
		$JoinDS->setWhereString('tmp1.id = :tmp1id');
		$JoinDS->setWhereParam(array('tmp1id'=>$this->getActionParam('HelpField')));
		$JoinDS->setPropClass($ChildClassName);
		$JoinDS->setHelpFieldType('Value');
		$JoinDS->setHelpField($this->getActionParam('HelpField'));
		
		/**
		 * 
		 */
		$req = Yii::app()->getRequest();
		$actionParams = $this->getActionParams();
		$accepts = isset($actionParams['isc_dataFormat']) ? $actionParams['isc_dataFormat'] : 'html';
		
		if ($req->getIsPutRequest())
			$this->UpdateRecord();
		else if ($req->getIsDeleteRequest())
			$this->sjRemoveRecord($JoinDS);
		else if ($req->getIsPostRequest()) {
			$this->sjAddRecord($JoinDS);
		}
		else	// Is a GET request
			if ($accepts == 'json')
				$this->fetchResponse($JoinDS);
			else {
				//No Need For JoinTb
				//Join Model dont need to view 
		//		$this->renderView();
			}
//		$this->actionIndex($JoinDS);
	}
	
	
	
	
	public function actionIndex(JoinTb $JoinDS=NULL)
	{
		$req = Yii::app()->getRequest();
		$actionParams = $this->getActionParams();
		//Yii::trace('Here is ActionIndex','system.web.CController');
		
		$accepts = isset($actionParams['isc_dataFormat']) ? $actionParams['isc_dataFormat'] : 'html';
		
		if ($req->getIsPutRequest())
			$this->UpdateRecord();
		else if ($req->getIsDeleteRequest())
			$this->RemoveRecord();
		else if ($req->getIsPostRequest()) {
			$this->AddRecord();
		}
		else	// Is a GET request
			if ($accepts == 'json')
				$this->fetchResponse($JoinDS);
			else {
				$this->renderView();
			}
	}
	protected function renderView()
	{
		$this->viewVars['dsMaster'] = $this->getId();

		try {
			$this->render('index', $this->getViewVars());
		}
		catch (CException $ex)
		{
			$this->render('//entity/index', $this->getViewVars());
		}
	}
	
	

	/**
	 * 
	 * Fetch objects from entity repository with SmartClient-sent criteria
	 * @param string[] $IgnoredProperties
	 * @param \Doctrine\ORM\EntityManager $em
	 */
	protected function fetchResponse(JoinTb $JoinDS=NULL,$IgnoredProperties = NULL, $em = NULL)
	{
		
		if ($em == NULL)
			$em = \Yii::app()->doctrine->getEntityManager();
		
		$className = $this->getEntityClassname();
		$params = $this->getActionParams();
		$prefix = $this->getActionParam('isc_metaDataPrefix');
		
		$startRow = '0';
		if (isset($params[$prefix.'startRow']))
			$startRow = $params[$prefix.'startRow'];
		
		$endRow = '100';
		if (isset($params[$prefix.'endRow']))
			$endRow = $params[$prefix.'endRow'];
		
		$totalRows = '0';
		
		try {
			if (isset($params['id'])) {
				$id = $params["id"];
				$cls=$em->getRepository($className)
						->find($id);
				RestDataSource::AddResponse(array($cls->GetClassSCPropertiesInArray()));
			}
			else
			{
				//Get sortBy Defines
				$orderBy = array();
				$order = null;
				if (isset($params[$prefix.'sortBy']))
					$order = $params[$prefix.'sortBy'];
					
				$criteria = array();
				if (isset($params['criteria'])) {
					$jsoncriteria = $params['criteria'];
					if (!is_array($jsoncriteria))
						$jsoncriteria = array($jsoncriteria);
					foreach($jsoncriteria as $v) {
						$j = json_decode($v);
						if ($j != null)
							$criteria[]=get_object_vars($j);
					}
				}
				//For PickListMenu Filter
				if(array_key_exists($prefix.'componentId',$params))
					$componentid = $params[$prefix.'componentId'];
				else 
					$componentid='';
				if(strpos($componentid,'PickListMenu')>0){
					//Filter for PickListMenu
					$reader = new AnnotationReader();
					$methods=get_class_methods($className);
					foreach ($methods as $methodName)
					{
					//Check That Method is getter or setter else continue
					if(!(substr($methodName, 0,3)=='get' ||	substr($methodName,0,3)=='set')	) continue;
					$propname = substr($methodName, 3,strlen($methodName)-3);
					$reflMethod = new \ReflectionMethod($className, $methodName);
					$MethodAnns = $reader->getMethodAnnotations($reflMethod);
					foreach ($MethodAnns as $annots){
						if(is_a($annots,'\IRERP\Basics\Annotations\scField')){
							//Check That Is Defined annots in filter
							if(isset($params[$annots->name]))
								$criteria[]=array('fieldName'=>$annots->name,'operator'=>'iContains','value'=>$params[$annots->name]);
								
						}
					}
					}
					
				}
				
				if($order != null) {
					if(!is_array($order))
						$order = array($order);
					
					foreach($order as $fieldname)
						if(substr($fieldname,0,1)=='-')
							$orderBy[\ApplicationHelpers::TranslateSCVarsToDoctrine(substr($fieldname,1,strlen($fieldname)-1), $this->getEntityClassname())]='DESC';
						else
							$orderBy[\ApplicationHelpers::TranslateSCVarsToDoctrine($fieldname, $this->getEntityClassname())  ]='ASC';
				}
				$wh = $this->setwhere($criteria);
				$whstr='';
				$whparam =null;
				if (count($criteria)>0){
					$whstr = $wh[0];
					$whparam=$wh[1];
				}
				//var_dump($wh); die;
				
				//Get Objects Form Db
				$cls=new ReflectionClass($className);
				$cls = $cls->newInstance();
				$rtn=$cls->fetchObjects($startRow,$endRow,$whstr,$whparam,$orderBy,$JoinDS);
				
				$results=$rtn['results'];
				$totalRows=$rtn['totalRows'];
				
				//Making Result Array
				$resarr = array();
				foreach($results as $item)
					$resarr[]=$item->GetClassSCPropertiesInArray($IgnoredProperties);
				
				$this->SmartClientRespond($resarr, array(
					"startRow"=>$startRow,
					"endRow"=>$endRow,
					"totalRows"=>$totalRows,
				));
				//$this->SmartClientRespond($startRow,$endRow,$totalRows,$resarr);
			}
		} catch(\Exception $e) {
			print_r($e);
		}
	}
	/**
	 * 
	 * Updates selected record from SmartClient form data
	 * @param \Doctrine\ORM\EntityManager $em
	 */
	protected function UpdateRecord($em=NULL)
	{
		if ($em == NULL)
			$em = \Yii::app()->doctrine->getEntityManager();
		$className = $this->getEntityClassname();
		
		try {
			$cls=$em->getRepository($className)
					->find($this->getActionParam('id'));
			$cls->CreateClassFromScUsingMethod(array($this, 'getActionParam'), array("ID"));
			 
			$cls->Save($em);
			$em->flush();
	
			$this->SmartClientRespond($cls->GetClassSCPropertiesInArray());
	
		} catch(Exception $e) {
			$this->SmartClientRespond(array("Name"=>array("errorMessage"=>$e->getMessage())), NULL, '-4');
		}
	}

	/**
	 * 
	 * Simple Join Model With ENUM
	 * IN ENUM Mode
	 * Client Send id of child classs to server 
	 * to add it to parent class that parent's id is in HelpField
	 * All things do with ids
	 * @param JoinTb $joinTable
	 * @param unknown_type $em
	 */
	protected function sjAddRecordENUM(JoinTb $joinTable,$em=NULL){
		$params = $this->getActionParams();
		if ($em == NULL)
			$em = Yii::app()->doctrine->getEntityManager();
		//Check That HelpField and id is set or noy
		$parentid=NULL;
		$childid = NULL;
		if(isset($params['HelpField'])) $parentid=$params['HelpField'];
		if(isset($params['id'])) $childid=$params['id'];
		if($parentid==NULL || $childid==NULL) {
			//Send Error Message To Client
			$this->SmartClientRespond(
								NULL,
								array('errors'=>
								array("errorMessage"=>"داده های لازم برای عملیات کافی نیستند")
								)
								, 
								 '-1');
			
			
		}
		//Load Parent Class
		$pcls = $joinTable->getClassInstance($em);
		$pcls=$pcls->GetByID($parentid);
		$ccls = $joinTable->getPropClassInstance($em);
		$ccls=$ccls->GetByID($childid);
		$pcls->AddToMemberENUM($joinTable->getProp(),$ccls);
		$em->flush();
		$ccls = $joinTable->getPropClassInstance($em);
		
		$ccls=$ccls->GetByID($childid);
		$ccls->setHelpField($pcls->getid());
		
		/***
		 * In Some Times the GetByID return proxied Class 
		 * and proxied class has no annotations to use in GetClassSCPropertyInArray
		 * abnd this cause some problem like send embty data section in response to client
		 * to prevent this problem we need test that $ccls class equals with requested
		 * PropClass , if it is not we must copy all property to PropClass Type 
		 */

		if(get_class($ccls)!=$joinTable->getPropClass()){
				$tmpccls=$joinTable->getPropClassInstance($em);
				$tmpccls->CopyProps($ccls);
				$ccls=$tmpccls;
		}
		
		try {
		$rtn=$ccls->GetClassSCPropertiesInArray();
		} catch (\Exception $e) {
			print_r($e);
		}
		$this->SmartClientRespond($rtn);
	}
	/**
	 * 
	 * Simple Join Model Update Data
	 * @param JoinTb $joinTable
	 * @param unknown_type $em
	 */
	protected function sjAddRecord(JoinTb $joinTable,$em=NULL)
	{
		$className = $this->getEntityClassname();
		$params = $this->getActionParams();
		if ($em == NULL)
			$em = Yii::app()->doctrine->getEntityManager();
		
		try{
			
			$cls = $joinTable->getClassInstance($em);
			$pcls = $joinTable->getPropClassInstance($em);
			

			//$cls is DbEntity And Parent Class That Must Load Using HelpField
			$cls =$cls->GetByID($joinTable->getHelpField());
			//Check That id defined
			$id=NULL;
			$id = $this->getActionParam('id');
			if(isset($id)) 
			 	if ($id!='') 
			 		$pcls=$pcls->GetByID($id);
			//if there  is no id
			$id = $pcls->getid();
			if(!isset($id))
			if(!($id>0))
			 		$pcls->CreateClassFromScUsingMethod(array($this, 'getActionParam'));
			
			/*			 		
			if(!(isset($pcls->getid())))
			   if(!($pcls->getid()>0))
			
			*/
			//Call Add function To Add pcls to Cls
			//call_user_method('add'.$joinTable->getProp(), $cls,$pcls);
			$cls->AddToMember($joinTable->getProp(),$pcls);
			$pcls->setHelpField($cls->getid());
			$em->flush();
			
			
			/*$cls->CreateClassFromScUsingMethod(array($this, 'getActionParam'));
			$cls->Save();
			$em->flush();*/
			$this->SmartClientRespond($pcls->GetClassSCPropertiesInArray());
		} catch(Exception $e) {
			throw $e;
			//$this->SmartClientRespond(array("Name"=>array("errorMessage"=>$e->getMessage())), NULL, '-1');
			
		}
		
	}
	
	
	/**
	 * 
	 * Add form data as a record  
	 * @param \Doctrine\ORM\EntityManager $em
	 * @throws Exception
	 */
	protected function AddRecord($em=NULL)
	{
		$className = $this->getEntityClassname();
		$params = $this->getActionParams();
		
		if ($em == NULL)
			$em = Yii::app()->doctrine->getEntityManager();
		
		try{
			$r = new ReflectionClass($className);
			$cls=$r->newInstance();
			$cls->CreateClassFromScUsingMethod(array($this, 'getActionParam'));
			$cls->Save();
			if(count($cls->Errors)!=0) {print_r($cls->Errors);die;}
			$em->flush();
			$this->SmartClientRespond($cls->GetClassSCPropertiesInArray());
		} catch(Exception $e) {
			throw $e;
			//$this->SmartClientRespond(array("Name"=>array("errorMessage"=>$e->getMessage())), NULL, '-1');
			
		}
	}
	
	/**
	 * 
	 * Removes record by ID
	 * @param \Doctrine\ORM\EntityManager $em
	 */
	protected function RemoveRecord($em = NULL) {
		if ($em == NULL)
			$em = \Yii::app()->doctrine->getEntityManager();
		
		$className = $this->getEntityClassname();
		
		try {
			$cls = $em->getRepository($className)
					  ->find($this->getActionParam('id'));
			$cls->setIsDeleted(true);
	
			$cls->Save($em);
			$em->flush();
	
			$this->SmartClientRespond($cls->GetClassSCPropertiesInArray());
	
		} catch(Exception $e) {
			$this->SmartClientRespond(array("Name"=>array("errorMessage"=>$e->getMessage())), NULL, '-2');
		}
	}
	
	/**
	 * 
	 * Remove Connection From Child Class (id) And ParentClass(Helpid)
	 * @param JoinTb $joinTable
	 * @param unknown_type $em
	 */
	protected function sjRemoveRecordENUM(JoinTb $joinTable,$em=NULL){
		if ($em == NULL)
			$em = \Yii::app()->doctrine->getEntityManager();
		$pcls = $joinTable->getClassInstance($em);
		$pid = NULL;
		switch ($joinTable->getHelpFieldType()){
				case 'Value':
					$pid=$joinTable->getHelpField();
					break;
			}
		$cid = NULL;
		$cid=$this->getActionParam('id');
		if(!(isset($pid) && isset($cid))) {
						$this->SmartClientRespond(
								NULL,
								array('errors'=>
								array("errorMessage"=>"داده های لازم برای عملیات کافی نیستند")
								)
								, 
								 '-1');
		}
		$pcls=$pcls->GetByID($pid);
		$ccls=$joinTable->getPropClassInstance($em);
		$ccls=$ccls->GetByID($cid);
		$pcls->RemoveFromMember_ENUM($joinTable->getProp(),$ccls);
		$em->flush();
		$ccls->setHelpField($pcls->getid());
		$this->SmartClientRespond($ccls->GetClassSCPropertiesInArray());
	}
	
	/**
	 * 
	 * Removes record by ID
	 * @param \Doctrine\ORM\EntityManager $em
	 */
	protected function sjRemoveRecord(JoinTb $joinTable,$em = NULL) {
		if ($em == NULL)
			$em = \Yii::app()->doctrine->getEntityManager();
		
		$className = $this->getEntityClassname();
		
		try {
			$pid=NULL;
			switch ($joinTable->getHelpFieldType()){
				case 'Value':
					$pid=$joinTable->getHelpField();
					break;
			}
			$cid=NULL;
			$cid = $this->getActionParam('id');
			//Check That there is $pid and id
			if(isset($pid) && isset($cid))
			{
				
			$client = $em->getRepository($joinTable->getPropClass())->find($cid);
			$cls = $em->getRepository($joinTable->getClass())->find($pid);
			//call_user_method('remove'.$joinTable->getProp(), $cls,$client);
			//$cls->Save($em);
			$cls->RemoveFromMember_Complete($joinTable->getProp(),$client);
			$em->flush();
			$client->setHelpField($cls->getid());
			$this->SmartClientRespond($client->GetClassSCPropertiesInArray());
			}else {
				//Send Error To Client
				$this->SmartClientRespond(
								NULL,
								array('errors'=>
								array("errorMessage"=>"داده های لازم برای عملیات کافی نیستند")
								)
								, 
								 '-1');
				return;
			}
			
//			$cls->setIsDeleted(true);
	
	
		} catch(Exception $e) {
			$this->SmartClientRespond(array("Name"=>array("errorMessage"=>$e->getMessage())), NULL, '-2');
		}
	}
	
	
	protected function SmartClientRespond($data = NULL, $params = NULL, $statusCode = '0')
	{
		$response = array('response' => array('status' => $statusCode));
		if ($params != NULL)
			foreach($params as $key => $param)
		$response['response'][$key] = $param;
		if(isset($data)) $response['response']['data'] = $data;

		$this->ajaxRespondJSON($response);
	}

	private function setwhere($a)
	{
		$change=array(
		'lessThan'=>' < :p',
		'greaterThan'=>' > :p',
		'lessThanOrEqual'=>' <= :p',
		'greaterThanOrEqual'=>' >= :p',
		'betweenInclusive'=>' between :1p and :2p',
		'notEqual'=>' != :p',
		'startsWith'=>' like :p',
		'endsWith'=>' like :p',
		'notStartsWith'=>' not like :p',
		'notEndsWith'=>' not like :p',
		'iContains'=>' like :p',
		'notContains'=>' not like :p',
		'inSet'=>' in :p',
		'notInSet'=>' not in :p',
		'isNull'=>' IS NULL',
		'isNotNull'=>' IS NOT NULL ',
		'exact match'=>' = :p',
		'equals'=>' = :p '
		);


		$reval=array();
		$ret='';
		$tmp1=0;
		foreach ($a as &$s)
		{
			$fieldName = \ApplicationHelpers::TranslateSCVarsToDoctrine($s['fieldName'], $this->getEntityClassname(), NULL);
			$tmp1++;
			if(!isset($s['value']))
			$s['value'] = '';

			switch ($s['operator']){
				case 'startsWith':
				case 'notStartsWith': $tmp=$s['value'].'%'; break;
				case 'endsWith':
				case 'notEndsWith': $tmp='%'.$s['value']; break;
				case 'iContains':
				case 'notContains': $tmp='%'.$s['value'].'%'; break;
				default: $tmp=$s['value'];break;
			}
			if($s['operator']=='betweenInclusive')
			{
				$reval['1'.str_ireplace('.', '_', $fieldName).$tmp1]=$s['value'][0];
				$reval['2'.str_ireplace('.', '_', $fieldName).$tmp1]=$s['value'][1];
			}
			else
			{
				$reval[str_ireplace('.', '_', $fieldName).$tmp1]=$tmp;
			}
			if($tmp1!=1)
			{
				$ret=$ret.' and tmp.'. $fieldName.str_replace('p',str_ireplace('.', '_', $fieldName).$tmp1,$change[$s['operator']]);
			}
			else
			{
				$ret='tmp.'.$fieldName.str_replace('p',str_ireplace('.', '_', $fieldName).$tmp1,$change[$s['operator']]);
			}
		}
		return array($ret,$reval);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}