<?php
namespace IRERP\Basics\Validation;
class ModelValidationReturnClass
{
	public $Success=FALSE;
	public $Exception="";
	
	public function getSuccess(){return $this->Success;}
	public function setSuccess($v){$this->Success=$v;}
	
	public function getException(){return $this->Exception;}
	public function setException($v){$this->Exception=$v;}
	
}
?>