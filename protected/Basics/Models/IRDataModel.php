<?php
namespace IRERP\Basics\Models;

use IRERP\Utils\AnnotationHelper;

use IRERP\Basics\Annotations\UI\IRInternalType;

use IRERP\Basics\Descriptors\DataSourceField;

use IRERP\Basics\JoinTb;

use IRERP\Basics\Descriptors\DataSource;

use \Doctrine\Common\Annotations\AnnotationReader,
	 \IRERP\Basics\Annotations\scField,
	\IRERP\Basics,
	 \CModel, \Yii;

use \Doctrine\ORM\Mapping\Id,\Doctrine\ORM\Mapping\GeneratedValue
,\Doctrine\ORM\Mapping\Column
;

use 
IRERP\Basics\Annotations\UI\IRUseInClientDS,
IRERP\Basics\Annotations\UI\IRClientName,
IRERP\Basics\Annotations\UI\IRTitle,
IRERP\Basics\Annotations\UI\IRPropertyType,
IRERP\Basics\Annotations\UI\IRParentGridMember,
IRERP\Basics\Annotations\UI\IRPickListMember,
IRERP\Basics\Annotations\UI\IRUseAsProfile,
IRERP\Basics\Annotations\UI\IRPrimaryKey,
IRERP\Basics\Annotations\UI\IRHidden
;
   
use IRERP\Basics\Descriptors\DescriptorBase;
use Doctrine\ORM\Mapping\Entity;
//This shoud be defined inside php.ini file, not here
//date_default_timezone_set('UTC');

/**
 * @MappedSuperclass
 * @author masoud
 * each IRDataModel has 3 Profiles By default, They Are:
 * GENERAL  : When Use As Direct Not In Another Class
 * DETAIL   : When Use In Another Class As Property With 1-n Relation
 * ABSTRACT : When Use In Another Class As Property with 1-1 Relation
 * Picklist : When Use In PickList
 *
 */
class IRDataModel extends CModel
{
	////////////////////////////////
	/////// Doctrine Section
	private $_entityPersister;
	private $_identifier;
	protected function get_identifier()
	{
		return $this->_identifier;
	}
	protected function set_identifier($v)
	{
		$this->_identifier=$v;
	}
	
	protected  function get_entityPersister()
	{
		return $this->_entityPersister;
	}
	
	protected  function set_entityPersister($v)
	{
		$this->_entityPersister=$v;
	}
	public function DoctrineLoad()
	{
		//This function Will Override By Doctrine Proxy Auto Generate
		// and call __load method
	}
	//////////////////////////////////////
	
	
	private $GeneralConfiguration = array
	(
	//Define Useful Function Names For Generator
	    DescriptorBase::MethodName_GenDataSource =>'__GetDataSource',
		DescriptorBase::MethodName_GenForm => '__GetForm',
		DescriptorBase::MethodName_GenGrid => '__GetGrid',
		DescriptorBase::MethodName_GetDisplayField => '__GetDisplayField'
	);
	
	public function GetGeneralConfiguration()
	{
		return $this->GeneralConfiguration;
	}
	
	
	
	private static $_names=array();

	/**
	 * Entity Manager That This Class Use To 
	 * Doing Something To Objects
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $entityManager;
	
	/**
	 * @Id @generatedValue(strategy="AUTO") @Column(type="integer")
	 * 
	 * @IRUseInClientDS()
	 * @IRClientName(ClientName="id")
	 * @IRPrimaryKey(NotForProfile="ABSTRACT,")
	 * @IRHidden
	 * @IRPropertyType(Type="integer")
	 * @IRParentGridMember
	 * @var integer
	 */
	protected $id = null;
	/**
	 * @Column(type="integer")
	 * @version
	 * @var integer
	 */
	protected $version = 0;
	
	/**
	 * @Column(type="datetime")
	 * @var DateTime
	 */
	protected $dateCreated;
	
	/**
	 * @Column(type="datetime")
	 * @var DateTime
	 */
	Protected $dateLastModified;
	
