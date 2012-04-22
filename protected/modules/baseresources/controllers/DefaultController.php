<?php
class DefaultController extends IRController
{
	public function actionIndex()
	{
		$b = \IRERP\Utils\GenerationHelper::GetDataSource(get_class(new \IRERP\modules\baseresources\models\Company()), 'GENERAL');
		echo $b->GenerateClientCode();
		//$this->render('//adventity/index');
	}
	function showinherits($cls)
	{
		$a = new \ReflectionClass($cls);
		$spaces='*';
		$cname=$a->name;
		while ($cname!='')
		{
			echo $spaces. $cname.'<br/>';
			$spaces.='*';
			$a=$a->getParentClass();
			if($a!=NULL) $cname=$a->name; else $cname='';
			
		}
	}
	function showvar($em)
	{
		$clsref = new \ReflectionClass($em);
		$b=$clsref->getProperties();
		foreach ($b as $pref)
		{
			$pref->setAccessible(true);
			$v = $pref->getValue($em);
			echo $pref->name.'='.gettype($v);
			if(gettype($v)!='object') print_r($v);
			if(gettype($v)=='object') echo $this->showinherits($v);
			if(gettype($v)=='boolean') if($v==true) echo('true'); else echo ('false');
			if($pref->name=='CharacterTitle') {
				echo '<br/> ****************** <br/>';
				//$v->__load();
				$this->showvar($v);
				echo '<br/> ****************** <br/>';
			}
			
			echo '<br/>';
			
			
		}
		
		
	}
	
}
?>