<?php
namespace IRERP\Basics\Descriptors;
use IRERP\Basics\Annotations\UI\IRPickListDisplayField;
use IRERP\Basics\Annotations\UI\IRUseInClientDS;
use Doctrine\ORM\Query\AST\Functions\UpperFunction;
use IRERP\Basics\Descriptors\DescriptorBase;
use IRERP\Basics\ClientFrameWork;
class DynamicFormField extends DescriptorBase
{
	protected $DsField;
	protected $ShowInForm;
	protected $IsPickList;
	protected $PickListFields= array();
	protected $Validation=NULL;
	protected $DisplayField=NULL; // mixed type : string or array(ReflectionProperty,ReflectionProperty,...)
	public function __construct(DataSourceField $dsField,DescriptorBase $Parent=NULL)
	{
		$this->DsField=$dsField;
		if(isset($this->DsField)) $this->CompletePropsFromDsField();
		$this->setParentDescriptor($Parent);
	}
	
	protected  function CompletePropsFromDsField()
	{
		$__r1=$this->DsField->getHelpDataSource();
		if(isset($__r1)) $this->IsPickList=true; else $this->IsPickList=false;
		if($this->IsPickList){
		$this->PickListFields=$this->DsField->getHelpDataSource()->getFields();
		//Get DisplayField
			//Check that DS's Class has any Configuration for Get DisplayField For Specified Profile
			$PicklistDataSource=$this->DsField->getHelpDataSource();
			$Picklist_Class = $PicklistDataSource->getIRMClass();
			$Picklist_Class = new $Picklist_Class ;
			$Picklist_Class_Profile= $PicklistDataSource->getProfile();
			$DisplayFieldMethodName=NULL;
			$genconf=$Picklist_Class->getGeneralConfiguration();
			if(isset($genconf))	
				if(isset($genconf[DescriptorBase::MethodName_GetDisplayField])) 
					$DisplayFieldMethodName=$genconf[DescriptorBase::MethodName_GetDisplayField];
			$DispFieldSetSuccessfully=false;
			if(isset($DisplayFieldMethodName))
				try {
					$refmethod= new \ReflectionMethod($Picklist_Class, $DisplayFieldMethodName);
					$this->setDisplayField(
						$refmethod->
							invoke($Picklist_Class, $Picklist_Class_Profile)
					);
					$DispFieldSetSuccessfully=true;
				} catch (\Exception $e) {
				}
			if(!$DispFieldSetSuccessfully){
				//Get Display Field Annotations
				$this->DisplayField='';
				$clsdecr=\ApplicationHelpers::GetClassAnnots($Picklist_Class, $Picklist_Class_Profile);
				foreach ($clsdecr as $pname=>$pannots)
					if(isset($clsdecr[$pname][get_class(new IRPickListDisplayField(array()))])) $this->DisplayField.=$pname;
									
				
			}
		}
			
	}
	
	public function getDataSourceField(){return $this->DsField;}
	public function setDataSourceField($v){$this->DsField=$v;}
	
	public function getShowInForm(){return $this->ShowInForm;}
	public function setShowInForm($v){return $this->ShowInForm=$v;} 
	
	public function getDisplayField(){return $this->DisplayField;}
	public function setDisplayField($v){return $this->DisplayField=$v;} 
	
	
	public function getIsPickList(){return $this->IsPickList;}
	public function setIsPickList($v){return $this->IsPickList=$v;}

	public function getPickListFields(){return $this->PickListFields;}
	public function setPickListFields($v){return $this->PickListFields=$v;}
	
	public function getValidation(){return $this->Validation;}
	public function setValidation($v){return $this->Validation=$v;}
	
	public function GenerateClientCode($ClientFrameWork)
	{
		switch ($ClientFrameWork)
		{
			case ClientFrameWork::SmartClient:
				$rtn='{';
				$rtn.='name:"'.$this->getDataSourceField()->getFieldName().'"';
				if(!$this->ShowInForm) return $rtn.',hidden:true}'; 
				if($this->IsPickList)
				{
					$rtn.=',hidden:false,editorType:"SelectItem"';
					$rtn.=',optionDataSource:"'.$this->getDataSourceField()->getHelpDataSource()->getID().'"';
					$rtn.=',displayField:"'.$this->DisplayField.'"';//FIXME: What is displayField
					$rtn.=',valueField:"id"';
					$rtn.=',pickListProperties: {showFilterEditor:true}';
					$rtn.=',pickListFields: [';
					$_Fields = $this->getDataSourceField()->getHelpDataSource()->getFields();
					foreach($_Fields as $f) if($f->getFieldName()!='id') $rtn.='{name:"'.$f->getFieldName().'"},';
					$rtn.=']}';
					return $rtn;
				}
				switch( $this->getDataSourceField()->getFieldType())
				{
					case "string":
					case "str":
						break;
					case "integer":
					case "int":
						break;
					case "double":
					case "dbl":
						break;
					case "date":
						break;
					case "file":
						break;
						
				}
				$rtn.=',title:"'.$this->getDataSourceField()->getTitle().'"';
				if($this->ShowInForm) $rtn.=',hidden:false';
				$rtn.='}';
				return $rtn;
			    break;
		}
	}
	
	
}
?>