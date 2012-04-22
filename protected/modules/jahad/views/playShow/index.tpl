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
	{/literal}{$this->GetDataSource('"PlayShowContentlist"','/jahad/PlayShowContentlist')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"Auidunce"','/jahad/Auidunce')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });  
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"Title"','/jahad/Title')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"FilmEducationalGoal"','/jahad/FilmEducationalGoal')}{literal}
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
            {name:"PlayShowTime",type:"string",title:"زمان "},
            {name:"Center",type:"string",title:"مرکز"},
            {name:"PlayShowCode",type:"string",title:"کد "},
            {name:"PlayShowabstracFile",type:"link",title:"پرونده خلاصه ",linkURLPrefix:baseurl+'Download/'},
            {name:"TitleName",type:"string",title:"عنوان"},
            {name:"TitleID",type:"string",hidden:true,title:"عنوان"}
            ],
            });

isc.ListGrid.create({
	{/literal}{$this->GetMasterListGrid()}{literal}
   });

isc.DynamicForm.create({
	{/literal}{$this->GetMasterForm()}{literal}
		fields:[
	            ,    {name:"TitleName",type:"string",title:"عنوان",hidden:true},
	            {/literal}{$this->GetPickListField('TitleID','Title','Name','id',array('Name','Description'))}{literal}
	            	,{name:"PlayShowabstracFile",click:function(a,b){
	                     ShowUploadDialog(null,window.AfterUploadFile,a,b);}}
	    		            
				]
});
{/literal}
{$this->GetInitMaster()}
{$this->GetMasterToolbar()}
{$this->GetMasterLayout()}
{literal}
/***********************************************************************************************
Detail Section - TechnicalExperts
*/
var detailGrid1Name = 'Detail_TechnicalExpert_Grid';
var detailForm1Name = 'Detail_TechnicalExpert_Form';
var detailDs1Name='PlayShow_TechnicalExpert';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs1Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cPlayShow/TechnicalExperts/')}
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
Detail Section - Speakers
*/
var detailGrid2Name = 'Detail_Speaker_Grid';
var detailForm2Name = 'Detail_Speaker_Form';
var detailDs2Name='PlayShow_Speaker';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs2Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cPlayShow/Speakers/')}
	 {literal}
  fields:
	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"راوی"},
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
Detail Section - Actors
*/
var detailGrid3Name = 'Detail_Actor_Grid';
var detailForm3Name = 'Detail_Actor_Form';
var detailDs3Name='PlayShow_Actor';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs3Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cPlayShow/Actors/')}
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
Detail Section - Writers
*/
var detailGrid4Name = 'Detail_Writer_Grid';
var detailForm4Name = 'Detail_Writer_Form';
var detailDs4Name='PlayShow_Writer';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs4Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cPlayShow/Writers')}
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
Detail Section - Directors
*/
var detailGrid5Name = 'Detail_Director_Grid';
var detailForm5Name = 'Detail_Director_Form';
var detailDs5Name='PlayShow_Director';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs5Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cPlayShow/Directors/')}
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
 
 
/****************************************************
Detail Section - EducationalGoals
 */
 var detailGrid6Name = 'Detail_EducationalGoal_Grid';
 var detailForm6Name = 'Detail_EducationalGoal_Form';
 var detailDs6Name='PlayShow_EducationalGoal';
 isc.RestDataSource.create({
 	 {/literal}
 	 {$this->GetDataSource('detailDs6Name','/jahad/FilmEducationalGoal/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cPlayShow/EducationalGoals/')}
 	 {literal}
   fields:
 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
 	                {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"هدف آموزشی"},
 	                {name:"Name",type:"string",title:"نام"},
 	                {name:"Description",type:"string",title:"شرح", length:2000}
 	            ],
 	            });
 isc.ListGrid.create({
 	{/literal}{$this->GetDetailListGrid(6)}{literal}
   	   });

 	isc.DynamicForm.create({
 		{/literal}{$this->GetDetailForm(6)}{literal}
 	            fields:[
 	    	            {hidden:"true", name:"Name"},
 	    	            {hidden:"true", name:"Description"},
 	    	            {/literal}{$this->GetPickListField('id','FilmEducationalGoal','Name','id',array('Name','Description'))}{literal}
 	    	    	    ]

 	});
 	{/literal}
 	{$this->GetInitDetail(6)}
 	{$this->GetDetailToolbar(6)}
 	{$this->GetDetailLayout(6)}
 	{literal}

 /***********************************************/
 /****************************************************
Detail Section - PlayShowContentlists
 */
 var detailGrid7Name = 'Detail_PlayShowContentlist_Grid';
 var detailForm7Name = 'Detail_PlayShowContentlist_Form';
 var detailDs7Name='PlayShow_PlayShowContentlist';
 isc.RestDataSource.create({
 	 {/literal}
 	 {$this->GetDataSource('detailDs7Name','/jahad/PlayShowContentlist/jds/_5cIRERP_5cmodules_5cjahad_5cmodels_5cPlayShow/PlayShowContentlists/')}
 	 {literal}
   fields:
 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
 	                {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
 	                {name:"ContentTitle",type:"string",title:"نام"},
 	                {name:"Description",type:"string",title:"شرح", length:2000}
 	            ],
 	            });
 isc.ListGrid.create({
 	{/literal}{$this->GetDetailListGrid(7)}{literal}
   	   });

 	isc.DynamicForm.create({
 		{/literal}{$this->GetDetailForm(7)}{literal}
 	});
 	{/literal}
 	{$this->GetInitDetail(7)}
 	{$this->GetDetailToolbar(7)}
 	{$this->GetDetailLayout(7)}
 	{literal}

 /***********************************************/
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /************************Detail Section - Audiences
 */
 var detailGrid8Name = 'Detail_Audience_Grid';
 var detailForm8Name = 'Detail_Audience_Form';
 var detailDs8Name='PlayShow_Audience';
 isc.RestDataSource.create({
 	 {/literal}
 	 {$this->GetDataSource('detailDs8Name','/jahad/Auidunce/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cPlayShow/Audiences/')}
 	 {literal}
   fields:
 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
 	                {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"مخاطب"},
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
 	    	            {/literal}{$this->GetPickListField('id','Auidunce','Name','id',array('Name','Description'))}{literal}
 	    	    	    ]

 	});
 	{/literal}
 	{$this->GetInitDetail(8)}
 	{$this->GetDetailToolbar(8)}
 	{$this->GetDetailLayout(8)}
 	{literal}

 /***********************************************/
 
