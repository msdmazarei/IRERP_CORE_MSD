<script type="text/javascript">
var dsMasterName = "{$dsMaster}"; 
var frmMasterName = "frm{$dsMaster}";
var MasterGridName = "{$dsMaster}Grid";
{literal}
var DetailForms= Array();
var DetailGrids= Array();
var DetailDss=Array();	

function ChangesDetailMasterId(Masterid)
{
	for(var i=0;DetailForms.length>i;i++){
		DetailForms[i].HelpField=Masterid;
		DetailGrids[i].initialCriteria={HelpField : Masterid};
	}
	for(var i=0;DetailForms.length>i;i++){
		//DetailForms[i].HelpField=Masterid;
		DetailGrids[i].fetchData({HelpField:Masterid});
	}

}

function TitleClick(DataSourceAddress)
{
alert(DataSourceAddress);
}
function SaveForm(frm)
{
if(frm.isNewRecord()) frm.saveData(); else eval(frm.dataSource).updateData(frm.getValues());	
}
function SaveFormDetail(frm)
{
	var Datas=frm.getValues();
	
	if(frm.isNewRecord()) 
	{
		Datas.HelpField=frm.HelpField;
		eval(frm.dataSource).addData(Datas);
	} 
	else 
		eval(frm.dataSource).updateData(Datas);
}

function DeleteForm(ans,frmid,gridid)
{
	var frm = eval(frmid); 
	var grid= eval(gridid);
	
    if(ans=='YES'){
        var record = grid.getSelectedRecord();
        if (record == null) return ;
        grid.removeData(record);
        frm.clearValues();
       }
}

function SaveMaster()
{
    if(frmMaster.isNewRecord ())
    frmMaster.saveData();
    else
    {
        
        dsMaster.updateData(frmMaster.getValues());
        //MasterGrid.selection.selectSingle(0);
    }
}
function DeleteMaster(ans)
{
    if(ans=='YES'){
     var record = MasterGrid.getSelectedRecord();
     if (record == null) return ;
     MasterGrid.removeData(record);
     frmMaster.clearValues();
    }
}

function EnableForm(frm)
{
for(var i=0;i<frm.getFields().length;i++) frm.getFields()[i].enable();
}
function DisableForm(frm)
{
for(var i=0;i<frm.getFields().length;i++) frm.getFields()[i].disable();
}

function ShowDialog(Title,Message,Yes,No,afterclose,frmid,gridid)
{
    isc.Window.create({
        ID:"dlgQuest",
        height:100,
        width:300,
        canDragResize: true,
        autoCenter:true,
        isModal:true,
        autoSize:true,
        align:"right",
        headerControls : [ "closeButton",
                            "minimizeButton", isc.Label.create({
                                            height: "100%",
                                            width: "100%",
                                            contents: Title,
                                            align:"center"
                                        })
                            
                     ],
        items:[
                    isc.VLayout.create({
                        defaultLayoutAlign: "center",
                        width: "100%",
                        height: "100%",
                        layoutMargin: 6,
                        membersMargin: 6,
                        border: "1px",
                        align: "center",  // As promised!
                        members: [
                            isc.Label.create({
                                height: "100%",
                                width: "100%",
                                contents: Message,
                                align:"center"
                            }),
                           isc.HLayout.create({
                                layoutMargin: 6,
                                membersMargin: 6,
                                border: "1px",
                                defaultLayoutAlign:"center",
                                members:[
                                            isc.Label.create({width:"*"}),
                                            isc.Button.create({title:Yes,click:function(){dlgQuest.hide();eval(afterclose+'("YES",'+frmid+','+gridid+')');}}),
                                            isc.Button.create({title:No,click:function(){dlgQuest.hide();eval(afterclose+'("NO",'+frmid+','+gridid+')');}}),
                                            isc.Label.create({width:"*"})
                                            ]

                          })
                        ]
                    })
                ]
        
    });
}

