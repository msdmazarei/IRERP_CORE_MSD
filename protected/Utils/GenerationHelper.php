<?php
namespace IRERP\Utils;

use IRERP\Basics\Annotations\UI\IRRequire;

use IRERP\Basics\Annotations\UI\IRPickListDisplayField;

use IRERP\Basics\Annotations\UI\IRInternalType;

use IRERP\Basics\Annotations\UI\IRDetailViewDefines;

use IRERP\Basics\Annotations\UI\IRCriteria;

use IRERP\Basics\Descriptors\DataSourceField;

use Doctrine\ORM\Mapping\OneToMany;

use Doctrine\ORM\Mapping\OneToOne;

use Doctrine\ORM\Mapping\ManyToMany;

use Doctrine\Common\Annotations\Annotation;
use IRERP\modules\jahad\models\Human;
use IRERP\Basics\Descriptors\DataSource;
use 
IRERP\Basics\Annotations\UI\IRUseInClientDS,
IRERP\Basics\Annotations\UI\IRClientName,
IRERP\Basics\Annotations\UI\IRTitle,
IRERP\Basics\Annotations\UI\IRPropertyType,
IRERP\Basics\Annotations\UI\IRParentGridMember,
IRERP\Basics\Annotations\UI\IRPickListMember,
IRERP\Basics\Annotations\UI\IRUseAsProfile,
IRERP\Basics\Annotations\UI\IRPrimaryKey,
IRERP\Basics\Annotations\UI\IRHidden,
IRERP\Basics\Annotations\UI\IREnumRelation
;   
use Doctrine\ORM\Mapping\ManyToOne;

use IRERP\Basics\Models\IRDataModel;
use IRERP\Basics\Descriptors;
use 
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\ORM\Mapping\ClassMetadataInfo,
    Doctrine\ORM\Mapping\MappingException;

use IRERP\Utils\AnnotationHelper;



class GenerationHelper extends HelperBaseClass 
{
	/**
	 * 
	 * Convert Server Field Name to Client 
	 * @param string $FieldName
	 */
	public static function GetClientFieldName($FieldName)
	{
		return str_replace('_', '_5F', $FieldName);
	}
	
	/**
	 * 
	 * Convert Client Side Field Name To Server
	 * @param string $FieldName
	 */
	public static function ConvertFromClientFieldName($FieldName)
	{
		$rtn=str_replace('_', '%', $FieldName);
		return urldecode($rtn);
	}
	
	/**
	 * 
	 * Convert Server Class Name To Client DS Name
	 * @param string $ClassName
	 * @param string $Profile
	 */
	public static function GetDSName_By_ClassName($ClassName,$Profile)
	{
		$rtn='';
		$rtn=str_replace('\\', '', $ClassName).'_'.$Profile;
		return $rtn;
	}
	/**
	 * 
	 * Replace \ with _5c to enable class name use in Url
	 * 
	 * @param string $ClassName
	 */
	public static function ConvertClassNameToUseInUrl($ClassName)
	{
		return str_replace('\\', '_5c', $ClassName);
	}
	
