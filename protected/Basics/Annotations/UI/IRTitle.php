<?php 
namespace IRERP\Basics\Annotations\UI;
use IRERP\Utils\T;

/**
 * هدف از این نشانه تعریف عنوان 
 * برای خصوصیت است
 */
/** @Annotation */
final class IRTitle extends IRUIAnnotation
{
	 
	/**
	 * 
	 * نوعی که بیان کننده عنوان است را در خود دارد. که می تواند رشته 
	 * و یا تابع باشد
	 * @var ENUM {'STRING'|'FUNCTION'|'TRANS'}
	 */
	public $TitleType;
	
	/**
	 * 
	 * در صورتی که نوع تعریف شده برای عنوان رشته باشد حاوی رشته است
	 * در صورتی که تابع باشد آرایه ای است که حاوی شی و نام تابع است
	 * array($obj,$MethodName)
	 * @var mixed
	 */
	public $Value;
	
	/**
	 * 
	 * در صورتی که نوع عنوان تابع باشد پارامترهای لازم را
	 * در قالب آرایه در این متغییر قرار می دهیم
	 * @var array
	 */
	public $Params;
	
	public $TransCat;
	public $TransMsg;
	public function GetTitle($C=NULL,$P=NULL)
	{
		if($this->TitleType=='STRING') return $this->Value;
		if($this->TitleType=='TRANS'){
			if(!isset($this->Params)) $this->Params=array();
			return T::T($this->TransCat,$this->TransMsg,$this->Params);
			
		}
		
	}
}
?>