<?
include_once 'dbConnection.php';
?>
<html>
<head>
<title><? echo sitename;?>Get Assign Plan</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function downloadfile()
{
	fname = "Individual_Learning_Plan.doc";
//	new1=window.open("../download.php?id="+fname,"","titlebar='CareerPaths Online - Chatting","menubar=1,height=475,width=775,scrollbars=yes,top=50 left=150");
	new1=window.open("../download.php?id="+fname);
}

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
</head>
<body>
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  
  <tr> 
    <td rowspan="2" valign="top" width="25%" bgcolor="#FFFFFF">
      <? include "leftpanel.php";?>
    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
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
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        
                      <td class="welcome">Get Learning Plan</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
									<tr>
											
											
                      <td width="94%" class="bodytext">You have been assign plan 
                        from the following tutors:</td>
									</tr>
									<tr>
											<td class="bodytext">Click on link to download review plan</td>
									</tr>
									<tr>
										<td colspan="2"  class="forborder">
										<table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
								
											<tr height="10">
												<td width="40%" height="20"  class="bodytext"><b><font color="#0033CC">&nbsp;Tutor Name</font></b></td>
												<td width="60%"  class="bodytext"><b><font color="#0033CC">Assigned Date</font></b></td>
											</tr>
								<?
										$query_tutor_id = "select iTutorId,dDate from cpo_ind_plan where iStudentId ='".$_SESSION['user_id']."' and iflag=0";
										$result_tutor_id = runquery($query_tutor_id);
										$nos = 0;
										if($result_tutor_id)
										{
											$nos = mysqli_num_rows($result_tutor_id);
										}
										if($nos>0)
										{
										 while($result_tutor = mysqli_fetch_array($result_tutor_id))
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
										<tr bgcolor="#FFFFFF">
	                        				<td class="bodytext">&nbsp;<a target="_blank" href="../download.php?id=Individual_Learning_Plan.doc"><? echo $result_tutor_info['vUserName'];?></a>&nbsp;&nbsp;&nbsp;</td>
											<td class="bodytext"><? echo $ans[2]."/".$ans[1]."/".$ans[0] ?></td>
										</tr>
										
										<? }									
									}
								//}
							}
							else
							{ ?>
								<tr>
									
                            <td colspan="2" class="bodytext" align="center" height="20" bgcolor="#FFFFFF"><b>No Learning Plan assign.</b></td>
								</tr>
							<? }
							?>
						
					</table>
				</td>
              </tr>
			  <tr><td></td></tr>
			  </table>
			 
			  <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><!--<div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div>--></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
             
            </table>
			
			<!-- new -->
			<table width="90%"> 
			<tr><td>&nbsp;</td></tr>
			</table>
			<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        
                <td class="welcome">Get Learning Plan changes by Tutor</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
									<tr>
						                <td width="94%" class="bodytext">The Following tutors have made changes to your plan and submitted to you</td>
									</tr>
									<tr>
										<td class="bodytext">Click on link to download plan</td>
									</tr>
									<tr>
										<td colspan="2"  class="forborder">
										<table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
											<tr height="10">
												<td width="40%" height="20"  class="bodytext"><b><font color="#0033CC">&nbsp;Tutor Name</font></b></td>
							                    <td width="60%"  class="bodytext"><b><font color="#0033CC">Changes Date</font></b></td>
											</tr>
								<?
							$query_tutor_id = "select iTutorId,dDate,iIndId from cpo_ind_plan where iStudentId ='".$_SESSION['user_id']."' and iflag=1 and iComplete=1";
							$result_tutor_id = runquery($query_tutor_id);
							$nos = 0;
							if($result_tutor_id)
							{
								$nos = mysqli_num_rows($result_tutor_id);
							}
							if($nos>0)
							{
										 while($result_tutor = mysqli_fetch_array($result_tutor_id))
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
										<tr bgcolor="#FFFFFF">
	                        				<td class="bodytext">&nbsp;<a target="_blank" href="plan/<? echo $result_tutor['iIndId'] ?>.doc"><? echo $result_tutor_info['vUserName'];?></a>&nbsp;&nbsp;&nbsp;</td>
											<td class="bodytext"><? echo $ans[2]."/".$ans[1]."/".$ans[0] ?></td>
										</tr>
										
										<? }									
									}
								//}
							}
							else
							{ ?>
								<tr>					
					                <td colspan="2" class="bodytext" align="center" height="20" bgcolor="#FFFFFF"><b>No Learning Plan changes available.</b></td>
								</tr>
							<? }
							?>
						
					</table>
				</td>
              </tr>
			  <tr><td></td></tr>
			  </table>
			 
			  <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><!--<div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div>--></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
             
             <? }
			  ?>
              <table align="center">
              <tr>
              <td width="596">
              <div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div>
              </td>
              </tr>
              </table>
	</td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
   <tr>
        <th align="right" valign="top" scope="col" colspan="2"><a href="javascript:history.back();" class="textlink">Back</a></th>
      </tr>
  <? include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
