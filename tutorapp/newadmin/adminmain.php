<?php

//echo 'in main of admin';
//exit;


//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.location = 'index.htm';
	</script> 
<?php
} ?>
<!--#include file="conn.asp"-->
<html>
<head>
<title>Career Paths Online Admin Panel</title>
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
</head>
<frameset rows="50,92%" frameborder="0" border="0" framespacing="0">
<%if  session("auname")="" then
		Response.write("<a href='login.asp' target='_top'>Your session is expired</a>")
		response.End()
end if%>
  <frame name="banner" scrolling="no" noresize target="contents" src="top.php">
   <frameset cols="181,*" frameborder="0" border="0" framespacing="0" >
    <frame name="contents" target="main" src="add.php" noresize border=1px scrolling="auto">
    <frame name="main" src="middle.php">
  </frameset>
<noframes>
</noframes>
</frameset>
<frameset>
</frameset>
</html>
