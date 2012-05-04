/**
 * 
 */

var IRERPJS_Page=function(id){
	this._id=id;
	// Details DataViewSection
	this._Details=new Array();
	// Master DataViewSection
	this._Master = null;

	// Variable To Save Shown Details, Shown Details = Details that are showing
	this._ShownDetails=new Array();
	
	this._iconpath=baseurl+"Download/sys/Icons/iconic/vector/";
	this._icon_new=iconpath+"Health.png";
	this._icon_Save=iconpath+"Save.png";
	this._icon_Edit=iconpath+"Pen.png";
	this._icon_Delete=iconpath+"Trash.png";
	this._icon_Cancel=iconpath+"Cancel.png";

}
/**
 * @author Msd.Mazarei
 * @param IRERPJS_DataViewSection dv
 * @return nothing
 */
IRERPJS_Page.prototype.setMaster=function(dv){
	this._Master=dv;
	this._Master.setPage(this);
}
/**
 * 
 * @author Msd.Mazarei
 * @returns IRERPJS_DataViewSection
 * Page Master DVS(DataViewSection)
 */
IRERPJS_Page.prototype.getMaster=function(){return this._Master;}
/**
 * @author Msd.Mazarei
 * @param IRERPJS_DataViewSection dv
 * @returns nothing
 * Add New Detail To This Page
 */
IRERPJS_Page.prototype.addDetail=function(dv){
	dv.setPage(this);
	this._Details[this._Details.length]=dv;
}
/**
 * @author Msd.Mazarei
 * @returns IRERPJS_DataViewSection[]
 * Get All Detail DVS that current Are Showing
 */
IRERPJS_Page.prototype.getShownDetails = function(){return this._ShownDetails;}
/**
 * @author Msd.Mazarei
 * @param String Detailid
 * @returns integer
 * Determine that Detailid is showing or not, 
 * if it is showing returns index of it in ShownDetails
 * else returns -1
 */
IRERPJS_Page.prototype.IsDetailShown = function (Detailid){
	for(var i=0;i<this.getShownDetails().length;i++)
		if(this.getShownDetails()[i].getID()==Detailid) return i;
	return -1;
}
/**
 * @author Msd.Mazarei
 * @param String Detailid
 * @returns Nothing
 * Add New Detail to list of Showing DVS
 */
IRERPJS_Page.prototype.setDetailShown= function (Detailid){
	if(this.IsDetailShown(Detailid)==-1) 
		try{
		this._ShownDetails[this.getShownDetails().length]=Detailid;
		}catch(e){}
		//alert(this.getShownDetails().length);
}
/**
 * @author Msd.Mazarei
 * @param String Detailid
 * @returns Nothing
 * Remove Detailid from Showing Detail DVS
 */
IRERPJS_Page.prototype.setDetailHidden = function (Detailid){
	var index=this.IsDetailShown(Detailid);
	if(index!=-1) 
		//Remove index from array
		this._ShownDetails[index].remove();
}

/**
 * @author Msd.Mazarei
 * @param String Detailid
 * @returns IRERPJS_DataViewSection
 * Get Detail DVS by ID
 */
IRERPJS_Page.prototype.getDetailByID=function(Detailid){
	for(var i=0;i<this.getDetails().length;i++)
		if(this.getDetail(i).getID()==Detailid) return this.getDetail(i);
}

/**
 * @author Msd.Mazarei
 * @param integer index
 * @returns IRERPJS_DataViewSection 
 * return DVS at index position in Details Array
 */
IRERPJS_Page.prototype.getDetail=function(index){return this._Details[index];}
/**
 * @author Msd.Mazarei
 * @returns IRERPJS_DataViewSection[]
 * return All Details 
 */
IRERPJS_Page.prototype.getDetails=function(){return this._Details;}

/**
 * @author Msd.Mazarei
 * @param string Masterid
 * @returns Nothing
 * When Master Selected Record Change This Function 
 * Notify this change to all Children DVS
 */
