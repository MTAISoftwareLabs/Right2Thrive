<?
include_once 'dbConnection.php';
include "session.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/swf; charset=utf-8" />
<title>careerpathsonline.net</title>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="JavaScript" src="lms/txteditor.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />

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
<? 
$u=$_SESSION['u'];
?>
<body>
<table width="800" height="900" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
include('header.php');  
?>
      <tr>
        <td height="622" valign="top">
        	<table width="800" border="0" cellspacing="0" cellpadding="0">
          		<tr>
                  <td width="205" height="200" valign="top" bgcolor="#f5f5f5">
                    <?php include('left.php');?>
                  </td>
                  <td width="580" valign="top">
                    <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr><td>&nbsp;</td></tr>
                     	<tr>
                          <td><p class="fontgreen"><strong>You Have Successfully Paid Money for <? echo $u; ?></strong></p>
			 </td>
                        </tr>
            		</table>
                     <?	/*$sqlfiles="SELECT iCourseId FROM cpo_coursemaster WHERE vCourseName = '".$_SESSION['u']."' AND iStatus =1 LIMIT 0 , 30";
				$rsfiles = runquery($sqlfiles);
				$rslist=mysqli_fetch_array($rsfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ $flag=1;
		$sql1="select vCourseName from cpo_coursemaster where iCourseId = '".$rslist["iCourseId"]."' order by iCourseOrder";
									$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
									$num = $result1 ? mysqli_num_rows($result1) : 0;
							*/?>
              		<!-- <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
                	<tr><td>
                    <table width="100%" border="0">
                <tr>
                  <td class="fontgreen">&nbsp;Course Name</td>
                  <td colspan="2"><?// if ($num > 0){	$name=mysqli_result($result1,0,0); echo $sr."-   ".$name; } ?></td>
                </tr>
                <tr>
                  <td class="fontgreen">&nbsp;Subjects</td>
                  <td colspan="2">&nbsp;</td>
                </tr> 
				   <?/*
									$sql1="select vSubjectID from cpo_subjectincourse where iCourseID = '".$rslist["iCourseId"]."'";
									$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
									$num = $result1 ? mysqli_num_rows($result1) : 0;
									if ($num > 0)
									{
									$name=mysqli_result($result1,0,0);
									
										$id=explode(",", $name);
																			
										for($i=0;$i<count($id);$i++)
											{
													$sql2="select iSubjectId,vSubjectName from cpo_subjectmaster where iSubjectId= ".$id[$i]."";
													$result2=runquery1($sql2);
													$num = $result2 ? mysqli_num_rows($result2) : 0;
													if ($num > 0)
													{
														$name=mysqli_fetch_array($result2);
						*/								?>
                <tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? //echo $name[1] ?></td>
                  <td><a href="newadmin/flash/<? //echo $name['0']; ?>.swf" target="_blank"><img src="lms/images/starttutorial2.jpg" alt="Start Tutorial" width="125" height="30" border="0" /></a></td>
                  <td><a class="links2" href="downloadswf.php?f=<? //echo $name['0']; ?>.swf" target="_blank">Download</a></td>
                </tr>
				<?// }}}}?>
              </table>
                    </td></tr>
              		</table> -->
              		<table width="380" height="272" border="0" align="center" cellpadding="0" cellspacing="0">
                		
              		</table>
              		<table width="380" border="0" align="center" cellpadding="0" cellspacing="0">
                		
                		
              		</table>
                </td>
          	</tr>
        </table>
       </td>
      </tr>
      <?php include('footer.php'); ?>
    </table>
    </td>
  </tr>
</table>

<map name="Map" id="Map"><area shape="rect" coords="4,5,47,28" href="#" /></map>
<map name="Map2" id="Map2"><area shape="rect" coords="5,3,88,28" href="<?php echo $chatstr;?>" /></map>

<map name="Map10" id="Map10">
<area shape="rect" coords="-4,2,157,61" href="#" />
</map>
<map name="Map11" id="Map11">
<area shape="rect" coords="2,1,181,46" href="#" />
</map>
</body>
</html>
