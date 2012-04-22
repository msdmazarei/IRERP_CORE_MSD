
//Variables
var iconpath=baseurl+"Download/sys/Icons/iconic/raster/blue/";
var icon_new=iconpath+"new.png";
var icon_Save=iconpath+"Save.png";
var icon_Edit=iconpath+"Pen.png";
var icon_Delete=iconpath+"Trash.png";
var icon_Cancel=iconpath+"Cancel.png";


// Variable For Complicated Pages
var DetailForms= Array(); // All Detail Forms
var DetailGrids= Array(); // All Detail Grids
var DetailDss=Array();	// All Detail DataSources

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

function ShowDialog(Title,Message,Yes,No,afterclose)
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
                                            var func=eval(afterclose);
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
function AfterUploadFile(filename,DynForm,Field)
{
Field.setValue(filename);
}
function ShowUploadDialog(obj,afterclose)
{
    isc.HTMLPane.create({
        ID:"myPane",
        height: "100%",
        width: "100%",
        scrollbarSize:0
    });
    var iframeid='jjjli12d';
    var content= "<iframe scrolling=\"no\" width=\"100%\" height=\"100%\" id=\'"+iframeid+"\' ";
    content += "src=\'"+baseurl+"/upload/\' style=\"width:100%;height:100%;border:none;\"/>";
    
    myPane.setContents(content);
    var args=[];
	   for(var i=2; i < arguments.length; i++)
	    {
	        args.push(arguments[i]);
	    }
     isc.Window.create({
        ID:"dlgUploadFile",
        ARGS:args,
        obj:obj,
        height:200,
        width:300,
        canDragResize: true,
        isModal:true,
        align:"right",
        autoCenter:true,
        title:"بارگذاری پرونده",
        items:[
               isc.Button.create({title:'پرونده مورد تایید است',click:function(){
            	   dlgUploadFile.hide();
            	   if(afterclose!=null) try{
                	   //Get File Name
                	   
                	   filename=document.getElementById(iframeid).contentWindow.getFileName();
                	   dlgUploadFile.ARGS.splice(0,0,filename);
                	   
                	   afterclose.apply(dlgUploadFile.obj,
                        	   dlgUploadFile.ARGS);

                	   }catch(err){}
                   }})
               ,
    			myPane
               ]
        
    });
}
