<?php 
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
 


class ApplicationHelpers
{

		const ManyToOne= 2;
		const OneToOne=1;
		const ManyToMany=8;
		const OneToMany=4;
		
		
	public static function IsORMProxyClass($ClassName)
	{
		$nameparts = explode('\\', $ClassName);
		if(strtolower($nameparts[0])=='proxy') return true; else return false;
		
	}		
	protected static function GetClientSideClassName($ServerClassName)
	{
		return str_replace('\\', '_5c', $ServerClassName);
	}
	
	public static function GetClassAnnots($ClassName,$Profile)
	{
		$rtn=array();
		$clsref = new \ReflectionClass($ClassName);
		$allprops = $clsref->getProperties();
		$reader=new AnnotationReader();
		$reader->setIgnoreNotImportedAnnotations(FALSE);
		foreach ($allprops as $p)
		{
			$proparr=array();
			$annots = $reader->getPropertyAnnotations($p);
			foreach ($annots as $annot)
				if(ApplicationHelpers::IsAnnotValid($annot, $Profile)!=NULL){
					$proparr[get_class($annot)]=$annot;
				}
			$rtn[$p->name]=$proparr;
		}
		return $rtn; 
	}
	/**
	 * 
	 * Check That spca is valid for Profile
	 * @param IRAnnotation $spca
	 * @param string $Profile
	 */
	protected static function IsAnnotValid($spca , $Profile)
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
	  
	protected static function GetValidAnnotationUsingProfile($annots , $an,$Profile='General')
	{
		if($annots==NULL) return NULL;
		$specificAnnots =array();
		foreach ($annots as $a)
			if(is_a($a,get_class($an)))	
				$specificAnnots[]=$a;
				
		$rtnval=NULL;
		foreach ($specificAnnots as $spca)
		{
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
			
			if($rtnval!=NULL) break;
		}
		
		return $rtnval;
		
	}

