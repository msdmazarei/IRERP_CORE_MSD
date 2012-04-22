<?php

use 
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\ORM\Mapping\ClassMetadataInfo,
    
    Doctrine\ORM\Mapping\MappingException;

function parseObjectToArray($object) {
    $array = array();
    if (is_object($object)) {
        $array = get_object_vars($object);
    }
    return $array;
}

function GetSimpleDataSource($ClassName,$ExcludedProperties)
{
	$reader = new AnnotationReader();
	$reader->setDefaultAnnotationNamespace('.');

	//Get All scget functions in Class
	$result='';
	$methods = get_class_methods($ClassName);
	foreach($methods as $m) {
		if(substr($m,0,3)=='get') {
			if(is_array($ExcludedProperties)) 
			    if (in_array(substr($m,3),$ExcludedProperties)) 
			        continue;
			$result.='{';
			$relmethod = new ReflectionMethod($ClassName,$m);
			$methoddefine = $reader->getMethodAnnotations($relmethod);
			foreach($methoddefine as $annots)
    			if(is_a($annots,'scField'))
					foreach(parseObjectToArray($annots) as $k=>$v)
						if($v!=null) {
							switch($k) {
								case "canEdit":
								case "canExport":
								case "canFilter":
								case "canSave":
								case "canSortClientOnly":
								case "detail":
								case "hidden":
								case "primaryKey":
									$result.=$k.':"'.($v?"true":"false").'",';
									break;
								case "childrenProperty":
								case "childTagName":
								case "editorType":
								case "foreignKey":
								case "name":
								case "type":
								case "title":
									$result.=$k.':"'.$v.'",';
									break;
							}
						}

			$result = substr($result,0,strlen($result)-1);
			$result.='},';
		}
	}

    $result = substr($result,0,strlen($result)-1);
    $result='isc.RestDataSource.create({ID:"'.$ClassName.'",fields:['.$result.']';
    $result.='})';
    return $result;
}


function GetCompleteDataSource($ClassName,$EM) 
{
	$result ='';
	$result = GetSimpleDataSource($ClassName,null);

	//Get Related Classes
	foreach($EM->getClassMetadata($ClassName)->associationMappings as $a)
	    $result.=GetSimpleDataSource($a['targetEntity'],null);

	return $result;
} 
?>
