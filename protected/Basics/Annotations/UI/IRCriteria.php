<?php 
namespace IRERP\Basics\Annotations\UI;

/**
 * هدف از این نشانه تعریف نام سمت کلاینت  
 * برای خصوصیت است
 */
/** @Annotation */
final class IRCriteria extends IRUIAnnotation
{
	public $Criteria;
	
	public function GetCompiledCriteria()
	{
		
	}
}
?>