IRERPJS_Page.prototype.MasterRecordChange=function(Masterid)
{
	for(var i=0;this.getDetails().length>i;i++){
		var Detail_DVS=this.getDetail(i);
		
		if(Detail_DVS.getForm()!=null) 
			Detail_DVS.getForm().HelpField=Masterid;

		if(Detail_DVS.getGrid()!=null)
			Detail_DVS.getGrid().initialCriteria={HelpField:Masterid};
	}

	//FIXME: To Test
	
	if(
			(this.getShownDetails().length==0) && 
			(this.getDetails().length>0))
		{
		var __id=this.getDetails()[0].getID();
		this.setDetailShown(__id);
		}
	//////////////////////////
	for(var i=0;this.getShownDetails().length>i;i++){
		var grid=eval(this.getShownDetails()[i]).getGrid();
		grid.fetchData({HelpField:Masterid});
	}

}

/**
 * @author Msd.Mazarei
 * @param String Detailid
 * @returns Nothing
 * Fill DVS Grid By MasterId
 */
IRERPJS_Page.prototype.ShowDetailDVS = function (Detailid){
	var _DVS=this.getDetailByID(Detailid);
	var Masterid=_DVS.getForm().HelpField;
	_DVS.getGrid().fetchData({HelpField:Masterid});
	
}
IRERPJS_Page.prototype.onReceiveData   = function(dsResponse, data, dsRequest,sender)
{
	var sendertype = sender.__proto__.Class;
	switch(dsResponse.status){
	case -4:
		//Validation Error
		if(sendertype=="DynamicForm"){
			sender.setErrors(dsResponse.errors,true);
			this.GeneralEnableDisable(sender.IRERPDVS, true, false, false, true, false, true);
		}
		break;
	case 0:
		//On Successful
		break;
	}
}
IRERPJS_Page.prototype.AfterUpdateData = function(dsResponse, data, dsRequest,sender){
	this.onReceiveData(dsResponse, data, dsRequest, sender);
	
}
IRERPJS_Page.prototype.AfterAddData    = function(dsResponse,data,dsRequest,sender){
	this.onReceiveData(dsResponse, data, dsRequest, sender);
}

IRERPJS_Page.prototype.SaveForm = function (Form){
	
	var closurethis=this;
	// Detect Type Of Form DVS
	/**
	 * @type IRERPJS_DataViewSection
	 */
	var DVS = Form.IRERPDVS;
	if(DVS.getID()==this.getMaster().getID()){
		// Master Form
		 if(Form.isNewRecord ()) 
			 (eval(Form.dataSource))
			 .addData(Form.getValues(),function(){
				 closurethis.AfterAddData(arguments[0],arguments[1],arguments[2],Form);
			 });
		 
		 else 
			 (eval(Form.dataSource)).updateData(Form.getValues(),function(){
				 closurethis.AfterAddData(arguments[0],arguments[1],arguments[2],Form);
			 });
		 
	}else if (this.getDetailByID(DVS.getID())!=null){
		// Detail Form
		// Detail Form Must Send HelpField To Server
		/**
		 * @type Array
		 */
		var Datas=Form.getValues();
		
		if(Form.isNewRecord()) 
		{
			Datas.HelpField=Form.HelpField;
			eval(Form.dataSource).addData(Datas,function(){
				 closurethis.AfterAddData(arguments[0],arguments[1],arguments[2],Form);
			 });
		} 
		else 
			eval(Form.dataSource).updateData(Datas,function(){
				 closurethis.AfterAddData(arguments[0],arguments[1],arguments[2],Form);
			 });
	}
	
}

/**
 * @param IRERPJS_DataViewSection DVS
 * @param bool FStatus -- Form 
 * @param bool NCStatus -- NewCommanders
 * @param bool ECStatus -- EditCommanders
 * @param bool SCStatus -- SaveCommanders
 * @param bool DCStatus -- DeleteCommanders
 * @param bool CCStatus -- CancelCommanders
 */
