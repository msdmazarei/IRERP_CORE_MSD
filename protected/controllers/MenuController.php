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
class MenuController extends EntityController
{
	public function __construct($id, $module)
	{
		parent::__construct($id,$module);
		$this->viewVars['imageURLPrefix'] = Yii::app()->baseUrl . '/images/';
	}
	
	public function actionAdmin()
	{
		if ($this->getIsGetRequest())
			$this->renderView('//entity/index');
	}

	public function actionMenuData()
	{
				
	}
}
?>
