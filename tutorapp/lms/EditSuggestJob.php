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
<title><? echo sitename;?>Job Suggestion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">

<script language="JavaScript">
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><? include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc">
      <? include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="FRMSUGGESTJOB" method="post" action="EditSuggestJob.php?next=1">
			<?
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Edit Job Suggestion Action</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
					
					<tr>
						<?
							$sqlselect="select js.vOutcome,js.vActiontaken,js.dDateOfEntry,us.vUserName as student,j.vJobTitle as job,j.tJobDesc as jobDesc,j.vContactAdd as jobContact,j.vContactPerson as jobPerson,j.vContactPhone as jobPhone,j.dDate as jobDate,j.vJobEmailId as jobEmail
							from cpo_jobsuggesioninfo js,cpo_usermaster us, cpo_jobmaster j
							where js.iTutorId = us.iUserId and js.iJobId = j.iJobId and js.iJobinfoId=".$HTTP_GET_VARS['id'];	
							
							$result_info=runquery($sqlselect);
							$num = $result_info ? mysqli_num_rows($result_info) : 0;
							if($num > 0)
							{
								$result_info = mysqli_fetch_array($result_info);
							}
							
						?>
							
                        <td class="bodytext" height="32">Tutor Name</td>
							
                        <td class="bodytext">&nbsp;&nbsp;<? echo $result_info['student']; ?></td>
						</tr>
						
						<tr>
							
                        <td width="30%" height="30" class="bodytext">Job Suggested</td>
							
                        <td width="70%" class="bodytext">&nbsp;&nbsp;<? echo $result_info['job'];?></td>
						</tr>
						<tr>
							<td width="30%" height="30" class="bodytext">Action Taken</td>
							<td width="70%">&nbsp;<textarea name="TAACTIONTAKEN" class="textbox" rows="4" cols="50"><? echo $result_info['vActiontaken'];?></textarea></td>
						</tr>
						
						<tr>
							<td width="30%" height="30" class="bodytext" valign="top">Outcomes</td>
							<td width="70%">&nbsp;<textarea name="TAOUTCOMES" class="textbox" rows="4" cols="50"><? echo $result_info['vOutcome'];?></textarea></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<input type="hidden" name="id" value="<? echo $HTTP_GET_VARS['id'] ?>"> 
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?
			  }
			  else
			  {
			  
					
					$action_taken = $_POST['TAACTIONTAKEN'];
					$id = $HTTP_POST_VARS['id'];
					$outcomes = clean_string($_POST['TAOUTCOMES']);
					$sql="update cpo_jobsuggesioninfo set vActiontaken='". $action_taken ."',vOutcome='".$outcomes."' where iJobinfoId=".$id;
					runquery($sql) or die('error'.mysqli_error());
					$msg = "Your job suggestion information has been Updated successfully.";
					$color = "black";
					addlog(12);
					?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Job Suggestion</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<? echo $color;?>"><b><? echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='./'"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>					
	           <? }
			  ?>
			
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
