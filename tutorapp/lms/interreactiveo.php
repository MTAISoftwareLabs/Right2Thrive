<?
include_once 'dbConnection.php';
if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
?>
<html>
<head>
<title>Interactive - CareerPaths Online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="./txteditor.js"></script>
<script language="JavaScript">

</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top" ><table width="99%" border="0" cellspacing="0" cellpadding="0" style="border-right : 1pt solid  #E2E2E2;">
        <tr> 
          <td width="100%"  valign="top"><? include "includetop.php";?></td>
          <td  ></td>
        </tr>
      </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc">
      <? include "includeleft.php";?>
    </td>
<td valign="top"> 
      <? include "includewelcome.php";?>
    </td>    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="intereactive" method="post">
			
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Interactive Course</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<?
						$sql="SELECT * FROM cpo_usercourse where iCourseStatus=1 and iUserId=$user_id";
    					$rID=runquery1( $sql);
						$count = mysqli_num_rows($rID);
						$sr=1;
						if($count >0)
						{
							while($rslist=mysqli_fetch_array($rID))
							{
									$sql1="select vCourseName from cpo_coursemaster where iCourseId = '".$rslist["iCourseId"]."'";
									$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
									$num = $result1 ? mysqli_num_rows($result1) : 0;
															
									?>
									<tr><td class="bodytext"><font color="#0033CC"><? if ($num > 0)
															{
									$name=mysqli_result($result1,0,0); echo $sr."-   ".$name; } ?></font></b></td></tr>
									<?
									
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
														?>
																<tr>
																<td class="bodytext">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $name[1] ?></td>
																<td class="bodytext"><input type="image" src="images/starttutorial.jpg" alt="Start Tutorial" width="123" height="24" onClick="previewflash('<? echo $name[0];?>')"></td>
																<!--<td class="bodytext"><a href="http://www.careerpathsonline.net/admin/flash/<? echo $name[0]; ?>.swf" target="_blank" ><img src="images/starttutorial.jpg" alt="Start Tutorial" width="123" height="24" border="0"></a></td>-->
															    </tr>
																<tr><td colspan="2"><hr width="100%"></td></tr>
														<?
													}
										
																												
                               
											}
										}
							  
									$sr=$sr+1;
									 		
							}
						}
						?>
						
						
					  
					  <tr><td colspan="2">&nbsp;</td></tr>
					</table>
				</td>
              </tr>
              <tr> 
					<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
					<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
					<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
				  </tr>
            </table>
			  			
			</form></td>
        </tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <tr> 
    <td colspan="2"> 
      <? include "includebottom.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="30" border="0" alt=""></td>
  </tr>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
