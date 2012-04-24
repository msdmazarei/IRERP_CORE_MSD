<?php
use IRERP\modules\baseresources\models\Human;
use IRERP\modules\baseresources\models\CharacterTitle;
use IRERP\modules\baseresources\models\CharacterType;
use IRERP\modules\jahad\models\Nationality;
use IRERP\Basics\EntityController;
use IRERP\Basics\AdvanceEntityController;
use IRERP\Basics\SmartClient\SmartClientController;

class MsdtestController extends EntityController
{
	public function actionLambda()
	{
		$funcs=array();
		$funcs['func1']=function($a){return "Hello ".$a;};
		$funcs['func2']=function($a,$b){return  $a.' '.$b;};
		echo $funcs['func1']("Msoud");
		echo $funcs['func2']("Salam","Nasim");
		

	}
	
	public function actionFilldb()
	{
		//Select Nationality
		$chartype=new CharacterType();
		$chartype= $chartype->GetByID(11);
		
		$chartit = new CharacterTitle();
		$chartit= $chartit->GetByID(20);
		
		for($i=0;$i<1000;$i++){
			$b = new Human();
			$b->CharacterTitle=$chartit;
			$b->CharacterType=$chartype;
			$b->LastName="LastName".$i;
			$b->Description="Description".$i;
			$b->Name="Name".$i;
			$b->NationalCode="Nationalcode".$i;
			$b->FatherName="FatherName".$i;
			$b->Save();
			echo "$i<br/>";
			
		}
		 \Yii::app()->doctrine->getEntityManager()->flush();
	}
}
?>