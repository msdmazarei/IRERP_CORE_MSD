<script type="text/javascript">
var dsMasterName = "{$dsMaster}"; 
var frmMasterName = "frm{$dsMaster}";
var MasterGridName = "{$dsMaster}Grid";
{literal}
function TitleClick(DataSourceAddress)
{
alert(DataSourceAddress);
}
 
isc.RestDataSource.create({
	{/literal}{$this->GetMasterDataSource()}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {type:"string",name:"TitleName",title:"عنوان"},
            {type:"integer",name:"onvan_id",title:"عنوان",hidden:true},
            {type:"string",name:"MagTypeName",title:"نوع مجله"},
            {type:"integer",name:"MagTypeid",title:"نوع مجله",hidden:true}
            ],
            });
            
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"Title"','/jahad/Title/')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"MagazineType"','/jahad/MagazineType/')}{literal}
     fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
 isc.ListGrid.create({
	{/literal}{$this->GetMasterListGrid()}{literal}
});
isc.DynamicForm.create({
	{/literal}{$this->GetMasterForm()}{literal}
    fields:
        [
            {name:"id"},
            {name:"TitleName",hidden:true},
            {name:"onvan_id",hidden:false,editorType:"SelectItem",
            optionDataSource:"Title",displayField:"Name",
            pickListProperties:{showFilterEditor:true},pickListFields:[{name:"Name"},{name:"Description"}]
            ,
            titleClick:function(a,b){
	            isc.Window.create({
				        height:500,
				        width:500,
				        canDragResize: true,
				        isModal:true,
				        align: "center",
				        autoCenter:true,
				        showMaximizeButton:true,
				        closeClick:function(){isc_PickListMenu_9.fetchData();this.hide();},
				        src:"http://localhost/IranERP/jahad/title"});
	            }
            },
            {name:"MagTypeName",hidden:true},
            {name:"MagTypeid",hidden:false,editorType:"SelectItem",
            optionDataSource:"MagazineType",displayField:"Name",valueField:"id",
            pickListProperties:{showFilterEditor:true},pickListFields:[{name:"Name"},{name:"Description"}]
            }
        ]
});

{/literal}
{$this->GetInitMaster()}
{$this->GetMasterToolbar()}
{$this->GetMasterLayout()}
{literal}
/***********************************************************************************************
  Detail Section - Matter
 */
 var detailGrid1Name = 'Detail_Matter_Grid';
 var detailForm1Name = 'Detail_Matter_Form';
 var detailDs1Name='Magazine_Matter';
 isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('"Matter"','/jahad/Matter')}
	 {literal}
    fields:
	        [   {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
	            {name:"Name",type:"string",title:"نام"},
	            {name:"Description",type:"string",title:"شرح", length:2000}
	            ],
	            });
 isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs1Name','/jahad/matter/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazine/mozu/')}
		 {literal}
	    fields:
	        [   {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
	            {name:"Name",type:"string",title:"نام"},
	            {name:"Description",type:"string",title:"شرح", length:2000}
	            ],
	            });
isc.ListGrid.create({
	{/literal}{$this->GetDetailListGrid(1)}{literal}
    	   });

	isc.DynamicForm.create({
		{/literal}{$this->GetDetailForm(1)}{literal}
	    fields:[
	            {name:"Name",hidden:true},{name:"Description",hidden:true},
	            {name:"id",hidden:false,editorType:"SelectItem",
	                optionDataSource:'Matter',displayField:"Name",valueField:"id",
	                pickListProperties:{showFilterEditor:true},pickListFields:[{name:"Name"},{name:"Description"}]
	                }
	    	    ]
	});
	{/literal}
	{$this->GetInitDetail(1)}
	{$this->GetDetailToolbar(1)}
	{$this->GetDetailLayout(1)}
	{literal}

 /*****************************************************/

 
 /***********************************************************************************************
  Detail Section - MagazineVersion
 */
 var detailGrid2Name = 'Detail_MagazineVersion_Grid';
 var detailForm2Name = 'Detail_MagazineVersion_Form';
 var detailDs2Name='Magazine_MagazineVersion';

 isc.RestDataSource.create({
	    fields:
	        [   {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
	            {name:"Name",type:"string",title:"نام"},
	            {name:"Description",type:"string",title:"شرح", length:2000}
	            ],
	    {/literal}
 		{$this->GetDataSource('"Year"','/jahad/year')}
		{literal}
        });

 
 isc.RestDataSource.create({
	    fields:
	        [   {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
	            {name:"YearID",type:"integer",hidden:"true",title:"سال"},
	            {name:"YearTitle",type:"string",title:"سال"},
	            {name:"Shomare",type:"string",title:"شماره"},
	            {name:"Tirajh",type:"string",title:"تبراژ"}
	            ],
	    {/literal}
 {$this->GetDataSource('detailDs2Name',
		 '/jahad/MagazineVersion/jds/_5cIRERP_5cmodules_5cjahad_5cmodels_5cMagazine/magver/')}
		{literal}
	       });
isc.ListGrid.create({ 
	{/literal}{$this->GetDetailListGrid(2)}{literal}	   
					});

	isc.DynamicForm.create({
	    {/literal}{$this->GetDetailForm(2)}{literal}
	    fields:[
	    	    
	            {name:"YearTitle",hidden:true},
	            {name:"YearID",hidden:false,editorType:"SelectItem",
	                optionDataSource:'Year',displayField:"Name",valueField:"id",
	                pickListProperties:{showFilterEditor:true},pickListFields:[{name:"Name"},{name:"Description"}]
	                }
	    	    ]
	});

	{/literal}
	{$this->GetInitDetail(2)}
	{$this->GetDetailToolbar(2)}
	{$this->GetDetailLayout(2)}
	{literal}
	 

 /*****************************************************/
 
 {/literal}
 {$this->GetTabSet(array("موضوعات یک مجله",
		 				"نسخه های مجله"
		 				))}
 {$this->GetSectionStack("مجلات",
		 					"جزییات مجله")}
 {literal}
 
  

</script>
{/literal}