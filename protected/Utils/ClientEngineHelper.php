<?php
namespace IRERP\Utils;

class ClientEngineHelper extends HelperBaseClass
{
	/**
	 * @author Masoud Mazarei - Msd.Mazarei@Gmail.com
	 * return default template of views for selected clientEngine
	 */
	public static function  GetDefaultTemplate()
	{
		switch (\Yii::app()->params['clientEngine'])
		{
			case 'SmartClient':
				return '//layouts/empty';
				break;
		}
		return '';
	}
	/**
	 * @author Masoud Mazari - Msd.Mazarei@Gmail.com
	 * Convert View To View Name Spec for clientEngine
	 * @param string $View
	 */
	public static function GetViewName($View)
	{
		switch (\Yii::app()->params['clientEngine']) {
			case 'SmartClient':
				return  $View.'_SC';
			break;
			
			default:
				return $View;
			break;
		}
	}
}
?>