<?php
namespace IRERP\Basics\Descriptors;
use IRERP\Basics\ClientFrameWork;
class DataSource extends DescriptorBase
{
	const DataFormat_JSON='json';
	const DataFormat_XML='xml';
	
	
	
	/**
	 * 
	 * Fields
	 * @var array of DataSourceField
	 */
	protected $fields=array();
	protected $dataFormat=DataSource::DataFormat_JSON;
	protected $fetchurl='';
	protected $addurl='';
	protected $removeurl='';
	protected $updateurl='';
	protected $id='__';
	protected $DetailDS=array();
	protected $HasItsGRIDFORM=FALSE;
	protected $Profile='';
	/**
	 * 
	 * Enter description here ...
	 * @var DataSource
	 */	
	protected $ParentDataSource;
	
	// Specified Class That This DS Generated For it.
	protected $IRMClass=NULL;
	/**
	 * 
	 * Specified To Parent Class Property
	 * @var string
	 */	
	protected $ParentClassProperty=NULL;
	
	
	public function getParentDataSource(){return $this->ParentDataSource;}
	public function setParentDataSource($v){$this->ParentDataSource=$v;}
	
	public function getParentClassProperty(){return $this->ParentClassProperty;}
	public function setParentClassProperty($v){$this->ParentClassProperty=$v;}
	
	public function getIRMClass(){return $this->IRMClass;}
	public function setIRMClass($v){$this->IRMClass=$v;}
	
	public function getProfile(){return $this->Profile;}
	public function setProfile($v){$this->Profile=$v;}
	
	public function getHasItsGRIDFORM(){return $this->HasItsGRIDFORM;}
	public function setHasItsGRIDFORM($v){$this->HasItsGRIDFORM=$v;}
	
	public function getDetails(){return $this->DetailDS;}
	public function addDetail(DataSource $ds){
		for($i=0;$i<count($this->DetailDS);$i++)
		if($this->DetailDS[$i]->getID()==$ds->getID()) {
			$this->DetailDS[$i]=$ds;
//			print_r("ooooo ".$this->DetailDS[$i]->getID()." == ".$ds->getID()."ooooo <br/>");
			return ;
		}/*else 
		print_r($this->DetailDS[$i]->getID()." != ".$ds->getID()."<br/>");*/
		$this->DetailDS[]=$ds;
	}
	
	public function getFields() {return $this->fields;}
	public function addField(DataSourceField $dsf){
		//Check That Field Exists
		for($i=0;$i<count($this->fields);$i++)
			if($this->fields[$i]->getFieldName()==$dsf->getFieldName()) {
				$this->fields[$i]=$dsf;
				return;
			}
		$this->fields[]=$dsf;
	}
	public function removeField(DataSourceField $dsf){
		for($i=0;$i<count($this->fields);$i++)
		if($this->fields[$i]->getFieldName()==$dsf->getFieldName())
		{
			//TODO: Remove $i index from fields
		}
	}
	/**
	 * 
	 * Enter description here ...
	 * @param string $FieldName
	 * @return DataSourceField
	 */
	public function getField($FieldName)
	{
		foreach ($this->fields as $f) if($f->FieldName()==$FieldName) return  $f;
	}
	public function setDataFormat($DataFormat){$this->dataFormat=$DataFormat;}
	public function getDataFormat(){return $this->dataFormat;}
	
	public function getfetchURL(){return $this->fetchurl;}
	public function setfetchURL($d){$this->fetchurl=$d;}
	
	public function setaddURL($d){$this->addurl=$d;}
	public function getaddURL(){return $this->addurl;}
	
	public function setupdateURL($d){$this->updateurl=$d;}
	public function getupdateURL(){return $this->updateurl;}
	
	public function setremoveURL($d){$this->removeurl=$d;}
	public function getremoveURL(){return $this->removeurl;}
	
	public function setdataURL($d){
		$this->fetchurl=$d;
		$this->removeurl=$d;
		$this->addurl=$d;
		$this->updateurl=$d;
	}
	
	public function setID($d){$this->id=$d;}
	public function getID(){return $this->id;}
	protected function GetFieldCodes(){
		$str=$this->fields[0]->GenerateClientCode(ClientFrameWork::SmartClient);
		for($i=1;$i<count($this->fields);$i++)
			$str.=','.$this->fields[$i]->GenerateClientCode(ClientFrameWork::SmartClient);
		return $str;
	}
	//public function GetID(){return $this->getID();}
	

	public function GenerateClientCode($ClientFrameWork=ClientFrameWork::SmartClient)
	{
		switch ($ClientFrameWork)
		{
			case ClientFrameWork::SmartClient:
				$str='';
				$str='jsIRERP.RestDataSource.create({';
				$str.='ID:"'.$this->getID().'",';
				$str.='fields:[';
				$str.=$this->GetFieldCodes();
				$str.='],';
				$str.='dataFormat:"'.$this->getDataFormat().'",';
				$str.='operationBindings:[
     									{operationType:"fetch", dataProtocol:"getParams"},
     									{operationType:"add", dataProtocol:"postParams"},
     									{operationType:"remove",dataProtocol:"postParams",requestProperties:{httpMethod:"DELETE"}},
     									{operationType:"update", dataProtocol:"postParams", requestProperties:{httpMethod:"PUT"}}
									    ],';
				$str.='fetchDataURL :"'.$this->getfetchURL().'",
    					addDataURL   :"'.$this->getaddURL().'",
    					updateDataURL:"'.$this->getupdateURL().'",
    					removeDataURL:"'.$this->getremoveURL().'"';
				$str.=' ,});';
				return $str;
				break;
		}
	}
	
}
?>
