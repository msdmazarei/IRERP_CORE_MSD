<?php
namespace IRERP\Basics\Descriptors;
use IRERP\Basics\Annotations\UI\IREnumRelation;

use IRERP\Basics\ClientFrameWork;
use IRERP\Basics\Models\IRDataModel;
class DynamicForm extends DescriptorBase
{
	/**
	 * 
	 * Enter description here ...
	 * @var DataSource
	 */
	protected $DataSource=NULL;
	/**
	 * 
	 * Enter description here ...
	 * @var DynamicFormField[]
	 */
	protected $Fields=array();
	private $StructureIsReady=false;
	
	public function GetID(){return 'FRM'.$this->DataSource->GetID();}
	public function __construct(DataSource $DS,DescriptorBase $Parent=NULL)
	{
		$this->DataSource=$DS;
		if(isset($this->DataSource)) $this->MakeStructure();
		$this->setParentDescriptor($Parent);
	}
	
	public function getFields(){return $this->Fields;}
	public function setFields($v){$this->Fields=$v;}
	
	public function getDataSource(){return $this->DataSource;}
	public function setDataSource($v){$this->DataSource=$v;}
	
	protected function MakeStructure()
	{
		
		if($this->StructureIsReady) return;
		if(!isset($this->DataSource)) $this->Fields=array();
		//Check for Detail Form 
		if($this->DataSource->getParentDataSource()!=null)  //there is parent datasource
			if($this->DataSource->getParentClassProperty()) //there is parent property 
			{
				
				$clsdesc=\ApplicationHelpers::GetClassAnnots($this->DataSource->getParentDataSource()->getIRMClass(),
															 $this->DataSource->getParentDataSource()->getProfile());
				//Check That Property is Defined as ENUM
				if(isset($clsdesc[$this->DataSource->getParentClassProperty()][get_class(new IREnumRelation(array()))]))
				{
					
					
					/**
					 * 
					 * Specified to id field
					 * @var DataSourceField
					 */
					$idfield=NULL;
					foreach ($this->DataSource->getFields() as $dsf) 
						if($dsf->getFieldName()=='id') {
							$idfield=$dsf;
						$idfield->setHideInForm(FALSE);
					$ddd=$this->DataSource->getDetails();
					$idfield->setHelpDataSource($ddd[0]);
					$dynfield=new DynamicFormField($idfield);
					$dynfield->setShowInForm(true);
					$this->Fields[]=$dynfield;
						}
						else {
								$idfield=$dsf;
						$idfield->setHideInForm(true);
					
					$dynfield=new DynamicFormField($idfield);
					$dynfield->setShowInForm(false);
					$this->Fields[]=$dynfield;
							
							
						}
					
					//print_r($dynfield->GenerateClientCode(ClientFrameWork::SmartClient));
					return ;
				}
			}
		//FIXME: Use $this->DataSource->getIRMClass() to generate Fields if possible(DataSource's Class use to generate FormFields)
		foreach($this->DataSource->getFields() as $dsfield)
		{
			$dynfrmfield= new DynamicFormField($dsfield);
			$dynfrmfield->setShowInForm(false);
			//Check that dfField Belongs to DataSource->IRMClass or not
			if($this->DataSource->getIRMClass()==$dsfield->getIRMClass())
				if($dsfield->getFieldName()!='id')	
					$dynfrmfield->setShowInForm(true);
			//Check For 1-1 Relation And Just For id Property
			$_strsplited=explode('_2E',$dsfield->getFieldName());
			if(count($_strsplited)==2) if($_strsplited[1]=='id') $dynfrmfield->setShowInForm(true);
			
			$this->Fields[]=$dynfrmfield;
		}
		$this->StructureIsReady=true;
	}
	
	public function ClearStructure(){$this->StructureIsReady=false;}
	
	public function GenerateClientCode($ClientFrameWork)
	{
		switch ($ClientFrameWork)
		{
			case ClientFrameWork::SmartClient:
				$rtn='';
				// $rtn=  numCols:2,	    ,	    ,	    HelpField:1,";
				$rtn.='jsIRERP.DynamicForm.create({';
				$rtn.='ID:"FRM'.$this->DataSource->getID().'"';
				$rtn.=',dataSource:"'.$this->DataSource->getID().'"';
				$rtn.=',numCols:5';
				$rtn.=',useAllDataSourceFields:true';
				$rtn.=',defaultLayoutAlign: "right"';
				$rtn.=',HelpField:1';
				$rtn.=', fields:[';
				foreach ($this->Fields as $f) {
					$rtn.=$f->GenerateClientCode($ClientFrameWork).','
					;
				}
				$rtn.=']});';
				return $rtn;
				break;
		}
	}
}
?>