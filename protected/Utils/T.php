<?php
namespace IRERP\Utils;
/**
 * 
 * Translation Class
 * @author Msd.Mazarei@Gmail.com
 *
 */
class T extends UtilsBaseClass
{
	public static function T($category,$message,$params=array(),$source=null,$language=null)
	{
		return \Yii::t($category,$message,$params,$source,$language);
	}
}
?>