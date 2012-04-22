<script type="text/javascript">
var dsMasterName = "{$dsMaster}"; 
var frmMasterName = "frm{$dsMaster}";
var MasterGridName = "{$dsMaster}Grid";
{literal}

/**********************************************************************************************************
 * **************************************** BASIC DATASOURCE  *******************************
*/
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('"Human"','/jahad/Human')}
	 {literal}
 fields:
	        [   {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
	            {type:"string",title:"نام",name:"FirstName"},
	            {type:"string",title:"نام خانوادگی",name:"LastName"},
	            {type:"string",title:"کدملی",name:"NationalCode"},
	            {type:"string",title:"نام پدر",	name:"FatherName"},
	            {type:"string",title:"ملیت",name:"NationalityTitle"},
	            {type:"integer",hidden:true,name:"NationalityID"},
	            {type:"string",title:"کدپستی",name:"PostalCode"},
	            {type:"string",title:"شماره تلفن",name:"PhoneNo"}
	            ],
	            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"FilmFilmContentlist"','/jahad/FilmFilmContentlist')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
 /*
 *********************************************************************************************************
 **********************************************************************
 *******************************************************************************************************
  */

  
isc.RestDataSource.create({
	{/literal}{$this->GetMasterDataSource()}{literal}
    fields:
        [
         
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"FilmName",type:"string",title:"نام فیلم"},
            {name:"FilmTime",type:"string",title:"زمان فیلم"},
            {name:"ProductionDate",type:"string",title:"تاریخ تولید"},
            {name:"Montage",type:"string",title:"مونتاژ"},
            {name:"FilmCode",type:"string",title:"کد فیلم"},
            {name:"FilmabstracFile",type:"link",title:"پرونده خلاصه فیلم",linkURLPrefix:baseurl+'Download/'},
            {name:"ProductionFormatName",type:"string",title:"قالب تولید"},
            {name:"ProductionFormatID",type:"string",hidden:true,title:"قالب تولید"},
            {name:"ClientFirstName",type:"string", title:"نام سفارش دهنده"},
            {name:"ClientLastName",type:"string" ,title:"نام خانوادگی سفارش دهنده"},
            {name:"ClientID",type:"string",hidden:true,title:"سفارش دهنده"},
            {name:"SystemTypeName",type:"string",title:"نوع سیستم"},
            {name:"SystemTypeID",type:"string",hidden:true,title:"نوع سیستم"}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"FilmProductionFormat"','/jahad/FilmProductionFormat')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"FilmSystemType"','/jahad/FilmSystemType')}{literal}
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
		fields:[
		        {name:"ProductionFormatName",type:"string",title:"قالب تولید",hidden:true},
		        {/literal}{$this->GetPickListField('ProductionFormatID','FilmProductionFormat','Name','id',array('Name','Description'))}{literal}
	            ,{name:"",type:"string",hidden:true,title:"قالب تولید"},
	            {name:"ClientFirstName",type:"string", title:"نام سفارش دهنده",hidden:true},
	            {name:"ClientLastName",type:"string" ,title:"نام خانوادگی سفارش دهنده",hidden:true},
	            {/literal}{$this->GetPickListField('ClientID','Human','LastName','id',array('FirstName','LastName','NationalCode','PhoneNo'))}{literal}
	            ,    {name:"SystemTypeName",type:"string",title:"نوع سیستم",hidden:true},
	            {/literal}{$this->GetPickListField('SystemTypeID','FilmSystemType','Name','id',array('Name','Description'))}{literal}
	            	,{name:"FilmabstracFile",click:function(a,b){
	                     ShowUploadDialog(null,window.AfterUploadFile,a,b);}}
	    		            
				]
});
{/literal}
{$this->GetInitMaster()}
{$this->GetMasterToolbar()}
{$this->GetMasterLayout()}
{literal}
/***********************************************************************************************
Detail Section - Executives
*/
var detailGrid1Name = 'Detail_Executive_Grid';
var detailForm1Name = 'Detail_Executive_Form';
var detailDs1Name='Film_Executive';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs1Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cFilm/Executives/')}
	 {literal}
  fields:
	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"مجری"},
	            {type:"string",title:"نام",name:"FirstName"},
	            {type:"string",title:"نام خانوادگی",name:"LastName"},
	            {type:"string",title:"کدملی",name:"NationalCode"},
	            {type:"string",title:"نام پدر",	name:"FatherName"},
	            {type:"string",title:"ملیت",name:"NationalityTitle"},
	            {type:"integer",hidden:true,name:"NationalityID"},
	            {type:"string",title:"کدپستی",name:"PostalCode"},
	            {type:"string",title:"شماره تلفن",name:"PhoneNo"}
	            ],
	            });