IRERPJS_Page.prototype.GeneralEnableDisable=function(DVS,
		FStatus,
		NCStatus,
		ECStatus,
		SCStatus,
		DCStatus,
		CCStatus)
{
	if(DVS!=null)
		{
		 var form = DVS.getForm();
		 if(FStatus!=null)
			 {
			 if(FStatus==true) EnableForm(form); else DisableForm(form);
			 }
		 if(NCStatus!=null)
			 {
			 if(NCStatus==true)
				for(var i=0;i<DVS.getNEWCommanders().length;i++) 
					try
					{DVS.getNEWCommanders()[i].enable();}
					catch(e){}
			else
				for(var i=0;i<DVS.getNEWCommanders().length;i++) 
					try
					{DVS.getNEWCommanders()[i].disable();}
					catch(e){}
			 }

		 if(ECStatus!=null)
			 {
			 if(ECStatus==true)
				for(var i=0;i<DVS.getEDITCommanders().length;i++) 
					try
					{DVS.getEDITCommanders()[i].enable();}
					catch(e){}
			else
				for(var i=0;i<DVS.getEDITCommanders().length;i++) 
					try
					{DVS.getEDITCommanders()[i].disable();}
					catch(e){}
			 }

		 if(SCStatus!=null)
			 {
			 if(SCStatus==true)
				for(var i=0;i<DVS.getSAVECommanders().length;i++) 
					try
					{DVS.getSAVECommanders()[i].enable();}
					catch(e){}
			else
				for(var i=0;i<DVS.getSAVECommanders().length;i++) 
					try
					{DVS.getSAVECommanders()[i].disable();}
					catch(e){}
			 }

		 if(DCStatus!=null)
		 {
			 if(DCStatus==true)
				for(var i=0;i<DVS.getDELETECommanders().length;i++) 
					try
					{DVS.getDELETECommanders()[i].enable();}
					catch(e){}
			else
				for(var i=0;i<DVS.getDELETECommanders().length;i++) 
					try
					{DVS.getDELETECommanders()[i].disable();}
					catch(e){}
		 }

		 if(CCStatus!=null)
		 {
			 if(CCStatus==true)
				for(var i=0;i<DVS.getCANCELCommanders().length;i++) 
					try
					{DVS.getCANCELCommanders()[i].enable();}
					catch(e){}
			else
				for(var i=0;i<DVS.getCANCELCommanders().length;i++) 
					try
					{DVS.getCANCELCommanders()[i].disable();}
					catch(e){}
		 }
		 
		}
}
/**
 * @param IRERPJS_DataViewSection DVS
 * @author Msd.Mazarei
 */
IRERPJS_Page.prototype.OnNEWCommand = function(DVS){
	this.GeneralEnableDisable(DVS, true, false, false, true, false, true);
	DVS.getForm().editNewRecord();
	//Show Window
	try{
		var winformid ="WINFORM_"+DVS.getForm().getID();
		var win = eval(winformid);
		win.show();
	}catch(e){}
	
}
/**
 * @param IRERPJS_DataViewSection DVS
 * @author Msd.Mazarei
 */
IRERPJS_Page.prototype.OnSAVECommand = function(DVS){
	this.GeneralEnableDisable(DVS, false, true, true, false, true, true);
	//Save Record
	this.SaveForm(DVS.getForm());
}
/**
 * @param IRERPJS_DataViewSection DVS
 * @author Msd.Mazarei
 */

IRERPJS_Page.prototype.OnEDITCommand = function(DVS){
	this.GeneralEnableDisable(DVS, true, false, false, true, false, true);
	//Show Window
	try{
		var winformid ="WINFORM_"+DVS.getForm().getID();
		var win = eval(winformid);
		win.show();
	}catch(e){}
}
/**
 * @param IRERPJS_DataViewSection DVS
 * @author Msd.Mazarei
 */

IRERPJS_Page.prototype.OnDELETECommand = function(DVS){

	this.ShowDialog('اخطار حذف',
			'آیا از حذف مورد انتخاب شده اطمینان دارید؟',
			'بله',
			'خیر',
			this.DeleteRecord,
			DVS.getForm().getID(),
			DVS.getGrid().getID()
			);

}

