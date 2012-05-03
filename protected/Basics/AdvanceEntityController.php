<?php
namespace IRERP\Basics;
use IRERP\Basics\Descriptors\DataSourceField;

use IRERP\Utils\ClientEngineHelper;

use IRERP\Utils\AnnotationHelper;

use IRERP\Basics\Descriptors\DataSource;

use IRERP\Basics\Models\IRDataModel;
use IRERP\Utils\GenerationHelper;

use Symfony\Component\Console\Tester\ApplicationTester;

use IRERP\Basics\Annotations\UI\IREnumRelation;

use IRERP\Basics\Annotations\UI\IRUseAsProfile;

use IRERP\Basics\Annotations\UI\IRUseInClientDS;

use Doctrine\Common\Annotations\AnnotationReader;

use IRERP\Basics\EntityController;
abstract class AdvanceEntityController extends EntityController
{
		public $layout='//layouts/main';

		protected $GeneralActionValidators = array(
		"Update"=>array(),
		"JoinUpdate"=>array(),
		
		"Add"=>array(),
		"JoinAdd"=>array(),
		
		"Delete"=>array(),
		"JoinDelete"=>array()
		
		);
		
	
		//------------------------------------------
	public function actionEnumFiller()
	{
		
		$UrlProps = $this->ExtractPropsFromUrl('enumfiller');
		
		$Profile=$UrlProps['Profile'];
		$ParentClass = $UrlProps['ParentClass'];
		$ParentProperty=$UrlProps['ParentProperty'];
		
		if( $Profile=='' ||$ParentClass=='' ||$ParentProperty=='') {
				\Yii::log(
						'Request To AdvnaceEntityController is not Valid'.
						' Profile='.$Profile.',ParentClass='.$ParentClass.
						',ParentProperty='.$ParentProperty
						);
						print_r(
						'Request To AdvnaceEntityController is not Valid'.
						' Profile='.$Profile.',ParentClass='.$ParentClass.
						',ParentProperty='.$ParentProperty
						);
				return ;
		}
		
		$JoinDS = new JoinTb();
		$JoinDS->setClass($ParentClass); //Parent Class That This Controller Must Response it's Request For a Property Of It.
		$JoinDS->setProp($ParentProperty);
		$JoinDS->setWhereString('tmp1.id = :tmp1id');
		$JoinDS->setWhereParam(array('tmp1id'=>$this->getActionParam('HelpField')));
		$JoinDS->setPropClass($this->getEntityClassname());
		$JoinDS->setHelpFieldType('Value');
		$JoinDS->setHelpField($this->getActionParam('HelpField'));
		$JoinDS->setClassProfile($Profile);
		$jtb = $JoinDS;
		
		//Detect Client Request
		$req = \Yii::app()->getRequest();
		$actionParams = $this->getActionParams();
		$accepts = isset($actionParams['isc_dataFormat']) ? $actionParams['isc_dataFormat'] : 'html';
		if ($req->getIsPutRequest())
				{
					//INVALID REQUEST
				}
		else if ($req->getIsDeleteRequest()) 	
				{
					//INVALID REQUEST
				}
		else if ($req->getIsPostRequest()) 		
				{
					//INVALID REQUEST
				}
		else if ($accepts == 'json')			
				{
					
					$this->Adv_EnumFiller($jtb);
				}
		else {
			//INVALID REQUEST
			}
	}
		
	protected function Adv_EnumFiller(JoinTb $jtb)
	{
		
		//There is No Algorithem
		// Must Check Dependency
		// Check User Access
		$this->Adv_fetchResponse(null);
		
		
	} 
	
