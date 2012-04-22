{literal}
isc.Menu.create({
	ID: "IRMainMenu",
	autoDraw: false,
	data: [
       {title: "New"},
        {title: "Open", keyTitle: "Ctrl+O"},
        {isSeparator: true},
        {title: "Save", keyTitle: "Ctrl+S"},
        {title: "Save As"},
        {isSeparator: true},
        {title: "Recent Documents", submenu: [
            {title: "data.xml", checked: true},
            {title: "Component Guide.doc"},
            {title: "SmartClient.doc", checked: true},
            {title: "AJAX.doc"}
        ]},
        {isSeparator: true},
        {title: "Export as...", submenu: [
            {title: "XML"},
            {title: "CSV"},
            {title: "Plain text"}
        ]},
        {isSeparator: true},
        {title: "Print", enabled: false, keyTitle: "Ctrl+P"}
	]
});

isc.MenuButton.create({
	ID: "button3",
	title: "منوی اصلی",
	autoFit: true,
	menu: IRMainMenu
});

isc.Button.create({
    ID: "button1",
    autoFit: true,
    autoDraw: false,
    title: "Find Related",
});

isc.IButton.create({
    ID: "button2",
    autoFit: true,
    labelHPad: 15,
    autoDraw: false,
    title: "Search within results",
});

isc.HStack.create({
    membersMargin: 20,
    height: 44,
    members: [ button1, button2, button3 ]
});

isc.Button.create({
    title: "Change Title",
    top: 45,
    left: 60,
    click : function () {
        // have buttons exchange their titles
        var title1 = button1.getTitle();
        button1.setTitle(button2.getTitle());
        button2.setTitle(title1);
    }
});
{/literal}