<?php
namespace IRERP\Utils;

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
 



class AnnotationHelper extends HelperBaseClass
{
	/**
	 * 
	 * Get All Define Annotation in Class For Specified Profile
	 * return type is in form of:
	 * array(
	 * 'Class'=>array('Annot1'=>Annot1,...),
	 * 'Properties'=>array(
	 * 				'prop1'=>array('annot1'=>annot1,....)
	 * 				)
	 * )
	 * 
	 * @param string $ClassName
	 * @param string $Profile
	 * @return array
	 * 
	 */
	public static function GetCacheID($ClassName,$Profile)
	{
		return 'Annots_'.$ClassName.$Profile;
	}
	public static function GetClassAnnotations($ClassName,$Profile)
		{
			$rtn=ServerCacheHelper::GetFromCache(AnnotationHelper::GetCacheID($ClassName, $Profile));
			if($rtn!=NULL) return $rtn;
		
			$MainReturn=array();
			$rtn=array();
			$clsref = new \ReflectionClass($ClassName);
			$allprops = $clsref->getProperties();
			$reader=new AnnotationReader();
			$classannots=NULL;
			$classannots=$reader->getClassAnnotations($clsref);
			$okclassannot=array();
			foreach ($classannots as $clsannotspec) 
				if(AnnotationHelper::IsAnnotValid($clsannotspec, $Profile))
					$okclassannot[get_class($clsannotspec)]=$clsannotspec;
			
			//$reader->setIgnoreNotImportedAnnotations(FALSE);
			foreach ($allprops as $p)
			{
				
				$proparr=array();
				$annots = $reader->getPropertyAnnotations($p);
				foreach ($annots as $annot)
					if(AnnotationHelper::IsAnnotValid($annot, $Profile)!=NULL){
						$proparr[get_class($annot)]=$annot;
					}
				$rtn[$p->name]=$proparr;
			}
			$MainReturn['Class']=$okclassannot;
			$MainReturn['Properties']=$rtn;
			
			ServerCacheHelper::Cache(
				AnnotationHelper::GetCacheID($ClassName,$Profile),
				$MainReturn);
				
			return $MainReturn; 
		}
		
	/**
	 * 
	 * Check That spca is valid for Profile
	 * @param IRAnnotation $spca
	 * @param string $Profile
	 */
	public static function IsAnnotValid($spca , $Profile)
	{
		$pr=NULL;
		try {
		$pr=new \ReflectionProperty($spca, 'Profile');	
		} catch (\Exception $e) {
		}
		
		if(!isset($pr)) return $spca;
		$rtnval=NULL;
			if($spca->Profile==NULL){
				//Check That NotForProfile
				if($spca->NotForProfile==NULL) $rtnval=$spca;
				else 
				{
				$notfor = split(',', $spca->NotForProfile);
				//print_r((array_search('ABSTRACT', $notfor)>-1));
				if((array_search($Profile, $notfor)>-1)) $rtnval=NULL;
				else $rtnval=$spca;
				}
			}
			else 
			{
				$notfor = split(',', $spca->NotForProfile);
				if(array_search($Profile, $notfor)>-1) $rtnval=NULL;
				else $rtnval=$spca;
				
				//Check That is is in Profiles Name
				$for=split(',', $spca->Profile);
				if(array_search($Profile, $for)>-1) $rtnval=$spca;
				else $rtnval=NULL;
			}
		return $rtnval;
	}
}
?>