	/**
	 * @Column(type="boolean")
	 * @var boolean
	 */
	protected $IsDeleted=false;
	
	
	/**
	 * @Column(type="integer")
	 * @var integer
	 */
	protected $creatorUserId=-1;
	
	/**
	 * @Column(type="integer")
	 * @var integer
	 */
	protected $modifierUserId=-1;
	
	/**
	 * 
	 * Values of all annotations is stored in this array
	 * @var string[]
	 */
	protected $annotationValues = array();
	/**
	 * 
	 * @IRHidden
	 * @IRPropertyType(Type="string")
	 * @var unknown_type
	 */
	protected $HelpField='';
	public function setHelpField($v){$this->HelpField=$v;}
   /**
	 *@scField(name="HelpField") 
	 */
	public function getHelpField(){return $this->HelpField;}
	
	
	protected function getClassMember($MemberName){
		$tmp=new \ReflectionProperty($this,$MemberName);
		$tmp->setAccessible(true);
		return $tmp->getValue($this);
	}
	
	protected function setClassMember($MemberName,$Value,$Obj=NULL){
		$tmp=new \ReflectionProperty($this,$MemberName);
		$tmp->setAccessible(true);
		if(!isset($Obj)) $Obj=$this; 
		$tmp->setValue($Obj, $Value);
	}
	
	
	public function AddToMember($MemberName,IRDataModel $Value){
		$_1nPropName = NULL;
		$_1nPropName=\ApplicationHelpers::GetPropertyInTargetFor1nRelation($this, $MemberName, $Value);
		if(isset($_1nPropName)){
			$Value->setClassMember($_1nPropName, $this,$Value);
			$this->getClassMember($MemberName)->add($Value);
			$Value->Save();
		}else {

		$this->getClassMember($MemberName)->add($Value);
		$this->Save();
		}
		//Check For Relation Betweeen $Value Class And Member Class 
		//if Relation is n-1 And There Is 
	}
	public function AddToMemberENUM($MemberName,$Value){
		$this->getClassMember($MemberName)->add($Value);
	}
	public function RemoveFromMember_ENUM($MemberName,$Value){
		$this->getClassMember($MemberName)->removeElement($Value);
	}
	public function RemoveFromMember_Complete($MemberName,IRDataModel $Value){
		$this->getClassMember($MemberName)->removeElement($Value);
		$Value->setIsDeleted(true);
		$Value->Save();
		$this->Save();
		
	}
	
	/***
	 * this method copy all property from src to this class property which have save name
	 */
	