IRERPJS_Page.prototype.OnRefreshCommand=function(DVS){
	var criteria = DVS.getGrid().initialCriteria;
	DVS.getGrid().initialCriteria=null;
	DVS.getGrid().fetchData({taghi:1});
	DVS.getGrid().initialCriteria = criteria;
	DVS.getGrid().fetchData(criteria);
}
/**
 * @param IRERPJS_DataViewSection DVS
 * @author Msd.Mazarei
 */

IRERPJS_Page.prototype.OnCANCELCommand = function(DVS){
	this.GeneralEnableDisable(DVS, false, true, true, false, true, true);
}

/**
 * @param IRERPJS_DataViewSection DVS
 * @author Msd.Mazarei
 */
IRERPJS_Page.prototype.OnFirstCommand = function(DVS){
	this.OnCANCELCommand(DVS);
	var totalrows=DVS.getGrid().getTotalRows();
	if(totalrows>0)
	DVS.getGrid().selectSingleRecord(0);
}

/**
 * @param IRERPJS_DataViewSection DVS
 * @author Msd.Mazarei
 */
IRERPJS_Page.prototype.OnLastCommand = function(DVS){
	this.OnCANCELCommand(DVS);
	var totalrows=DVS.getGrid().getTotalRows();
	if(totalrows>0)
	DVS.getGrid().selectSingleRecord(totalrows-1);
}


/**
 * @param IRERPJS_DataViewSection DVS
 * @author Msd.Mazarei
 */
IRERPJS_Page.prototype.OnPreviousCommand = function(DVS){
	this.OnCANCELCommand(DVS);
	//Get Currect Selected Record
	if(DVS.getGrid().anySelected())
		{
		var selectedrecord=DVS.getGrid().getSelectedRecord();
		if(selectedrecord!=null){
			var selectedrecordindex=DVS.getGrid().getRecordIndex(selectedrecord);
			if(selectedrecordindex>0) selectedrecordindex--;
			DVS.getGrid().selectSingleRecord(selectedrecordindex);
		} else this.OnFirstCommand(DVS);
		}
	else
		{
		this.OnFirstCommand(DVS);
		}
}

/**
 * @param IRERPJS_DataViewSection DVS
 * @author Msd.Mazarei
 */
IRERPJS_Page.prototype.OnNextCommand = function(DVS){
	this.OnCANCELCommand(DVS);
	//Get Currect Selected Record
	if(DVS.getGrid().anySelected())
		{
		var selectedrecord=DVS.getGrid().getSelectedRecord();
		if(selectedrecord!=null){
			var totalrows=DVS.getGrid().getTotalRows();
			
			var selectedrecordindex=DVS.getGrid().getRecordIndex(selectedrecord);
			if(selectedrecordindex<(totalrows-1)) selectedrecordindex++;
			DVS.getGrid().selectSingleRecord(selectedrecordindex);
		} else this.OnFirstCommand(DVS);
		}
	else
		{
		this.OnFirstCommand(DVS);
		}
}


IRERPJS_Page.prototype.OnGridRecordClick = function (Grid,DVS){
	
	var record = Grid.getSelectedRecord();
	if (record == null) return ;
	// Check That DVS is Master or not
	if(DVS.getPage().getMaster().getID()==DVS.getID()){
		// Grid is Master Grid
		if(record.id!=DVS.getForm().getValues()['id']){
			//Record is Changed , Notify To All Details
			this.MasterRecordChange(record.id);
		}
	}else
	{
		// Grid is not Master Grid
	}
	
	//Set Record To Form
	DVS.getForm().editRecord(record);
}
/**
 * @author Msd.Mazarei
 * @param String ans : can be 'YES'/'NO' , Dialog Result
 * @param String frmid: Form Id
 * @param String gridid: Grid Id
 */
IRERPJS_Page.prototype.DeleteRecord = function (ans,frmid,gridid)
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

/**
 * @author Msd.Mazarei
 * @param String Title : Dialog Title
 * @param String Message : Dialog Message
 * @param String Yes : Yes Button Title
 * @param String No : No Button Title
 * @param function afterclose : callback function to call
 */
