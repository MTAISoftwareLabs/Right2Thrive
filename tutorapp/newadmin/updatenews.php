<?php
@ob_start();
include_once 'dbConnection.php';
?>

<html>
<head>
<title>Edit News</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<form name=frmupdatenews action=modifynews.php>
<?php
	    $title=ereg_replace("'","''",$_GET['title']);
	    $description=ereg_replace("'","''",$_GET['description']);
		$createdate=date('d/m/y');
        list ($day, $month, $year) = split ('[/.-]', $createdate);
		$sql="update newsinfo set news_title='". $title ."',news_description='".$description."', news_date='".$createdate."',news_month='".$month."',news_year='".$year."' where news_id=".$_GET['id'];
        //echo $sql;
		$rscheck=mysqli_query($sql,$_SESSION['conn']);
?>
<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
   	<tr> 
   		<td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
   		<td width="100%" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
   	</tr>
	<tr> 
   		<td width="100%" height="36" colspan="2" class="comment" align="center">News Information is Updated successfully..</td>
	</tr>
	<tr> 
   		<td width="100%" class="headingtd" colspan="2">&nbsp;</td>
	</tr>
</table> 
</BODY>
</HTML>