	public function actionGeneralAdvanceJoin()
	{
		$UrlProps = $this->ExtractPropsFromUrl();
		$Profile=$UrlProps['Profile'];
		$ParentClass = $UrlProps['ParentClass'];
		$ParentProperty=$UrlProps['ParentProperty'];
		
		if( $Profile=='' ||$ParentClass=='' ||$ParentProperty=='') {
				\Yii::log(
						'Request To AdvnaceEntityController is not Valid'.
						' Profile='.$Profile.',ParentClass='.$ParentClass.
						',ParentProperty='.$ParentProperty
						);
				return ;
			}

		$JoinDS = new JoinTb();
		$JoinDS->setClass($ParentClass); //Parent Class That This Controller Must Response it's Request For a Property Of It.
		$JoinDS->setProp($ParentProperty);
		$JoinDS->setWhereString('tmp1.id = :tmp1id');
		$JoinDS->setWhereParam(array('tmp1id'=>$this->getActionParam('HelpField')));
		$JoinDS->setPropClass($this->getEntityClassname());
		$JoinDS->setHelpFieldType('Value');
		$JoinDS->setHelpField($this->getActionParam('HelpField'));
		$JoinDS->setClassProfile($Profile);
		$jtb = $JoinDS;
		
		//Detect Client Request
		$req = \Yii::app()->getRequest();
		$actionParams = $this->getActionParams();
		$accepts = isset($actionParams['isc_dataFormat']) ? $actionParams['isc_dataFormat'] : 'html';
		if ($req->getIsPutRequest())
				{
					if($ParentClass=='NONE' && $ParentProperty=='NONE')
						$this->UpdateRecord($Profile); //FOR this Class
					else  
						$this->Adv_UpdateRecord($jtb); //For Update Request
				}
		else if ($req->getIsDeleteRequest()) 	
				{
					if($ParentClass=='NONE' && $ParentProperty=='NONE')
						$this->RemoveRecord($Profile);  // FOR This CLass
					else
						$this->Adv_RemoveRecord($jtb); //For Remove Request
				}
		else if ($req->getIsPostRequest()) 		
				{
					if($ParentClass=='NONE' && $ParentProperty=='NONE')
						$this->AddRecord($Profile);
					else
						$this->Adv_AddRecord($jtb); //For add Request
				}
		else if ($accepts == 'json')			
				{
					if($ParentClass=='NONE' && $ParentProperty=='NONE')
						$this->fetchResponse($Profile);
					else 
						$this->Adv_fetchResponse($jtb); //fetch
				}
		else {
			if($ParentClass=='NONE' && $ParentProperty=='NONE') $this->renderView();
			}
	}
	
