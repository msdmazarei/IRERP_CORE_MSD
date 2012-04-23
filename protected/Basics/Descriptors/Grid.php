<?php
namespace IRERP\Basics\Descriptors;
use IRERP\Basics\ClientFrameWork;
use IRERP\Basics\Models\IRDataModel;
use IRERP\Basics\Descriptors\DataSource;
class Grid extends DescriptorBase
{
	/**
	 * 
	 * Enter description here ...
	 * @var DataSource
	 */
	protected $DataSource=NULL;
	
	public function __construct(DataSource $DS,DescriptorBase $Parent=NULL)
	{
		$this->DataSource=$DS;
		$this->setParentDescriptor($Parent);
	}
	public function GetID(){return 'GRD'.$this->DataSource->GetID();}
	public function GenerateClientCode($ClientFrameWork)
	{

		switch ($ClientFrameWork)
		{
			case ClientFrameWork::SmartClient:
				$rtn='';
				$rtn.='jsIRERP.ListGrid.create({';
				$rtn.="showFilterEditor: true,";
				$rtn.=" allowFilterExpressions: true,";
				$rtn.="ID: \"GRD".$this->DataSource->getID()."\",";
			    $rtn.="width:\"100%\", height:\"100%\", alternateRecordStyles:true,";
			    $rtn.="autoFetchData: true,";
			    $rtn.="dataSource: ".$this->DataSource->getID().",";
			    $rtn.="recordClick:function(){this.IRERPPage.EventManager('OnGridRecordClick',this,this.IRERPDVS);},";
			    $rtn.="recordDoubleClick:function(){this.IRERPPage.EventManager('OnGridRecordDblClick',this,this.IRERPDVS);},";
			    $rtn.="});";
			    return $rtn;
				break;
		}
	}
}
?>