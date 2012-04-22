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
	{/literal}{$this->GetDataSource('"Auidunce"','/jahad/Auidunce')}{literal}
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
	            {name:"TVSchoolName",type:"string",title:"نام "},
	            {name:"TVTitle",type:"string",title:"عنوان"},
	            {name:"TVDescription",type:"string",title:"توضیحات"},
	            {name:"PublicationNo",type:"string",title:"شماره نشریه"},
	            {name:"PublicationCode",type:"string",title:"کد نشریه"},
	            {name:"PublicationPeriod",type:"string",title:"نوبت چاپ"},
	            {name:"PublicationDate",type:"string",title:"تاریخ انتشار"},
	            {name:"DistributionDate",type:"string", title:"تاریخ پخش"},
	            {name:"Tirajh",type:"string" ,title:"تیراژ"},
	            {name:"CenterName",type:"string" ,title:"نام مرکز"},
	            {name:"Address",type:"string" ,title:"آدرس"},
	            {name:"Tel",type:"string" ,title:"تلفن"},
	            {name:"Fax",type:"string" ,title:"دورنگار"},
	            {name:"AbstractFile",type:"link",title:"پرونده خلاصه ",linkURLPrefix:baseurl+'Download/'}
	            ],
        });
 
 
	 isc.ListGrid.create({
			{/literal}{$this->GetMasterListGrid()}{literal}
		   });

		isc.DynamicForm.create({
			{/literal}{$this->GetMasterForm()}{literal}
				fields:
					[
{name:"AbstractFile",click:function(a,b){
    ShowUploadDialog(null,window.AfterUploadFile,a,b);}}
						]
		});
		{/literal}
			 
	 {$this->GetInitMaster()}
	 {$this->GetMasterToolbar()}
	 {$this->GetMasterLayout()}
	 {literal}

	 /***********************************************************************************************
	 Detail Section - Publishers
	  */
	  var detailGrid1Name = 'Detail_Publisher_Grid';
	  var detailForm1Name = 'Detail_Publisher_Form';
	  var detailDs1Name='TVSchool_Publisher';
	  isc.RestDataSource.create({
	  	 {/literal}
	  	 {$this->GetDataSource('detailDs1Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/Publishers/')}
	  	 {literal}
	    fields:
	  	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	 	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"ناشر"},
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

	 /***********************************************************************************************
	 Detail Section - Writers
	 */
	 var detailGrid2Name = 'Detail_Writer_Grid';
	 var detailForm2Name = 'Detail_Writer_Form';
	 var detailDs2Name='TVSchool_Writer';
	 isc.RestDataSource.create({
	 	 {/literal}
	 	 {$this->GetDataSource('detailDs2Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/Writers/')}
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
	 Detail Section - TechnicalExperts
	 */
	 var detailGrid3Name = 'Detail_TechnicalExpert_Grid';
	 var detailForm3Name = 'Detail_TechnicalExpert_Form';
	 var detailDs3Name='TVSchool_TechnicalExpert';
	 isc.RestDataSource.create({
	 	 {/literal}
	 	 {$this->GetDataSource('detailDs3Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/TechnicalExperts/')}
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
	 Detail Section - TechnicalSupervisors
	 */
	 var detailGrid4Name = 'Detail_TechnicalSupervisor_Grid';
	 var detailForm4Name = 'Detail_TechnicalSupervisor_Form';
	 var detailDs4Name='TVSchool_TechnicalSupervisor';
	 isc.RestDataSource.create({
	 	 {/literal}
	 	 {$this->GetDataSource('detailDs4Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/TechnicalSupervisors/')}
	 	 {literal}
	   fields:
	 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	 	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"ناظر فنی"},
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
	 Detail Section - TVPrints
	 */
	  var detailGrid5Name = 'Detail_TVPrint_Grid';
	  var detailForm5Name = 'Detail_TVPrint_Form';
	  var detailDs5Name='TVSchool_TVPrint';
	  isc.RestDataSource.create({
	  	 {/literal}
	  	 {$this->GetDataSource('detailDs5Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/TVPrints/')}
	  	 {literal}
	    fields:
	    	[ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"چاپ"},
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
	 Detail Section - TypeSetters
	 */
	 var detailGrid6Name = 'Detail_TypeSetter_Grid';
	 var detailForm6Name = 'Detail_TypeSetter_Form';
	 var detailDs6Name='TVSchool_TypeSetter';
	 isc.RestDataSource.create({
	 	 {/literal}
	 	 {$this->GetDataSource('detailDs6Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/TypeSetters/')}
	 	 {literal}
	   fields:
	 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	 	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"حروفچین"},
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
	 Detail Section - Editors
	 */
	 var detailGrid7Name = 'Detail_Editor_Grid';
	 var detailForm7Name = 'Detail_Editor_Form';
	 var detailDs7Name='TVSchool_Editor';
	 isc.RestDataSource.create({
	 	 {/literal}
	 	 {$this->GetDataSource('detailDs7Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/Editors/')}
	 	 {literal}
	   fields:
	 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	 	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"ویراستار"},
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
	 /***********************************************************************************************
	 Detail Section - PageStylists
	 */
	 var detailGrid8Name = 'Detail_PageStylist_Grid';
	 var detailForm8Name = 'Detail_PageStylist_Form';
	 var detailDs8Name='TVSchool_PageStylist';
	 isc.RestDataSource.create({
	 	 {/literal}
	 	 {$this->GetDataSource('detailDs8Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/PageStylists/')}
	 	 {literal}
	   fields:
	 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	 	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"صفحه آرا"},
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
	 	{/literal}{$this->GetDetailListGrid(8)}{literal}
	   	   });

	 	isc.DynamicForm.create({
	 		{/literal}{$this->GetDetailForm(8)}{literal}
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
	 	{$this->GetInitDetail(8)}
	 	{$this->GetDetailToolbar(8)}
	 	{$this->GetDetailLayout(8)}
	 	{literal}

	 /*****************************************************/
	 /***********************************************************************************************
	 Detail Section - Graphists
	 */
	 var detailGrid9Name = 'Detail_Graphist_Grid';
	 var detailForm9Name = 'Detail_Graphist_Form';
	 var detailDs9Name='TVSchool_Graphist';
	 isc.RestDataSource.create({
	 	 {/literal}
	 	 {$this->GetDataSource('detailDs9Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/Graphists/')}
	 	 {literal}
	   fields:
	 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	 	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"گرافیست"},
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
	 /***********************************************************************************************
	 Detail Section - Preparators
	 */
	 var detailGrid10Name = 'Detail_Preparator_Grid';
	 var detailForm10Name = 'Detail_Preparator_Form';
	 var detailDs10Name='TVSchool_Preparator';
	 isc.RestDataSource.create({
	 	 {/literal}
	 	 {$this->GetDataSource('detailDs10Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/Preparators/')}
	 	 {literal}
	   fields:
	 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	 	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"آماده سازی"},
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
	 	{/literal}{$this->GetDetailListGrid(10)}{literal}
	   	   });

	 	isc.DynamicForm.create({
	 		{/literal}{$this->GetDetailForm(10)}{literal}
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
	 	{$this->GetInitDetail(10)}
	 	{$this->GetDetailToolbar(10)}
	 	{$this->GetDetailLayout(10)}
	 	{literal}

	 /*****************************************************/
	 /***********************************************************************************************
	 Detail Section - LitoGraphists
	 */
	 var detailGrid11Name = 'Detail_LitoGraphist_Grid';
	 var detailForm11Name = 'Detail_LitoGraphist_Form';
	 var detailDs11Name='TVSchool_LitoGraphist';
	 isc.RestDataSource.create({
	 	 {/literal}
	 	 {$this->GetDataSource('detailDs11Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/LitoGraphists/')}
	 	 {literal}
	   fields:
	 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
	 	            {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"لیتوگرافی"},
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
	 	{/literal}{$this->GetDetailListGrid(11)}{literal}
	   	   });

	 	isc.DynamicForm.create({
	 		{/literal}{$this->GetDetailForm(11)}{literal}
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
	 	{$this->GetInitDetail(11)}
	 	{$this->GetDetailToolbar(11)}
	 	{$this->GetDetailLayout(11)}
	 	{literal}

	 /*****************************************************/

/************************Detail Section - BookBinders
 */
 var detailGrid12Name = 'Detail_BookBinder_Grid';
 var detailForm12Name = 'Detail_BookBinder_Form';
 var detailDs12Name='TVSchool_BookBinder';
 isc.RestDataSource.create({
 	 {/literal}
 	 {$this->GetDataSource('detailDs12Name','/jahad/Human/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/BookBinders/')}
 	 {literal}
   fields:
	   [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
          {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"صحاف"},
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
 	{/literal}{$this->GetDetailListGrid(12)}{literal}
   	   });

 	isc.DynamicForm.create({
 		{/literal}{$this->GetDetailForm(12)}{literal}
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
 	{$this->GetInitDetail(12)}
 	{$this->GetDetailToolbar(12)}
 	{$this->GetDetailLayout(12)}
 	{literal}

 /***********************************************/	 
/************************Detail Section - Audiences
 */
 var detailGrid13Name = 'Detail_Audience_Grid';
 var detailForm13Name = 'Detail_Audience_Form';
 var detailDs13Name='TVSchool_Audience';
 isc.RestDataSource.create({
 	 {/literal}
 	 {$this->GetDataSource('detailDs13Name','/jahad/Auidunce/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/Audiences/')}
 	 {literal}
   fields:
	   [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
           {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"مخاطب"},
           {name:"Name",type:"string",title:"نام"},
           {name:"Description",type:"string",title:"شرح", length:2000}
       ],
 	            });
 isc.ListGrid.create({
 	{/literal}{$this->GetDetailListGrid(13)}{literal}
   	   });

 	isc.DynamicForm.create({
 		{/literal}{$this->GetDetailForm(13)}{literal}
 	            fields:[
  	    	            {hidden:"true", name:"Name"},
  	    	            {hidden:"true", name:"Description"},
  	    	            {/literal}{$this->GetPickListField('id','Auidunce','Name','id',array('Name','Description'))}{literal}
  	    	    	    ]

 	});
 	{/literal}
 	{$this->GetInitDetail(13)}
 	{$this->GetDetailToolbar(13)}
 	{$this->GetDetailLayout(13)}
 	{literal}

 /***********************************************/	 
/************************Detail Section - EducationalGoals
 */
 var detailGrid14Name = 'Detail_EducationalGoal_Grid';
 var detailForm14Name = 'Detail_EducationalGoal_Form';
 var detailDs14Name='TVSchool_EducationalGoal';
 isc.RestDataSource.create({
 	 {/literal}
 	 {$this->GetDataSource('detailDs14Name','/jahad/FilmEducationalGoal/jdsenum/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/EducationalGoals/')}
 	 {literal}
   fields:
 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
 	                {hidden:"true",name:"id",primaryKey:"true",type:"integer",title:"هدف آموزشی"},
 	                {name:"Name",type:"string",title:"نام"},
 	                {name:"Description",type:"string",title:"شرح", length:2000}
 	            ],
 	            });
 isc.ListGrid.create({
 	{/literal}{$this->GetDetailListGrid(14)}{literal}
   	   });

 	isc.DynamicForm.create({
 		{/literal}{$this->GetDetailForm(14)}{literal}
 	            fields:[
 	    	            {hidden:"true", name:"Name"},
 	    	            {hidden:"true", name:"Description"},
 	    	            {/literal}{$this->GetPickListField('id','FilmEducationalGoal','Name','id',array('Name','Description'))}{literal}
 	    	    	    ]

 	});
 	{/literal}
 	{$this->GetInitDetail(14)}
 	{$this->GetDetailToolbar(14)}
 	{$this->GetDetailLayout(14)}
 	{literal}

 /***********************************************/					
/**********Detail Section - ContentList
 */
 var detailGrid15Name = 'Detail_TVContentList_Grid';
 var detailForm15Name = 'Detail_TVContentList_Form';
 var detailDs15Name='TVSchool_TVContentList';
 isc.RestDataSource.create({
 	 {/literal}
 	 {$this->GetDataSource('detailDs15Name','/jahad/TVContentList/jds/_5cIRERP_5cmodules_5cjahad_5cmodels_5cTVSchool/ContentList/')}
 	 {literal}
   fields:
 	        [ {hidden:"true",name:"HelpField",primaryKey:"true",type:"integer"},
 	                {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
 	                {name:"ContentTitle",type:"string",title:"نام"},
 	                {name:"Description",type:"string",title:"شرح", length:2000}
 	            ],
 	            });
 isc.ListGrid.create({
 	{/literal}{$this->GetDetailListGrid(15)}{literal}
   	   });

 	isc.DynamicForm.create({
 		{/literal}{$this->GetDetailForm(15)}{literal}
 	});
 	{/literal}
 	{$this->GetInitDetail(15)}
 	{$this->GetDetailToolbar(15)}
 	{$this->GetDetailLayout(15)}
 	{literal}

 /***********************************************/
 
  {/literal}
 {$this->GetTabSet(array("ناشران"
		                ,"نویسندگان"
		 				,"کارشناسان فنی"
		 				,"ناظران فنی"
		 				 ,"چاپ"
		 				 ,"حروفچینی"
		 				 ,"ویراستاران"
		 				,"صفحه آرایی"
		 				 ,"گرافیک"
		 				,"آماده سازی"
		 				,"لیتوگرافی"
		 				,"صحافی"
		 				,"مخاطبین"
		 				 ,"اهداف آموزشی"
		 				 ,"فهرست فیلم"
		 				))}
 {$this->GetSectionStack("مدرسه تلویزیونی",
		 					"جزییات مدرسه تلویزیونی")}
 
 {literal}
 
</script>
{/literal}
