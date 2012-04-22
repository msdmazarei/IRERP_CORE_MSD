<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <title>{$this->pageTitle}</title>
    <link rel="stylesheet" href="{$this->baseUrl}/css/jquery/base/jquery.ui.all.css" type="text/css" />

<!--    <link rel="Stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-darkness/jquery-ui.css" type="text/css" /> -->

    <script type="text/javascript" src="{$this->baseUrl}/js/jquery/jquery-1.6.2.js"></script>
    <script type="text/javascript" src="{$this->baseUrl}/js/jquery/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" src="{$this->baseUrl}/js/jquery/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="{$this->baseUrl}/js/jquery/ui/jquery.ui.position.js"></script>
    <script type="text/javascript" src="{$this->baseUrl}/js/jquery/ui/jquery.ui.menu.js"></script>
    <script type="text/javascript" src="{$this->baseUrl}/js/jquery/ui/jquery.ui.button.js"></script>
    <script type="text/javascript" src="{$this->baseUrl}/js/jquery/ui/jquery.ui.popup.js"></script>
    <script type="text/javascript" src="{$this->baseUrl}/js/jquery/ui/jquery.ui.tabs.js"></script>
<!--    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script> -->
    <script type="text/javascript" src="{$this->baseUrl}/js/ui.tabs.closable/ui.tabs.closable.js"></script>

    <script type="text/javascript">
    	$(function() {
/*        	var ali = $("#AppMenuButton").button({
			    icons: {
				    primary: "ui-icon-triangle-1-s"
			    }
		    }).next().menu({
			    select: function(event, ui) {
			        if (ui.item.children("a[aria-haspopup='true']").length == 0)
    				    $(this).hide();
    				
    				tabsList = $tabs.children("ul").first();
    				menuAnchor = ui.item.children("a[role='menuitem']").first();
    				
    				//$tabs.append('<div id="' + menuAnchor.attr("href") + '"></div>');
    				$tabs.append('<div id="Matter"></div>');
    				// Add a new tab and its frame
    				addedTab = '<li><a class="tabref" href="#Matter" rel="/jahad/matter">' + menuAnchor.text() + '</a></li>';
    				tabsList.append(addedTab);
    				$tabs.tabs('refresh','');
    				
    				$("a.tabref").click(function() {
                        loadTabFrame($(this).attr("href"),$(this).attr("rel"));
                    });
    				
//    				alert(ui.item.children("a[role='menuitem']").first().text());
			    }
		    });
		    ali.popup();
		    
		    $("#Alerts").button({
		    });
		    
        	$("#Help").button({
			    icons: {
				    primary: "ui-icon-triangle-1-s"
			    }
		    }).next().menu({
//			    select: function(event, ui) {
			        //alert(event);
				    //$(this).hide();
//			    }
		    }).popup();

            $("#Profile").button();
            
		    $("#LogOutAnchor").button({
		        text: false,
		        icons: { primary: "ui-icon-power"}
		    });
		    
		    /***** Tabs ***************
		    var $tabs = $("#tabs").tabs();
        	var activeTab;
        	var openTabs = [];
        	
        	function getSelectedTabIndex() {
                return $tabs.tabs('option', 'selected');
            }
            
            beginTab = $("#tabs ul li:eq(" + getSelectedTabIndex() + ")").find("a");
            //loadTabFrame($(beginTab).attr("href"),$(beginTab).attr("rel"));
            
            $("a.tabref").click(function() {
                loadTabFrame($(this).attr("href"),$(this).attr("rel"));
            });
            
            function loadTabFrame(tab, url) {
                if ($(tab).find("iframe").length == 0) {
                    var html = [];
                    html.push('<div class="tabIframeWrapper">');
                    html.push('<iframe class="iframetab" src="' + url + '">Load Failed?</iframe>');
                    html.push('</div>');
                    $(tab).append(html.join(""));
                    $(tab).find("iframe").height($(window).height()-80);
                }
                return false;
            }
            */
            IRERP = {
                menuBarItems : [],
                mainTabsElement : '',
                dashboardTabClass: 'tabDashboard',
                
                mainTabs: null,
                openTabs: [],
                
                /****** App Functions ********/
                initUI: function() {
                    this._initMenuBar();
                    this._initTabs();
                },
                loadApplication: function() {
                    this.menuBarItems = ["#AppMenuButton", "#Alerts", "#Help", "#Profile", "#LogOutAnchor"];
                    this.mainTabsElement = "#tabs";
                    
                    this.initUI();
                    this.loadDashboardTab();
                    
                },
                loadDashboardTab: function() {
                    hasDashboardTab = ($(this.mainTabsElement + " li a." + this.dashboardTabClass).length > 0);
                    
                    if (!hasDashboardTab) {
                        this._loadTab('/dashboard', "tab-frame-dashboard", "میز کار", "tabDashboard");
                        $(this.mainTabsElement).tabs('option', 'active', 0);
                    }
                },
                
                /****** UI Utils *************/
                _initMenuBar: function() {
                    $(this.menuBarItems.join(',')).each(function(index, Element) {
                        if (Element.nodeName == "A")
                            $(Element).button();
                        else if (Element.nodeName == "BUTTON")
                            $(Element).button({
                            	icons: {
                				    primary: "ui-icon-triangle-1-s"
                			    }
                            }).next().menu({
                                select: IRERP.menuItemSelectHandler
                            }).popup();
                    });
                },
                _initTabs: function() {
                    this.mainTabs = $(this.mainTabsElement).tabs({
                      closable: true
                    });
                },
                _loadTab: function(url, frameId, title, className) {
                    if (typeof className == "undefined")
                        className = "tabRef";
                    
                    htmlNewTabFrame = [];
                    htmlNewTabFrame.push("<div id='" + frameId + "'>");
                    htmlNewTabFrame.push('<div class="tabIframeWrapper">');
                    htmlNewTabFrame.push('<iframe class="iframetab" src="' + url + '">Load Failed?</iframe>');
                    htmlNewTabFrame.push("</div>");
                    htmlNewTabFrame.push("</div>");
                    
                    $(this.mainTabsElement).append(htmlNewTabFrame.join(''));

                    var closetab = '<a href="javascript:void(0);" class="close">&times;</a>';
                    var htmlNewTabItem = "<li><a id='" + frameId.replace('tab-frame-','tab-item-') + "' href='#" + frameId + "' class='" + className + "' ref='" + url + "'><span>" + title + "</span>" + closetab + "</a></li>";
                    $(this.mainTabsElement).children("ul").first().append(htmlNewTabItem);
                    $(this.mainTabsElement).tabs('refresh', '');
                    
                    $(".close").click(function() {
                        tabId = $(this).prev().attr("id");
                        console.log("tabId: " + tabId);
                        IRERP._removeTab(tabId);
                    });
                },
                
                _removeTab: function(tabId) {
                    $('#' + tabId).parent().remove();
                    $('#' + tabId.replace('tab-item-','tab-frame-')).remove();
                    $(this.mainTabsElement).tabs('refresh', '');
                },
                
                _hasTab: function(id) {
                    return ($(this.mainTabsElement).children('#' + id).length > 0);
                },
                _getIndexForId: function (searchId){
                    var index = -1 //if function returns -1, then tab wasn't found
                    
                    console.log(searchId);
                    $(this.mainTabsElement).children(".ui-tabs-panel").each(function(i, elem){
                        if (searchId == $(elem).attr("id")){
                            //index = $("#tabcontainer .tab").index(this);
                            index = i;
                        }
                    });
                    
                    return index;
                },
                /****** Event Handlers ******/
                menuItemSelectHandler: function(event, ui) {
			        if (ui.item.children("a[aria-haspopup='true']").length == 0)
			        {
    				    $(this).hide();
    				    
    				    anchor = ui.item.children("a").first();
    				    href = anchor.attr('href').replace('/#!', '');
    				    id = anchor.attr('id');
    				    title = anchor.text();
    				    
    				    if (!IRERP._hasTab('tab-frame-' + id))
        				    IRERP._loadTab(href, 'tab-frame-' + id, title);
        				
        				$(IRERP.mainTabsElement).tabs('option', 'active', IRERP._getIndexForId('tab-frame-'+id));
    				}
                }
            };
            
            IRERP.loadApplication();
    	});
    </script>
    
    <style type="text/css">
    	body {
    		direction: rtl;
    	}
    	nav {
    	    margin-bottom: 20px;
    	}
    	.iframetab {
            width:100%;
            height:400px;
            border:0px;
            margin:0px;
            position:relative;
            top:-13px;
        }

    	.ui-widget {
    		font-family: Verdana, "Nazli", sans-serif;
    	}
    	.ui-button-text-icon-secondary .ui-button-text, .ui-button-text-icons .ui-button-text {
            padding: 0.4em 1em 0.4em 2.1em;
        }
        .ui-menubar-item {
            float: right;
        }
        .ui-tabs .ui-tabs-nav li {
            float: right;
        }
        
        .ui-tabs .ui-tabs-nav li a {
            float: right;
        }
        
        .ui-tabs .ui-tabs-nav li a.tabRef:first-child {
            padding-left: 0.25em;
        }
        
        .ui-tabs .ui-tabs-nav li a.close {
            display: none;
        }
        .ui-tabs .ui-tabs-nav li a.tabRef + a.close {
            display: block;
            padding: 0.25em 0.25em 0.25em 0.25em;
            margin: 0.5em 0.25em 0.25em 0.5em;
            border-radius: 0.2em;
            cursor: pointer;
            font-size: smaller;
            font-weight: bolder;
        }
        .ui-tabs a.close:hover {
            background-color: #ddd;
        }
        
        .ui-button-text-icon-secondary .ui-button-icon-secondary, .ui-button-text-icons .ui-button-icon-secondary, .ui-button-icons-only .ui-button-icon-secondary {
            left: 0.5em;
            right: auto;
        }
        .ui-menubar {
            padding-left: auto;
            padding-right: 0;
        }
        .ui-menu { width: 200px; position: absolute; z-index: 1000;}
        
        .ui-menu .ui-menu-icon {
            float: left;
            position: static;
        }
    </style>
