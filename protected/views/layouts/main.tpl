<!DOCTYPE html>
<html dir='{$this->direction}'>
<head>
    <meta charset="utf-8">
    <title>{$this->pageTitle}</title>
    <style>

	.MainTitleStyle	{
	color: #01556e;
    font-family: Nazli,Nazli,Arial,Verdana,sans-serif;
    font-size: 17px;
    background-image:url('http://localhost/IranERP/isomorphic/skins/EnterpriseBlue/images/Tab/top/tab_Selected_stretch.png');
    background-size: 100% 100%;
    text-shadow: 2px 2px 2px #1f738f;
    
    }

	</style>
{foreach from=$this->globalResources item=resource}
    {$resource}
{/foreach}
</head>
<body >

{$content}

</body>
</html>