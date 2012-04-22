<?php
use \IRERP\Basics\Upload\FileUploader;


class  UploadController extends IRController
{

	public $layout='//layouts/upload';
	public function actionIndex()
{
	$this->render('index');
}
public function actionRemove()
{
$oldfilename=\Yii::app()->basePath.'/uploads/'.$_POST['filename'];
if(rename($oldfilename, $oldfilename.'_Deleted'))
	echo htmlspecialchars(json_encode(array('success'=>true)), ENT_NOQUOTES);
else 
	echo htmlspecialchars(json_encode(
	 array('error' => 'خطا در حذف پرونده مجدد تلاش کنید')
	), ENT_NOQUOTES);
;
	
}

public function actionUpload()
{
	
// list of valid extensions, ex. array("jpeg", "xml", "bmp")
$allowedExtensions = array();
// max file size in bytes
$sizeLimit = 10 * 1024 * 1024;

$uploader = new FileUploader($allowedExtensions, $sizeLimit);
$result = $uploader->handleUpload(\Yii::app()->basePath.'/uploads/');
// to pass data through iframe you will need to encode all html tags
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
}
}