	public function CopyProps($src)
	{
		//Get all Properties
		$rcls = new \ReflectionClass(get_class($src));
		foreach($rcls->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED) as $p){
			//$p is PropertyReflection
			try{
			$p->setAccessible(true);
			$thisclassp=new \ReflectionProperty($this, $p->getName());
			$thisclassp->setAccessible(true);
			$thisclassp->setValue($this, $p->getValue($src));
			}catch(\Exception $e)
			{}
		}
	}
	
	public function setEntityManager(&$value = NULL){
		if ($value !== NULL && is_a($value, '\Doctrine\ORM\EntityManager'))
			$this->entityManager = $value;
		else
			$this->entityManager=\Yii::app()->doctrine->getEntityManager();
	}
	public function &getEntityManager(){
		if ($this->entityManager === NULL)
			$this->setEntityManager();
		
		return $this->entityManager;
	}
	
	/**
	 *@scField(name="id",DoctrineField="id",type="integer",primaryKey="true",hidden="true") 
	 */
	public function getid(){return $this->id;}
	public function setid($v){$this->id=$v;}
	
 	public function getVersion(){return $this->version;}
	
	public function getCreatorUserID(){return $this->creatorUserId;}
	public function setCreatorUserID($uid){$this->creatorUserId=$uid;}
	
	public function getModifierUserID(){return $this->modifierUserId;}
	public function setModifierUserID($uid){$this->modifierUserId=$uid;}
	
	public function getCreateDate(){return $this->dateCreated;}
	public function setCreateDate($d){$this->dateCreated=$d;}
	
	public function getdateLastModified(){return $this->dateLastModified;}
	public function setdateLastModified($d){$this->dateLastModified=$d;}
	
	public function getIsDeleted(){return $this->IsDeleted;}
	public function setIsDeleted($d){$this->IsDeleted=$d;}

	public function CreateClassFrom_SentData_By_Client($functionName,DataSource $DS,array $ExceptParams=NULL){
		foreach ($DS->getFields() as $f)
		{
			
			$FieldName=\ApplicationHelpers::TranslateFieldName_From_Client2Server($f->getFieldName());
			$propname='';
			if(strpos($FieldName, '\\')>-1)
			{
				$parts= explode('.', $FieldName);
				if(count($parts)>3) continue;
				switch(count($parts))
				{
					case 2:
						$propname=$parts[1];
						if(isset($ExceptParams)) if(key_exists($propname, $ExceptParams)) continue;
						$this->$propname= call_user_func($functionName,$FieldName);
						break;
					case 3:
						if($parts[2]=='id'){
							
							$propname=$parts[1];
							// Get Target Class Name
							$clsdesc= \ApplicationHelpers::GetClassAnnots(get_class($this),$DS->getProfile());
							$ClientFieldValue= call_user_func($functionName,$FieldName);
							if(key_exists($propname, $clsdesc))
								if(
									key_exists(get_class(new IRInternalType(array())),
													 $clsdesc[$propname]))
													 {
													 	$_tmp = $clsdesc [$propname] [get_class(new IRInternalType(array()))] ;
													 	$clsname=$_tmp->ClassName;
													 	//Get Class Name
													 	$cls = new $clsname();
													 	$cls=$cls->GetByID($ClientFieldValue);
													 	$this->$propname=$cls;
													 }
							
						} 
						break;
				}
			}
			else 
			{
				$parts= explode('.', $FieldName);
				if(count($parts)>2) continue;
				switch(count($parts))
				{
					case 1:
						$propname=$parts[0];
						if(isset($ExceptParams)) if(key_exists($propname, $ExceptParams)) continue;
						$this->$propname= call_user_func($functionName,$FieldName);
						break;
					case 2:
						if($parts[1]=='id'){
							
							$propname=$parts[0];
							// Get Target Class Name
							//$clsdesc= ApplicationHelpers::GetClassAnnots(get_class($this),$DS->getProfile());
							$clsdesc = AnnotationHelper::GetClassAnnotations(get_class($this), $DS->getProfile());
							$ClientFieldValue= call_user_func($functionName,$f->getFieldName());

							if(key_exists($propname, $clsdesc['Properties']))
								if(
									key_exists(get_class(new IRInternalType(array())),
													 $clsdesc['Properties'][$propname]))
													 {
													 	$_tmp = $clsdesc['Properties'] [$propname] [get_class(new IRInternalType(array()))] ;
													 	$clsname=$_tmp->ClassName;
													 	//Get Class Name
													 	$cls = new $clsname();
													 	$cls=$cls->GetByID($ClientFieldValue);
													 	$this->$propname=$cls;
													 }
							
						} 
						break;
				}
			}
			
		}
		
	}
	public function CreateClassFromScUsingMethod($functionName,$ExceptedProperties=NULL,$ValueArray = NULL){
		$reader = new AnnotationReader();
		$methods=get_class_methods(get_class($this));

		foreach ($methods as $methodName)
		{
			//Check That Method is getter or setter else continue
			if(!(substr($methodName, 0,3)=='get' ||	substr($methodName,0,3)=='set')	) continue;
			$propname = substr($methodName, 3,strlen($methodName)-3);
			//if propname is in $ExceptedProperties jump to next property
			if(is_array($ExceptedProperties))
				if(in_array($propname, $ExceptedProperties)) continue; 
			//Get Method Annotation
			$reflMethod = new \ReflectionMethod(get_class($this), $methodName);
			$MethodAnns = $reader->getMethodAnnotations($reflMethod);
			foreach ($MethodAnns as $annots){
				if(is_a($annots,'\IRERP\Basics\Annotations\scField')){
					//if defined Annotation is scField
					//Get Value From User
					$fieldvalue = call_user_func($functionName,$annots->name,$ValueArray);
					//Try To Set To Class 
					try {
						$this->$propname = $fieldvalue;
					}
					catch (\Exception $ex)
					{
						call_user_func(array(&$this, 'set'.$propname),$fieldvalue);
					}
				}
			}
		}
	}
	
	public function GetByID($id)
	{
		return $this->getEntityManager()
					->getRepository(get_class($this))
					->find($id);
	}
	
	protected function parseObjectToArray()
	{
		return Common::parseObjectToArray($this);
	}

	protected function persistEntity()
	{
		$this->getEntityManager()->persist($this);
	}
	public function Save()
	{
		$this->persistEntity();
	}


	public function GetClassSCPropertiesInArray_Advance(DataSource $DS)
	{
		
		//if(!isset($Profile) || !isset($ClassName)) return;
		$rtnval=array();
		$propref=new \ReflectionProperty(get_class($this), 'id');
		$propref->setAccessible(true);
		$PropValue=$propref->getValue($this);
		$rtnval['id']=$PropValue;

		foreach ($DS->getFields() as $f)
		{
			
			if($f=='id') continue;
			$fieldName=$f->getFieldName();
			/*$fieldName=str_replace('_', '\\', $fieldName);
			$fieldName=urldecode($fieldName);
			if(strpos($fieldName, '\\')>-1) $fieldName=substr($fieldName, strpos($fieldName, '.')+1);
			*//*$fieldName=str_replace('.', '->', $fieldName);
			$fieldName='$this->'.$fieldName;
			print_r($fieldName.' TO EVAL . 	');
			print_r($this->Title);
			$ap='';
			$b='$this->Title';
			$a=eval($b);
			print_r('eval1='.$a);
			print_r('eval1='.$ap);
			*/
			try {
				$fieldName=\ApplicationHelpers::TranslateFieldName_From_Client2Server($fieldName);
				$parts=explode('.', $fieldName);
				$PropValue=$this;
				$propref=null;
				//print_r($fieldName.':');
				//print_r($parts);
				try{
				for ($i=0;$i<count($parts);$i++){
					$_clsname = get_class($PropValue);
					if(\ApplicationHelpers::IsORMProxyClass($_clsname)) $PropValue->DoctrineLoad();
					$propref=new \ReflectionProperty(get_class($PropValue), $parts[$i]);
					
					
				//print_r('  |  Class:'.$propref->class.' prop:'. $propref->name.'  |   ');	
				$propref->setAccessible(true);
				if(isset($PropValue))
					$PropValue=$propref->getValue($PropValue);
				else 
				{$PropValue=NULL;
				//print_r('Break at '.$parts[$i]);
				break;}
				 	/*echo gettype($PropValue);
				 	if(gettype($PropValue)=='object') echo 'Class:'.get_class($PropValue);
				 	echo '***';*/
				
				}
				}catch(\Exception $e){
					//print_r($e);
					$PropValue=NULL;
				}catch(\ReflectionException $ec){
					//print_r($e);
					$PropValue=NULL;
				}
				//print_r($PropValue);
				$rtnval[$f->getFieldName()]=$PropValue;
			} catch (Exception $e) {
				$rtnval[$f->getFieldName()]=null;
			}
		}
		return $rtnval;														
	}
	
	public function GetClassSCPropertiesInArray($ExceptedProperties=NULL){
		$rtnval=array();
		$isarray=is_array($ExceptedProperties);
		$reader=new AnnotationReader();
		$methods=get_class_methods(get_class($this));
		foreach ($methods as $methodName)
		{
			//Check That Method is getter or setter else continue
			if(!(substr($methodName, 0,3)=='get')) continue;
			$propname = substr($methodName, 3,strlen($methodName)-3);
			//if propname is in $ExceptedProperties jump to next property
			if($isarray) if(in_array($propname, $ExceptedProperties)) continue; 
			//Get Method Annotation
			$reflMethod= NULL;
			$reflMethod = new \ReflectionMethod(get_class($this), $methodName);
			$MethodAnns = $reader->getMethodAnnotations($reflMethod);
			foreach ($MethodAnns as $annots){
				if(is_a($annots,'\IRERP\Basics\Annotations\scField')){
					//if defined Annotation is scField
					//Get Value
					try{
					$rtnval[$annots->name]=	call_user_func(array(&$this, 'get'.$propname));
					}catch(\Exception $ex){}
				}
			}
		}

		
		return $rtnval;
	}

	function GetClassPropertiesinArray($ExceptedProperties)
	{
		$rtnval = array();
		$isarray=is_array($ExceptedProperties);
		$methods = get_class_methods($this);
		print_r($methods);
		foreach($methods as $m)
		{
			if(substr($m,0,3)=='get'){
				$propname=substr($m,3);
				
				if($isarray){
					//Check That propname exist in ExcepredProperties
					if(in_array($propname,$ExceptedProperties)) continue;
				}
				
				$rtnval[$propname]=call_user_method($m,$this);
			}
		}
			
		return $rtnval;
	}


	function GetClassArray()
	{
		return $this->parseObjectToArray();
	}

