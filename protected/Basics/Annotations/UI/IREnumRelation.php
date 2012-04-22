<?php
namespace IRERP\Basics\Annotations\UI;

/**
 هدف از این نشانه مشخص کردن ماهیت در روابط 
 ۱-*
 و 
 *-*
 *و تعیین آدرس دهی است که
 *jds
 *یا
 *jdsenum
 *استفاده شود
 */
/** @Annotation */
final class IREnumRelation extends IRUIAnnotation
{
	public $RelType='ENUM';
	public $ENUMFILLER_Profile="General";
	public $ENUMFILLER_Filter="";
	public function GetAddressKey()
	{
		return 'advjds';
		if($this->RelType=='ENUM') return 'jdsenum'; else return 'jds';
	}
	
}
?>