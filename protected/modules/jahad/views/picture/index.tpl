<script type="text/javascript">
var dsMasterName = "{$dsMaster}"; 
var frmMasterName = "frm{$dsMaster}";
var MasterGridName = "{$dsMaster}Grid";
{literal}
isc.RestDataSource.create({
	{/literal}{$this->GetMasterDataSource()}{literal}
    fields:
        [
         
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"TitleName",type:"string",title:"عنوان"},
            {name:"TitleID",type:"string",hidden:true,title:"عنوان"},
            {name:"ShotDate",type:"string",title:"تاریخ عکسبرداری"},
            {name:"ClientFirstName",type:"string",title:"نام سفارش دهنده"},
            {name:"ClientLastName",type:"string", title:"نام خانوادگی سفارش دهنده"},
            {name:"ClientID",type:"string",hidden:true,title:"سفارش دهنده"},
            {name:"PicCode",type:"string", title:"کد عکس"},
            {name:"ResulationName",type:"string",title:"وضوح تصویر"},
            {name:"ResulationID",type:"string",hidden:true,title:"وضوح تصویر"},
            {name:"SizeName",type:"string",title:"قطع عکس"},
            {name:"SizeID",type:"string",hidden:true,title:"قطع عکس"},
            {name:"LocationName",type:"string",title:"محل عکسبرداری"},
            {name:"LocationID",type:"string",hidden:true,title:"محل عکسبرداری"},
            {name:"PhotographerFirstName",type:"string" ,title:"نام عکاس"},
            {name:"PhotographerLastName",type:"string",title:"نام خانوادگی عکاس"},
            {name:"PhotographerID",type:"string",hidden:true,title:"  عکاس"},
            {name:"PictureFormatName",type:"string",title:"فرمت عکس"},
            {name:"PictureFormatID",type:"string",hidden:true,title:"فرمت عکس"},
            {name:"PictureTypeName",type:"string",title:"نوع عکس"},
            {name:"PictureTypeID",type:"string",hidden:true,title:"نوع عکس"},
            {name:"SubjectName",type:"string",title:"سوژه عکس"},
            {name:"SubjectID",type:"string",hidden:true,title:"سوژه عکس"},
            {name:"PicFile",type:"link",title:"پرونده",linkURLPrefix:baseurl+'Download/'}
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
	{/literal}{$this->GetDataSource('"Size"','/jahad/Size')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"Resulation"','/jahad/Resulation')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"Location"','/jahad/Location')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"Subject"','/jahad/Subject')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"PictureFormat"','/jahad/PictureFormat')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"PictureType"','/jahad/PictureType')}{literal}
    fields:
        [
            {hidden:"true",name:"id",primaryKey:"true",type:"integer"},
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });
isc.RestDataSource.create({
	{/literal}{$this->GetDataSource('"Human"','/jahad/Human')}{literal}
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
            });
            

isc.ListGrid.create({
	{/literal}{$this->GetMasterListGrid()}{literal}
   });

isc.DynamicForm.create({
	{/literal}{$this->GetMasterForm()}{literal}
		fields:[
	            {name:"TitleName",hidden:true},
	            {/literal}{$this->GetPickListField('TitleID','Title','Name','id',array('Name','Description'))}{literal}
	            	 ,{name:"ClientFirstName",hidden:true},
	                 {name:"ClientLastName",hidden:true},
	                 {/literal}{$this->GetPickListField('ClientID','Human','LastName','id',array('FirstName','LastName'))}{literal}
	                 ,{name:"ResulationName",hidden:true},
	                 {/literal}{$this->GetPickListField('ResulationID','Resulation','Name','id',array('Name','Description'))}{literal}
	                 ,{name:"SizeName",hidden:true},
	                 {/literal}{$this->GetPickListField('SizeID','Size','Name','id',array('Name','Description'))}{literal}
	                 
	                 ,{name:"LocationName",hidden:true},
	                 {/literal}{$this->GetPickListField('LocationID','Location','Name','id',array('Name','Description'))}{literal}
	                 ,{name:"PhotographerFirstName",hidden:true},
	                 {name:"PhotographerLastName",hidden:true},
	                 {/literal}{$this->GetPickListField('PhotographerID','Human','LastName','id',array('FirstName','LastName','NationalCode','PhoneNo'))}{literal}
	                 ,{name:"PictureFormatName",hidden:true},
	                 {/literal}{$this->GetPickListField('PictureFormatID','PictureFormat','Name','id',array('Name','Description'))}{literal}
	                 ,{name:"PictureTypeName",hidden:true},
	                 {/literal}{$this->GetPickListField('PictureTypeID','PictureType','Name','id',array('Name','Description'))}{literal}
	                 ,{name:"SubjectName",hidden:true},
	                 {/literal}{$this->GetPickListField('SubjectID','Subject','Name','id',array('Name','Description'))}{literal}
		                 ,{name:"PicFile",click:function(a,b){
		                     ShowUploadDialog(null,window.AfterUploadFile,a,b);

		                 }}
		]
});
{/literal}
{$this->GetInitMaster()}
{$this->GetMasterToolbar()}
{$this->GetMasterLayout()}
{literal}
MasterFrame.setHeight('100%');
</script>
{/literal}





