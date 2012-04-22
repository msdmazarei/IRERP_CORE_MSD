<?php
use \IRERP\Basics\EntityController,
	\IRERP\Basics\Annotations\MapModelController,
	\IRERP\models\MenuItem;

/**
 * 
 * System-level controller for main menu items
 * @author abbas
 *
 * @MapModelController("\IRERP\models\MenuItem")
 */
class MenuAdminController extends EntityController
{
	public function __construct($id, $module)
	{
		parent::__construct($id,$module);
		$this->viewVars['imageURLPrefix'] = Yii::app()->baseUrl . '/images/';
	}
}
?>