/*	public function __construct()
	{
		$this->dateLastModified=new \DateTime();
		$this->dateCreated=new \DateTime();
		$this->EntityManager = Yii::app()->doctrine->getEntityManager();
	}*/
public function __construct($em=NULL)
	{
		$this->dateLastModified=new \DateTime();
		$this->dateCreated=new \DateTime();
		if(isset($em))
			$this->entityManager=$em;
		else 
			$this->entityManager = \Yii::app()->doctrine->getEntityManager();
	}

	public function findAll($parameters)
	{
		$tableAlias = 'tmp';
		
		$queryBuilder = $this->EntityManager->createQueryBuilder();
		$queryBuilder->add('select', $tableAlias)
					 ->add('from', get_class($this));
		
		if(isset($parameters['startRow']))
		{
			$queryBuilder->setFirstResult($parameters['startRow']);
			if(isset($parameters['endRow']))
				$queryBuilder->setMaxResults($parameters['endRow'] - $parameters['startRow']);
		}
		
		if(isset($parameters['orderBy']))
			foreach ($parameters['orderBy'] as $key => $value)
				$queryBuilder->addOrderBy($tableAlias.'.'.$key,$value);
		
		
	}
	/**
	 * 
	 * return Correct Table Name
	 * @param string $whstr
	 * @param array $ordery
	 * @return array('TableName'=>$TableName,'OrderBy'=>$NEWorderBy,'Where'=>$NEWWhStr);
	 */
	protected function GetTableName($whstr='',$orderby=array())
	{
		$TableName=get_class($this)." tmp";
		$NEWorderBy=array();
		$NEWWhStr="";
		
		foreach ($orderby as $fn=>$st){
			
			$sparr = explode(".", $fn) ;
			if(count($sparr)>1){
				$Alias="tmp";
				$LastAlias="";
				for($i=0;$i<count($sparr)-1;$i++)
				{
					
					$_Table= $sparr[$i];
					$LastAlias=$Alias;
					$Alias.="___".$_Table;
					if(strpos($TableName, ' '.$Alias.' ')>-1)  
						continue;
					$TableName.=" JOIN ".
								$LastAlias.
								"."
								.$_Table.
								" ".
								$Alias.' ';
				}
				$NewFieldName=$Alias.".".$sparr[count($sparr)-1];
				$NEWorderBy[$NewFieldName]=$st;
			}else{
				$NEWorderBy[$fn]=$st;
			} 
		}
		//Do Same Thing For Where
		
		$wherestringparts=explode(' ', $whstr);
		foreach ($wherestringparts as $whpart){
			$sparr = explode(".", $whpart) ;
			if(count($sparr)>2){
				$Alias="tmp";
				$LastAlias="";
				for($i=1;$i<count($sparr)-1;$i++)
				{
					
					$_Table= $sparr[$i];
					$LastAlias=$Alias;
					$Alias.="__".$_Table;
					
					if(strpos($TableName, ' '.$Alias.' ')>-1)  
						continue;
					$TableName.=" JOIN ".
								$LastAlias.
								"."
								.$_Table.
								" ".
								$Alias.' ';
				}
				$NEWWhStr.=$Alias.".".$sparr[count($sparr)-1].' ';
			}else{
				$NEWWhStr.=$whpart.' ';
			} 
			
			
			
		}
		return array('TableName'=>$TableName,'OrderBy'=>$NEWorderBy,'Where'=>trim($NEWWhStr));
	}
