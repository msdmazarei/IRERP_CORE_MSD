<?php
use IRERP\Basics\Annotations\UI\IREnumRelation;
use IRERP\modules\jahad\models\Matter;
use IRERP\modules\jahad\models;
use IRERP\Utils\T;


class DefaultController extends IRController
{
	public function actionIndex()
	{
		$b="function(){return IRERP\\Utils\\T::T('IRERP','msd');}";
		$c= eval($b);
		echo $c;
		die;
		\Yii::app()->ir_ClassLoader->nop();
		$b = new Matter();
		$this->render('index');
	}
}