isc.RestDataSource.create({
    ID:dsMasterName,
    fields:
        [

         {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
         {name:"Magazineid",type:"string",title:"نام مجله",hidden:"true"},
         {name:"MagazineTitle",type:"string",title:"نام مجله"},
         {name:"YearID",type:"integer",hidden:"true",title:"سال"},
         {name:"YearTitle",type:"string",title:"سال"},
         {name:"Shomare",type:"string",title:"شماره"},
         {name:"Tirajh",type:"string",title:"تبراژ"},
         {name:"File",type:"binary",title:"پرونده"}
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
    ID:"Size",
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
    fetchDataURL :"{$this->baseUrl}/jahad/Size/",
    addDataURL   :"{$this->baseUrl}/jahad/Size/",
    updateDataURL:"{$this->baseUrl}/jahad/Size/",
    removeDataURL:"{$this->baseUrl}/jahad/Size/"
            });
{literal}
isc.RestDataSource.create({
    ID:"Auidunce",
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
    fetchDataURL :"{$this->baseUrl}/jahad/Auidunce/",
    addDataURL   :"{$this->baseUrl}/jahad/Auidunce/",
    updateDataURL:"{$this->baseUrl}/jahad/Auidunce/",
    removeDataURL:"{$this->baseUrl}/jahad/Auidunce/"
            });

{literal}
isc.RestDataSource.create({
    ID:"Year",
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
    fetchDataURL :"{$this->baseUrl}/jahad/Year/",
    addDataURL   :"{$this->baseUrl}/jahad/Year/",
    updateDataURL:"{$this->baseUrl}/jahad/Year/",
    removeDataURL:"{$this->baseUrl}/jahad/Year/"
            });

{literal}
isc.RestDataSource.create({
    ID:"Human",
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
    fetchDataURL :"{$this->baseUrl}/jahad/human/",
    addDataURL   :"{$this->baseUrl}/jahad/human/",
    updateDataURL:"{$this->baseUrl}/jahad/human/",
    removeDataURL:"{$this->baseUrl}/jahad/human/"
            });
            

{literal}

isc.RestDataSource.create({
    ID:"Magazine",
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {type:"string",name:"TitleName",title:"عنوان"},
            {type:"integer",name:"onvan_id",title:"عنوان",hidden:true},
            {type:"string",name:"MagTypeName",title:"نوع مجله"},
            {type:"integer",name:"MagTypeid",title:"نوع مجله",hidden:true}
            ],
    dataFormat:"json",
    operationBindings:[
     {operationType:"fetch", dataProtocol:"getParams"},
     {operationType:"add", dataProtocol:"postParams"},
     {operationType:"remove", dataProtocol:"postParams", requestProperties:{httpMethod:"DELETE"}},
     {operationType:"update", dataProtocol:"postParams", requestProperties:{httpMethod:"PUT"}}
    ],
    {/literal}
    fetchDataURL :"{$this->baseUrl}/jahad/Magazine/",
    addDataURL   :"{$this->baseUrl}/jahad/Magazine/",
    updateDataURL:"{$this->baseUrl}/jahad/Magazine/",
    removeDataURL:"{$this->baseUrl}/jahad/Magazine/"
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
             if(record.id!=eval(frmMasterName).getValues()['id'])
             {
            	 ChangesDetailMasterId(record.id);
             }
             eval(frmMasterName).editRecord(record);
        }

   });

isc.DynamicForm.create({
    ID:frmMasterName,
    dataSource:dsMasterName,
    numCols:2,
    encoding:"multipart",
    target:"frame1",
    {/literal}
        
    action:"{$this->baseUrl}/",
    {literal}
    useAllDataSourceFields:true,
    defaultLayoutAlign: "center",
    fields:
        [
 	    
         {name:"YearTitle",hidden:true},
         {name:"YearID",hidden:false,editorType:"SelectItem",
             optionDataSource:'Year',displayField:"Name",valueField:"id",
             pickListProperties:{showFilterEditor:true},pickListFields:[{name:"Name"},{name:"Description"}]
             },
         {name:"MagazineTitle",hidden:true},
         {name:"Magazineid",hidden:false,editorType:"SelectItem",
                 optionDataSource:'Magazine',displayField:"TitleName",valueField:"id",
                 pickListProperties:{showFilterEditor:true},pickListFields:[{name:"TitleName"},{name:"MagTypeName"}]
                 },
                 {name:"FILE",editorType:"UploadItem"},
                 {name:"id",hidden:true},
             
  
        ]
    
});