/**
 * 
 * Enter description here ...
 * @param integer $startRow
 * @param integer $endRow
 * @param string $whstr
 * @param array $whparam
 * @param array $orderby
 * @param array $joinedTable
 * 			> array structure array('Class'=>TargetClassName,
 * 									'Prop'=>TargetProperty,
 * 									'whstr'=>WhereString,
 * 									'whparam'=>array,
 * 									'HelpField'=>array('Type'=>['Value' or 'function'],
 * 																['Value'=>Value]['function'=>function($reterivedClass)]))
 */
	public function fetchObjects($startRow=0,$endRow=100,$whstr='',$whparam=NULL,$orderby=array(),JoinTb  $joinedTable=NULL){
		

		$em = $this->entityManager;
		$GetTabNameFuncRes=$this->GetTableName($whstr,$orderby);

		$TableName	=	$GetTabNameFuncRes['TableName'];
		$orderby	=	$GetTabNameFuncRes['OrderBy'];
		$whstr		=	$GetTabNameFuncRes['Where'];
		
		
		$qb = $em->createQueryBuilder();
		if(!isset($joinedTable)){
		$qb->add('select', 'tmp')
		   ->add('from', $TableName)
		   ->setFirstResult( $startRow )
		   ->setMaxResults( $endRow-$startRow );
		}else {
			$subquery= $em->createQueryBuilder();
			$subquery
			->select('TBIDS.id')
			->from($joinedTable->getClass(),'tmp1')
			->innerJoin('tmp1.'.$joinedTable->getProp(), 'TBIDS')
			;
			$jointbwhstr = $joinedTable->getWhereString();
			$jointbwhparam = $joinedTable->getWhereParam();
			
			if(isset($jointbwhstr)) {
				$subquery->add('where',$joinedTable->getWhereString());
				if(isset($jointbwhparam)) 
					$subquery->setParameters($joinedTable->getWhereParam());
					
			$qb->add('select', 'tmp')
		   ->add('from', $TableName)
		   ->setFirstResult( $startRow )
		   ->setMaxResults( $endRow-$startRow );
		   
		   $qb->add('where','tmp.id in ('.$subquery->getDQL().')');
		   $qb->setParameters($subquery->getParameters());
			}
		}

		$tmp=0;
		foreach($orderby as $fn=>$kn)
			if($tmp==0){
					$qb->orderBy($fn,$kn);
					$tmp=1;
				}
				else
					$qb->addOrderBy($fn,$kn);
				
		if(isset($joinedTable))
		{
			if($whstr!=''){
				$qb->andWhere($whstr.' and tmp.IsDeleted = 0 ');
				if(isset($whparam)) $qb->setParameters($whparam);
			}
			else 
			{
				$qb->andWhere('tmp.IsDeleted = 0');
			}
		}else 
			if($whstr!='') {
				$qb->add('where',$whstr.' and tmp.IsDeleted = 0 ');
				 if(isset($whparam))$qb->setParameters($whparam);
			}
			else
				$qb->add('where','tmp.IsDeleted =0');
		
		$query = $qb->getQuery();
		/*if($whstr!='') {
			print_r($query);
			print_r($query->getSQL());
			die;}*/
		

//		var_dump($qb->getQuery()->getSQL());
//		var_dump($whparam);
//		var_dump($whstr); die;
		$jointbhelpfieldtype =NULL;
		if(isset($joinedTable))		$jointbhelpfieldtype = $joinedTable->getHelpFieldType();
		
		$results = $query->getResult();
		if(isset($joinedTable))
			if(isset($jointbhelpfieldtype))
				foreach($results as $r){
					switch ($joinedTable->getHelpFieldType()){
						case 'Value':
							$r->HelpField=$joinedTable->getHelpField();
							break;
						case 'function':
							/**
							 * 
							 *TODO: Complete this section for
							 *Make instance of function and call it 
							 *HelpField=function($r);
							 */
							break;
							
						
					}
						
				}

				
		//get Total Rows
		$qb1 = $em->createQueryBuilder();
	if(!isset($joinedTable)){
		$qb1->add('select', 'count(tmp.id)')
		   ->add('from', $TableName);
		}else {
			$subquery= $em->createQueryBuilder();
			$subquery
			->select('TBIDS.id')
			->from($joinedTable->getClass(),'tmp1')
			->innerJoin('tmp1.'.$joinedTable->getProp(), 'TBIDS')
			;
			$jointbwhstr = $joinedTable->getWhereString();
			$jointbwhparam = $joinedTable->getWhereParam();
			
			if(isset($jointbwhstr)) {
				$subquery->add('where',$joinedTable->getWhereString());
				if(isset($jointbwhparam)) 
					$subquery->setParameters($joinedTable->getWhereParam());
					
			$qb1->add('select', 'count(tmp.id)')
		   ->add('from',$TableName);
		   
		   $qb1->add('where','tmp.id in ('.$subquery->getDQL().')');
		   $qb1->setParameters($subquery->getParameters());
			}
		}
	if(isset($joinedTable))
		{
			if($whstr!=''){
				$qb1->andWhere($whstr.' and tmp.IsDeleted = 0 ');
				if(isset($whparam)) $qb1->setParameters($whparam);
			}
			else 
			{
				$qb1->andWhere('tmp.IsDeleted = 0');
			}
		}else 
			if($whstr!='') {
				$qb1->add('where',$whstr.' and tmp.IsDeleted = 0 ');
				 if(isset($whparam))$qb1->setParameters($whparam);
			}
			else
				$qb1->add('where','tmp.IsDeleted =0');
		$dql = $qb1->getQuery();
		
		$tmptest = $dql->getResult();
		$totalRows = $tmptest[0][1];
		
		return array('totalRows'=>$totalRows,'results'=>$results);
	}
	
	/**
	* Returns the list of attribute names.
	* By default, this method returns all public properties of the class.
	* You may override this method to change the default.
	* @return array list of attribute names. Defaults to all public properties of the class.
	*/
	public function attributeNames()
	{
		$className=get_class($this);
		if(!isset(self::$_names[$className]))
		{
			$class=new ReflectionClass(get_class($this));
			$names=array();
			foreach($class->getProperties() as $property)
			{
				$name=$property->getName();
				if($property->isPublic() && !$property->isStatic())
				$names[]=$name;
			}
			return self::$_names[$className]=$names;
		}
		else
		return self::$_names[$className];
	}
}
/***
 * Old
 * /*
function GetClassSCPropertiesInArray($ExceptedProperties=NULL)
{
$rtnval = array();
	$isarray=is_array($ExceptedProperties);
	$methods = get_class_methods($this);
	foreach($methods as $m){
		
		if(substr($m,0,5)=='scget'){
			$propname=substr($m,5);
			
			if($isarray){
				//Check That propname exist in ExcepredProperties
				if(in_array($propname,$ExceptedProperties)) continue;
			}
			
			$rtnval[$propname]= call_user_func(array(&$this, $m));
		}
	}
		
return $rtnval;
	
}

/*public function CreateClassFromScUsingMethod($functionName,$ExceptedProperties=NULL)
	{
	$isarray=is_array($ExceptedProperties);
	$methods = get_class_methods($this);
	foreach($methods as $m){
		
		if(substr($m,0,5)=='scset'){
			$propname=substr($m,5);
			
			if($isarray){
				//Check That propname exist in ExcepredProperties
				if(in_array($propname,$ExceptedProperties)) continue;
			}
			$rtn = call_user_func($functionName,$propname);
			//call_user_method($m,$this,$rtn);
			call_user_func(array(&$this, $m),$rtn);
		}
		
	}
	}
	public static function parseObjectToArray(){
	/*$object = $this;
    $array = array();
    if (is_object($object)) {
        $array = get_object_vars($object);
    }
    return $array;
}
*/
?>