	protected static function GDSD_FP_Complex_ToMany (ReflectionProperty $p,IRDataModel $Cls,$Profile,&$DS,$meta,$isuseasprofile,$annots)
	{
		if($meta->associationMappings[$p->name]['type']==ApplicationHelpers::ManyToMany 
												||
		   $meta->associationMappings[$p->name]['type']==ApplicationHelpers::OneToMany)
		{
			if($isuseasprofile==NULL) return;
				$trgcls = new \ReflectionClass($meta->associationMappings[$p->name]['targetEntity']);
				$trgcls= $trgcls->newInstance();
				$tmprtns=\ApplicationHelpers::GetDataSourceDescriptor($trgcls,$isuseasprofile->TargetProfile,$Cls,$p->name);
				
				if($tmprtns!=NULL)
				{
					//FIXME: may be to remove this line
					//if($tmprtns['DataSource']!=NULL) $DS->addDetail($tmprtns['DataSource']);
					//Add Tabs For ManyToMany Relation
					if($meta->associationMappings[$p->name]['type']==ApplicationHelpers::ManyToMany )
					{
						//Detect M2M Realtion is ENUM Or Not
						$EnumRel=\ApplicationHelpers::GetValidAnnotationUsingProfile($annots,new IREnumRelation(array()),$Profile);
						if($EnumRel==null) {$EnumRel=new IREnumRelation(array());$EnumRel->RelType="NOTENUM";}
						
						$_ds=$tmprtns['DataSource'];
						//Change DataSource id
						$_ds->setID(ApplicationHelpers::GetClientSideClassName( $p->getDeclaringClass()->getName()) .'_2E'.$p->getName()) ;
						//Change Its Address
						$url=$_ds->getfetchURL();
						$urlparts=explode('/', $url);
						$url='';
						foreach ($urlparts as $v) if($v=='advjds') break; else $url.=$v.'/';
						
						$_ds->setdataURL($url.$EnumRel->GetAddressKey().'/'.$isuseasprofile->TargetProfile.'/'.ApplicationHelpers::GetClientSideClassName(get_class($Cls)).'/'.$p->getName());
						$_ds->setHasItsGRIDFORM(true);
						$_ds->setProfile($isuseasprofile->TargetProfile);
						$_ds->setParentDataSource($DS);
						$_ds->setParentClassProperty($p->name);
						
						if($EnumRel->RelType=='ENUM')
						{
							//Generate EnumFiller DataSource
							//FIXME: it is better to seperate url addressing of fillers from other , for example we can use /ir/mo/co/enumfillers/profile/class/property 
							$enumfillerds = ApplicationHelpers::GetDataSourceDescriptor($trgcls,$EnumRel->ENUMFILLER_Profile,null,null);
							$enumfillerds['DataSource']->setParentDataSource($_ds);
							$_ds->addDetail($enumfillerds['DataSource']);
							
						}
						$DS->addDetail($_ds);
					}else $DS->addDetail($tmprtns['DataSource']);
				}
		}
	}
	protected static function GDSD_FP_Complex_ToOne (ReflectionProperty $p,IRDataModel $Cls,$Profile,&$DS,$meta,$isuseasprofile)
	{
					if($meta->associationMappings[$p->name]['type']==ApplicationHelpers::ManyToOne 
												||
					   $meta->associationMappings[$p->name]['type']==ApplicationHelpers::OneToOne)
						{
							//Check That Can We Use this Property
							//Is Defined IRUseAsProfile
							if($isuseasprofile==NULL) return;
							$trgcls = new \ReflectionClass($meta->associationMappings[$p->name]['targetEntity']);
							$trgcls= $trgcls->newInstance();
							$tmprtns=\ApplicationHelpers::GetDataSourceDescriptor($trgcls,$isuseasprofile->TargetProfile,$Cls,$p->name);

							$tmprtns['DataSource']->setParentDataSource($DS);
							$tmprtns['DataSource']->setParentClassProperty($p->name);
							
							if($tmprtns!=NULL)
							{
								if($tmprtns['Fields']!=NULL)
									foreach ($tmprtns['Fields'] as $tmpa)
									{
										
										if($isuseasprofile->PrefixTitle!=NULL) $tmpa->setTitle($isuseasprofile->PrefixTitle.$tmpa->getTitle());
										if($isuseasprofile->PostfixTitle!=NULL) $tmpa->setTitle($tmpa->getTitle().$isuseasprofile->PostfixTitle);
										//Correct Field Names
										$fieldnameprefix=ApplicationHelpers::GetClientSideClassName(get_class($trgcls));
										//$fieldnameprefix=ApplicationHelpers::GetClientSideClassName($p->getName()).'_2E'.$fieldnameprefix;
										$fname = str_replace($fieldnameprefix,ApplicationHelpers::GetClientSideClassName(get_class($Cls)).'_2E'.$p->getName(), $tmpa->getFieldName());
										//$fname=str_replace('IRERP'.$fieldnameprefix,$p->getName(), $tmpa->getFieldName());
										$tmpa->setFieldName($fname);
										$DS->addField($tmpa);
									}
								if($tmprtns['DataSource']!=NULL)
									$DS->addDetail($tmprtns['DataSource']);
							}
						}
		
		
	}
	protected static function GDSD_FP_SimpleField(ReflectionProperty $p,IRDataModel $Cls, $ParentClass,$ParentProperty='',$Profile,&$DS,$annots)
	{
		$pmeta = NULL;
		if(isset($ParentClass))
			$pmeta = $ParentClass->getEntityManager()->getClassMetadata(get_class($ParentClass));
		$Is_ToManyRelation=false;
		if(isset($ParentClass)) 
			if($pmeta->
				associationMappings
					[$ParentProperty]['type']
				==
				ApplicationHelpers::ManyToMany 
				||
			   $pmeta->
			   	associationMappings
			   		[$ParentProperty]['type']
			   	==
			   	ApplicationHelpers::OneToMany)	$Is_ToManyRelation=TRUE;
			
	//Simple Field
		$FieldType=\ApplicationHelpers::GetValidAnnotationUsingProfile($annots, new IRPropertyType(array()),$Profile);
		$FieldTitle=\ApplicationHelpers::GetValidAnnotationUsingProfile($annots, new IRTitle(array()),$Profile);
		$PrimaryKey=\ApplicationHelpers::GetValidAnnotationUsingProfile($annots, new IRPrimaryKey(array()),$Profile);
		$Hidden=\ApplicationHelpers::GetValidAnnotationUsingProfile($annots, new IRHidden(array()),$Profile);
		
		if($Is_ToManyRelation || !isset($ParentClass))
			$FieldName = $p->name;
		else 
			$FieldName=ApplicationHelpers::GetClientSideClassName(get_class($ParentClass)).'_2E'.$ParentProperty.'_2E'.$p->name;
		$__title='';
		$dsfield = new \IRERP\Basics\Descriptors\DataSourceField();
		if(isset($FieldTitle)) $__title=$FieldTitle->GetTitle($Cls,$ParentClass);
		$dsfield->setFieldName($FieldName);
		$dsfield->setFieldType($FieldType->Type);
		$dsfield->setTitle($__title);
		if(isset($Hidden)) $dsfield->setHidden(true);
		if(isset($PrimaryKey)) $dsfield->setPrimaryKey(true);
		$dsfield->setReflectionProperty($p);
		$dsfield->setIRMClass($Cls);
		$DS->addField($dsfield);
	}	
	protected static function GDSD_ForProperty(ReflectionProperty $p,IRDataModel $Cls, $ParentClass,$ParentProperty='',$Profile,&$DS)
	{
		$meta = $Cls->getEntityManager()->getClassMetadata(get_class($Cls));
		$pmeta = NULL;
		if(isset($ParentClass))
			$pmeta = $ParentClass->getEntityManager()->getClassMetadata(get_class($ParentClass));

		$reader=new AnnotationReader();
		$reader->setIgnoreNotImportedAnnotations(FALSE);
		$annots = $reader->getPropertyAnnotations($p);
		//Check That Field Can Use To ClientSide or Not
		$IRUSEINCLIENT= \ApplicationHelpers::GetValidAnnotationUsingProfile($annots, new IRUseInClientDS(array()),$Profile);
		
		
		if($IRUSEINCLIENT==NULL)return ; 	/*{			echo get_class($Cls).$p->getName().' for profile:'.$Profile.' is NULL'.'<br/>';			return ;			} else			echo get_class($Cls).$p->getName().' for profile:'.$Profile.' is '.$IRUSEINCLIENT->Profile.'<br/>';				*/
		//Check That Realtion is *One or *Many?
		$Is_ToManyRelation=false;
		if(isset($ParentClass)) 
			if($pmeta->
				associationMappings
					[$ParentProperty]['type']
				==
				ApplicationHelpers::ManyToMany 
				||
			   $pmeta->
			   	associationMappings
			   		[$ParentProperty]['type']
			   	==
			   	ApplicationHelpers::OneToMany)	$Is_ToManyRelation=TRUE;
		$IRParentGridMember= \ApplicationHelpers::GetValidAnnotationUsingProfile($annots, new IRParentGridMember(array()),$Profile);
		if($IRParentGridMember==NULL && isset($ParentClass) && (!$Is_ToManyRelation)) return;
		//Get Field Type
		$FieldType = \ApplicationHelpers::GetValidAnnotationUsingProfile($annots, new IRPropertyType(array()),$Profile);
		$isuseasprofile = \ApplicationHelpers::GetValidAnnotationUsingProfile($annots,new IRUseAsProfile(array()),$Profile);				
		if($FieldType==NULL){
			//Complex Field -- Get MetaStructure
 			//*ToOne?
			\ApplicationHelpers::GDSD_FP_Complex_ToOne($p, $Cls, $Profile, &$DS, $meta, $isuseasprofile);
			//*ToMany
			\ApplicationHelpers::GDSD_FP_Complex_ToMany($p, $Cls, $Profile, &$DS, $meta, $isuseasprofile,$annots);
		}
		else
			\ApplicationHelpers::GDSD_FP_SimpleField($p, $Cls, $ParentClass,$ParentProperty, $Profile, &$DS, $annots);
			
			
	}	
	public static function GetDataSourceDescriptor(IRDataModel $Cls,$Profile='General',IRDataModel $ParentClass=NULL,$ParentProperty='')
	{
		//Check That is There GetDataSourceDescriptor Method in $Cls
		$clsref = new \ReflectionClass($Cls);
		$clsmethod=NULL;
		try{
		$clsmethod= $clsref->getMethod('GetDataSourceDescriptor');
		}catch(Exception $ex)
		{
			$clsmethod=NULL;
		}
		if($clsmethod != NULL) 
			return $clsmethod->invoke($Cls,$Profile,$ParentClass);
		$DS = new \IRERP\Basics\Descriptors\DataSource();
		//Get All Properties
		$allprops = $clsref->getProperties();
		$reader=new AnnotationReader();
		$reader->setIgnoreNotImportedAnnotations(FALSE);
		foreach ($allprops as $p) 
		{
			//print_r("Pop:".get_class($Cls).'.'.$p->getName().'<br/>');
		ApplicationHelpers::GDSD_ForProperty($p, $Cls,$ParentClass,$ParentProperty, $Profile, &$DS);
/*		print_r('Fields added to count:'.count($DS->getFields())." FOR CLASS ".get_class($Cls)."<br/>");
		print_r('Props Are:');
		foreach($DS->getFields() as $f) print_r($f->getFieldName().',');
		print_r('<br/>');*/
		}
		$pmeta = NULL;
		if(isset($ParentClass))
			$pmeta = $ParentClass->getEntityManager()->getClassMetadata(get_class($ParentClass));
		$Is_ToManyRelation=false;
		$Is_ToOneRelation=false;
		if(isset($pmeta)) 
			if($pmeta->
				associationMappings
					[$ParentProperty]['type']
				==
				ApplicationHelpers::ManyToMany 
				||
			   $pmeta->
			   	associationMappings
			   		[$ParentProperty]['type']
			   	==
			   	ApplicationHelpers::OneToMany)	$Is_ToManyRelation=TRUE;
		if(isset($pmeta)) 
			if($pmeta->
				associationMappings
					[$ParentProperty]['type']
				==
				ApplicationHelpers::ManyToOne 
				||
			   $pmeta->
			   	associationMappings
			   		[$ParentProperty]['type']
			   	==
			   	ApplicationHelpers::OneToOne)	$Is_ToOneRelation=TRUE;
				
		
	
		//Just for * To One Relation
		if(isset($ParentClass) && $Is_ToOneRelation)
		{

			$Fields=array();
			foreach ($DS->getFields() as $__1) $Fields[]=$__1;
			//Get Standad DataSource
			$DS=\ApplicationHelpers::GetDataSourceDescriptor($Cls,'GENERAL');
			$DS=$DS['DataSource'];
			
			foreach ($Fields as $__1)
			{
				$__1->setHelpDataSource($DS);
			}
			$DS->setIRMClass($Cls);
			return array('Fields'=>$Fields,'DataSource'=>$DS);
		}
		else 
		{
		$ID = ApplicationHelpers::GetClientSideClassName(get_class($Cls));
		$DS->setID($ID);
		$Address = str_replace('IRERP\\modules\\', '', get_class($Cls));
		$Address=str_replace('\\models', '', $Address);
		$Address=str_replace('\\', '/', $Address);
		$Address=\Yii::app()->baseUrl.'/'.$Address.'/advjds/'.$Profile.'/NONE/NONE';
		$DS->setdataURL($Address);
		$DS->setProfile($Profile);
		$DS->setIRMClass($Cls);
		return array('Fields'=>NULL,'DataSource'=>$DS);
		}
	} 
	
