<?php
namespace IRERP\Basics\Annotations\UI;

/**
 * این نشانه مشخص می کند که خصوصیت در 
 * تولید داده های کلایت استفاده می شود
 */
/** @Annotation */
final class IRUseInClientDS extends IRUIAnnotation
{
	/**
	 * 
	 * Inicates That This Property Use In Form
	 * @var bool
	 */
	public $ShowInForm=true;
	/**
	 * 
	 * Inicates That This Property Show In Grid
	 * @var bool
	 */
	public $ShowInGrid=true;
}
?>