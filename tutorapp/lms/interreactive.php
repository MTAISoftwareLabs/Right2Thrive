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
<title><? echo sitename;?>Interactive Courses</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="./txteditor.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>
<link href="css.css" rel="stylesheet" type="text/css" />


<style type="text/css">
<!--
.style1 {color: #FF3333}
-->
</style>
<link href="css.css" rel="stylesheet" type="text/css">
</head>

<body >
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<form name="interactive" action="" method="post">
<table width="911" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <th height="672"  align="center"><table width="905" border="0" align="center"  cellpadding="0" cellspacing="0">
      <tr>
        <th width="199" rowspan="2" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><? include "leftpanel.php"; ?></th>
        <th height="10" align="left" valign="top" scope="col"><? include "includewelcome.php";?></th>
        </tr>
      <tr>
        <th align="center" valign="top" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="11"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                  <td width="547" background="images/changep_center_cor.jpg">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="welcome"><b>Interactive Course</b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                      </tr>
                  </table>
				  </td>
                  <td width="11" background="images/changep_right_cor.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">
					<table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
                    <?
						//$sql="SELECT * FROM cpo_usercourse where iCourseStatus=1 and iUserId=$user_id";
					$sql="select uc.* from cpo_usercourse uc,cpo_coursemaster cm where cm.iCourseId=uc.iCourseId and uc.vTutorId<>'' and uc.iUserId=$user_id order by cm.iCourseOrder";
    				//exit;
    				$rID=runquery1( $sql);
					$count = mysqli_num_rows($rID);
					$sr=1;
					if($count>0) {
						while($rslist=mysqli_fetch_array($rID)) {
							$sql1="select vCourseName from cpo_coursemaster where iCourseId = '".$rslist["iCourseId"]."' order by iCourseOrder";
							$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
							$num = $result1 ? mysqli_num_rows($result1) : 0;
							?>
						<tr height="10">
                        <td width="207" height="20"  class="bodytext"><b><font color="#0033CC">&nbsp;Course Name </font></b></td>
                        <td colspan="2" width="292"  class="bodytext"><b>
                            <? 
							if ($num > 0){
								$name=mysqli_result($result1,0,0); 
								echo $sr."-   ".$name; 
							} 
							?>
                        </b></td>
						</tr>
                        <tr height="10">
                        <td colspan="3" width="207" height="20"  class="bodytext"><b><font color="#0033CC">&nbsp;Subjects</font></b></td>
                        </tr>
                            <?
							$sql1="select vSubjectID from cpo_subjectincourse where iCourseID = '".$rslist["iCourseId"]."'";
							$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
							$num = $result1 ? mysqli_num_rows($result1) : 0;
							if ($num > 0){
								$name=mysqli_result($result1,0,0);
								$id=explode(",", $name);
								for($i=0;$i<count($id);$i++) {
									$sql2="select iSubjectId,vSubjectName from cpo_subjectmaster where iSubjectId= ".$id[$i]."";
									$result2=runquery1($sql2);
								    $num = $result2 ? mysqli_num_rows($result2) : 0;
									if ($num > 0) {
										$name=mysqli_fetch_array($result2);
							?>
						<tr bgcolor="#FFFFFF">
                         <td class="bodytext">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $name[1] ?></td>
                         <td colspan="2" class="bodytext"><a href="javascript:previewflash('<? echo $name[0];?>')"><img src="images/starttutorial2.jpg" alt="Start Tutorial" width="125" height="30" border="0"></a></td>
                        </tr>
								<? }
								}
							}
						$sr=$sr+1;
					    }
					} else {
					?>
                        <tr height="10" bgcolor="#FFFFFF">
                          <td colspan="3" height="20" class="bodytext" align="center"><b><font color="#000000">&nbsp;No interactive courses found for you.</font></b></td>
                        </tr>
                    <?
					}
					$sql1="select i_subjectid from cpo_student_interact where i_studentid = '".$user_id."' and i_active=1" ;
				    $result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
					$num = $result1 ? mysqli_num_rows($result1) : 0;
				    if ($num > 0){ 	
					?>
						<tr height="10">
                        <td colspan="3" width="207" height="20"  class="bodytext"><b><font color="#0033CC">&nbsp;Additional Subjects</font></b></td>
                        </tr>	
					<?  for($i=0;$i<$num;$i++){
							$thisid = mysqli_result($result1,$i,"i_subjectid") ;
							$sql2="select iSubjectId,vSubjectName from cpo_subjectmaster where iSubjectId= ".$thisid;
							//echo $sql2;
							$result2=runquery1($sql2);
							$name=mysqli_fetch_array($result2);
					?>
                        <tr bgcolor="#FFFFFF">
						  <td class="bodytext">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $name[1] ?></td>
                          <td colspan="2" class="bodytext"><a href="javascript:previewflash('<? echo $name[0];?>')"><img src="images/starttutorial2.jpg" alt="Start Tutorial" width="125" height="30" border="0"></a></td>
                        </tr>
					<?  } ?>
					<!--end sam-->
                    <?
					}
					?>
                        <tr bgcolor="#FFFFFF">
                        <td colspan="3"><hr style="height:1px" color="blue"></td>
                        </tr>
                  
                  </table></td>
                </tr>
                <tr>
                  <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                  <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                  <td colspan="2" width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                </tr>
            </table>
              <table align="center">
                <tr>
                  <td width="584"><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
                </tr>
              </table>
              <p>&nbsp;</p></td>
          </tr>
        </table>
          <div align="right"></div></th>
      </tr>
      
      <tr>
        <th colspan="2" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><div align="center">
          <? include "includebottom.php";?>
        </div></th>
        </tr>
      
      
      
    </table>      
    </th>
  </tr>
</table>
<p class="table">&nbsp;</p>

<map name="Map2" id="Map2"><area shape="rect" coords="1,1,196,67" href="#" /></map>
<map name="Map3" id="Map3"><area shape="rect" coords="-4,-6,167,30" href="#" /></map>
</form>
</body>
</html>
