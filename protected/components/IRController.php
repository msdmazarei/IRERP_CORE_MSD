<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class IRController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * context menu items. This property will be assigned to {@link CMenu::items}.
	 * @var array
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function __construct($id,$m=NULL)
	{
		
		parent::__construct($id,$m);
		Yii::app()->ir_ClassLoader->nop();
		Yii::app()->doctrine->nop();
	}
	
	public $baseUrl = '';
	
	public $direction = 'rtl';
	/**
	 * 
	 * Static resources for all controllers.
	 * @var array
	 */
	public $globalResources = array();
	
	protected $actionParams = array();
	
	protected function getIsGetRequest()
	{
		$req = Yii::app()->getRequest();
		return !($req->getIsDeleteRequest() || $req->getIsPostRequest() || $req->getIsPutRequest());
	}
	
	public function getActionParam($paramName)
	{
		$req = Yii::app()->getRequest();
		if ($req->getIsPutRequest())
			return $req->getPut($paramName, NULL);
		else
		{
			if (count($this->actionParams) == 0)
				$this->actionParams = $this->getActionParams();
			
			if (isset($this->actionParams[$paramName]))
				return $this->actionParams[$paramName];
			else
				return NULL;
		}
	}
	public function getActionParams()
	{
		$req = Yii::app()->getRequest();
		
		if ($req->getIsPostRequest() || $req->getIsDeleteRequest())
			return $_REQUEST;
		if ($this->getIsGetRequest()) {
			$queryString = $req->getQueryString();
			
			// FIXME check for other possible errors 
			if ($queryString !== '') {
				$reqParams = explode('&', $queryString);
				
				$actionParams = array();
				foreach($reqParams as $param)
				{
					list($paramName, $paramValue) = explode('=',$param);
					if(array_key_exists($paramName, $actionParams)) {
						$temp = $actionParams[$paramName];
						if (!is_array($temp))
							$actionParams[$paramName] = array(0 => $temp);
						$actionParams[$paramName][] = urldecode($paramValue);
					}
					else
						$actionParams[$paramName] = urldecode($paramValue);
				}
				return $actionParams;
			}
			else
				return $_GET;
		}
		
		return NULL;
	}
	
	public function beforeRender($view)
	{
		$this->baseUrl = Yii::app()->baseUrl;
		$res = MainLayoutHelpers::GetSmartClientJs();
		$this->globalResources = array_merge($this->globalResources, $res);
		$this->direction = Yii::app()->params['direction'];
		
		return parent::beforeRender($view);
	}
	
	/**
	*
	* Sends raw response with desired content-type
	* @param object $response
	* @param string $contentType
	*/
	public function ajaxRespond($response, $contentType)
	{
		header('Content-Type: ' . $contentType . '; charset=utf-8');
		echo $response;
	}
	
	/**
	 *
	 * Sends json response with content-type: text/json
	 * @param array $responseArray
	 */
	public function ajaxRespondJSON($responseArray)
	{
		$this->ajaxRespond(json_encode($responseArray), 'text/json');
	}
	
	
	// Below Function Must be Removed In Future
	public function GetMasterLayout()
	{
		$rtn="isc.HLayout.create({
    ID:\"MasterFrame\",
    width: \"100%\",
    height: \"70%\"
		,
    defaultLayoutAlign: \"right\",
    members: [
              isc.VLayout.create({
                  defaultLayoutAlign: \"right\",
                  showResizeBar:true,
                  Height:\"100%\",
                  width:\"*\",
                  members:[ToolstripMaster, 
                           frmMaster
                           ]
              }),
             isc.VLayout.create({
                        width: \"65%\",
                        members: [MasterGrid ]
                         })
              ]
  });


		";
		return $rtn;
	}
	public function GetInitMaster()
	{
		$rtn="var dsMaster = eval(dsMasterName);
		var frmMaster = eval(frmMasterName);
		var MasterGrid = eval(MasterGridName);
		DisableForm(frmMaster);
		";
		return $rtn;
		
	}
	public function GetMasterDataSource()
	{
		return $this->GetDataSource('dsMasterName', '/'.$this->uniqueId);
	}
	public function GetMasterForm()
	{
		$rtn="	ID:frmMasterName,
    dataSource:dsMasterName,
    numCols:2,
    width:\"100%\",
    useAllDataSourceFields:true,
    defaultLayoutAlign: \"center\",";
		return $rtn;
	}
	public function GetMasterListGrid()
	{
	$rtn="    showFilterEditor: true,
    allowFilterExpressions: true,
    ID: MasterGridName,
    width:\"100%\", height:\"100%\", alternateRecordStyles:true,
    autoFetchData: true,
    dataSource: dsMasterName,
    recordClick:\"this.FillForm()\",
    FillForm:function()
        {
             var record = this.getSelectedRecord();
             if (record == null) return ;
             if(record.id!=eval(frmMasterName).getValues()['id'])
             {
            	 ChangesDetailMasterId(record.id);
             }
             eval(frmMasterName).editRecord(record);
             
             
        }

	";
	return $rtn;
	}
	public function GetMasterToolbar()
	{
		

	$rtnval="isc.ToolStripButton.create({ID:\"btnNew_Master\",title:\"جدید\",  icon: icon_new,click:function(){EnableForm(frmMaster);btnSave_Master.enable();btnNew_Master.disable();btnEdit_Master.disable();btnDelete_Master.disable();frmMaster.editNewRecord();}});";
	$rtnval.="isc.ToolStripButton.create({ID:\"btnSave_Master\",title:\"ذخیره\",  icon: icon_Save,disabled:true,click:function(){DisableForm(frmMaster);SaveMaster();btnSave_Master.disable();btnNew_Master.enable();btnEdit_Master.enable();btnDelete_Master.enable();}});";
	$rtnval.="isc.ToolStripButton.create({ID:\"btnEdit_Master\",title:\"ویرایش\",  icon: icon_Edit,click:function(){EnableForm(frmMaster);btnSave_Master.enable();btnNew_Master.disable();btnEdit_Master.disable();btnDelete_Master.disable();}});";
	$rtnval.="isc.ToolStripButton.create({ID:\"btnDelete_Master\",title:\"حذف\",  icon: icon_Delete,click:function(){";
	$rtnval.="ShowDialog(";
	$rtnval.="'اخطار حذف',";
	$rtnval.="'آیا از حذف مورد انتخاب شده اطمینان دارید؟',";
	$rtnval.="'بله',";
	$rtnval.="'خیر',";
	$rtnval.="'DeleteMaster'";
	$rtnval.="            );	}});";
	$rtnval.="isc.ToolStripButton.create({ID:\"btnCancel_Master\",title:\"انصراف\",  icon: icon_Cancel,click:function(){DisableForm(frmMaster);btnNew_Master.enable();btnEdit_Master.enable();btnSave_Master.disable();btnDelete_Master.enable();}});";
	$rtnval.="	isc.ToolStrip.create({	    width: \"100%\",	    height:24,	    ID:\"ToolstripMaster\",	    members: [btnNew_Master, \"separator\",";
	$rtnval.="   btnEdit_Master, \"separator\",";
	$rtnval.="              btnSave_Master,\"separator\",";
	$rtnval.="            btnDelete_Master,\"separator\",";
	$rtnval.="        btnCancel_Master]	});";
	return $rtnval;
	}
	
	public function GetDetailToolbar($DetailNumber)
	{
	$rtnval="isc.ToolStripButton.create({ID:\"btnNew_detail$DetailNumber\",title:\"جدید\",  icon: icon_new,click:function(){EnableForm(detailForm$DetailNumber);btnSave_detail$DetailNumber.enable();btnNew_detail$DetailNumber.disable();btnEdit_detail$DetailNumber.disable();btnDelete_detail$DetailNumber.disable();detailForm$DetailNumber.editNewRecord();}});";
	$rtnval.="isc.ToolStripButton.create({ID:\"btnSave_detail$DetailNumber\",title:\"ذخیره\",  icon: icon_Save,disabled:true,click:function(){DisableForm(detailForm$DetailNumber);SaveFormDetail(detailForm$DetailNumber);btnSave_detail$DetailNumber.disable();btnNew_detail$DetailNumber.enable();btnEdit_detail$DetailNumber.enable();btnDelete_detail$DetailNumber.enable();}});";
	$rtnval.="isc.ToolStripButton.create({ID:\"btnEdit_detail$DetailNumber\",title:\"ویرایش\",  icon: icon_Edit,click:function(){EnableForm(detailForm$DetailNumber);btnSave_detail$DetailNumber.enable();btnNew_detail$DetailNumber.disable();btnEdit_detail$DetailNumber.disable();btnDelete_detail$DetailNumber.disable();}});";
	$rtnval.="isc.ToolStripButton.create({ID:\"btnDelete_detail$DetailNumber\",title:\"حذف\",  icon: icon_Delete,click:function(){";
	$rtnval.="ShowDialog(";
	$rtnval.="'اخطار حذف',";
	$rtnval.="'آیا از حذف مورد انتخاب شده اطمینان دارید؟',";
	$rtnval.="'بله',";
	$rtnval.="'خیر',";
	$rtnval.="'DeleteForm',detailForm".$DetailNumber."Name,detailGrid".$DetailNumber."Name";
	$rtnval.="            );	}});";
	$rtnval.="isc.ToolStripButton.create({ID:\"btnCancel_detail$DetailNumber\",title:\"انصراف\",  icon: icon_Cancel,click:function(){DisableForm(detailForm$DetailNumber);btnNew_detail$DetailNumber.enable();btnEdit_detail$DetailNumber.enable();btnSave_detail$DetailNumber.disable();btnDelete_detail$DetailNumber.enable();}});";
	$rtnval.="	isc.ToolStrip.create({	    width: \"100%\",	    height:24,	    ID:\"Toolstripdetail$DetailNumber\",	    members: [btnNew_detail$DetailNumber, \"separator\",";
	$rtnval.="   btnEdit_detail$DetailNumber, \"separator\",";
	$rtnval.="              btnSave_detail$DetailNumber,\"separator\",";
	$rtnval.="            btnDelete_detail$DetailNumber,\"separator\",";
	$rtnval.="        btnCancel_detail$DetailNumber]	});";
	return $rtnval;
	}
	
	public function GetDetailLayout($DetailNumber)
	{
		$rtnval="isc.HLayout.create({";
		$rtnval.="ID:\"detail".$DetailNumber."Frame\",";
		$rtnval.="width: \"100%\",";
		$rtnval.="height: \"100%\",";
		$rtnval.="defaultLayoutAlign: \"right\",";
		$rtnval.=" members: [";
		$rtnval.="isc.VLayout.create({";
		$rtnval.="defaultLayoutAlign: \"right\",";
		$rtnval.="showResizeBar:true,";
		$rtnval.="Height:\"100%\",";
		$rtnval.=" width:\"*\",";
		$rtnval.="	members:[Toolstripdetail$DetailNumber,detailForm$DetailNumber";
		$rtnval.="]}),";
		$rtnval.="isc.VLayout.create({";
		$rtnval.=" width: \"65%\",";
		$rtnval.="members: [detailGrid$DetailNumber ]";
		$rtnval.="	                         })	              ]	  });		";
		return $rtnval;
	}
	public function GetInitDetail($DetailNumber)
	{
		$rtnval="	var detailDs$DetailNumber = eval(detailDs".$DetailNumber."Name);";
		$rtnval.="	var detailForm$DetailNumber= eval(detailForm".$DetailNumber."Name);";
		$rtnval.="	var detailGrid$DetailNumber = eval(detailGrid".$DetailNumber."Name);";
		$rtnval.="	DetailForms[DetailForms.length]=detailForm$DetailNumber;";
		$rtnval.="	DetailGrids[DetailGrids.length]=detailGrid$DetailNumber;";
		$rtnval.="	DetailDss[DetailDss.length]=detailDs$DetailNumber;";
		$rtnval.="	DisableForm(detailForm$DetailNumber);";
		return $rtnval;
	}
	
	public function GetTabSet(array $DetailTitles)
	{
		$rtnval=" isc.TabSet.create({";
		$rtnval.="ID:\"itemDetailTabs\",";
		$rtnval.="defaultLayoutAlign: \"right\",";
		$rtnval.="align:\"right\",";
		$rtnval.="tabBarAlign:\"right\",";
		$rtnval.="tabs:[";
		$i=1;
		foreach($DetailTitles as $tit)
		{
			$rtnval.="{title:\"$tit\",pane:detail".$i."Frame,ID:\"detail".$i."FrameTab\" },";
			$i++;
		}
			$rtnval.="]});";
			
		return $rtnval;
	}
	
	public function GetSectionStack( $MasterTitle,$DetailsTitle)
	{
		$rtnval="isc.SectionStack.create({";
		$rtnval.="ID:\"rightSideLayout\",";
		$rtnval.="width:\"100%\",height:\"100%\",";
		$rtnval.="visibilityMode:\"multiple\",";
		$rtnval.="animateSections:true,";
		$rtnval.="  sections:[";
		$rtnval.="{title:\"$MasterTitle\", autoShow:true, items:[MasterFrame]},";
		$rtnval.="{title:\"$DetailsTitle\",autoShow:true,items:[itemDetailTabs]}";
		$rtnval.="]});";
		return $rtnval;
		
	}
	
	public function GetDataSource($id,$url)
	{
		$url=$this->baseUrl.$url;
		$rtn=" ID:$id,";
		$rtn.="dataFormat:\"json\",";
		$rtn.=" operationBindings:[";
		$rtn.="{operationType:\"fetch\", dataProtocol:\"getParams\"},";
		$rtn.="{operationType:\"add\", dataProtocol:\"postParams\"},";
		$rtn.="{operationType:\"remove\", dataProtocol:\"postParams\", requestProperties:{httpMethod:\"DELETE\"}},";
		$rtn.="{operationType:\"update\", dataProtocol:\"postParams\", requestProperties:{httpMethod:\"PUT\"}}";
		$rtn.="],";
		$rtn.="fetchDataURL :\"$url\",";
		$rtn.="addDataURL :\"$url\",";
		$rtn.="updateDataURL :\"$url\",";
		$rtn.="removeDataURL :\"$url\",";
 		return $rtn;
	}
	
	public function GetDetailListGrid($DetailNumber)
	{
		$rtn="showFilterEditor: true,";
		$rtn.=" allowFilterExpressions: true,";
		$rtn.="initialCriteria:{HelpField : \"1\"},";
		$rtn.="ID: detailGrid".$DetailNumber."Name,";
	    $rtn.="width:\"100%\", height:\"100%\", alternateRecordStyles:true,";
	    $rtn.="autoFetchData: true,";
	    $rtn.="dataSource: detailDs".$DetailNumber."Name,";
	    $rtn.="recordClick:\"this.FillForm()\",";
	    $rtn.="FillForm:function()";
	    $rtn.="{var record = this.getSelectedRecord();if (record == null) return ;
	             eval(detailForm2Name).editRecord(record);";
	    $rtn.="}";
		return $rtn;
	}
	public function GetDetailForm($DetailNumber)
	{
		$rtn="ID:detailForm".$DetailNumber."Name,	    dataSource:detailDs".$DetailNumber."Name,	    numCols:2,	    useAllDataSourceFields:true,	    defaultLayoutAlign: \"center\",	    HelpField:1,";
		return $rtn;
	}

	public function GetPickListField($fieldname,$ds,$displayfield,$valuefield='id',array $picklistfields)
	{
		$rtn="{name:\"$fieldname\",hidden:false,editorType: \"SelectItem\",";
		$rtn.="optionDataSource: \"$ds\", displayField:\"$displayfield\", valueField:\"$valuefield\",";
		$rtn.="pickListProperties: {showFilterEditor:true},                 pickListFields:[";
		foreach ($picklistfields as $f)
		$rtn.="{name:\"".$f."\"},";
        $rtn.="  ]}	";
        return $rtn;
	}
}
	

