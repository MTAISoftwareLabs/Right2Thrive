<?
include_once 'dbConnection.php';
?>
<html>
<head>
<title><? echo sitename;?>Upload Plan</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function closewin()
{
	document.location='UploadPlan.php';
}
function validation()
{
	if (document.FRMUPLOADPLAN.CBOSTUDENT.value == "")
	{	
		alert("Please select Tutor !!");
		document.FRMUPLOADPLAN.CBOSTUDENT.focus();
		return false;
	}
	if (document.FRMUPLOADPLAN.TXUPFILE.value == "")
	{	
		alert("Please select File to be upload !!");
		document.FRMUPLOADPLAN.TXUPFILE.focus();
		return false;
	}
	return true;	
}
function Upload()
{
	document.FRMUPLOADPLAN.method="post";
	document.FRMUPLOADPLAN.action="UploadPlan.php?Upload=yes";
	document.FRMUPLOADPLAN.submit();
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
      <? include "leftpanel.php";?>    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>    </td>
    <!--<td><img src="images/spacer.gif" width="1" height="20" border="0" alt=""></td>-->
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
         <tr> 
          <td><form name="FRMUPLOADPLAN" method="post" action="UploadPlan.php?next=1" onSubmit=" return validation();" enctype="multipart/form-data">
			<?
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Upload Plan</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<? 	$query_tutor_id = "select iTutorId from cpo_ind_plan where iStudentId=".$_SESSION['user_id']." and iflag=0";
							$result_tutor_id = runquery($query_tutor_id);
							$nos = 0;
							if($result_tutor_id)
							{
								$nos = mysqli_num_rows($result_tutor_id);
								
							}
							if($nos==0)
							{
								?>
								<tr>
									
                            <td colspan="2" class="bodytext" align="center" height="20"><b>No Learning Plan Assign.</b></td>
								</tr>
								<?
							}
							else
							{
						?>
						<tr>
							
                        <td class="bodytext" align="right">Select Tutor&nbsp;&nbsp;</td>
	                        <td>&nbsp;<select name="CBOSTUDENT" class="textbox" onChange="Upload()">
							<option value="" selected>Select Tutor</option>
							<?
							//$query_tutor_id = "select iUserId from cpo_usercourse where iUserId<>0 and vTutorId = ".$user_id;
							$query_tutor_id = "select iTutorId from cpo_ind_plan where iStudentId=".$_SESSION['user_id']." and iflag=0";
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
									$str_tutor_id=$result_tutor['iTutorId'];

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
											<option value="<? echo $result_tutor['iUserId'];?>" <? if(isset($_POST['CBOSTUDENT']) && $_POST['CBOSTUDENT']==$result_tutor['iUserId'] ) { ?> selected <? }?>><? echo $result_tutor['vUserName'];?></option>	
										<?
										}									
									}
								}
								}//while end
								
							}
							} // if end
							?>
							</select>							</td>
						</tr>
<?						if(isset($_GET['Upload']))  { ?>
						<tr><td class="bodytext" align="right">Select File&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;<input type="file" name="TXUPFILE" class="textbox" size="50"></td>
						</tr> 
						<tr><td colspan="2" height="10" class="bodytext" align="center"><font color="red">(Only *.doc files can upload)</font></td></tr>
<? } ?>						
					</table>				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><? if($nos!=0) { ?><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"> <? } ?></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?
			  }
			  else
			  {
			
			  		$sqlid="select * from cpo_ind_plan where iStudentId=".$_SESSION['user_id']." and iTutorId=".$_POST['CBOSTUDENT']." and iflag=0";
					$rsid=runquery($sqlid);
					$numid=$rsid ? mysqli_num_rows($rsid) : 0;
					if($numid>0)
					{
						$rs=mysqli_fetch_array($rsid);
					}
					if($_FILES['TXUPFILE']['type']=="application/msword")
					{
				  		$uploaddir = "./plan";
						$userfile_tmp = $_FILES['TXUPFILE']['tmp_name'];
						$newfile=$uploaddir."/".$rs['iIndId'].".doc";
						move_uploaded_file($userfile_tmp,$newfile);
						$sqlup="update cpo_ind_plan set iflag=1,dDate='".date('Y/m/d')."' where iIndId=".$rs['iIndId']."";
						runquery($sqlup);
						$msg="Your File is Uploaded Successfully";
						$color = "black";
						addlog(16);
					}
					else
					{
						$msg="You can only Upload MS-Word Files";
						$color = "red";
					}
					
					
						
					 ?>
 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Upload Plan</td>
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
					</table>				</td>
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
         <tr>
           <td><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
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