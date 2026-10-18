<?php 
include_once 'dbConnection.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<title>WELCOME to CareerPaths Online</title>
<style type="text/css">
<!--
.style1 {	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="javascript">
<!--
function chatnow()
{
new1=window.open("./chatnew/","","titlebar='CareerPaths Online - Chatting',height=475,width=775,scrollbars=yes,top=50 left=150");
}

function checklogin(){
	var x = document.FRMLOGIN.TXUSERID.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(x))	{
		alert("Enter a valid E-mail address!");
		document.FRMLOGIN.TXUSERID.value="";
		document.FRMLOGIN.TXUSERID.focus();
		return false;
	}
	if(document.FRMLOGIN.TXPASSWORD.value=="") 	{
		alert("Enter a valid Password!");
		document.FRMLOGIN.TXPASSWORD.value="";
		document.FRMLOGIN.TXPASSWORD.focus();
		return false;
	}
	return true;
}

-->
</script>

<script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-34503062-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
</script>
</head>