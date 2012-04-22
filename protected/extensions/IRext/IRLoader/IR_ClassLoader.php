<?php
/**
 * This Class Trye To Load IRanerp Classes 
 * all Classes That Use In IranErp Defined In IranERp Namespace
 */
class IR_ClassLoader extends CApplicationComponent
{
	function init(){
		\Yii::trace('#@! -- IRClassLoader is Initializing');
		\Yii::registerAutoloader(array($this,'LoadIRanClasses'));
		\Yii::trace('#@! -- IRClassLoader Initialized');
		parent::init();
	}
	function LoadIRanClasses($classname)
	{
		//Detect That namespce is IRERP
		$secs = explode("\\", $classname);
		if(isset($secs[0]))
			if($secs[0]=='IRERP')
			{
				$path =\Yii::app()->basePath;
			 	for($i=1;$i<count($secs);$i++)
			 		$path=$path.DIRECTORY_SEPARATOR.$secs[$i];
// 				if($secs[count($secs)-1] == '__all')
// 				{
					
// 				}
// 				else
			 		$path=$path.'.php';
			 	//\Yii::trace('#@! -- Try To Include '.$path);
			 	//Check That File Exist?
			 	if(file_exists($path)){
			 		require $path;
			 		\Yii::trace('#@! -- Request To Load '.$classname . ' --> ' . $path);
			 		return true;
			 	}
				else
				{
					\Yii::trace('#@! -- Request To Load '.$classname . ' --> Failed.');
			 		return false;
				}
			}
		return FALSE;
	}
	public function nop(){}
}
?>