	/**
	 * 
	 * Return Standard Url To use in fetch,add,remove,... 
	 * @param string $ClassName
	 * @param string $Profile
	 * @return string
	 */
	public static function GetUrl($ClassName,$Profile)
	{
		$Address = str_replace('IRERP\\modules\\', '', $ClassName);
		$Address=str_replace('\\models', '', $Address);
		$Address=str_replace('\\', '/', $Address);
		$Address=\Yii::app()->baseUrl.'/'.$Address.'/advjds/'.$Profile.'/NONE/NONE';
		return $Address;
		
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param string $Url
	 * @param string $UrlType
	 * @param string $Profile
	 * @param string $ClassName
	 * @param string $Property
	 * @return string
	 */
	public static function ChangeUrlTail($Url,$UrlType,$Profile,$ClassName,$Property)
	{
		$urlparts = explode('/', $Url);
		$urllastpart=count($urlparts)-1;
		$urlparts[$urllastpart]=$Property;
		$urlparts[$urllastpart-1]=$ClassName;
		$urlparts[$urllastpart-2]=$Profile;
		$urlparts[$urllastpart-3]=$UrlType;
		$rtn='';
		foreach ($urlparts as $up) $rtn.=$up.'/';
		$rtn = str_replace('//', '/', $rtn);
		return $rtn;
	}
	
	public static function GetCacheName($ClassName,$Profile)
	{
		$ClassName1=str_replace('\\', '', $ClassName);
		return "DS".$ClassName1.$Profile;
	}
	/**
	 * 
	 * Get DataSource For Specified Class For Specified Profile
	 * @param string $ClassName
	 * @param string $Profile
	 * @return DataSource
	 */
	public static function GetDataSource($ClassName,$Profile)
	{
		$VarFromCache=ServerCacheHelper::GetFromCache(
						GenerationHelper::GetCacheName($ClassName, $Profile)	
					);
		if($VarFromCache!=NULL) return $VarFromCache;
		
		/**
		 * Algorithem To Generate DataSource
		 * Foreach Property in Class
		 * 	1.if Property Type is Generic
		 * 		1.1 Convert Prop To Field & set To DS
		 * 	2.if Property Type is *2O
		 * 		2.1 TT=GetPropertyTargetType(Property)
		 * 		2.2 TP=GetPropertyTargetProfile(Property)
		 * 		2.3 TF=GetPropertyTargetFillerProfile(Property) | 'General'
		 * 		2.4 TD=GetDataSource(TT,TP)
		 * 		2.5 TFD=GetDataSource(TT,TF)
		 * 		2.6 change All TD Fields Name To Property.".".FieldName & Make Their Title Correct
		 * 		2.7 Add All TD Fields To DS
		 * 		2.8 Change TFD Url & Set To /enumfiller/Profile/classname/property
		 * 		2.9 Change TFD ID to ID.'_enumfiller'
		 * 		2.10 Add TFD to Added Fields From TD to DS as HelpDataSource
		 * 
		 *  3. if Property Type is *2M
		 *  	3.1 TT=GetPropertyTargetType(Property)
		 *  	3.2 TP=GetPropertyTargetProfie(Property)
		 *  	3.3 TD=GetDataSource(TT,TP)
		 *  	3.4 Change TD ID To ID.'_'.classname.property
		 *  	3.5 TD.ParentDataSource=DS
		 *  	3.6 DS.Details Add (TD)
		 *  	3.7 TD.ParentProperty=Property
		 *  	3.8 Chnge TD Url to /advjds/Profile/classname/property
		 *  	3.9 if Relation Type Of this property is ENUM
		 *  	3.9.1 TF=GetPropertyTargetFillerProfile(Property)
		 *  	3.9.2 TFD= GetDataSource(TT,TF);
		 *  	3.9.3 add TFD To All Fields in TD as HelpDataSource
		 *  	3.9.4 add TFD as Detail To TD
		 *  	3.9.5 Change TFD ID To ID.'_EnumFiller'
		 *  	3.9.6 Change TFD Url as step 2.8
		 *  	3.10 set HasItsGRIDFORM of TD To True
		 *  End For
		 *  DS.ID=Classname.Profile
		 *  return DS
		 */
		
		
		
		$ClassAnnots = AnnotationHelper::GetClassAnnotations($ClassName, $Profile);
					/**
			 * 
			 * Final Generate DataSource
			 * @var DataSource
			 */
			$DS = new DataSource();
			//Get Property Type
			$PropertyType='GENERIC';
			$ManyToManyAnnot=new ManyToMany(array());
			$ManyToOneAnnot =new ManyToOne(array());
			$OneToOneAnnot  =new OneToOne(array());
			$OneToManyAnnot =new OneToMany(array());
			
			// All Annotation Class Instances
			$_IRClientName= new IRClientName(array());
			$_IRCriteria = new IRCriteria(array());
			$_IRDetailViewDefines = new IRDetailViewDefines(array());
			$_IREnumRelation = new IREnumRelation(array());
			$_IRHidden = new IRHidden(array());
			$_IRInternalType = new IRInternalType(array());
			$_IRParentGridMember = new IRParentGridMember(array());
			$_IRPickListDisplayField = new IRPickListDisplayField(array());
			$_IRPickListMember = new IRPickListMember(array());
			$_IRPrimaryKey = new IRPrimaryKey(array());
			$_IRPropertyType = new IRPropertyType(array());
			$_IRRequire = new IRRequire(array());
			$_IRTitle = new IRTitle(array());
			$_IRUseAsProfile = new IRUseAsProfile(array());
			$_IRUseInClientDS = new IRUseInClientDS(array());

			$_clsIRClientName= get_class($_IRClientName);
			$_clsIRCriteria = get_class($_IRCriteria);
			$_clsIRDetailViewDefines = get_class($_IRDetailViewDefines);
			$_clsIREnumRelation = get_class($_IREnumRelation );
			$_clsIRHidden = get_class($_IRHidden );
			$_clsIRInternalType = get_class($_IRInternalType );
			$_clsIRParentGridMember = get_class($_IRParentGridMember );
			$_clsIRPickListDisplayField =get_class($_IRPickListDisplayField );
			$_clsIRPickListMember =get_class($_IRPickListMember );
			$_clsIRPrimaryKey = get_class($_IRPrimaryKey );
			$_clsIRPropertyType = get_class($_IRPropertyType );
			$_clsIRRequire =get_class($_IRRequire );
			$_clsIRTitle = get_class($_IRTitle );
			$_clsIRUseAsProfile =get_class($_IRUseAsProfile );
			$_clsIRUseInClientDS =get_class($_IRUseInClientDS );
			
			//////////////////////////////////////////////
		
		foreach($ClassAnnots['Properties'] as $propname=>$propannots)
		{
			$PropertyType="GENERIC";
			if(!key_exists($_clsIRUseInClientDS, $propannots)) continue;
			if(key_exists(get_class($ManyToManyAnnot), $propannots)) $PropertyType='*2M';
			if(key_exists(get_class($OneToManyAnnot), $propannots)) $PropertyType='*2M';
			if(key_exists(get_class($OneToOneAnnot), $propannots)) $PropertyType='*2O';
			if(key_exists(get_class($ManyToOneAnnot), $propannots)) $PropertyType='*2O';
			$TT=NULL;$TP=NULL;$TF=NULL;
			/**
			 * 
			 * Contains Fields To Add To Master DS
			 * @var DataSource
			 */
			$TD=NULL;
			/**
			 * 
			 * Filler DataSource
			 * @var DataSource
			 */
			$TFD=NULL;
			$MetaClass=NULL;
			
			switch ($PropertyType)
			{
				case 'GENERIC':

					$DSField = new DataSourceField();
					$FieldName= GenerationHelper::GetClientFieldName($propname);
					$FieldTitle='';
					$FieldType='string';
					$FieldHidden=false;
					$FieldPrimaryKey = false;
					
					if(key_exists($_clsIRTitle, $propannots)) 
						$FieldTitle=$propannots[get_class($_IRTitle)]->GetTitle();
					
					
					if(key_exists($_clsIRPropertyType, $propannots))
						$FieldType=$propannots[get_class($_IRPropertyType)]->Type;
					
					
					if(key_exists($_clsIRHidden, $propannots))
						$FieldHidden=true;
					
					if(key_exists($_clsIRPrimaryKey, $propannots))
						$FieldPrimaryKey=true;
						
					if($FieldName=='id'){

						if($FieldTitle==NULL || $FieldTitle=='')
						{
							//Check That Class Has Defined IRTitle
							if(key_exists($_clsIRTitle, $ClassAnnots['Class']))
							{
								$irTitle=$ClassAnnots['Class'][$_clsIRTitle];
								$FieldTitle=$irTitle->GetTitle();
							}
							
						}
						
					}
					$DSField->setTitle($FieldTitle);
					$DSField->setFieldName($FieldName);
					$DSField->setFieldType($FieldType);
					$DSField->setHidden($FieldHidden);
					$DSField->setPrimaryKey($FieldPrimaryKey);
					$DSField->setIRMClass($ClassName);
					 $DS->addField($DSField);
					break;
				case '*2O':
					/*
			 		 * 	2.if Property Type is *2O
					 * 		2.1 TT=GetPropertyTargetType(Property)
					 * 		2.2 TP=GetPropertyTargetProfile(Property)
					 * 		2.3 TF=GetPropertyTargetFillerProfile(Property) | 'General'
					 * 		2.4 TD=GetDataSource(TT,TP)
					 * 		2.5 TFD=GetDataSource(TT,TF)
					 * 		2.6 change All TD Fields Name To Property.".".FieldName
					 * 		2.7 Add All TD Fields To DS
					 * 		2.8 Change TFD Url & Set To /enumfiller/classname/property
					 * 		2.9 Change TFD ID to ID.'_enumfiller'
					 * 		2.10 Add TFD to Added Fields From TD to DS as HelpDataSource
					 */
					// Algo:2.1 					
					if(key_exists($_clsIRInternalType, $propannots))
						$TT=$propannots[$_clsIRInternalType]->ClassName;
					else {
						// Catch TT From Doctrine Relation Defines
						$em=\Yii::app()->doctrine->getEntityManager();
						$MetaClass=$em->getClassMetadata($ClassName);
						$TT=$MetaClass->associationMappings[$propname]['targetEntity'];
					}
					
					// Algo:2.2
					if(key_exists($_clsIRUseAsProfile, $propannots)) 
						$TP=$propannots[$_clsIRUseAsProfile]->TargetProfile;
					else
						$TP='ABSTRACT';
					
					// Algo:2.3
					if(key_exists($_clsIREnumRelation, $propannots))
						$TF=$propannots[$_clsIREnumRelation]->ENUMFILLER_Profile;
					else 
						$TF=$TP;
					
					//Algo: 2.4
					$TD=GenerationHelper::GetDataSource($TT, $TP);
					//Algo: 2.5
					$TFD=GenerationHelper::GetDataSource($TT, $TF);
					//Algo: 2.6 & 2.7 & 2.10
					foreach ($TD->getFields() as $f) {
						if($f->getFieldName()!='id')
						if(key_exists($_clsIRUseAsProfile, $propannots)){
							$propUSEASPROFILE= $propannots[$_clsIRUseAsProfile];
							if(isset($propUSEASPROFILE->PrefixTitle)) $f->setTitle($propUSEASPROFILE->PrefixTitle . $f->getTitle());
							if(isset($propUSEASPROFILE->PostfixTitle)) $f->setTitle($f->getTitle() . $propUSEASPROFILE->PostfixTitle);
							if(isset($propUSEASPROFILE->ExactTitle)) $f->setTitle($propUSEASPROFILE->ExactTitle);
							
						}
						if($f->getFieldName()=='id'){
							if(key_exists($_clsIRTitle, $propannots))
							$f->setTitle($propannots[$_clsIRTitle]->GetTitle());
						}
						
						$f->setFieldName( GenerationHelper::GetClientFieldName($propname).'_2E'.$f->getFieldName());
						
						$f->setHelpDataSource($TFD);
						$DS->addField($f);
					}
					// Algo: 2.8
					$TFD->setdataURL(
						GenerationHelper::ChangeUrlTail($TFD->getfetchUrl(), 'enumfiller', $Profile, str_replace('\\', '_5c', $ClassName), $propname) 
					);
					
					// Algo: 2.9
					$TFD->setID($TFD->getID().self::GetDSName_By_ClassName($ClassName, $Profile).$propname.'_enumfiller');
					
					$DS->addDetail($TFD);
					
					break;
				case '*2M':
					/*
					 *  3. if Property Type is *2M
					 *  	3.1 TT=GetPropertyTargetType(Property)
					 *  	3.2 TP=GetPropertyTargetProfie(Property)
					 *  	3.3 TD=GetDataSource(TT,TP)
					 *  	3.4 Change TD ID To ID.'_'.classname.property
					 *  	3.5 TD.ParentDataSource=DS
					 *  	3.6 DS.Details Add (TD)
					 *  	3.7 TD.ParentProperty=Property
					 *  	3.8 Chnge TD Url to /advjds/Profile/classname/property
					 */
					// Algo : 3.1
					if(key_exists($_clsIRInternalType, $propannots))
						$TT=$propannots[$_clsIRInternalType]->ClassName;
					else {
						// Catch TT From Doctrine Relation Defines
						$em=\Yii::app()->doctrine->getEntityManager();
						$MetaClass=$em->getClassMetadata($ClassName);
						$TT=$MetaClass->associationMappings[$propname]['targetEntity'];
					}
					
					// Algo:3.2
					if(key_exists($_clsIRUseAsProfile, $propannots)) 
						$TP=$propannots[$_clsIRUseAsProfile]->TargetProfile;
					else
						$TP='ABSTRACT';
					// Algo: 3.3
					$TD = GenerationHelper::GetDataSource($TT, $TP);
					// Algo: 3.4
					$TD->setID($TD->getID().'_'.str_replace('\\', '', $ClassName).'_'.$propname);
					// Algo:3.5
					$TD->setParentDataSource($DS);
					// Algo:3.6
					$DS->addDetail($TD);
					// Algo: 3.7
					$TD->setParentClassProperty($propname);
					// Algo: 3.8
					$TD->setdataURL( 
						GenerationHelper::ChangeUrlTail($TD->getfetchUrl(), 'advjds', $Profile, GenerationHelper::ConvertClassNameToUseInUrl($ClassName) , $propname)
						);
					// Algo:3.9
					if(key_exists($_clsIREnumRelation, $propannots)){
						// Algo:3.9.1 TF=GetPropertyTargetFillerProfile(Property)
						$TF=$propannots[$_clsIREnumRelation]->ENUMFILLER_Profile;
						// Algo:3.9.2 TFD= GetDataSource(TT,TF);
						$TFD = GenerationHelper::GetDataSource($TT, $TF);
						// Algo:3.9.3 add TFD To All Fields in TD as HelpDataSource
						foreach ($TD->getFields() as $f)	
							$f->setHelpDataSource($TFD);
						// Algo:3.9.4 add TFD as Detail To TD
						$TD->addDetail($TFD);
						// Algo:3.9.5 Change TFD ID To ID.'_EnumFiller'
						$TFD->setID($TFD->getID().'_enumFiller');
						// Algo:3.9.6 Change Filler Url
						$TFD->setdataURL(
						GenerationHelper::ChangeUrlTail($TFD->getfetchUrl(), 'enumfiller', $Profile, str_replace('\\', '_5c', $ClassName), $propname) 
					);
						
					}
					// Algo:3.10 set HasItsGRIDFORM of TD To True
					$TD->setHasItsGRIDFORM(true);
					break;
			}
		}
		
		$DS->setID(GenerationHelper::GetDSName_By_ClassName($ClassName, $Profile));
		$DS->setdataURL(GenerationHelper::GetUrl($ClassName, $Profile));
		$DS->setIRMClass($ClassName);
		//Cache Variable
		ServerCacheHelper::Cache(
			GenerationHelper::GetCacheName($ClassName, $Profile),
		 	$DS);
		return $DS;
	}
}















?>