isc.ListGrid.create({
	{/literal}{$this->GetDetailListGrid(1)}{literal}
  	   });

	isc.DynamicForm.create({
		{/literal}{$this->GetDetailForm(1)}{literal}
	            fields:[
	    	            {hidden:"true", name:"FirstName"},
	    	            {hidden:"true", name:"LastName"},
	    	            {hidden:"true", name:"NationalCode"},
	    	            {hidden:"true", 	name:"FatherName"},
	    	            {hidden:"true", name:"NationalityTitle"},
	    	            {hidden:"true", name:"NationalityID"},
	    	            {hidden:"true",name:"PostalCode"},
	    	            {hidden:"true", name:"PhoneNo"},
	    	            {/literal}{$this->GetPickListField('id','Human','LastName','id',array('FirstName','LastName'))}{literal}
	    	    	    ]

	});
	{/literal}
	{$this->GetInitDetail(1)}
	{$this->GetDetailToolbar(1)}
	{$this->GetDetailLayout(1)}
	{literal}

/*****************************************************/

/***********************************************************************************************
Detail Section - TechnicalExperts
*/
var detailGrid2Name = 'Detail_TechnicalExpert_Grid';
var detailForm2Name = 'Detail_TechnicalExpert_Form';
var detailDs2Name='Film_TechnicalExpert';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs2Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cFilm/TechnicalExperts/')}
	 {literal}
  fields:
	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"کارشناس فنی"},
	            {type:"string",title:"نام",name:"FirstName"},
	            {type:"string",title:"نام خانوادگی",name:"LastName"},
	            {type:"string",title:"کدملی",name:"NationalCode"},
	            {type:"string",title:"نام پدر",	name:"FatherName"},
	            {type:"string",title:"ملیت",name:"NationalityTitle"},
	            {type:"integer",hidden:true,name:"NationalityID"},
	            {type:"string",title:"کدپستی",name:"PostalCode"},
	            {type:"string",title:"شماره تلفن",name:"PhoneNo"}
	            ],
	            });
isc.ListGrid.create({
	{/literal}{$this->GetDetailListGrid(2)}{literal}
  	   });

	isc.DynamicForm.create({
		{/literal}{$this->GetDetailForm(2)}{literal}
	            fields:[
	    	            {hidden:"true", name:"FirstName"},
	    	            {hidden:"true", name:"LastName"},
	    	            {hidden:"true", name:"NationalCode"},
	    	            {hidden:"true", 	name:"FatherName"},
	    	            {hidden:"true", name:"NationalityTitle"},
	    	            {hidden:"true", name:"NationalityID"},
	    	            {hidden:"true",name:"PostalCode"},
	    	            {hidden:"true", name:"PhoneNo"},
	    	            {/literal}{$this->GetPickListField('id','Human','LastName','id',array('FirstName','LastName'))}{literal}
	    	    	    ]

	});
	{/literal}
	{$this->GetInitDetail(2)}
	{$this->GetDetailToolbar(2)}
	{$this->GetDetailLayout(2)}
	{literal}

/*****************************************************/

/***********************************************************************************************
Detail Section - Speakers
*/
var detailGrid3Name = 'Detail_Speaker_Grid';
var detailForm3Name = 'Detail_Speaker_Form';
var detailDs3Name='Film_Speaker';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs3Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cFilm/Speakers/')}
	 {literal}
  fields:
	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"گوینده"},
	            {type:"string",title:"نام",name:"FirstName"},
	            {type:"string",title:"نام خانوادگی",name:"LastName"},
	            {type:"string",title:"کدملی",name:"NationalCode"},
	            {type:"string",title:"نام پدر",	name:"FatherName"},
	            {type:"string",title:"ملیت",name:"NationalityTitle"},
	            {type:"integer",hidden:true,name:"NationalityID"},
	            {type:"string",title:"کدپستی",name:"PostalCode"},
	            {type:"string",title:"شماره تلفن",name:"PhoneNo"}
	            ],
	            });
