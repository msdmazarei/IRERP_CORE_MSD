<?php
use IRERP\Basics\Annotations\UI\IREnumRelation;
use IRERP\modules\jahad\models\Matter;
use IRERP\modules\jahad\models;
use IRERP\Utils\T;


class DefaultController extends IRController
{
	public function actionIndex()
	{
		$b="";
		eval("\$b=IRERP\\Utils\\T::T('IRERP','msd');");
		echo $b;
		die;
		\Yii::app()->ir_ClassLoader->nop();
		$b = new Matter();
		$this->render('index');
	}
}