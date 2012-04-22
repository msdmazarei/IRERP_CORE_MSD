/**
 * 
 */

var IRERPJS_DataViewSection = function(id){
	this._id=id;
	
	this._commanders=new Array();
	this._commanders['NEW']=new Array();
	this._commanders['EDIT']=new Array();
	this._commanders['SAVE']=new Array();
	this._commanders['DELETE']=new Array();
	this._commanders['CANCEL']=new Array();
	this._commanders['Download']=new Array();
	this._commanders['Upload']=new Array();
	this._commanders['Print']=new Array();
	this._commanders['Comments']=new Array();
	this._commanders['Last']=new Array();
	this._commanders['First']=new Array();
	this._commanders['Next']=new Array();
	this._commanders['Previous']=new Array();
	
	
	this._iconpath=baseurl+"Download/sys/Icons/iconic/vector/";
	this._icon_new=iconpath+"New.png";
	this._icon_Save=iconpath+"Save.png";
	this._icon_Edit=iconpath+"Pen.png";
	this._icon_Delete=iconpath+"Trash.png";
	this._icon_Cancel=iconpath+"Cancel.png";
	
	this._icon_Download=iconpath+"Download.png";
	this._icon_Upload=iconpath+"Upload.png";
	
	this._icon_Print=iconpath+"Print.png";
	this._icon_Comments=iconpath+"Comments.png";
	
	this._icon_Last=iconpath+"Last.png";
	this._icon_First=iconpath+"First.png";
	
	this._icon_Next=iconpath+"Next.png";
	this._icon_Previous=iconpath+"Previous.png";
	
	
	
	this._icon_Refresh=iconpath+"reload_24x28.png";
}