IRERPJS_Page.prototype.ShowDialog =function (Title,Message,Yes,No,afterclose)
{
    var args=["YES"];
	   	for(var i=5; i < arguments.length; i++)
	    {
	        args.push(arguments[i]);
	    }

    isc.Window.create({
    	ARGS:args,
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
                                            isc.Button.create({title:Yes,click:function(){dlgQuest.hide();
                                            //var func=eval(afterclose);
                                            var func=afterclose;
                                            func.apply(null,dlgQuest.ARGS);
                                            //eval(afterclose+'("YES")');
                                            }}),
                                            isc.Button.create({title:No,click:function(){dlgQuest.hide();eval(afterclose+'("NO")');}}),
                                            isc.Label.create({width:"*"})
                                            ]

                          })
                        ]
                    })
                ]
        
    });
}
/**
 * @author Msd.Mazarei
 * @param String e : EventName
 * @param object s : sender
 * @param object p : param
 * @returns bool : true if we want to execute Standard EvManager and false to prevent execute standard EvManager
 * this function executes before executing EventManger
 * User Can Override this function to manages Events
 */
IRERPJS_Page.prototype.BeforeEventManager=function(e,s,p){return true;}

/**
 * @author Msd.Mazarei
 * @param String e : EventName
 * @param object s : sender
 * @param object p : param
 * this function executes after executing EventManager
 * User Can Override this function to manages Events
 */
IRERPJS_Page.prototype.AfterEventManager = function(e,s,p){}
/**
 * @auther Msd.Mazarei
 * @param String eventname
 * @param object sender
 * @param object param
 * @returns Depend On event
 * Event Manager of Page,
 * All Events that occure in page pass to this function
 */
IRERPJS_Page.prototype.EventManager=function(eventname,sender,param,args){
	if(!this.BeforeEventManager(eventname, sender, param)) return;
	switch(eventname)
	{
	case 'OnSaveForm':
		/**
		 * param is Form
		 */
		var form=param;
		this.SaveForm(form);
		break;
	case 'OnGridRecordDblClick':
		/**
		 * param is DVS
		 */
		this.OnEDITCommand(param);
		break;
	case 'OnGridRecordClick':
		/**
		 * sender is isc.Grid
		 * param is IRERPJS_DataViewSection
		 */
		this.OnGridRecordClick(sender,param);
		break;
	case 'OnDVSShown':
		/**
		 * param is Detailid
		 */
		var __Detailid=param;
		this.setDetailShown(__Detailid);
		this.ShowDetailDVS(__Detailid);
		break;
	case 'OnDVSHidden':
		/**
		 * param is Detailid
		 */
		var __Detailid= param;
		this.setDetailHidden(__Detailid);
		break;
	case 'OnNEWCommand':
		/**
		 * param is DVS
		 */
		this.OnNEWCommand(param);
		
		break;
	case 'OnEDITCommand':
		/**
		 * param is DVS
		 */
		this.OnEDITCommand(param);
		break;
	case 'OnSAVECommand':
		/**
		 * param is DVS
		 */
		this.OnSAVECommand(param);
		break;
	case 'OnDELETECommand':
		/**
		 * param is DVS
		 */
		this.OnDELETECommand(param);
		break;
	case 'OnCANCELCommand':
		/**
		 * param is DVS
		 */
		this.OnCANCELCommand(param);
		break;
	case 'OnRefreshCommand':
		/**
		 * param is DVS
		 */
		this.OnRefreshCommand(param);
		break;
		/**
		 * param is DVS
		 */
	case 'OnFirstCommand':
		this.OnFirstCommand(param);
		this.OnGridRecordClick(param.getGrid(), param);
		break;
		/**
		 * param is DVS
		 */
	case 'OnPreviousCommand':
		this.OnPreviousCommand(param);
		this.OnGridRecordClick(param.getGrid(), param);
		break;
		/**
		 * param is DVS
		 */
	case 'OnNextCommand':
		this.OnNextCommand(param);
		this.OnGridRecordClick(param.getGrid(), param);
		break;
		/**
		 * param is DVS
		 */
	case 'OnLastCommand':
		this.OnLastCommand(param);
		this.OnGridRecordClick(param.getGrid(), param);
		break;
	}
	this.AfterEventManager(eventname, sender, param);
	
}

