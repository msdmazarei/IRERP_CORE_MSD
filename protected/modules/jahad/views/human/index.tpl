<script type="text/javascript">
var dsMasterName = "{$dsMaster}"; 
var frmMasterName = "frm{$dsMaster}";
var MasterGridName = "{$dsMaster}Grid";
{literal}
isc.RestDataSource.create({
    ID:dsMasterName,
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {type:"string",title:"نام",name:"FirstName"},
            {type:"string",title:"نام خانوادگی",name:"LastName"},
            {type:"string",title:"کدملی",name:"NationalCode"},
            {type:"string",title:"نام پدر",	name:"FatherName"},
            {type:"string",title:"ملیت",name:"NationalityTitle"},
            {type:"integer",hidden:true,name:"NationalityID"},
            {type:"string",title:"کدپستی",name:"PostalCode"},
            {type:"string",title:"شماره تلفن",name:"PhoneNo"}

            ],
    dataFormat:"json",
    operationBindings:[
     {operationType:"fetch", dataProtocol:"getParams"},
     {operationType:"add", dataProtocol:"postParams"},
     {operationType:"remove", dataProtocol:"postParams", requestProperties:{httpMethod:"DELETE"}},
     {operationType:"update", dataProtocol:"postParams", requestProperties:{httpMethod:"PUT"}}
    ],
    {/literal}
    fetchDataURL :"{$this->baseUrl}/{$this->uniqueId}/",
    addDataURL   :"{$this->baseUrl}/{$this->uniqueId}/",
    updateDataURL:"{$this->baseUrl}/{$this->uniqueId}/",
    removeDataURL:"{$this->baseUrl}/{$this->uniqueId}/"
            });
            
{literal}
isc.RestDataSource.create({
    ID:"Nationality",
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
    dataFormat:"json",
    operationBindings:[
     {operationType:"fetch", dataProtocol:"getParams"},
     {operationType:"add", dataProtocol:"postParams"},
     {operationType:"remove", dataProtocol:"postParams", requestProperties:{httpMethod:"DELETE"}},
     {operationType:"update", dataProtocol:"postParams", requestProperties:{httpMethod:"PUT"}}
    ],
    {/literal}
    fetchDataURL :"{$this->baseUrl}/jahad/nationality/",
    addDataURL   :"{$this->baseUrl}/jahad/nationality/",
    updateDataURL:"{$this->baseUrl}/jahad/nationality/",
    removeDataURL:"{$this->baseUrl}/jahad/nationality/"
            });
{literal}
isc.ListGrid.create({
    showFilterEditor: true,
    allowFilterExpressions: true,
    ID: MasterGridName,
    width:"100%", height:"100%", alternateRecordStyles:true,
    autoFetchData: true,
    dataSource: dsMasterName,
    recordClick:"this.FillForm()",
    FillForm:function()
        {
             var record = this.getSelectedRecord();
             if (record == null) return ;
             eval(frmMasterName).editRecord(record);
             
        }

   });

isc.DynamicForm.create({
    ID:frmMasterName,
    dataSource:dsMasterName,
    numCols:2,
    useAllDataSourceFields:true,
    defaultLayoutAlign: "center",
    fields:
        [
            {name:"id"},
            {name:"FirstName"},
            {name:"LastName"},
            {name:"PhoneNo"},
            {name:"PostalCode"},
            {name:"NationalCode"},
            {name:"FatherName",disabled:true,click:function(a,b){
                ShowUploadDialog(null,window.AfterUploadFile,a,b);

                }},
            {name:"NationalityTitle",hidden:true},
            {name:"NationalityID",hidden:false,title:"ملیت",
            	 editorType: "SelectItem", 
                 optionDataSource: "Nationality", 
                 displayField:"Name", valueField:"id",
                 pickListProperties: {showFilterEditor:true},
                 pickListFields:[
                     {name:"Name"},
                     {name:"Description"}
                 ]
                 }
        ]
    
});

var dsMaster = eval(dsMasterName);
var frmMaster = eval(frmMasterName);
var MasterGrid = eval(MasterGridName);

DisableForm(frmMaster);
isc.ToolStripButton.create({ID:"btnNew_Master",title:"جدید",  icon:icon_new,click:function(){EnableForm(frmMaster);btnSave_Master.enable();btnNew_Master.disable();btnEdit_Master.disable();btnDelete_Master.disable();frmMaster.editNewRecord();}});
isc.ToolStripButton.create({ID:"btnSave_Master",title:"ذخیره",  icon: icon_Save,disabled:true,click:function(){DisableForm(frmMaster);SaveMaster();btnSave_Master.disable();btnNew_Master.enable();btnEdit_Master.enable();btnDelete_Master.enable();}});
isc.ToolStripButton.create({ID:"btnEdit_Master",title:"ویرایش",  icon: icon_Edit,click:function(){EnableForm(frmMaster);btnSave_Master.enable();btnNew_Master.disable();btnEdit_Master.disable();btnDelete_Master.disable();}});
isc.ToolStripButton.create({ID:"btnDelete_Master",title:"حذف",  icon: icon_Delete,click:function(){
    ShowDialog(
            'اخطار حذف',
            'آیا از حذف مورد انتخاب شده اطمینان دارید؟',
            'بله',
            'خیر',
            'DeleteMaster'
            );
}});
isc.ToolStripButton.create({ID:"btnCancel_Master",title:"انصراف",  icon: icon_Cancel,click:function(){DisableForm(frmMaster);btnNew_Master.enable();btnEdit_Master.enable();btnSave_Master.disable();btnDelete_Master.enable();}});

isc.ToolStrip.create({
    width: "100%", 
    height:24, 
    ID:"ToolstripMaster",
    members: [btnNew_Master, "separator",
              btnEdit_Master, "separator",
              btnSave_Master,"separator", 
              btnDelete_Master,"separator", 
              btnCancel_Master]
});


isc.HLayout.create({
    ID:"con",
    width: "100%",
    height: "100%",
    defaultLayoutAlign: "right",
    members: [
              isc.VLayout.create({
                  defaultLayoutAlign: "right",
                  showResizeBar:true,
                  Height:"100%",
                  width:"*",
                  members:[ToolstripMaster, 
                           frmMaster
                           ]
              }),
             isc.VLayout.create({
                        width: "70%",
                        members: [MasterGrid ]
                         })
              ]
  });





</script>
{/literal}