isc.ListGrid.create({
	{/literal}{$this->GetDetailListGrid(3)}{literal}
  	   });

	isc.DynamicForm.create({
		{/literal}{$this->GetDetailForm(3)}{literal}
	            fields:[
	    	            {hidden:"true", name:"FirstName"},
	    	            {hidden:"true", name:"LastName"},
	    	            {hidden:"true", name:"NationalCode"},
	    	            {hidden:"true", 	name:"FatherName"},
	    	            {hidden:"true", name:"NationalityTitle"},
	    	            {hidden:"true", name:"NationalityID"},
	    	            {hidden:"true",name:"PostalCode"},
	    	            {hidden:"true", name:"PhoneNo"},
	    	            {/literal}{$this->GetPickListField('id','Human','LastName','id',array('FirstName','LastName'))}{literal}
	    	    	    ]

	});
	{/literal}
	{$this->GetInitDetail(3)}
	{$this->GetDetailToolbar(3)}
	{$this->GetDetailLayout(3)}
	{literal}

/*****************************************************/

/***********************************************************************************************
Detail Section - Senarists
*/
var detailGrid4Name = 'Detail_Senarist_Grid';
var detailForm4Name = 'Detail_Senarist_Form';
var detailDs4Name='Film_Senarist';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs4Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cFilm/Senarists/')}
	 {literal}
  fields:
	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"سناریو نویس"},
	            {type:"string",title:"نام",name:"FirstName"},
	            {type:"string",title:"نام خانوادگی",name:"LastName"},
	            {type:"string",title:"کدملی",name:"NationalCode"},
	            {type:"string",title:"نام پدر",	name:"FatherName"},
	            {type:"string",title:"ملیت",name:"NationalityTitle"},
	            {type:"integer",hidden:true,name:"NationalityID"},
	            {type:"string",title:"کدپستی",name:"PostalCode"},
	            {type:"string",title:"شماره تلفن",name:"PhoneNo"}
	            ],
	            });
isc.ListGrid.create({
	{/literal}{$this->GetDetailListGrid(4)}{literal}
  	   });

	isc.DynamicForm.create({
		{/literal}{$this->GetDetailForm(4)}{literal}
	            fields:[
	    	            {hidden:"true", name:"FirstName"},
	    	            {hidden:"true", name:"LastName"},
	    	            {hidden:"true", name:"NationalCode"},
	    	            {hidden:"true", 	name:"FatherName"},
	    	            {hidden:"true", name:"NationalityTitle"},
	    	            {hidden:"true", name:"NationalityID"},
	    	            {hidden:"true",name:"PostalCode"},
	    	            {hidden:"true", name:"PhoneNo"},
	    	            {/literal}{$this->GetPickListField('id','Human','LastName','id',array('FirstName','LastName'))}{literal}
	    	    	    ]

	});
	{/literal}
	{$this->GetInitDetail(4)}
	{$this->GetDetailToolbar(4)}
	{$this->GetDetailLayout(4)}
	{literal}

/*****************************************************/
/***********************************************************************************************
Detail Section - Actors
*/
var detailGrid5Name = 'Detail_Actor_Grid';
var detailForm5Name = 'Detail_Actor_Form';
var detailDs5Name='Film_Actor';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs5Name','/jahad/Human/jdsenum/IRERP_5cmodules_5cjahad_5cmodels_5cFilm/Actors')}
	 {literal}
  fields:
	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"بازیگر"},
	            {type:"string",title:"نام",name:"FirstName"},
	            {type:"string",title:"نام خانوادگی",name:"LastName"},
	            {type:"string",title:"کدملی",name:"NationalCode"},
	            {type:"string",title:"نام پدر",	name:"FatherName"},
	            {type:"string",title:"ملیت",name:"NationalityTitle"},
	            {type:"integer",hidden:true,name:"NationalityID"},
	            {type:"string",title:"کدپستی",name:"PostalCode"},
	            {type:"string",title:"شماره تلفن",name:"PhoneNo"}
	            ],
	            });
