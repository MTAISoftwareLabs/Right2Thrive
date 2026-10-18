<?php
include_once 'dbConnection.php';
?>

<html>
<head>
<title><?php echo sitename;?>Get Assign Review</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">

</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <!-- fwtable fwsrc="lms_1.png" fwbase="lms_1.gif" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->
  
  <tr> 
    <td colspan="2" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="100%"  valign="top"><?php include "includetop.php";?></td>
          <td  ></td>
        </tr>
      </table></td>
    
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
      <?php include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>
    <!--<td><img src="images/spacer.gif" width="1" height="20" border="0" alt=""></td>-->
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="FRMSTUDENTPLAN" method="post">
			<?php
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
									<tr>
											
											
                        <td width="94%" class="bodytext">The following learners 
                          have filled the review and submited.</td>
									</tr>
									<tr>
											
                        <td class="bodytext">Click on link to download review 
                        </td>
									</tr>
									<tr>
										<td colspan="2"  class="forborder">
										<table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
								
											<tr height="10">
												
                              <td width="32%" height="20"  class="bodytext"><b><font color="#0033CC">&nbsp;Learner 
                                Name</font></b></td>
												
                              <td width="68%"  class="bodytext"><b><font color="#0033CC">Submited 
                                Date</font></b></td>
											</tr>
								<?php
										$query_tutor_id = "select iStudentId,iIndId,dDate from cpo_ind_review where iTutorId ='".$_SESSION['user_id']."' and iflag=1";
							$result_tutor_id = runquery($query_tutor_id);
							$nos = 0;
							if($result_tutor_id)
							{
								$nos = mysqli_num_rows($result_tutor_id);
							}
							if($nos>0)
							{
										while($row = mysqli_fetch_array($result_tutor_id))
										{
										$path = "../lms/review/".$row["iIndId"].".doc";
										$date=$row['dDate'];
										$ans=explode("-",$date);	
							  		$sql1="select vUserName from cpo_usermaster where iUserId = '".$row["iStudentId"]."'";
									
									$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
									$num = $result1 ? mysqli_num_rows($result1) : 0;
									if ($num > 0)
									{
									$name=mysqli_result($result1,0,0);
							  		}
										?>
										<tr bgcolor="#FFFFFF">
	                        				<td width="20" class="bodytext">&nbsp;<a href="<?php echo $path?>"><?php echo $name;?></a>&nbsp;&nbsp;&nbsp;</td>
											<td class="bodytext"><?php echo $ans[2]."/".$ans[1]."/".$ans[0] ?></td>
										</tr>
										
										<?php }									
									
								//}
							}
							else
							{ ?>
								<tr>
									
                              <td colspan="2" class="bodytext" align="center" height="20">No 
                                Learners Plan Found</td>
								</tr>
							<?php }
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
			  <?php
			  }
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
