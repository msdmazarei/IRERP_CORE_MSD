<?php
namespace \IRERP\Basics\Descriptors;

interface IGenerateDescriptors
{
	public function GenerateDataSource($ClientFrameWork,$Profile='General',$ParentClass=NULL);
	
	public function GenerateGrid($ClientFrameWork,$Profile='General',$ParentClass=NULL);
	
	public function GenerateForm($ClientFrameWork,$Profile='General',$ParentClass=NULL);
} 