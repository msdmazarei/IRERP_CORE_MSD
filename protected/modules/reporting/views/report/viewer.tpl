{literal}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">	
    <head>
        <title></title>         
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css" media="screen"> 
			html, body	{ height:100%; }
			body { margin:0; padding:0; overflow:hidden; text-align:center; 
			       background-color: #e8e8e8; }   
			#flashContent { display:none; }
        </style>
		
        <script type="text/javascript" src="{/literal}{$this->baseUrl}/js/Report_swfobject.js{literal}"></script>
        <script type="text/javascript">
			function getCallbackUrl() {
				var href = document.location.href;
				if (href.indexOf("?") > 0) href = href.substr(0, href.indexOf("?"));
				return href + "{/literal}{$this->sti_get_parameters()}{literal}";//old: href + "#MARKER_REPORT_PARAMS#";//return href + "#MARKER_REPORT_PARAMS#";
			}
			
			function changeTitle(title) {
				window.document.title = title;
			}
			var baseurl="{/literal}{$this->baseUrl}{literal}";
            var swfVersionStr = "10.2.0";
            <!-- To use express install, set to playerProductInstall.swf, otherwise the empty string. -->
            var xiSwfUrlStr =baseurl+"/Download/sys/swf/"+ "playerProductInstall.swf";
            var flashvars = {};
            var params = {};
            params.quality = "high";
            params.bgcolor = "#e8e8e8";
            params.allowscriptaccess = "sameDomain";
            params.allowfullscreen = "true";
            var attributes = {};
            attributes.id = "ViewerFx_PHP";
            attributes.name = "ViewerFx_PHP";
            attributes.align = "middle";
            swfobject.embedSWF(
            		baseurl+"/Download/sys/swf/"+"ViewerFx_PHP.swf", "flashContent", 
                "100%", "100%", 
                swfVersionStr, xiSwfUrlStr, 
                flashvars, params, attributes);
			<!-- JavaScript enabled so display the flashContent div in case it is not replaced with a swf object. -->
			swfobject.createCSS("#flashContent", "display:block;text-align:left;");
        </script>
    </head>
    <body>
        <div id="flashContent">
        	<p>
	        	To view this page ensure that Adobe Flash Player version 10.2.0 or greater is installed. 
			</p>
			<script type="text/javascript"> 
				var pageHost = ((document.location.protocol == "https:") ? "https://" :	"http://"); 
				/*document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='" 
								+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );*/ 
			</script> 
        </div>
		
		<noscript>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="ViewerFx_PHP">
                <param name="movie" value="ViewerFx_PHP.swf" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#e8e8e8" />
                <param name="allowScriptAccess" value="sameDomain" />
                <param name="allowFullScreen" value="true" />
                <!--[if !IE]>-->
                <object type="application/x-shockwave-flash" data="ViewerFx_PHP.swf" width="100%" height="100%">
                    <param name="quality" value="high" />
                    <param name="bgcolor" value="#e8e8e8" />
                    <param name="allowScriptAccess" value="sameDomain" />
                    <param name="allowFullScreen" value="true" />
                <!--<![endif]-->
                <!--[if gte IE 6]>-->
                	<p> 
                		Either scripts and active content are not permitted to run or Adobe Flash Player version 10.2.0 or greater is not installed.
                	</p>
                <!--<![endif]-->
                    <a href="http://www.adobe.com/go/getflashplayer">
                        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash Player" />
                    </a>
                <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>
	    </noscript>	
   </body>
</html>
{/literal}