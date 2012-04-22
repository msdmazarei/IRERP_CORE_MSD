jsIRERP
.defineClass("msdtestcon","VLayout")
.addProperties({
	headerLabelDefaults:{
		_constructor:jsIRERP.Label,
		click:function(){this.creator.bringToFront()},
		 wrap:false,  
         overflow:"hidden", 
         width:"100%"
	},
	
	initWidget: function () {
        this.Super("initWidget", arguments);
        this.addAutoChild("headerLabel", {
            contents: this.title, 
            styleName: this.titleStyleName
        });
        alert(this.headerLabel.getTitle());
        
	}
});