<?php
namespace IRERP\Basics\Descriptors;

use IRERP\Basics\Descriptors\Grid;
use IRERP\Basics\Descriptors\DynamicForm;
use IRERP\Basics\Descriptors\DataSource;
use IRERP\Basics\ClientFrameWork;

use IRERP\Basics\Descriptors\DescriptorBase;
class DataViewSection extends DescriptorBase
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
	 * @var DynamicForm
	 */
	protected $FORM=NULL;
	/**
	 * 
	 * Enter description here ...
	 * @var Grid
	 */
	protected $GRID=NULL;

	public function getPage(){return  $this->Page;}
	public function getDataSource(){return $this->DataSource;}
	
	
	public function __construct(DataSource $DS,DescriptorBase $Parent=NULL)
	{
		$this->DataSource=$DS;
		$this->setParentDescriptor($Parent);
		$this->MakeReady();
	}
	
	protected function MakeReady()
	{
		if(!isset($this->DataSource)) return ;
		$this->FORM= new DynamicForm($this->DataSource,$this);
		$this->GRID=new Grid($this->DataSource,$this);
		
	}
	public function GetID(){return 'SEC'.$this->DataSource->GetID();}
	public function getClientDVS(){return 'DVS_'.$this->GetID();}
	public function GenerateClientCode($ClientFrameWork)
	{
		switch ($ClientFrameWork)
		{
			case ClientFrameWork::SmartClient:
				$DVSID=$this->getClientDVS();
				$FORMID=$this->FORM->GetID();
				$GRIDID=$this->GRID->GetID();
				$SECID=$this->GetID();
				$rtnval='var '.$DVSID.'= new IRERPJS_DataViewSection(\''.$DVSID.'\');';
				$rtnval.= $this->FORM->GenerateClientCode($ClientFrameWork);
				$rtnval.= $this->GRID->GenerateClientCode($ClientFrameWork);
				$rtnval.= $DVSID.'.setFormId("'.$this->FORM->GetID().'");';
				$rtnval.= $DVSID.'.setGridId("'.$this->GRID->GetID().'");';
				
				$BTNID="btnNew_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",prompt:\"جدید\",IRERPDVS:$DVSID/*function(){EnableForm($FORMID);btnSave_$SECID.enable();btnNew_$SECID.disable();btnEdit_$SECID.disable();btnDelete_$SECID.disable();$FORMID.editNewRecord();}*/});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnNEWCommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconNew());";
				$rtnval.="$DVSID.addNEWCommander($BTNID);";
				
				$BTNID="btnSave_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",IRERPDVS:$DVSID,prompt:\"ذخیره\", disabled:true,/*click:function(){DisableForm($FORMID);SaveFormDetail($FORMID);btnSave_$SECID.disable();btnNew_$SECID.enable();btnEdit_$SECID.enable();btnDelete_$SECID.enable();}*/});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnSAVECommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconSave());";
				$rtnval.="$DVSID.addSAVECommander($BTNID);";
				
				$BTNID="btnEdit_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",IRERPDVS:$DVSID,prompt:\"ویرایش\",  icon: $DVSID.getIconEdit(),click:function(){EnableForm($FORMID);btnSave_$SECID.enable();btnNew_$SECID.disable();btnEdit_$SECID.disable();btnDelete_$SECID.disable();}});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnEDITCommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconEdit());";
				$rtnval.="$DVSID.addEDITCommander($BTNID);";
				
				$BTNID="btnDelete_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",IRERPDVS:$DVSID,prompt:\"حذف\",  icon: $DVSID.getIconDelete(),click:function(){";
				$rtnval.="ShowDialog(";
				$rtnval.="'اخطار حذف',";
				$rtnval.="'آیا از حذف مورد انتخاب شده اطمینان دارید؟',";
				$rtnval.="'بله',";
				$rtnval.="'خیر',";
				$rtnval.="'DeleteForm',$FORMID,$GRIDID";
				$rtnval.="            );	}});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnDELETECommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconDelete());";
				$rtnval.="$DVSID.addDELETECommander($BTNID);";
				
				$BTNID="btnCancel_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",IRERPDVS:$DVSID,prompt:\"انصراف\",  icon: icon_Cancel,click:function(){DisableForm($FORMID);btnNew_$SECID.enable();btnEdit_$SECID.enable();btnSave_$SECID.disable();btnDelete_$SECID.enable();}});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnCANCELCommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconCancel());";
				$rtnval.="$DVSID.addCANCELCommander($BTNID);";
				
				
				$BTNID="btnRefresh_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",IRERPDVS:$DVSID,prompt:\"بارگزاری مجدد\",});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnRefreshCommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconRefresh());";
				

				$OPE="Download";
				$BTNID="btn".$OPE."_$SECID";
				$CAPTION="دانلود";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				$OPE="Upload";
				$BTNID="btn".$OPE."_$SECID";
				$CAPTION="بارگذاری";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";

				$OPE="Comments";
				$BTNID="btn".$OPE."_$SECID";
				$CAPTION="یادداشتها";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				$OPE="Print";
				$BTNID="btn".$OPE."_$SECID";
				$CAPTION="چاپ";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				

				$OPE="Last";
				$BTNID="btn".$OPE."_$SECID";
				$CAPTION="آخرین رکورد";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				$OPE="Next";
				$BTNID="btn".$OPE."_$SECID";
				$CAPTION="رکورد بعدی";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				$OPE="Previous";
				$BTNID="btn".$OPE."_$SECID";
				$CAPTION="رکورد قبلی";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				$OPE="First";
				$BTNID="btn".$OPE."_$SECID";
				$CAPTION="اولین رکورد";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				
				$rtnval.="	jsIRERP.ToolStrip.create({	    
				width: \"100%\",
				height:32,
				ID:\"Toolstrip$SECID\",
				   members: [btnNew_$SECID,";
				$rtnval.="   btnEdit_$SECID,";
				$rtnval.="   btnDelete_$SECID,\"separator\",";
				$rtnval.="   btnSave_$SECID,";
				$rtnval.="   btnCancel_$SECID,
							\"separator\",
							 btnRefresh_$SECID,
							\"separator\",
							 btnDownload_$SECID,
							 btnUpload_$SECID,
							\"separator\",
							 btnComments_$SECID,
							 btnPrint_$SECID,
							\"separator\",
							 btnLast_$SECID,
							 btnNext_$SECID,
							 btnPrevious_$SECID,
							 btnFirst_$SECID
							]	});";
				
				
				/************************************************
				 * Create Window which contain Form
				 * WindowForm ToolStrip Buttons 
				 */
				$BTNID="btnWINFORMNew_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",IRERPDVS:$DVSID,prompt:\"جدید\"});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnNEWCommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconNew());";
				$rtnval.="$DVSID.addNEWCommander($BTNID);";
				
				$BTNID="btnWINFORMSave_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",IRERPDVS:$DVSID,prompt:\"ذخیره\", disabled:true});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnSAVECommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconSave());";
				$rtnval.="$DVSID.addSAVECommander($BTNID);";
				
				$BTNID="btnWINFORMEdit_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",IRERPDVS:$DVSID,prompt:\"ویرایش\"});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnEDITCommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconEdit());";
				$rtnval.="$DVSID.addEDITCommander($BTNID);";
				
				$BTNID="btnWINFORMDelete_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",IRERPDVS:$DVSID,prompt:\"حذف\",click:function(){";
				$rtnval.="ShowDialog(";
				$rtnval.="'اخطار حذف',";
				$rtnval.="'آیا از حذف مورد انتخاب شده اطمینان دارید؟',";
				$rtnval.="'بله',";
				$rtnval.="'خیر',";
				$rtnval.="'DeleteForm',$FORMID,$GRIDID";
				$rtnval.="            );	}});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnDELETECommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconDelete());";
				$rtnval.="$DVSID.addDELETECommander($BTNID);";
				
				$BTNID="btnWINFORMCancel_$SECID";
				$rtnval.="jsIRERP.ToolStripButton.create({ID:\"$BTNID\",IRERPDVS:$DVSID,prompt:\"انصراف\"});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('OnCANCELCommand',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIconCancel());";
				$rtnval.="$DVSID.addCANCELCommander($BTNID);";

				$OPE="Comments";
				$BTNID="btnWINFORM".$OPE."_$SECID";
				$CAPTION="یادداشتها";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				$OPE="Print";
				$BTNID="btnWINFORM".$OPE."_$SECID";
				$CAPTION="چاپ";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				

				$OPE="Last";
				$BTNID="btnWINFORM".$OPE."_$SECID";
				$CAPTION="آخرین رکورد";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				$OPE="Next";
				$BTNID="btnWINFORM".$OPE."_$SECID";
				$CAPTION="رکورد بعدی";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				$OPE="Previous";
				$BTNID="btnWINFORM".$OPE."_$SECID";
				$CAPTION="رکورد قبلی";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				$OPE="First";
				$BTNID="btnWINFORM".$OPE."_$SECID";
				$CAPTION="اولین رکورد";
				$rtnval.="jsIRERP.ToolStripButton.create({
													ID:\"$BTNID\",
													IRERPDVS:$DVSID,
													prompt:\"$CAPTION\", 
													icon: $DVSID.getIcon$OPE()
													});";
				$rtnval.="$BTNID.click=function(){".$BTNID.".IRERPDVS.getPage().EventManager('On".$OPE."Command',".$BTNID.",".$BTNID.".IRERPDVS);};";
				$rtnval.="$BTNID.setIcon($BTNID.IRERPDVS.getIcon$OPE());";
				$rtnval.="$DVSID.add".$OPE."Commander($BTNID);";
				
				
				$rtnval.="	jsIRERP.ToolStrip.create({height:32,ID:\"ToolstripWINFORM_$SECID\",
					    members: [btnWINFORMNew_$SECID,";
				$rtnval.="   btnWINFORMEdit_$SECID,";
				$rtnval.="            btnWINFORMDelete_$SECID,\"separator\",";
				$rtnval.="              btnWINFORMSave_$SECID,";
				$rtnval.="        btnWINFORMCancel_$SECID,
							\"separator\",
							btnWINFORMComments_$SECID,
							btnWINFORMPrint_$SECID,
							\"separator\",
							btnWINFORMLast_$SECID,
							btnWINFORMNext_$SECID,
							btnWINFORMPrevious_$SECID,
							btnWINFORMFirst_$SECID
							]	});";
				
				
				
				$rtnval.="";
				$rtnval.="
					jsIRERP.Window.create({
					 title: \"Modal Window\",
					 ID:\"WINFORM_$FORMID\",
    					autoSize:true,
    					autoCenter: true,
    					canDragReposition: true,
    					showMaximizeButton:true,
    					canDragResize: true,
    					isModal:true,
    					showModalMask:true,
    					autoDraw:false,
    					closeClick:function(){
    					$DVSID.getPage().EventManager('OnCANCELCommand',this,$DVSID);
    						this.hide();
    					},
						items:[
							jsIRERP.VLayout.create({
								members:[
									ToolstripWINFORM_$SECID,
									$FORMID
									]})
						]
					});
				";

				//$rtnval.="WINFORM_$SECID".".restore();";
				/*
				$rtnval.="jsIRERP.HLayout.create({";
				$rtnval.="ID:\"$SECID\",";
				$rtnval.="width: \"100%\",";
				$rtnval.="height: \"100%\",";
				$rtnval.="defaultLayoutAlign: \"right\",";
				$rtnval.=" members: [";
				$rtnval.="jsIRERP.VLayout.create({";
				$rtnval.="defaultLayoutAlign: \"right\",";
				$rtnval.="showResizeBar:true,";
				$rtnval.="Height:\"100%\",";
				$rtnval.=" width:\"*\",";
				$rtnval.="	members:[Toolstrip$SECID,$FORMID";
				$rtnval.="]}),";
				$rtnval.="jsIRERP.VLayout.create({";
				$rtnval.=" width: \"65%\",";
				$rtnval.="members: [$GRIDID ]";
				$rtnval.="	                         })	              ]	  });		";
				
				*/
				$rtnval.="jsIRERP.VLayout.create({";
				$rtnval.="ID:\"$SECID\",";
				$rtnval.="width: \"100%\",";
				$rtnval.="height: \"100%\",";
				$rtnval.="defaultLayoutAlign: \"right\",";
				$rtnval.=" members: [Toolstrip$SECID,$GRIDID";
				$rtnval.="	                        	              ]	  });		";
				
				return $rtnval;
				break;
		}
		
	}

	public function getForm(){return $this->FORM;}
	public function getGrid(){return $this->GRID;}
}
?>