isc.ListGrid.create({
	{/literal}{$this->GetDetailListGrid(5)}{literal}
  	   });

	isc.DynamicForm.create({
		{/literal}{$this->GetDetailForm(5)}{literal}
	            fields:[
	    	            {hidden:"true", name:"FirstName"},
	    	            {hidden:"true", name:"LastName"},
	    	            {hidden:"true", name:"NationalCode"},
	    	            {hidden:"true", 	name:"FatherName"},
	    	            {hidden:"true", name:"NationalityTitle"},
	    	            {hidden:"true", name:"NationalityID"},
	    	            {hidden:"true",name:"PostalCode"},
	    	            {hidden:"true", name:"PhoneNo"},
	    	            {/literal}{$this->GetPickListField('id','Human','LastName','id',array('FirstName','LastName'))}{literal}
	    	    	    ]

	});
	{/literal}
	{$this->GetInitDetail(5)}
	{$this->GetDetailToolbar(5)}
	{$this->GetDetailLayout(5)}
	{literal}

/*****************************************************/

/***********************************************************************************************
Detail Section - Writers
*/
var detailGrid6Name = 'Detail_Writer_Grid';
var detailForm6Name = 'Detail_Writer_Form';
var detailDs6Name='Film_Writer';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs6Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cFilm/Writers/')}
	 {literal}
  fields:
	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"نویسنده"},
	            {type:"string",title:"نام",name:"FirstName"},
	            {type:"string",title:"نام خانوادگی",name:"LastName"},
	            {type:"string",title:"کدملی",name:"NationalCode"},
	            {type:"string",title:"نام پدر",	name:"FatherName"},
	            {type:"string",title:"ملیت",name:"NationalityTitle"},
	            {type:"integer",hidden:true,name:"NationalityID"},
	            {type:"string",title:"کدپستی",name:"PostalCode"},
	            {type:"string",title:"شماره تلفن",name:"PhoneNo"}
	            ],
	            });
isc.ListGrid.create({
	{/literal}{$this->GetDetailListGrid(6)}{literal}
  	   });

	isc.DynamicForm.create({
		{/literal}{$this->GetDetailForm(6)}{literal}
	            fields:[
	    	            {hidden:"true", name:"FirstName"},
	    	            {hidden:"true", name:"LastName"},
	    	            {hidden:"true", name:"NationalCode"},
	    	            {hidden:"true", 	name:"FatherName"},
	    	            {hidden:"true", name:"NationalityTitle"},
	    	            {hidden:"true", name:"NationalityID"},
	    	            {hidden:"true",name:"PostalCode"},
	    	            {hidden:"true", name:"PhoneNo"},
	    	            {/literal}{$this->GetPickListField('id','Human','LastName','id',array('FirstName','LastName'))}{literal}
	    	    	    ]

	});
	{/literal}
	{$this->GetInitDetail(6)}
	{$this->GetDetailToolbar(6)}
	{$this->GetDetailLayout(6)}
	{literal}

/*****************************************************/

/***********************************************************************************************
Detail Section - Directors
*/
var detailGrid7Name = 'Detail_Director_Grid';
var detailForm7Name = 'Detail_Director_Form';
var detailDs7Name='Film_Director';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs7Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cFilm/Directors/')}
	 {literal}
  fields:
	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"کارگردان"},
	            {type:"string",title:"نام",name:"FirstName"},
	            {type:"string",title:"نام خانوادگی",name:"LastName"},
	            {type:"string",title:"کدملی",name:"NationalCode"},
	            {type:"string",title:"نام پدر",	name:"FatherName"},
	            {type:"string",title:"ملیت",name:"NationalityTitle"},
	            {type:"integer",hidden:true,name:"NationalityID"},
	            {type:"string",title:"کدپستی",name:"PostalCode"},
	            {type:"string",title:"شماره تلفن",name:"PhoneNo"}
	            ],
	            });