	protected function ExtractPropsFromUrl( $Key='advjds')
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
		if($typ!=$Key) return;
		$Profile='';
		$ParentClass='';
		$ParentProperty='';
		try {
		$Profile=$aUrl[$jdsindex+1];
		$ParentClass=\ApplicationHelpers::TranslateFieldName_From_Client2Server( $aUrl[$jdsindex+2]);
		$ParentProperty= $aUrl[$jdsindex+3];	
		} catch (\Exception $e) {
			//TODO: Make Below Better.
			print_r($e);
			return;
		}
		return array(
		'Profile'=>$Profile,
		'ParentClass'=>$ParentClass,
		'ParentProperty'=>$ParentProperty
		);
	}
	/**
	 * Update Record
	 * @param string $Profile
	 */
	protected function UpdateRecord($Profile)
	{
		// FIXME: Check Version To Standard Updae
		$em = \Yii::app()->doctrine->getEntityManager();
		$className = $this->getEntityClassname();
		try {
			/**
			 * 
			 * Enter description here ...
			 * @var IRDataModel
			 */
			$cls=$em->getRepository($className)
					->find($this->getActionParam('id'));
			$DS=\IRERP\Utils\GenerationHelper::GetDataSource($className, $Profile);
			$cls->CreateClassFrom_SentData_By_Client(array($this, 'getActionParam'),$DS, array("id"=>"id","version"=>"version"));
			$cls->Save($em);
			$em->flush();

			$this->SmartClientRespond($cls->GetClassSCPropertiesInArray_Advance($DS));
	
		} catch(Exception $e) {
			$this->SmartClientRespond(array("Name"=>array("errorMessage"=>$e->getMessage())), NULL, '-4');
		}
		
	}
	protected function Adv_UpdateRecord(JoinTb $jtb)
	{
		//Check That Model is ENUM or Not
		$joinTable=$jtb;
		$ENUMMddel=false;
		//Detect ENUM Model
		$clsdesc=\IRERP\Utils\AnnotationHelper::GetClassAnnotations($jtb->getClass(), $jtb->getClassProfile());
		//Search For IRENUMRelation
		if(key_exists($jtb->getProp(), $clsdesc['Properties']))
		{
			if(key_exists(get_class(new IREnumRelation(array())), $clsdesc['Properties'][$jtb->getProp()]))
				$ENUMMddel=true;
			else
				$ENUMMddel=false;
		}
		else
			return ;
			
		if($ENUMMddel)
		{
			//ENUM Model
			// There is no concept to ENUM Model Update
		}
		else 
		{
			//Not ENUM Model
			$this->Adv_UpdateRecord_NOTENUN($jtb);
		}
		
	}
	protected function Adv_UpdateRecord_NOTENUN(JoinTb $jtb)
	{
		try {
			/**
			 * 
			 * Enter description here ...
			 * @var IRDataModel
			 */
			$em = \Yii::app()->doctrine->getEntityManager();
			$className=$jtb->getPropClass();
			$Profile=$jtb->getPropClassProfile();
			
			$cls=$em->getRepository($className)
					->find($this->getActionParam('id'));
					
			$DS=\IRERP\Utils\GenerationHelper::GetDataSource($className, $Profile);
			$cls->CreateClassFrom_SentData_By_Client(array($this, 'getActionParam'),$DS, array("id"=>"id","version"=>"version"));
			$cls->Save($em);
			$em->flush();

			$this->SmartClientRespond($cls->GetClassSCPropertiesInArray_Advance($DS));
	
		} catch(Exception $e) {
			$this->SmartClientRespond(array("Name"=>array("errorMessage"=>$e->getMessage())), NULL, '-4');
		}
		
		
	}

	

	protected function Adv_RemoveRecord(JoinTb $jtb=NULL)
	{
		$em = \Yii::app()->doctrine->getEntityManager();
		
		$className = $this->getEntityClassname();
		
		try {
			$cls = $em->getRepository($className)
					  ->find($this->getActionParam('id'));
			$cls->setIsDeleted(true);
	
			$cls->Save($em);
			$em->flush();
			if(isset($jtb))
				$DS=\IRERP\Utils\GenerationHelper::GetDataSource($className, $jtb->getPropClassProfile());
			else 
				$DS=\IRERP\Utils\GenerationHelper::GetDataSource($className, NULL);
				
			$this->SmartClientRespond($cls->GetClassSCPropertiesInArray_Advance($DS));
	
		} catch(Exception $e) {
			$this->SmartClientRespond(array("Name"=>array("errorMessage"=>$e->getMessage())), NULL, '-2');
		}
	}

	/**
	 * 
	 * Add Data as Enum To Class Defined In $jtb
	 * @param JoinTb $jtb
	 * @param string $Profile
	 * @return NULL
	 */
	protected function Adv_AddRecord_ENUM(JoinTb $jtb, $Profile)
	{
		$clsdesc=\IRERP\Utils\AnnotationHelper::GetClassAnnotations($jtb->getClass(), $jtb->getClassProfile());
		$joinTable = $jtb;
		$params = $this->getActionParams();
		$em = \Yii::app()->doctrine->getEntityManager();
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
			$MyProfile='General';
		if(key_exists($jtb->getProp(), $clsdesc['Properties']))
				{
					if(key_exists(get_class(new IRUseAsProfile(array())), $clsdesc['Properties'][$jtb->getProp()]))
					{
						$ann=$clsdesc['Properties'][$jtb->getProp()][get_class(new IRUseAsProfile(array()))];
						$MyProfile=$ann->TargetProfile;
					}
					else
					{
						//FIXME: DEBUG Message
						echo 'There is no IRUseAsProfile in Property '.$jtb->getProp().' in Class '.$jtb->getClass();
						return;
					}
				}
				else 
				{
						//FIXME: DEBUG Message					
					echo 'There is no Property With Name '.$jtb->getProp().' In Class '.$jtb->getClass();
					return;
				}
				$__cn=$jtb->getPropClass();
				$__cn1=$jtb->getClass();
				print_r($__cn);
				print_r($MyProfile);
				print_r($__cn1);
				print_r($jtb->getClassProfile());
				return ;
		$DS=GenerationHelper::GetDataSource($__cn1, $MyProfile); //  \ApplicationHelpers::GetDataSourceDescriptor(new $__cn(),		$MyProfile,		new $__cn1(),		$jtb->getClassProfile());
		$rtn=$ccls->GetClassSCPropertiesInArray_Advance($DS);
		} catch (\Exception $e) {
			print_r($e);
		}
		$this->SmartClientRespond($rtn);
		
		
	}
	protected function Adv_AddRecord_NOTENUN(JoinTb $jtb,$Profile)
	{
		$joinTable=$jtb;
		$clsdesc=\IRERP\Utils\AnnotationHelper::GetClassAnnotations($jtb->getClass(), $jtb->getClassProfile());
		$DS=\IRERP\Utils\GenerationHelper::GetDataSource($jtb->getClass(), $jtb->getClassProfile());
		$joinTable=$jtb;
		$className = $this->getEntityClassname();
		$params = $this->getActionParams();
		$em = \Yii::app()->doctrine->getEntityManager();
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
				{
			 		$pcls->CreateClassFrom_SentData_By_Client(array($this, 'getActionParam'),$DS);
			 		//Save $pcls
			 		$pcls->Save();
			 		
				}
					
			//Call Add function To Add pcls to Cls
			$cls->AddToMember($joinTable->getProp(),$pcls);
			$pcls->setHelpField($cls->getid());
			$em->flush();
			$MyProfile='General';
			if(key_exists($jtb->getProp(), $clsdesc['Properties']))
				{
					if(key_exists(get_class(new IRUseAsProfile(array())), $clsdesc['Properties'][$jtb->getProp()]))
					{
						$ann=$clsdesc['Properties'][$jtb->getProp()][get_class(new IRUseAsProfile(array()))];
						$MyProfile=$ann->TargetProfile;
					}
					else
					{
						//FIXME: DEBUG Message
						echo 'There is no IRUseAsProfile in Property '.$jtb->getProp().' in Class '.$jtb->getClass();
						return;
					}
				}
				else 
				{
						//FIXME: DEBUG Message					
					echo 'IRERP:: There is no Property With Name '.$jtb->getProp().' In Class '.$jtb->getClass();
					print_r($clsdesc);
					return;
				}
			//$DS=ApplicationHelpers::GetDataSourceDescriptor($jtb->getPropClass(),$MyProfile,$jtb->getClass(),$jtb->getProfile());
			$DS=\IRERP\Utils\GenerationHelper::GetDataSource($jtb->getPropClass(), $MyProfile);
			$this->SmartClientRespond($pcls->GetClassSCPropertiesInArray_Advance($DS));
				} catch(Exception $e) {
					throw $e;
					//$this->SmartClientRespond(array("Name"=>array("errorMessage"=>$e->getMessage())), NULL, '-1');
					
				}
	}
	protected function Adv_AddRecord(JoinTb $jtb,$Profile='General')
	{
		$joinTable=$jtb;
		$ENUMMddel=false;
		//Detect ENUM Model
		$clsdesc=\IRERP\Utils\AnnotationHelper::GetClassAnnotations($jtb->getClass(), $jtb->getClassProfile());
		//Search For IRENUMRelation
		if(key_exists($jtb->getProp(), $clsdesc['Properties']))
		{
			if(key_exists(get_class(new IREnumRelation(array())), $clsdesc['Properties'][$jtb->getProp()]))
				$ENUMMddel=true;
			else
				$ENUMMddel=false;
		}
		else
			return ;
			
		if($ENUMMddel)
		{
			//ENUM Model
			$this->Adv_AddRecord_ENUM($jtb, $Profile);
		}
		else 
		{
			//Not ENUM Model
			$this->Adv_AddRecord_NOTENUN($jtb, $Profile);
		}
		
	}
	protected function Adv_fetchResponse(JoinTb $jtb=NULL)
	{
		$UserName='Admin';
		$JoinDS=$jtb;
		if(isset($jtb)){
		//Old Method
		//$clsdescr=\ApplicationHelpers::GetClassAnnots($jtb->getClass(), $jtb->getClassProfile()); //Parent Class Descriptor
		$clsdescr = \IRERP\Utils\AnnotationHelper::GetClassAnnotations($jtb->getClass(), $jtb->getClassProfile());
		if(!$this->CheckStandardValidations($jtb, $clsdescr)) {
			\Yii::log("$UserName Try To Access To ".$jtb->getClass() .'.'.$jtb->getProp(). "But Denied By CheckStandardValidations function");
			//FIXME:remove below
			print_r("$UserName Try To Access To ".$jtb->getClass() .'.'.$jtb->getProp(). "But Denied By CheckStandardValidations function");
			return;
		}
		}
		//All Things is O.k. Go To Catch Data
		
			$em = \Yii::app()->doctrine->getEntityManager();
		
		$className = $this->getEntityClassname();
		$params = $this->getActionParams();
		$prefix = $this->getActionParam('isc_metaDataPrefix');
		//START ROW 
		$startRow = '0';
		if (isset($params[$prefix.'startRow']))
			$startRow = $params[$prefix.'startRow'];
		//END ROW
		$endRow = '100';
		if (isset($params[$prefix.'endRow']))
			$endRow = $params[$prefix.'endRow'];
		
		$totalRows = '0';
		$DS=NULL;

		if(isset($jtb))
		{
			if($jtb->getPropClass()!='' || $jtb->getPropClass()!=NULL)
			{
				$DS=GenerationHelper::GetDataSource($jtb->getPropClass(), $jtb->getPropClassProfile());
			} else if ($jtb->getClass()!='' || $jtb->getClass()!=NULL)
			{
				$DS = GenerationHelper::GetDataSource($jtb->getClass(), $jtb->getClassProfile());
			}
		}else
		{
			$DS=GenerationHelper::GetDataSource($className, 'GENERAL');
		}
		try {
			// Catch Specified Record
			// FIXME: Check Filters for specified Record
			if (isset($params['id'])) {
				$id = $params["id"];
				$cls=$em->getRepository($className)
						->find($id);
				RestDataSource::AddResponse(array($cls->GetClassSCPropertiesInArray_Advance($DS))); //RestDataSource::AddResponse(array($cls->GetClassSCPropertiesInArray()));
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
				//Get Field Filters Send By Simple Filter On Top Of Grid
				foreach ($DS->getFields() as $f){
					if(isset($params[$f->getFieldName()])){
						switch(strtolower( $f->getFieldType())){
							case "string":
								
								$criteria[]=array(	'fieldName'=>$f->getFieldName(),
													'operator'=>'iContains',
													'value'=>$params[$f->getFieldName()]);
								break;
							case "integer":
								break;
						}
					}
					
				}
				


				if($order != null) {
					if(!is_array($order))
						$order = array($order);
					
					foreach($order as $fieldname)
						if(substr($fieldname,0,1)=='-')
							$orderBy[
							GenerationHelper::ConvertFromClientFieldName(
								\ApplicationHelpers::TranslateSCVarsToDoctrine(
																substr($fieldname,1,strlen($fieldname)-1),
																 $this->getEntityClassname()
																 )
																 )]='DESC';
						else
						{
							
							$orderBy[
							GenerationHelper::ConvertFromClientFieldName(
								\ApplicationHelpers::TranslateSCVarsToDoctrine($fieldname, $this->getEntityClassname())
								)  
							]='ASC';
						}
				
				}
				//FIXME: Add additional Filters Here To $criteria From Class Annotation
				$wh = $this->setwhere($criteria);
				$whstr='';
				$whparam =null;
				if (count($criteria)>0){
					$whstr = $wh[0];
					$whparam=$wh[1];
				}
				//var_dump($wh); die;
				
				//Get Objects Form Db
				$cls=new \ReflectionClass($className);
				$cls = $cls->newInstance();
				$rtn=$cls->fetchObjects($startRow,$endRow,$whstr,$whparam,$orderBy,$JoinDS);
				
				$results=$rtn['results'];
				$totalRows=$rtn['totalRows'];
				
				//Making Result Array
				$resarr = array();
				//Get Property Class Profile
				$MyProfile='General';
				$MyClassDescriptor=NULL;
				if(isset($clsdescr)){
				if(key_exists($jtb->getProp(), $clsdescr))
				{
					if(key_exists(get_class(new IRUseAsProfile(array())), $clsdescr[$jtb->getProp()]))
					{
						$ann=$clsdescr[$jtb->getProp()][get_class(new IRUseAsProfile(array()))];
						$MyProfile=$ann->TargetProfile;
						$MyClassDescriptor=AnnotationHelper::GetClassAnnotations($jtb->getPropClass(), $MyProfile);
						
					}
					else
					{
						//FIXME: DEBUG Message
						echo 'There is no IRUseAsProfile in Property '.$jtb->getProp().' in Class '.$jtb->getClass();
						return;
					}
				}
				else 
				{
						//FIXME: DEBUG Message					
					echo 'There is no Property With Name '.$jtb->getProp().' In Class '.$jtb->getClass();
					return;
				}
				if($MyClassDescriptor==NULL)
				{
						//FIXME: DEBUG Message					
					echo 'Can Not Find Class Descriptor';
					return;
				}
				/*$cn=$jtb->getPropClass();
				$cn1=$jtb->getClass();
				$DS= \ApplicationHelpers::GetDataSourceDescriptor(	
															new $cn(),
															$MyProfile,
															new $cn1(),
															$jtb->getProp()
														);*/ 
				
				}
				else 
				{
					//None Mode --- None Parent Child Model
					/*
					$MyProfile=\ApplicationHelpers::getEntityProfileFromUrl($this->getUniqueId());
					$clsname=$this->getEntityClassname();
					$DS=\ApplicationHelpers::GetDataSourceDescriptor(new $clsname(),$MyProfile,null,null);
					*/
				}
				
				
				foreach($results as $item)
					$resarr[]=$item->GetClassSCPropertiesInArray_Advance($DS);
				
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
	 * Check All Validations On Parameters 
	 * @param JoinTb $jtb
	 * @param array $clsdescr
	 * @return Boolean
	 */
	protected function CheckStandardValidations(JoinTb $jtb,array $clsdescr)
	{
		$cls=$jtb->getClass();
		$prop=$jtb->getProp();
		
	
		//Check is There Property in Class?
		if(!array_key_exists($prop, $clsdescr)) { print_r("there is no prop"); return false;}
		//Check This Property can use in client
		if(!array_key_exists(
					get_class(new IRUseInClientDS(array())),
					$clsdescr[$prop]				
			)
		   ){ print_r("there is no IRUseInClientDS"); return false;}
		 //Check User Access
		return $this->CheckUserAccess($jtb, $clsdescr);
		return true;
		
	}
	
	protected function CheckUserAccess(JoinTb $jtb,array $clsdescr)
	{
		//FIXME: Make This Better
		return true;
	}
	
	
	protected function renderView()
	{
		
		$this->viewVars['dsMaster'] = $this->getId();
			$this->layout=\IRERP\Utils\ClientEngineHelper::GetDefaultTemplate();
		try {
			$viewname=\IRERP\Utils\ClientEngineHelper::GetViewName('index');
			$this->render($viewname, $this->getViewVars());
		}
		catch (\Exception $ex)
		{

			$viewname=\IRERP\Utils\ClientEngineHelper::GetViewName('//adventity/index');
			$this->render($viewname, $this->getViewVars());

		}
	}

	/**
	 * 
	 * Convert Criteria to Doctrine Filters
	 * @param array $a
	 * sample $a is array(array('fieldName'=>'f1','operator'=>'lessThan','value'=>'10'),array(...),...)
	 */
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
			$fieldName = \ApplicationHelpers::TranslateFieldName_From_Client2Server($s['fieldName'], $this->getEntityClassname());
			//Remove own ClassName From start of $fieldName
			if(strpos($fieldName, '\\')>-1)
			{
				$_arr=explode('.', $fieldName);
				$fieldName='';
				for($i=1;$i<count($_arr)-1;$i++) $fieldName=$_arr[$i].'.';
				$fieldName.=$_arr[count($_arr)-1];
			}
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
	

		protected function AddRecord($Profile)
		{
			
			$className = $this->getEntityClassname();
			$params = $this->getActionParams();
			
			$em = \Yii::app()->doctrine->getEntityManager();
			
			try{
				//FIXME: Get Profile from url
				
				$Profile="GENERAL";
				//$DS=\ApplicationHelpers::GetDataSourceDescriptor(new $className(),$Profile);
				$DS = GenerationHelper::GetDataSource($className, $Profile);
				$r = new \ReflectionClass($className);
				$cls=$r->newInstance();
				
				
				$cls->CreateClassFrom_SentData_By_Client(array($this, 'getActionParam'),$DS);
				
				$cls->Save();
				if(count($cls->getErrors())!=0) {
					$ErrorsToSendToClient=array();
					foreach($cls->getErrors() as $attrname=>$err)
					{
						$ErrorsToSendToClient['_5F'.$attrname]=array();
						foreach ($err as $e) $ErrorsToSendToClient['_5F'.$attrname]['errorMessage']=$e;
					}
					$this->SmartClientRespond(NULL,array('errors'=>$ErrorsToSendToClient),-4);
					//$this->SmartClientRespond(NULL,array('errors'=>array('_5FTitle'=>array('errorMessage'=>'عنوان باید حتما مقدار داشته باشد'))),-4);
					//print_r($cls->Errors);
					die;
				}
				$em->flush();
				$this->SmartClientRespond($cls->GetClassSCPropertiesInArray_Advance($DS));
			} catch(Exception $e) {
				throw $e;
				//$this->SmartClientRespond(array("Name"=>array("errorMessage"=>$e->getMessage())), NULL, '-1');
				
			}
		}

		protected function RemoveRecord($Profile)
		{
			$this->Adv_RemoveRecord(NULL);
			
		}
		
		protected function fetchResponse($Profile)
		{
			$this->Adv_fetchResponse(null);
		}
		
	
}
?>