	public static function 
	GetPropertyInTargetFor1nRelation(IRDataModel $sourceClass,
										$propname,
									 IRDataModel $targetclass)
	{
		$trgmeta = $targetclass->getEntityManager()->getClassMetadata(get_class($targetclass));
		$trgasso=$trgmeta->associationMappings;
		foreach ($trgasso as $FiledName=>$Dscriptor)
			if($Dscriptor['targetEntity']==get_class($sourceClass) &&
			$Dscriptor['inversedBy']==$propname

			) return $FiledName;
		return NULL
		;
	}
	/**
	 * 
	 * Convert Object To Array 
	 * 
	 * @param Object $object
	 */
public static function parseObjectToArray($object) {
    $array = array();
    if (is_object($object)) {
        $array = get_object_vars($object);
    }
    return $array;
}

/**
 * 
 * Translate $VarName To Doctrine Fields Using 
 * scField Annotation Defined in $ClassName
 * for scget or scset methods
 * @param string $VarName
 * @param string $ClassName
 * @param string $namespace
 */
public static function TranslateSCVarsToDoctrine($VarName,$ClassName,$namespace=NULL)
{
	return $VarName;
	//-----------------------------------------------------------------------
	$reader= new AnnotationReader();
	$methods = get_class_methods($ClassName);
	foreach ($methods as $methodName)
	{
		if
		(
			substr($methodName,0,3)=='__scget' || 
			substr($methodName,0,3)=='__scset'
		)
		{
			$reflmethod = new ReflectionMethod($ClassName, $methodName);
			$MethodAnns = $reader->getMethodAnnotations($reflmethod);
			
			foreach($MethodAnns as $annots) {
				if(is_a($annots,'\IRERP\Basics\Annotations\scField')) {
					//Check That VarName Defined in $annots
					if($annots->name==$VarName)
						return $annots->DoctrineField;
				}
			}
		}
	}
	return $VarName;
}



/**
 * A function for easily uploading files. This function will automatically generate a new 
 *        file name so that files are not overwritten.
 * Taken From: http://www.bin-co.com/php/scripts/upload_function/
 * Arguments:    $file_id- The name of the input field contianing the file.
 *                $folder    - The folder to which the file should be uploaded to - it must be writable. OPTIONAL
 *                $types    - A list of comma(,) seperated extensions that can be uploaded. If it is empty, anything goes OPTIONAL
 * Returns  : This is somewhat complicated - this function returns an array with two values...
 *                The first element is randomly generated filename to which the file was uploaded to.
 *                The second element is the status - if the upload failed, it will be 'Error : Cannot upload the file 'name.txt'.' or something like that
 */
public static function upload($file_id, $folder="", $types="") {
    if(!$_FILES[$file_id]['name']) return array('','No file specified');

    $file_title = $_FILES[$file_id]['name'];
    //Get file extension
    $ext_arr = split("\.",basename($file_title));
    $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension

    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
    $file_name = $uniqer . '_' . $file_title;//Get Unique Name

    $all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = "'".$_FILES[$file_id]['name']."' is not a valid file."; //Show error if any.
            return array('',$result);
        }
    }

    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;

    $result = '';
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : Folder don't exist.";
        } elseif(!is_writable($folder)) {
            $result .= " : Folder not writable.";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : File not writable.";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result = "Empty file found - please use a valid file."; //Show the error message
        } else {
            chmod($uploadfile,0777);//Make it universally writable.
        }
    }

    return array($file_name,$result);
}


