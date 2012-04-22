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
            {name:"Name",type:"string",title:"نام"},
            {name:"Description",type:"string",title:"شرح", length:2000}
            ],
            });

isc.ListGrid.create({
	{/literal}{$this->GetMasterListGrid()}{literal}
   });

isc.DynamicForm.create({
	{/literal}{$this->GetMasterForm()}{literal}    
});
{/literal}
{$this->GetInitMaster()}
{$this->GetMasterToolbar()}
{$this->GetMasterLayout()}
{literal}
MasterFrame.setHeight('100%');
</script>
{/literal}