/***********************************************************************************************
Detail Section - Producers
*/
var detailGrid9Name = 'Detail_Producer_Grid';
var detailForm9Name = 'Detail_Producer_Form';
var detailDs9Name='PlayShow_Producer';
isc.RestDataSource.create({
	 {/literal}
	 {$this->GetDataSource('detailDs9Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cPlayShow/Producers/')}
	 {literal}
  fields:
	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"تهیه کننده"},
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
	{/literal}{$this->GetDetailListGrid(9)}{literal}
  	   });

	isc.DynamicForm.create({
		{/literal}{$this->GetDetailForm(9)}{literal}
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
	{$this->GetInitDetail(9)}
	{$this->GetDetailToolbar(9)}
	{$this->GetDetailLayout(9)}
	{literal}

/*****************************************************/
 	 
 {/literal}
 {$this->GetTabSet(array(
		 				"کارشناسان فنی"
		 				 ,"راویان"
		 				 ,"بازیگران"
		 				 ,"نویسندگان"
		 				 ,"کارگردانان"
		 				 ,"اهداف آموزشی"
		 				 ,"فهرست "
		 				 ,"مخاطبین"
		 				 ,"تهیه کنندگان"
		 				))}
 {$this->GetSectionStack("نمایش",
		 					"جزییات نمایش")}
 {literal}
 
  
</script>
{/literal}