public static function mime_content_type($filename) {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }
    
    /**
     * 
     * 
     * 
     * 
     * Get All Property Has Specified Annotations & Profile
     * @param IRDataModel $Cls
     * @param array $SpecAnnot_Profile, array like array(array(annot,profile),array(annot,profile),..)
     * @deprecated
     */
    public static function GetAllPropSpecAnnot
    (IRDataModel $Cls,array $SpecAnnot_Profile)
    {
    	$rtn=array();
    	$clsref = new \ReflectionClass($Cls);
		$allprops = $clsref->getProperties();
		$reader=new AnnotationReader();
		$reader->setIgnoreNotImportedAnnotations(FALSE);
		foreach ($allprops as $p) 
		{
			$ValidProperty=true;
			$annots=$reader->getPropertyAnnotations($p);
			foreach($SpecAnnot_Profile as $spcanpr)
			{
				$_profile=$spcanpr[1];
				$_annots=$spcanpr[0];
				$_find=ApplicationHelpers::GetValidAnnotationUsingProfile($annots, $_annots,$_profile);
				if(isset($_find)) if($_find->Profile==$_profile) $_find=true; else $_find=false; else $_find=false;
				print_r($_find.' For ');
				print_r($_annots);
				$ValidProperty= $ValidProperty & $_find;
			}
			if($ValidProperty) $rtn[]=$p;
		}
		return $rtn;
    }

    public static function TranslateFieldName_From_Client2Server($ClientFieldName,$ClassName=NULL)
    {
    	//FIXME: when $ClassName Passed To function , it needs to search all property in function to find IRUseInClient(ClientName="PCName")
    	return urldecode(str_replace('_', '%', $ClientFieldName));
    }
    
    public static function GetMetaClass($ClassName)
    {
    	\Yii::app()->doctrine->getEntityManager()->getClassMetadata($ClassName);
    }
    public static function getEntityProfileFromUrl($ControllerUniqeId)
    {
    	$totalurl = \Yii::app()->getRequest()->getUrl();
		$questionmark=strpos($totalurl, '?');
		if($questionmark==NULL) $questionmark = strlen($totalurl);
		$totalurl= substr($totalurl, 0,$questionmark);
		
		$currentcontrollerAddress = \Yii::app()->getRequest()->getBaseUrl().'/'.$ControllerUniqeId;
		$aUrl = split('/', $totalurl);
		$aController= split('/', $currentcontrollerAddress);
		
		$jdsindex=count($aController);
		$typ = $aUrl[$jdsindex];
		if($typ!='advjds') return;
		$Profile='';
		$ParentClass='';
		$ParentProperty='';
		try {
		$Profile=$aUrl[$jdsindex+1];
		return $Profile;
		$ParentClass=$aUrl[$jdsindex+2];
		$ParentProperty=$aUrl[$jdsindex+3];	
		} catch (\Exception $e) {
			//TODO: Make Below Better.
			print_r($e);
			return;
		}
    }
    
}



?>