isc.ListGrid.create({
	{/literal}{$this->GetDetailListGrid(7)}{literal}
  	   });

	isc.DynamicForm.create({
		{/literal}{$this->GetDetailForm(7)}{literal}
	            fields:[
	    	            {hidden:"true", name:"FirstName"},
	    	            {hidden:"true", name:"LastName"},
	    	            {hidden:"true", name:"NationalCode"},
	    	            {hidden:"true", 	name:"FatherName"},
	    	            {hidden:"true", name:"NationalityTitle"},
	    	            {hidden:"true", name:"NationalityID"},
	    	            {hidden:"true",name:"PostalCode"},
	    	            {hidden:"true", name:"PhoneNo"},
	    	            {/literal}{$this->GetPickListField('id','Human','LastName','id',array('FirstName','LastName'))}{literal}
	    	    	    ]

	});
	{/literal}
	{$this->GetInitDetail(7)}
	{$this->GetDetailToolbar(7)}
	{$this->GetDetailLayout(7)}
	{literal}

/*****************************************************/
/****************************************************
Detail Section - EducationalGoals
 */
 var detailGrid8Name = 'Detail_EducationalGoal_Grid';
 var detailForm8Name = 'Detail_EducationalGoal_Form';
 var detailDs8Name='Film_EducationalGoal';
 isc.RestDataSource.create({
 	 {/literal}
 	 {$this->GetDataSource('detailDs8Name','/jahad/FilmEducationalGoal/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cFilm/EducationalGoals/')}
 	 {literal}
   fields:
 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
 	                {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"هدف آموزشی"},
 	                {name:"Name",type:"string",title:"نام"},
 	                {name:"Description",type:"string",title:"شرح", length:2000}
 	            ],
 	            });
 isc.ListGrid.create({
 	{/literal}{$this->GetDetailListGrid(8)}{literal}
   	   });

 	isc.DynamicForm.create({
 		{/literal}{$this->GetDetailForm(8)}{literal}
 	            fields:[
 	    	            {hidden:"true", name:"Name"},
 	    	            {hidden:"true", name:"Description"},
 	    	            {/literal}{$this->GetPickListField('id','FilmEducationalGoal','Name','id',array('Name','Description'))}{literal}
 	    	    	    ]

 	});
 	{/literal}
 	{$this->GetInitDetail(8)}
 	{$this->GetDetailToolbar(8)}
 	{$this->GetDetailLayout(8)}
 	{literal}

 /***********************************************/
 /****************************************************
Detail Section - FilmContentlists
 */
 var detailGrid9Name = 'Detail_FilmContentlist_Grid';
 var detailForm9Name = 'Detail_FilmContentlist_Form';
 var detailDs9Name='Film_FilmContentlist';
 isc.RestDataSource.create({
 	 {/literal}
 	 {$this->GetDataSource('detailDs9Name','/jahad/FilmContentlist/jds/_5cIRERP_5cmodules_5cjahad_5cmodels_5cFilm/FilmContentlists/')}
 	 {literal}
   fields:
 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
 	                {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
 	                {name:"ContentTitle",type:"string",title:"نام"},
 	                {name:"Description",type:"string",title:"شرح", length:2000}
 	            ],
 	            });
 isc.ListGrid.create({
 	{/literal}{$this->GetDetailListGrid(9)}{literal}
   	   });

 	isc.DynamicForm.create({
 		{/literal}{$this->GetDetailForm(9)}{literal}
 	});
 	{/literal}
 	{$this->GetInitDetail(9)}
 	{$this->GetDetailToolbar(9)}
 	{$this->GetDetailLayout(9)}
 	{literal}

 /***********************************************/
 {/literal}
 {$this->GetTabSet(array("مجریان"
		 				,"کارشناسان فنی"
		 				 ,"گویندگان"
		 				 ,"سناریو نویسان"
		 				 ,"بازیگران"
		 				 ,"نویسندگان"
		 				 ,"کارگردانان"
		 				 ,"اهداف آموزشی"
		 				 ,"فهرست فیلم"
		 				))}
 {$this->GetSectionStack("فیلم",
		 					"جزییات فیلم")}
 {literal}
 
  
</script>
{/literal}





