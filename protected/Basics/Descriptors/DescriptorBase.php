<?php
namespace IRERP\Basics\Descriptors;

class DescriptorBase
{
	const MethodName_GenDataSource='GenDataSource';
	const MethodName_GenForm='GenForm';
	const MethodName_GenGrid='GenGrid';
	const MethodName_GetDisplayField='GetDisplayField'; //function ($Profile){return array(DataSourceField,...)}
	/**
	 * 
	 * Parent Descriptor
	 * @var DescriptorBase
	 */
	protected $ParentDescriptor=NULL;
	public function getParentDescriptor(){return $this->ParentDescriptor;}
	public function setParentDescriptor($Parent){$this->ParentDescriptor=$Parent;}
	
	public function GenerateClientCode($ClientFrameWork)
	{}
	public function GetID(){}
	
}
?>