var dsMaster = eval(dsMasterName);
var frmMaster = eval(frmMasterName);
var MasterGrid = eval(MasterGridName);
DisableForm(frmMaster);
isc.ToolStripButton.create({ID:"btnNew_Master",title:"جدید",  click:function(){EnableForm(frmMaster);btnSave_Master.enable();btnNew_Master.disable();btnEdit_Master.disable();btnDelete_Master.disable();frmMaster.editNewRecord();}});
isc.ToolStripButton.create({ID:"btnSave_Master",title:"ذخیره",disabled:true,click:function(){DisableForm(frmMaster);SaveMaster();btnSave_Master.disable();btnNew_Master.enable();btnEdit_Master.enable();btnDelete_Master.enable();}});
isc.ToolStripButton.create({ID:"btnEdit_Master",title:"ویرایش",click:function(){EnableForm(frmMaster);btnSave_Master.enable();btnNew_Master.disable();btnEdit_Master.disable();btnDelete_Master.disable();}});
isc.ToolStripButton.create({ID:"btnDelete_Master",title:"حذف", click:function(){
    ShowDialog(
            'اخطار حذف',
            'آیا از حذف مورد انتخاب شده اطمینان دارید؟',
            'بله',
            'خیر',
            'DeleteMaster'
            );
}});
isc.ToolStripButton.create({ID:"btnCancel_Master",title:"انصراف",  click:function(){DisableForm(frmMaster);btnNew_Master.enable();btnEdit_Master.enable();btnSave_Master.disable();btnDelete_Master.enable();}});

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
    ID:"MasterFrame",
    width: "100%",
    height: "50%",
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


