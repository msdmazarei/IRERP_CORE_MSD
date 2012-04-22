<?php
namespace IRERP\Basics\Annotations\UI;

/**
 * هدف از این نشانه تعریف نام سمت کلاینت  
 * برای خصوصیت است
 */
/** @Annotation */
final class IRInternalType extends IRUIAnnotation
{
	public $ClassName;
	public $RelationType; //Can Be Simple,Array
}
?>