IRERPJS_DataViewSection.prototype.addNEWCommander= function(Commanderid){
	this._commanders['NEW'][this._commanders['NEW'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getNEWCommanders= function(){
	return this._commanders['NEW'];
}


IRERPJS_DataViewSection.prototype.addEDITCommander= function(Commanderid){
	this._commanders['EDIT'][this._commanders['EDIT'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getEDITCommanders= function(){
	return this._commanders['EDIT'];
}

IRERPJS_DataViewSection.prototype.addSAVECommander= function(Commanderid){
	this._commanders['SAVE'][this._commanders['SAVE'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getSAVECommanders= function(){
	return this._commanders['SAVE'];
}

IRERPJS_DataViewSection.prototype.addDELETECommander= function(Commanderid){
	this._commanders['DELETE'][this._commanders['DELETE'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getDELETECommanders= function(){
	return this._commanders['DELETE'];
}

IRERPJS_DataViewSection.prototype.addCANCELCommander= function(Commanderid){
	this._commanders['CANCEL'][this._commanders['CANCEL'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getCANCELCommanders= function(){
	return this._commanders['CANCEL'];
}


IRERPJS_DataViewSection.prototype.addDownloadCommander= function(Commanderid){
	this._commanders['Download'][this._commanders['Download'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getDownloadCommanders= function(){
	return this._commanders['Download'];
}

IRERPJS_DataViewSection.prototype.addUploadCommander= function(Commanderid){
	this._commanders['Upload'][this._commanders['Upload'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getUploadCommanders= function(){
	return this._commanders['Upload'];
}

IRERPJS_DataViewSection.prototype.addCommentsCommander= function(Commanderid){
	this._commanders['Comments'][this._commanders['Comments'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getCommentsCommanders= function(){
	return this._commanders['Comments'];
}

IRERPJS_DataViewSection.prototype.addPrintCommander= function(Commanderid){
	this._commanders['Print'][this._commanders['Print'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getPrintCommanders= function(){
	return this._commanders['Print'];
}

IRERPJS_DataViewSection.prototype.addLastCommander= function(Commanderid){
	this._commanders['Last'][this._commanders['Last'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getLastCommanders= function(){
	return this._commanders['Last'];
}
IRERPJS_DataViewSection.prototype.addFirstCommander= function(Commanderid){
	this._commanders['First'][this._commanders['First'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getFirstCommanders= function(){
	return this._commanders['First'];
}

IRERPJS_DataViewSection.prototype.addNextCommander= function(Commanderid){
	this._commanders['Next'][this._commanders['Next'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getNextCommanders= function(){
	return this._commanders['Next'];
}
IRERPJS_DataViewSection.prototype.addPreviousCommander= function(Commanderid){
	this._commanders['Previous'][this._commanders['Previous'].length]=Commanderid;
	}
IRERPJS_DataViewSection.prototype.getPreviousCommanders= function(){
	return this._commanders['Previous'];
}




IRERPJS_DataViewSection.prototype.getIconNew=function(){return this._icon_new;}
IRERPJS_DataViewSection.prototype.setIconNew=function(icon){ this._icon_new=icon;}

IRERPJS_DataViewSection.prototype.getIconSave=function(){return this._icon_Save;}
IRERPJS_DataViewSection.prototype.setIconSave=function(icon){ this._icon_Save=icon;}

IRERPJS_DataViewSection.prototype.getIconEdit=function(){return this._icon_Edit;}
IRERPJS_DataViewSection.prototype.setIconEdit=function(icon){ this._icon_Edit=icon;}

IRERPJS_DataViewSection.prototype.getIconDelete=function(){return this._icon_Delete;}
IRERPJS_DataViewSection.prototype.setIconDelete=function(icon){ this._icon_Save=Delete;}

IRERPJS_DataViewSection.prototype.getIconCancel=function(){return this._icon_Cancel;}
IRERPJS_DataViewSection.prototype.setIconCancel=function(icon){ this._icon_Cancel=icon;}

IRERPJS_DataViewSection.prototype.getIconRefresh=function(){return this._icon_Refresh;}
IRERPJS_DataViewSection.prototype.setIconRefresh=function(icon){ this._icon_Refresh=icon;}

IRERPJS_DataViewSection.prototype.getIconComments=function(){return this._icon_Comments;}
IRERPJS_DataViewSection.prototype.setIconComments=function(icon){ this._icon_Comments=icon;}

IRERPJS_DataViewSection.prototype.getIconPrint=function(){return this._icon_Print;}
IRERPJS_DataViewSection.prototype.setIconPrint=function(icon){ this._icon_Print=icon;}

IRERPJS_DataViewSection.prototype.getIconLast=function(){return this._icon_Last;}
IRERPJS_DataViewSection.prototype.setIconLast=function(icon){ this._icon_Last=icon;}

IRERPJS_DataViewSection.prototype.getIconFirst=function(){return this._icon_First;}
IRERPJS_DataViewSection.prototype.setIconFirst=function(icon){ this._icon_First=icon;}

IRERPJS_DataViewSection.prototype.getIconNext=function(){return this._icon_Next;}
IRERPJS_DataViewSection.prototype.setIconNext=function(icon){ this._icon_Next=icon;}

IRERPJS_DataViewSection.prototype.getIconPrevious=function(){return this._icon_Previous;}
IRERPJS_DataViewSection.prototype.setIconPrevious=function(icon){ this._icon_Previous=icon;}

IRERPJS_DataViewSection.prototype.getIconUpload=function(){return this._icon_Upload;}
IRERPJS_DataViewSection.prototype.setIconUpload=function(icon){ this._icon_Upload=icon;}

IRERPJS_DataViewSection.prototype.getIconDownload=function(){return this._icon_Download;}
IRERPJS_DataViewSection.prototype.setIconDownload=function(icon){ this._icon_Download=icon;}





IRERPJS_DataViewSection.prototype.getID = function() {return this._id;}
IRERPJS_DataViewSection.prototype.setID = function(id){this._id=id;}

IRERPJS_DataViewSection.prototype.setFormId = function(formid){
	this._formid=formid;
	var frm=this.getForm();
	try{
	if(frm!=null)
		if(frm.getID()!=formid) this.setForm(eval(formid)); else return;
	else
		this.setForm(eval(formid));
	} catch(e){}
}

IRERPJS_DataViewSection.prototype.getFormId = function(){
	return this._formid;
}

IRERPJS_DataViewSection.prototype.getForm = function(){
	return this._form;
	
}

IRERPJS_DataViewSection.prototype.setForm = function(form){
	this._form = form;
	if(this.getFormId()!=form.getID()) this.setFormId(form.getID());
	this.getForm().IRERPDVS=this;

}

IRERPJS_DataViewSection.prototype.getGridId = function(){
	return this._GridId;
}

IRERPJS_DataViewSection.prototype.setGridId = function(gridid){
	this._GridId=gridid;
	
	//Try To Set Grid 
	try
	{
		var grd=this.getGrid();
		if(grd!=null) 
			if(grd.getID()!=gridid) this.setGrid(eval(gridid)); else return;
		else 
			this.setGrid(eval(gridid));
	}catch(e){}
}

IRERPJS_DataViewSection.prototype.setGrid = function (grid){
	this._Grid=grid;
	this.getGrid().IRERPDVS=this;
	try{
		if(this.getGridId()!=grid.getID()) this.setGridId(grid.getID());
	}catch(e){}
	}

IRERPJS_DataViewSection.prototype.getGrid = function (){
	return this._Grid;
}

IRERPJS_DataViewSection.prototype.setPage = function(page){
	if(this.getForm()!=null) {
		this.getForm().IRERPPage=page;
		
	}
	if(this.getGrid()!=null) {
		this.getGrid().IRERPPage=page;
		
	}
	this._Page=page;
}

IRERPJS_DataViewSection.prototype.getPage= function(){return this._Page;}

IRERPJS_DataViewSection.prototype.checkfunction= function(){alert('test');}