/***********************************************************************************************
  Detail Section - Ghate
 */
 var detailGrid1Name = 'Detail_Size_Grid';
 var detailForm1Name = 'Detail_Size_Form';
 var detailDs1Name='MagazineVersion_Size';
 var detail1FrameTitle='قطع های انتشار یافته';
 isc.RestDataSource.create({
	    ID:"Matter",
	    fields:
	        [   {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
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
	    fetchDataURL :"{$this->baseUrl}/jahad/Size/",
	    addDataURL   :"{$this->baseUrl}/jahad/Size/",
	    updateDataURL:"{$this->baseUrl}/jahad/Size/",
	    removeDataURL:"{$this->baseUrl}/jahad/Size/"
	            });
{literal}

 
 isc.RestDataSource.create({
	    ID:detailDs1Name,
	    fields:
	        [   {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
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
	    fetchDataURL :"{$this->baseUrl}/jahad/Size/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/Ghate/",
	    addDataURL  :"{$this->baseUrl}/jahad/Size/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/Ghate/",
	    //updateDataURL:"{$this->baseUrl}/jahad/Size/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/Ghate/",
	    removeDataURL:"{$this->baseUrl}/jahad/Size/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/Ghate/"
	            });
{literal}
isc.ListGrid.create({
	    showFilterEditor: true,
	    allowFilterExpressions: true,
	    initialCriteria:{
	        HelpField : "1"
	     },
	    ID: detailGrid1Name,
	    width:"100%", height:"100%", alternateRecordStyles:true,
	    autoFetchData: true,
	    dataSource: detailDs1Name,
	    recordClick:"this.FillForm()",
	    FillForm:function()
	        {
	             var record = this.getSelectedRecord();
	             if (record == null) return ;
	             eval(detailForm1Name).editRecord(record);
	             
	        }

	   });

	isc.DynamicForm.create({
	    ID:detailForm1Name,
	    dataSource:detailDs1Name,
	    numCols:2,
	    useAllDataSourceFields:true,
	    defaultLayoutAlign: "center",
	    HelpField:1,
	    fields:[
	            {name:"Name",hidden:true},{name:"Description",hidden:true},
	            {name:"id",hidden:false,editorType:"SelectItem",
	                optionDataSource:'Size',displayField:"Name",valueField:"id",
	                pickListProperties:{showFilterEditor:true},pickListFields:[{name:"Name"},{name:"Description"}]
	                }
	    	    ]
	});

	var detailDs1 = eval(detailDs1Name);
	var detailForm1 = eval(detailForm1Name);
	var detailGrid1 = eval(detailGrid1Name);

	DetailForms[DetailForms.length]=detailForm1;
	DetailGrids[DetailGrids.length]=detailGrid1;
	DetailDss[DetailDss.length]=detailDs1;
	
	DisableForm(detailForm1);
	isc.ToolStripButton.create({ID:"btnNew_detail1",title:"جدید",  icon: "",click:function(){EnableForm(detailForm1);btnSave_detail1.enable();btnNew_detail1.disable();btnEdit_detail1.disable();btnDelete_detail1.disable();detailForm1.editNewRecord();}});
	isc.ToolStripButton.create({ID:"btnSave_detail1",title:"ذخیره",  icon: "",disabled:true,click:function(){DisableForm(detailForm1);SaveFormDetail(detailForm1);btnSave_detail1.disable();btnNew_detail1.enable();btnEdit_detail1.enable();btnDelete_detail1.enable();}});
	isc.ToolStripButton.create({ID:"btnEdit_detail1",title:"ویرایش",  icon: "",click:function(){EnableForm(detailForm1);btnSave_detail1.enable();btnNew_detail1.disable();btnEdit_detail1.disable();btnDelete_detail1.disable();}});
	isc.ToolStripButton.create({ID:"btnDelete_detail1",title:"حذف",  icon: "",click:function(){
	    ShowDialog(
	            'اخطار حذف',
	            'آیا از حذف مورد انتخاب شده اطمینان دارید؟',
	            'بله',
	            'خیر',
	            'DeleteForm',detailForm1Name,detailGrid1Name
	            );
	}});
	isc.ToolStripButton.create({ID:"btnCancel_detail1",title:"انصراف",  icon: "",click:function(){DisableForm(detailForm1);btnNew_detail1.enable();btnEdit_detail1.enable();btnSave_detail1.disable();btnDelete_detail1.enable();}});

	isc.ToolStrip.create({
	    width: "100%", 
	    height:24, 
	    ID:"Toolstripdetail1",
	    members: [btnNew_detail1, "separator",
	              btnEdit_detail1, "separator",
	              btnSave_detail1,"separator", 
	              btnDelete_detail1,"separator", 
	              btnCancel_detail1]
	});
	isc.HLayout.create({
	    ID:"detail1Frame",
	    width: "100%",
	    height: "100%",
	    defaultLayoutAlign: "right",
	    members: [
	              isc.VLayout.create({
	                  defaultLayoutAlign: "right",
	                  showResizeBar:true,
	                  Height:"100%",
	                  width:"*",
	                  members:[Toolstripdetail1, 
	                           detailForm1
	                           ]
	              }),
	             isc.VLayout.create({
	                        width: "70%",
	                        members: [detailGrid1 ]
	                         })
	              ]
	  });
	 

 /*****************************************************/

 
 /***********************************************************************************************
  Detail Section - modirMasoul
 */
 var detailGrid2Name = 'Detail_modirmasoul_Grid';
 var detailForm2Name = 'Detail_modirmasoul_Form';
 var detailDs2Name='MagazineVersion_modirmasoul';
 var detail2FrameTitle="مدیر مسیولان";
 
 isc.RestDataSource.create({
	    ID:detailDs2Name,
	    fields:[
	    	{hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
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
	    fetchDataURL :"{$this->baseUrl}/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/modirmasoul/",
	    addDataURL   :"{$this->baseUrl}/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/modirmasoul/",
	    updateDataURL:"{$this->baseUrl}/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/modirmasoul/",
	    removeDataURL:"{$this->baseUrl}/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/modirmasoul/"
	            });
{literal}
isc.ListGrid.create({
	    showFilterEditor: true,
	    allowFilterExpressions: true,
	    initialCriteria:{
	        HelpField : "1"
	     },
	    ID: detailGrid2Name,
	    width:"100%", height:"100%", alternateRecordStyles:true,
	    autoFetchData: true,
	    dataSource: detailDs2Name,
	    recordClick:"this.FillForm()",
	    FillForm:function()
	        {
	             var record = this.getSelectedRecord();
	             if (record == null) return ;
	             eval(detailForm2Name).editRecord(record);
	             
	        }

	   });

	isc.DynamicForm.create({
	    ID:detailForm2Name,
	    dataSource:detailDs2Name,
	    numCols:2,
	    useAllDataSourceFields:true,
	    defaultLayoutAlign: "center",
	    HelpField:1,
	    fields:[
	            {hidden:"true",type:"string",title:"نام",name:"FirstName"},
	            {hidden:"true",type:"string",title:"نام خانوادگی",name:"LastName"},
	            {hidden:"true",type:"string",title:"کدملی",name:"NationalCode"},
	            {hidden:"true",type:"string",title:"نام پدر",	name:"FatherName"},
	            {hidden:"true",type:"string",title:"ملیت",name:"NationalityTitle"},
	            {hidden:"true",type:"integer",hidden:true,name:"NationalityID"},
	            {hidden:"true",type:"string",title:"کدپستی",name:"PostalCode"},
	            {hidden:"true",type:"string",title:"شماره تلفن",name:"PhoneNo"},
	            {name:"id",hidden:false,editorType:"SelectItem",
	                optionDataSource:'Human',displayField:"LastName",valueField:"id",
	                pickListProperties:{showFilterEditor:true},pickListFields:[{name:"FirstName"},{name:"LastName"}]
	                }
	    	    ]
	});

	var detailDs2 = eval(detailDs2Name);
	var detailForm2= eval(detailForm2Name);
	var detailGrid2 = eval(detailGrid2Name);

	DetailForms[DetailForms.length]=detailForm2;
	DetailGrids[DetailGrids.length]=detailGrid2;
	DetailDss[DetailDss.length]=detailDs2;
	
	DisableForm(detailForm2);
	isc.ToolStripButton.create({ID:"btnNew_detail2",title:"جدید",  icon: "",
		click:function(){
			EnableForm(detailForm2);
			btnSave_detail2.enable();
			btnNew_detail2.disable();
			btnEdit_detail2.disable();
			btnDelete_detail2.disable();
			detailForm2.editNewRecord();}});
	isc.ToolStripButton.create({ID:"btnSave_detail2",title:"ذخیره",  icon: "",disabled:true,
		click:function(){
			DisableForm(detailForm2);
			SaveFormDetail(detailForm2);
			btnSave_detail2.disable();
			btnNew_detail2.enable();
			btnEdit_detail2.enable();
			btnDelete_detail2.enable();}});
	isc.ToolStripButton.create({ID:"btnEdit_detail2",title:"ویرایش",  icon: ""
		,click:function(){
			EnableForm(detailForm2);
			btnSave_detail2.enable();
			btnNew_detail2.disable();
			btnEdit_detail2.disable();
			btnDelete_detail2.disable();}});
	isc.ToolStripButton.create({ID:"btnDelete_detail2",title:"حذف",  icon: "",click:function(){
	    ShowDialog(
	            'اخطار حذف',
	            'آیا از حذف مورد انتخاب شده اطمینان دارید؟',
	            'بله',
	            'خیر',
	            'DeleteForm',detailForm2Name,detailGrid2Name
	            );
	}});
	isc.ToolStripButton.create({ID:"btnCancel_detail2",title:"انصراف",  icon: "",
		click:function(){
			DisableForm(detailForm2);
			btnNew_detail2.enable();
			btnEdit_detail2.enable();
			btnSave_detail2.disable();
			btnDelete_detail2.enable();}});

	isc.ToolStrip.create({
	    width: "100%", 
	    height:24, 
	    ID:"Toolstripdetail2",
	    members: [btnNew_detail2, "separator",
	              btnEdit_detail2, "separator",
	              btnSave_detail2,"separator", 
	              btnDelete_detail2,"separator", 
	              btnCancel_detail2]
	});
	isc.HLayout.create({
	    ID:"detail2Frame",
	    width: "100%",
	    height: "100%",
	    defaultLayoutAlign: "right",
	    members: [
	              isc.VLayout.create({
	                  defaultLayoutAlign: "right",
	                  showResizeBar:true,
	                  Height:"100%",
	                  width:"*",
	                  members:[Toolstripdetail2, 
	                           detailForm2
	                           ]
	              }),
	             isc.VLayout.create({
	                        width: "70%",
	                        members: [detailGrid2 ]
	                         })
	              ]
	  });
	 

 /*****************************************************/
 
 

 
 /***********************************************************************************************
  Detail Section - nevisandeh
 */
 var detailGrid3Name = 'Detail_nevisandeh_Grid';
 var detailForm3Name = 'Detail_nevisandeh_Form';
 var detailDs3Name='MagazineVersion_nevisandeh';
 var detail3FrameTitle="نویسندگان";
 
 isc.RestDataSource.create({
	    ID:detailDs3Name,
	    fields:[
	    	{hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
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
	    fetchDataURL :"{$this->baseUrl}/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/nevisandeh/",
	    addDataURL   :"{$this->baseUrl}/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/nevisandeh/",
	    updateDataURL:"{$this->baseUrl}/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/nevisandeh/",
	    removeDataURL:"{$this->baseUrl}/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazineVersion/nevisandeh/"
	            });
{literal}
isc.ListGrid.create({
	    showFilterEditor: true,
	    allowFilterExpressions: true,
	    initialCriteria:{
	        HelpField : "1"
	     },
	    ID: detailGrid3Name,
	    width:"100%", height:"100%", alternateRecordStyles:true,
	    autoFetchData: true,
	    dataSource: detailDs3Name,
	    recordClick:"this.FillForm()",
	    FillForm:function()
	        {
	             var record = this.getSelectedRecord();
	             if (record == null) return ;
	             eval(detailForm2Name).editRecord(record);
	             
	        }

	   });

	isc.DynamicForm.create({
	    ID:detailForm3Name,
	    dataSource:detailDs3Name,
	    numCols:2,
	    useAllDataSourceFields:true,
	    defaultLayoutAlign: "center",
	    HelpField:1,
	    fields:[
	            {hidden:"true",type:"string",title:"نام",name:"FirstName"},
	            {hidden:"true",type:"string",title:"نام خانوادگی",name:"LastName"},
	            {hidden:"true",type:"string",title:"کدملی",name:"NationalCode"},
	            {hidden:"true",type:"string",title:"نام پدر",	name:"FatherName"},
	            {hidden:"true",type:"string",title:"ملیت",name:"NationalityTitle"},
	            {hidden:"true",type:"integer",hidden:true,name:"NationalityID"},
	            {hidden:"true",type:"string",title:"کدپستی",name:"PostalCode"},
	            {hidden:"true",type:"string",title:"شماره تلفن",name:"PhoneNo"},
	            {name:"id",hidden:false,editorType:"SelectItem",
	                optionDataSource:'Human',displayField:"LastName",valueField:"id",
	                pickListProperties:{showFilterEditor:true},pickListFields:[{name:"FirstName"},{name:"LastName"}]
	                }
	    	    ]
	});

	var detailDs3 = eval(detailDs3Name);
	var detailForm3= eval(detailForm3Name);
	var detailGrid3 = eval(detailGrid3Name);

	DetailForms[DetailForms.length]=detailForm3;
	DetailGrids[DetailGrids.length]=detailGrid3;
	DetailDss[DetailDss.length]=detailDs3;
	
	DisableForm(detailForm3);
	isc.ToolStripButton.create({ID:"btnNew_detail3",title:"جدید",  icon: "",
		click:function(){
			EnableForm(detailForm3);
			btnSave_detail3.enable();
			btnNew_detail3.disable();
			btnEdit_detail3.disable();
			btnDelete_detail3.disable();
			detailForm3.editNewRecord();}});
	isc.ToolStripButton.create({ID:"btnSave_detail3",title:"ذخیره",  icon: "",disabled:true,
		click:function(){
			DisableForm(detailForm3);
			SaveFormDetail(detailForm3);
			btnSave_detail3.disable();
			btnNew_detail3.enable();
			btnEdit_detail3.enable();
			btnDelete_detail3.enable();}});
	isc.ToolStripButton.create({ID:"btnEdit_detail3",title:"ویرایش",  icon: ""
		,click:function(){
			EnableForm(detailForm3);
			btnSave_detail3.enable();
			btnNew_detail3.disable();
			btnEdit_detail3.disable();
			btnDelete_detail3.disable();}});
	isc.ToolStripButton.create({ID:"btnDelete_detail3",title:"حذف",  icon: "",click:function(){
	    ShowDialog(
	            'اخطار حذف',
	            'آیا از حذف مورد انتخاب شده اطمینان دارید؟',
	            'بله',
	            'خیر',
	            'DeleteForm',detailForm3Name,detailGrid3Name
	            );
	}});
	isc.ToolStripButton.create({ID:"btnCancel_detail3",title:"انصراف",  icon: "",
		click:function(){
			DisableForm(detailForm3);
			btnNew_detail3.enable();
			btnEdit_detail3.enable();
			btnSave_detail3.disable();
			btnDelete_detail3.enable();}});

	isc.ToolStrip.create({
	    width: "100%", 
	    height:24, 
	    ID:"Toolstripdetail3",
	    members: [btnNew_detail3, "separator",
	              btnEdit_detail3, "separator",
	              btnSave_detail3,"separator", 
	              btnDelete_detail3,"separator", 
	              btnCancel_detail3]
	});
	isc.HLayout.create({
	    ID:"detail3Frame",
	    width: "100%",
	    height: "100%",
	    defaultLayoutAlign: "right",
	    members: [
	              isc.VLayout.create({
	                  defaultLayoutAlign: "right",
	                  showResizeBar:true,
	                  Height:"100%",
	                  width:"*",
	                  members:[Toolstripdetail3, 
	                           detailForm3
	                           ]
	              }),
	             isc.VLayout.create({
	                        width: "70%",
	                        members: [detailGrid3 ]
	                         })
	              ]
	  });
	 

 /*****************************************************/
 
 
 isc.TabSet.create({
    ID:"itemDetailTabs",
    defaultLayoutAlign: "right",
    align:"right",
    tabBarAlign:"right",
    tabs:[
			{title:detail1FrameTitle,pane:detail1Frame,ID:"detail1FrameTab" },
			{title:detail2FrameTitle,pane:detail2Frame,ID:"detail2FrameTab" },
			{title:detail3FrameTitle,pane:detail3Frame,ID:"detail3FrameTab" },
				 
          ]});
 

isc.SectionStack.create({
    ID:"rightSideLayout",
    width:"100%",height:"100%",
    visibilityMode:"multiple",
    animateSections:true,
    sections:[
              {title:"مجلات", autoShow:true, items:[MasterFrame]},
              {title:"جزییات مربوط به مجله انتخاب شده",autoShow:true,items:[itemDetailTabs]}              

              ]});




</script>
<iframe id="frame1" name="frame1" src=""  style='width:500px;height:150px;border:1'></iframe>

{/literal}