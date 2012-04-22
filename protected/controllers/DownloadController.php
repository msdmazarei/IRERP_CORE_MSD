<?php

class  DownloadController extends IRController
{
public function actionIndex()
{
		
		$totalurl = \Yii::app()->getRequest()->getUrl();
		$questionmark=strpos($totalurl, '?');
		if($questionmark==NULL) $questionmark = strlen($totalurl);
		$totalurl= substr($totalurl, 0,$questionmark);
		
		$currentcontrollerAddress = \Yii::app()->getRequest()->getBaseUrl().'/'.$this->getUniqueId();
		$aUrl = split('/', $totalurl);
		$aController= split('/', $currentcontrollerAddress);
		$fileaddressIndex=count($aController);
		$fileaddress='';
		for($i=$fileaddressIndex;$i<count($aUrl);$i++)
		{
			$fileaddress.='/'.$aUrl[$i];
			
		}
		$fileaddress=\Yii::app()->basePath.'/uploads'.$fileaddress;
		if(file_exists($fileaddress)){
			$mimetype=\ApplicationHelpers::mime_content_type($fileaddress);
			//Send File To Client
			  header("Content-type: $mimetype");
			  readfile($fileaddress);
		
		}
		
		
}	

public function actionSaveToClient()
{
$totalurl = \Yii::app()->getRequest()->getUrl();
		$questionmark=strpos($totalurl, '?');
		if($questionmark==NULL) $questionmark = strlen($totalurl);
		$totalurl= substr($totalurl, 0,$questionmark);
		
		$currentcontrollerAddress = \Yii::app()->getRequest()->getBaseUrl().'/'.$this->getUniqueId();
		$aUrl = split('/', $totalurl);
		$aController= split('/', $currentcontrollerAddress);
		$fileaddressIndex=count($aController)+1;
		$fileaddress='';
		for($i=$fileaddressIndex;$i<count($aUrl);$i++)
		{
			$fileaddress.='/'.$aUrl[$i];
			
		}
		$fileaddress=\Yii::app()->basePath.'/uploads'.$fileaddress;
		if(file_exists($fileaddress)){
			$mimetype=\ApplicationHelpers::mime_content_type($fileaddress);
			//Send File To Client
			$filename=pathinfo($fileaddress);
			
			$filename=$filename['basename'];
		   header("Content-disposition: attachment;filename=$filename");
 			  readfile($fileaddress);
		
		}
}

}
?>