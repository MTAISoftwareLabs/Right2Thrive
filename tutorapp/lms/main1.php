<?
include_once 'db.php';
if(isset($_GET['close']))
{
	addlog(6);

}
else
{
	addlog(5);
}?>
<html>
<head>
<title>Interactive Tutorials</title>
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<?
if($_GET['id'])
{
	$name=$_GET['id'];	

}
?>
<frameset rows="100,0" frameborder="0" border="0" framespacing="0">

  <frame name="banner" scrolling="no" noresize target="contents" src="../newadmin/flash/<? echo $name; ?>.swf">
    
<noframes>
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"></noframes>
<frame src="UntitledFrame-2"></frameset>
<frameset>
</frameset>
</html>