<?php
$sitename= "21K Creative Media";
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@ob_start();	
include "dbConnection.php";

if (!isset($_SESSION['user_id']))
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
<title>21K Creative Media</title>

<link rel="shortcut icon" href="../assets/images/logo/logo.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/app.css">



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script language="JavaScript" type="text/javascript">
function openwin(obj)
{
	new1=window.open("Detail_LogBook.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
      <?php include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>
  </tr>
 
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="0%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="98%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Welcome</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="11" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="35" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext">&nbsp;<b>Right2Thrive UK Collective Careers Hub</b></td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
		<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="0%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">New infomation for you</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="11%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
<?php				$flag=0;
//////////////  New Entry in APPROVE CHAT TIMES

				$sqlfiles = "select  cpo_usermaster.vUserName,cpo_bookchattime.iChatId,cpo_bookchattime.dBookingDate, cpo_bookchattime.vTopicToDiscuss  from cpo_bookchattime,cpo_usermaster where cpo_bookchattime.iUserId=cpo_usermaster.iUserId and iTutorId=".$user_id." and iIsApproved=0";
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ $flag=1;
				?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><div align="left">&nbsp;<b>Approve Chat Time :</b></div></td>
              </tr>
              <tr> 
                <td colspan="3" class="forborder"><table class="" width="100%" align="center">
                    <tr> 
                      <td colspan="5"  class="forborder"><table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
					  <?php while($rsresult = mysqli_fetch_array($rsfiles))
					  {
						?>
					      <tr bgcolor="#FFFFFF" height="10"> 
                            <td class="bodytext" width="40%" height="20">&nbsp;<a href="approvebookchattime.php?chatid=<?php echo $rsresult['iChatId']; ?>"><?php echo $rsresult['vUserName']; ?></a></td>
                            <td class="bodytext" width="20%">&nbsp;<?php echo gdate($rsresult['dBookingDate']);?></td>
							<td class="bodytext" width="40%">&nbsp;<?php echo $rsresult['vTopicToDiscuss']; ?></td>
                          </tr>
					  <?php
					  }?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
			  <?php
			  }

//////////////  New Entry in LEARNER LOGBOOK
				$sqlfiles="select iLogId,cpo_usermaster.vUserName,dEntryDate,cpo_subjectmaster.vSubjectName from cpo_studentlogbook,cpo_usermaster,cpo_subjectmaster where cpo_subjectmaster.iSubjectId=cpo_studentlogbook.iSubjectId and cpo_studentlogbook.iStudentId=cpo_usermaster.iUserId and iviewed=0 and iTutorId=".$user_id."";
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ $flag=1;?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><div align="left">&nbsp;<b>Learner Log Book :</b></div></td>
              </tr>
              <tr> 
                <td colspan="3" class="forborder"> <table class="" width="100%" align="center">
                    <tr> 
                      <td colspan="5"  class="forborder"><table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
					  <?php while($rslist = mysqli_fetch_array($rsfiles))
					  {	?>
					      <tr bgcolor="#FFFFFF" height="10"> 
										<td class="bodytext" width="40%">&nbsp;<a href="#" onClick="javascript:openwin(<?php echo $rslist['iLogId']; ?>)"><?php echo $rslist['vUserName']; ?></a></td>
										<td class="bodytext" width="20%">&nbsp;<?php echo gdate($rslist['dEntryDate']);?></td>										
										<td height="20" class="bodytext" width="40%">&nbsp;<?php echo $rslist['vSubjectName']; ?></td>
									  </tr>
					  <?php
					  }?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
			  <?php
			  }


//////////////  New Entry in LEARNING PLAN
				$sqlfiles="select cpo_usermaster.vUserName,iStudentId,iIndId,dDate from cpo_ind_plan,cpo_usermaster where cpo_usermaster.iUserId=cpo_ind_plan.iStudentId and iTutorId ='".$_SESSION['user_id']."' and iflag=1 and iComplete=0";
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ $flag=1;?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><div align="left">&nbsp;<b>Learning Plan :</b></div></td>
              </tr>
              <tr> 
                <td colspan="3" class="forborder"> <table class="" width="100%" align="center">
                    <tr> 
                      <td colspan="5"  class="forborder"><table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
					  <?php while($result_tutor_info = mysqli_fetch_array($rsfiles))
					  {	
					  	$path = "../lms/plan/".$result_tutor_info["iIndId"].".doc";
					  ?>
										<tr bgcolor="#FFFFFF">
	                        				<td class="bodytext" width="40%">&nbsp;<a target="_blank" href="<?php echo $path?>"><?php echo $result_tutor_info["vUserName"];?></a>&nbsp;&nbsp;&nbsp;</td>
											<td class="bodytext">&nbsp;<?php echo gdate($result_tutor_info['dDate']); ?></td>
										</tr>
					  <?php
					  }?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
			  <?php
			  }


//////////////  New Entry in LEARNING REVIEW
				$sqlfiles="select cpo_usermaster.vUserName,iTutorId,dDate,iIndId from cpo_ind_review,cpo_usermaster where cpo_usermaster.iUserId=cpo_ind_review.iStudentId and iTutorId ='".$_SESSION['user_id']."' and iflag=1 and iComplete=0";
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ $flag=1;?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><div align="left">&nbsp;<b>Learning Review :</b></div></td>
              </tr>
              <tr> 
                <td colspan="3" class="forborder"> <table class="" width="100%" align="center">
                    <tr> 
                      <td colspan="5"  class="forborder"><table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
					  <?php while($result_tutor_info = mysqli_fetch_array($rsfiles))
					  {	
					  	$path = "../lms/review/".$result_tutor_info["iIndId"].".doc";
					  ?>
										<tr bgcolor="#FFFFFF">
	                        				<td class="bodytext" width="40%">&nbsp;<a target="_blank" href="<?php echo $path?>"><?php echo $result_tutor_info["vUserName"];?></a>&nbsp;&nbsp;&nbsp;</td>
											<td class="bodytext">&nbsp;<?php echo gdate($result_tutor_info['dDate']); ?></td>
										</tr>
					  <?php
					  }?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
			  <?php
			  }
			
			if($flag==0)
			{
			  ?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><b>No new information available</b></td>
              </tr>
			<?php
			}
			else
			{
			?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext">&nbsp;</td>
              </tr>
			  <?php
			  }
			  ?>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
      </table></td>
   <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
 <?php include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>

</body>

</html>
