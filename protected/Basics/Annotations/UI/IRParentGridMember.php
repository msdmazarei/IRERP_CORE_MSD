<?php 
namespace IRERP\Basics\Annotations\UI;

/**
 * زمانی که یک کلاس بعنوان عضوی در کلاس دیگری قرار می گیرد
 * در نمایش آن کلاس باید تصمیم گرفت که چه اعضایی از کلاس اول نیز باید همراه 
 * اعضای کلاس دوم نمایش داده شوند 
 * این نشانه در کلاس اول قرار می گیرد و می گوید اعضای نمایشی لازم عبارتند از 
 * اینها
 */
/** @Annotation 
 * @deprecated
 * */
final class IRParentGridMember extends IRUIAnnotation
{
	
}
?>