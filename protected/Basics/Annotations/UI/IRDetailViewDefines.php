<?php 
namespace IRERP\Basics\Annotations\UI;

/**
 * هدف از این نشانه 
 * تعریف خصوصیات نمایشی روبطه ۱ به چند و چند به چند 
 * در میان کلاس هاست
 * 
 */
/** @Annotation */
final class IRDetailViewDefines extends IRUIAnnotation
{
	const TABMODEL='TAB';
	const WINMODEL='WIN';
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	public $ViewType;
	/**
	 * 
	 * Tab or window Title
	 * @var IRTitle
	 */	
	public $DetailTitle;
	
}
?>