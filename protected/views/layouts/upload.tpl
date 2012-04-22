<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <title>{$this->pageTitle}</title>

{literal}
<style type="text/css" media="screen">
@import "general.css"; /* Mostly just text styling. */

body {
	margin:50px 0px; padding:0px; /* Need to set body margin and padding to get consistency between browsers. */
	text-align:center; /* Hack for IE5/Win */
	}
	
#Content {
width:200px;
	margin:0px auto; /* Right and left margin widths set to "auto" */
	text-align:left; /* Counteract to IE5/Win Hack */
	padding:15px;
	}
</style>
{/literal}
</head>
<body>
<div id="Content">
{$content}
</div>
</body>
</html>