<?
include_once 'dbConnection.php';
?>

<html>
<head>
<title><? echo sitename;?>Get Assign Review</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function closewin()
{
	document.location='AssignReview.php';
}

function validation()
{
	if (document.FRMTUTORCHANGEPASSWORD.CBOSTUDENT.value == "")
	{	
		alert("Please select Learner !!");
		document.FRMTUTORCHANGEPASSWORD.CBOSTUDENT.focus();
		return false;
	}
	return true;	
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <!-- fwtable fwsrc="lms_1.png" fwbase="lms_1.gif" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->
  
  <tr> 
    <td colspan="2" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="100%"  valign="top"><? include "includetop.php";?></td>
          <td  ></td>
        </tr>
      </table></td>
    
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
      <? include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
    <!--<td><img src="images/spacer.gif" width="1" height="20" border="0" alt=""></td>-->
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="FRMTUTORCHANGEPASSWORD" method="post" action="AssignReview.php?next=1" onSubmit=" return validation();">
			<?
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="11"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="546" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Get Learning Review</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="11" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
							<?
							$query_tutor_id = "select iTutorId,dDate from cpo_ind_review where iStudentId ='".$_SESSION['user_id']."' and iflag=0";
							$result_tutor_id = runquery($query_tutor_id);
							$nos = 0;
							if($result_tutor_id)
							{
								$nos = mysqli_num_rows($result_tutor_id);
							}
							if($nos>0)
							{
								 ?>
										<tr>
											
                        <td colspan="2" class="bodytext">You have been assign 
                          review plan from the following tutors:</td>
										</tr>
										<tr>
											<td colspan="2" class="bodytext">Click on link to download review plan</td>
										</tr>
										<? while($result_tutor = mysqli_fetch_array($result_tutor_id))
										{ 
										$date=$result_tutor['dDate'];
										$ans=explode("-",$date);
										$query_tutor_info = "select vUserName from cpo_usermaster where iUserId=".$result_tutor['iTutorId']."";
										$result_tutor_info = runquery($query_tutor_info);
										$nos = 0;
									if($result_tutor_info)
									{
										$nos = mysqli_num_rows($result_tutor_info);
									}
									if($nos>0)
									{  $result_tutor_info=mysqli_fetch_array($result_tutor_info);
										?>
										<tr>
											<td class="bodytext" align="right"></td>
	                        				<td>&nbsp;<a href="../Individual Learning Plan_Review.doc"><? echo $result_tutor_info['vUserName'];?></a>&nbsp;&nbsp;&nbsp;<? echo $ans[2]."/".$ans[1]."/".$ans[0] ?></td>
										</tr>
										<tr><td colspan="2"><hr width="100%"></td></tr>
										<? }									
									}
								//}
							}
							else
							{ ?>
								<tr>
									
                        <td colspan="2" class="bodytext" align="center" height="20">No 
                          Learning Review Assign !</td>
								</tr>
							<? }
							?>
						<tr><td colspan="2">&nbsp;</td></tr>
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><!--<div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div>--></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			
			<!-- new -->
			<table width="90%"> 
			<tr><td>&nbsp;</td></tr>
			</table>
			
			<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Get Learning Review Changes By Tutor</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
							<?
							$query_tutor_id = "select iTutorId,dDate,iIndId from cpo_ind_review where iStudentId ='".$_SESSION['user_id']."' and iflag=1 and iComplete=1";
							$result_tutor_id = runquery($query_tutor_id);
							$nos = 0;
							if($result_tutor_id)
							{
								$nos = mysqli_num_rows($result_tutor_id);
							}
							if($nos>0)
							{
								 ?>
										<tr>
											
                        <td colspan="2" class="bodytext">The Following tutors 
                          have made changes to your review and submitted to you.</td>
										</tr>
										<tr>
											<td colspan="2" class="bodytext">Click on link to download review plan</td>
										</tr>
										<? while($result_tutor = mysqli_fetch_array($result_tutor_id))
										{ 
										$date=$result_tutor['dDate'];
										$ans=explode("-",$date);
										$query_tutor_info = "select vUserName from cpo_usermaster where iUserId=".$result_tutor['iTutorId']."";
										$result_tutor_info = runquery($query_tutor_info);
										$nos = 0;
									if($result_tutor_info)
									{
										$nos = mysqli_num_rows($result_tutor_info);
									}
									if($nos>0)
									{  $result_tutor_info=mysqli_fetch_array($result_tutor_info);
										?>
										<tr>
											<td class="bodytext" align="right"></td>
	                        				<td>&nbsp;<a href="review/<? echo $result_tutor['iIndId'] ?>.doc"><? echo $result_tutor_info['vUserName'];?></a>&nbsp;&nbsp;&nbsp;<? echo $ans[2]."/".$ans[1]."/".$ans[0] ?></td>
										</tr>
										<tr><td colspan="2"><hr width="100%"></td></tr>
										<? }									
									}
								//}
							}
							else
							{ ?>
								<tr>
									
                        <td colspan="2" class="bodytext" align="center" height="20">No 
                          Learning Review Changes Available!</td>
								</tr>
							<? }
							?>
						<tr><td colspan="2">&nbsp;</td></tr>
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><!--<div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div>--></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			<!-- end new -->
			  <?
			  }
			  else
			  {
			  		$sqlchange = "select * from cpo_ind_review where iTutorId=".$_SESSION['user_id']." and iStudentId=".$_POST['CBOSTUDENT']." and iflag=0";
					$rschange = runquery1($sqlchange);	
					$num = $rschange ? mysqli_num_rows($rschange) : 0 ;
					if ($num > 0 )
					{
						$msg = "You have already assign !";
						$color = "red";
					}
					else
					{
						$sqlinsert = "insert into cpo_ind_review (iStudentId,iTutorId,iflag) values (".$_POST['CBOSTUDENT'].",".$_SESSION['user_id'].",0)";
						runquery($sqlinsert);
						$msg = "Your Assignment has done successfully!";
						$color = "black";						
					} ?>
 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Get Learning Review</td>
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
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="closewin()"></div></td>
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
  <? include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