</head>
<body>
	<div class="wrapper">
	    <nav>
		    <button id="AppMenuButton">منو</button>
		    <ul>
			    <li>
			        <a href="javascript:void(0)">اطلاعات پایه</a>
			        <ul>
			            <li><a href="{$this->baseUrl}/#!/jahad/title" id="mniSystemMenus">عناوین</a></li>
			            <li><a href="{$this->baseUrl}/#!/jahad/Year" id="mniSystemMenus">سال</a></li>
			            <li><a href="{$this->baseUrl}/#!/jahad/Auidunce" id="mniSystemMenus">مخاطبین</a></li>
			            <li><a href="{$this->baseUrl}/#!/jahad/MagazineType" id="mniSystemMenus">نوع مجله</a></li>
			            <li><a href="{$this->baseUrl}/#!/jahad/Matter" id="mniSystemMenus">موضوعات</a></li>
			            <li><a href="{$this->baseUrl}/#!/jahad/Nationality" id="mniSystemMenus">ملیتها</a></li>
			            <li><a href="{$this->baseUrl}/#!/jahad/Size" id="mniSystemMenus">قطع ها و اندازه های مجله</a></li>
			            <li> <a href="{$this->baseUrl}/#!/jahad/FilmProductionFormat" id="mniJahadFilmProductionFormat">قالب تولید</a></li>
			            <li> <a href="{$this->baseUrl}/#!/jahad/FilmSystemType" id="mniJahadFilmSystemType">نوع سیستم</a></li>
			            
			            <li>
			            	<a href="javascript:void(0)">اطلاعات پایه عکس</a>
			            	<ul>
			            	<li><a href="{$this->baseUrl}/#!/jahad/PictureType" id="mniSystemMenus" >تعریف انواع عکس</a></li>
			            	<li><a href="{$this->baseUrl}/#!/jahad/PictureFormat" id="mniSystemMenus">فرمتهای عکس</a></li>
			            	<li><a href="{$this->baseUrl}/#!/jahad/Subject" id="mniSystemMenus">سوژه های عکس</a></li>
			            	<li><a href="{$this->baseUrl}/#!/jahad/Resulation" id="mniSystemMenus">وضوح عکس</a></li>
			            	<li><a href="{$this->baseUrl}/#!/jahad/Location" id="mniSystemMenus">محل عکسبرداری</a></li>
			            	</ul>
			            </li>
			        </ul>
			    </li>
			    <li><a href="{$this->baseUrl}/#!/jahad/Picture" id="mniJahadPicture">عکس</a>
			    <li><a href="{$this->baseUrl}/#!/jahad/Film" id="mniJahadFilm">فیلم</a>
			    <li><a href="{$this->baseUrl}/#!/jahad/TVSchool" id="mniJahadTVSchool">مدرسه تلویزیونی</a>
			    <li><a href="{$this->baseUrl}/#!/jahad/TVSchool" id="mniJahadRadioSchool">مدرسه رادیویی</a>
			    <li><a href="{$this->baseUrl}/#!/jahad/SlideVision" id="mniJahadSlideVision">اسلاید ویژن</a>
			    <li><a href="{$this->baseUrl}/#!/jahad/PlayShow" id="mniJahadPlayShow">نمایش</a>
			    
			    <li><a href="{$this->baseUrl}/#!/jahad/Human" id="mniJahadHuman">افراد </a>
		    </ul>

		    <a href="{$this->baseUrl}/#!/system/alerts" id="Alerts">هشدارها <span id="AlertsCount" style="color: red;">(۴)</span></a>

            <button id="Help">راهنما</button>
            <ul>
                <li>
                    <a href="{$this->baseUrl}/#!/site/about" id="mniHelpAbout">درباره</a>
			    </li>
            </ul>
            
		    <a id="Profile" href="{$this->baseUrl}/#!/profile">کاربر</a>
		    
		    <a id="LogOutAnchor" href="{$this->baseUrl}/#!/logout">خروج</a>
	        
	        <img src="" alt="" id="CorpLogo">
	        <img src="" alt="" id="IRERPLogo">
	    </nav>
	    
	    <div id="tabs">
	        <ul>
	        </ul>
	    </div>
	</div>
</body>
</html>
