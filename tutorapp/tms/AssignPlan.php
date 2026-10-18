<?php
include_once 'dbConnection.php';

?>
<html>
<head>
<title><?php echo sitename;?>Assign Plan</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function closewin()
{
	document.location='AssignPlan.php';
}
function validation()
{
	if (document.FRMASSIGNPLAN.CBOSTUDENT.value == "")
	{	
		alert("Please select Learner !!");
		document.FRMASSIGNPLAN.CBOSTUDENT.focus();
		return false;
	}
	return true;	
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
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="FRMASSIGNPLAN" method="post" action="AssignPlan.php?next=1" onSubmit=" return validation();" enctype="multipart/form-data">
			<?php
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Assign Plan</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td class="bodytext" align="right">Select Learner&nbsp;&nbsp;</td>
	                        <td>&nbsp;<select name="CBOSTUDENT" class="textbox">
							<option value="" selected>Select Learner</option>
							<?php
							//$query_tutor_id = "select iUserId from cpo_usercourse where iUserId<>0 and vTutorId = ".$user_id;
							$query_tutor_id = "select distinct iUserId from cpo_usercourse where vTutorId like '%".$_SESSION['user_id']."%'";
							$result_tutor_id = runquery($query_tutor_id);
							$nos = 0;
							if($result_tutor_id)
							{
								$nos = mysqli_num_rows($result_tutor_id);
							}
							if($nos>0)
							{
								$tutor_ids='';
								while($result_tutor = mysqli_fetch_array($result_tutor_id))
								{
									$str_tutor_id=$result_tutor['iUserId'];

									$tutor_ids= $str_tutor_id;
									if($tutor_ids<>'')
								{
									
									$query_tutor_info = "select iUserId,vUserName from cpo_usermaster where iUserId=".$tutor_ids."";
									$result_tutor_info = runquery($query_tutor_info);
									$nos = 0;
									if($result_tutor_info)
									{
										$nos = mysqli_num_rows($result_tutor_info);
									}
									if($nos>0)
									{
										while($result_tutor = mysqli_fetch_array($result_tutor_info))
										{
										?>
											<option value="<?php echo $result_tutor['iUserId'];?>"><?php echo $result_tutor['vUserName'];?></option>	
										<?php
										}									
									}
								}
								}//while end
								
							} // if end
							?>
							</select>
							</td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?php
			  }
			  else
			  {
			  		$sqlchange = "select * from cpo_ind_plan where iTutorId=".$_SESSION['user_id']." and iStudentId=".$_POST['CBOSTUDENT']." and iflag=0";
					$rschange = runquery1($sqlchange);	
					$num = $rschange ? mysqli_num_rows($rschange) : 0 ;
					if ($num > 0 )
					{
						$msg = "You have already assign a Plan to Learner !";
						$color = "red";
					}
					else
					{
						$sqlinsert = "insert into cpo_ind_plan (iStudentId,iTutorId,iflag,dDate) values (".$_POST['CBOSTUDENT'].",".$_SESSION['user_id'].",0,'".date('Y/m/d')."')";
						runquery($sqlinsert);
						$sqlmax = "select max(iIndId) from cpo_ind_review";
						$rsmaxid = runquery($sqlmax);
						$nid = 1;
						if ($rsmaxid)
						{
							$num = mysqli_num_rows($rsmaxid);
							if ($num > 0)
							{
								$temp = mysqli_fetch_array($rsmaxid);
								$nid = $temp[0];
							}	
						}
						//echo $nid;
						//$s = "../lms/ReviewSheet.doc";
						//$d = "../lms/assign/".$nid.".doc";
						//move_uploaded_file($s,$d);
						$msg = "Your Assignment has done successfully!";
						$color = "black";						
					} ?>
 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Assign Plan</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                  <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<?php echo $color;?>"><b><?php echo $msg?></b></font></td>
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
	           <?php }
			  ?>
			
			</form></td>
        </tr>
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
