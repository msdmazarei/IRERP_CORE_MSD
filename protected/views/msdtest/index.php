<?php
?>

<script type="text/javascript">
<!--
IRERPJS_Page.prototype.AfterEventManager = function(e,s,p){
	switch(e)
	{
	
	}
}
//-->
</script>
<script type="text/javascript">
<!--
/***
 * 
 */
jsIRERP.ExtractSysComment = function(str){
	var specstr = "/**{SYS_COMMENT}**";
	var startpos=str.indexOf(specstr);
	var endpos  =str.indexOf("**{/SYS_COMMENT}*/",startpos+specstr.length);
	var syscomment="";
	if(startpos>-1 && endpos>-1)
			syscomment=str.substring(startpos+specstr.length,endpos);
	syscomment = "var _rtn="+syscomment;
	try{
		eval(syscomment);
		return _rtn;
		}catch(e){}
	return null;
}

jsIRERP.OpenTabCallback= function(url,data) {
	var syscomment = jsIRERP.ExtractSysComment(data);
	if(syscomment!=null)
		if(syscomment.ContainerID!=null)
	{
		eval(data);
		IRERPMainPageTabContainer.addTab({
	        title: "نمونه آزمایشی",
	        icon: "pieces/16/cube_green.png", iconSize:16,canClose:true,
	        pane: eval(syscomment.ContainerID)
	    });
	}
		
	            
     
	}
jsIRERP.OpenTab = function (url)
{
	//Open url in new tab
	// Add New Tab
	var data = { here: "is some data", to: ["send to the server"]};
	RPCManager.sendRequest({ data: data, callback: "jsIRERP.OpenTabCallback('"+url+"',data);", actionURL: url,httpMethod:'GET'});
	 
}
//-->
</script>
<script type="text/javascript">
//--------------------------------------------
// Logo And Title
jsIRERP.Img.create({
	ID:"IRERPMainPageLogo",
     height:"100",width:160,
    imageType: "stretch",
    align:"right",
    baseStyle:"MainTitleStyle",
    src: baseurl+"Download/sys/logo/logo.png"
});

jsIRERP.Label.create({
	ID:"IRERPMainPageLabel",
    contents: "<h2> سامانه جامع برنامه ریزی سازمانی ایران </h2>Open Source ERP Solution",
    align: "center",
    overflow: "visible",
    baseStyle:"MainTitleStyle",
    
    width:"*"
    
				});
jsIRERP.HLayout.create(
		{
			ID:"IRERPMainPageLogoAndTitle",
			width:"100%",height:"50",
			members:[
						
						IRERPMainPageLabel,IRERPMainPageLogo
						]
		}
		);				
//--------------------------------------------

//--------------------------------------------
// Menu Navigation
isc.SectionStack.create({
    ID: "IRERPMainPageMenuNavigation",
    visibilityMode: "multiple",
    width: 100, height: "100%",
    //border:"1px solid blue",
    sections: [
        {title: "دسته بندی منو ۱", expanded: true, items: [
            isc.Img.create({autoDraw: false, width: 48, height: 48, src: "pieces/48/pawn_blue.png"})
        ]},
        {title: "دسته بندی منو ۲", expanded: true,  items: [
            isc.Img.create({autoDraw: false, width: 48, height: 48, src: "pieces/48/cube_green.png"})
        ]},
        {title: "دسته بندی منو ۳", expanded: false, items: [
            isc.Img.create({autoDraw: false, width: 48, height: 48, src: "pieces/48/piece_yellow.png"})
        ]}
    ]
});

// End Navigation				        
//-------------------------------------------
//-------------------------------------------
// Main Menu 
isc.Menu.create({
    ID: "menu",
    autoDraw: false,
    showShadow: false,
    shadowDepth: 10,
        data: [
        {title: "New", keyTitle: "Ctrl+N", icon: "icons/16/document_plain_new.png",click:function(){jsIRERP.OpenTab(baseurl+'baseresources/CharacterTitle');}},
        {title: "Open", keyTitle: "Ctrl+O", icon: "icons/16/folder_out.png",click:function(){jsIRERP.OpenTab(baseurl+'baseresources/Human');}},
        {isSeparator: true},
        {title: "Save", keyTitle: "Ctrl+S", icon: "icons/16/disk_blue.png"},
        {title: "Save As", icon: "icons/16/save_as.png"},
        {isSeparator: true},
        {title: "Recent Documents", icon: "icons/16/folder_document.png", submenu: [
            {title: "data.xml", checked: true},
            {title: "Component Guide.doc"},
            {title: "SmartClient.doc", checked: true},
            {title: "AJAX.doc"}
        ]},
        {isSeparator: true},
        {title: "Export as...", icon: "icons/16/export1.png", submenu: [
            {title: "XML"},
            {title: "CSV"},
            {title: "Plain text"}
        ]},
        {isSeparator: true},
        {title: "Print", enabled: false, keyTitle: "Ctrl+P", icon: "icons/16/printer3.png"}
    ]
});

isc.MenuButton.create({
    ID: "IRERPMainPageMainMenu",
    title: "منو اصلی",
    align:"right",
    autoFit:true,
    menu: menu
});
//-------------------------------------------
//---------------------------------------------
// Tab Set
isc.TabSet.create({
    ID: "IRERPMainPageTabContainer",
    tabBarPosition: "top",
    tabBarAlign:"right",
    width: "100%",
    height: "100%",
    tabs: [
        {title: "میزکار", icon: "pieces/16/pawn_blue.png", iconSize:16,
         pane: isc.Img.create({autoDraw: false, width: 48, height: 48, src: "pieces/48/pawn_blue.png"})},
        {title: "کارتابل", icon: "pieces/16/pawn_green.png", iconSize:16,
         pane: isc.Img.create({autoDraw: false, width: 48, height: 48, src: "pieces/48/pawn_green.png"})}
    ]
});
// End TabSet
//---------------------------------------------

//Main Page Layout



jsIRERP.VLayout.create({
    width: "100%",
    height: "100%",
    members: [
              IRERPMainPageLogoAndTitle,
    			jsIRERP.HStack.create({
					width:"100%",
					members:[
						IRERPMainPageMainMenu,
						jsIRERP.Label.create({
								    contents: "Menu2",
								    align: "right",
								    border: "1px solid blue"
								}),
								
								]
					}),
				isc.HLayout.create({
				    width: "100%",
				    height: "100%",
				    members: [
						IRERPMainPageMenuNavigation,
				        IRERPMainPageTabContainer
								]
				})

              ]
	
});
</script>