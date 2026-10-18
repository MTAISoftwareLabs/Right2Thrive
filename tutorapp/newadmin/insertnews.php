<?php
@ob_start();
include_once 'dbConnection.php';
?>

<html>
<head>
<title>Add News</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<form name=frmadd action=addnews.php>
<?php
		$title=ereg_replace("'","''",$_GET['title']);
        $description=ereg_replace("'","''",$_GET['description']);
        $sql="select max(news_id) from newsinfo";
        $rscheck=mysqli_query($sql,$_SESSION['conn']);
		$num=1;
        if(! empty($rscheck))
		{
		    $rs=mysqli_fetch_row($rscheck);
		    if($rs)
		    {
		        $num=$rs[0]+1;
            }
            $createdate=date('d/m/y');
            //echo "createdate is".$createdate;
            list ($day, $month, $year) = split ('[/.-]', $createdate);
            //echo "Month: $month; Day: $day; Year: $year<br>\n";
            $addsql="insert into newsinfo values (".$num.",'".$title."','".$description."','".$createdate."',null,'".$month."','".$year."')";
            //echo $addsql;
            $record=mysqli_query($addsql,$_SESSION['conn']);
			?>
	<br>		
<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
   	<tr> 
   		<td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
   		<td width="100%" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
   	</tr>
	<tr> 
   		<td width="100%" height="36" colspan="2" class="comment" align="center">News is added successfully</td>
	</tr>
	<tr> 
   		<td width="100%" class="headingtd" colspan="2">&nbsp;</td>
	</tr>
</table> 
		 
			<?php		

		}
?>
</BODY>
</HTML>
