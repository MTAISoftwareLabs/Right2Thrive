<?php
include_once 'dbConnection.php';

if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
  $jobid = 0;
if (isset($_GET['id']))
{
  $jobid = $_GET['id'];
}
  $desc = "";
	$sql="SELECT * FROM cpo_jobmaster where iJobId=".$jobid;
  $rID=runquery1($sql);
	if(isset($rID))
	{
		$rslist = mysqli_fetch_array($rID);
		$desc = $rslist['tJobDesc'];
	}
?>
<link href="tms.css" rel="stylesheet" type="text/css">
<title>Job Information - Careerpaths Online</title><body topmargin="0">
<html>
<head>
<script language="JavaScript">
function disdesc()
{
  if (document.FRMSUGGESTJOB.CBOJOB.value != "")
  {
    document.location = "job.php?id="+document.FRMSUGGESTJOB.CBOJOB.value;
  }
}
</script>
</head>
<form name="FRMSUGGESTJOB">
<br>
<br>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="1%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
    <td width="98%" background="images/changep_center_cor.jpg">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td class="welcome">Job Description</td>
            <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
          </tr>
      </table>
    </td>
    <td width="1%" background="images/changep_right_cor.jpg">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
		  <table class="" width="90%" align="center">
			  <tr>
				  <td class="bodytext" height="32" width="23%">&nbsp; Select Job</td>
					<td class="bodytext" width="77%"><select name="CBOJOB" class="textbox" onChange="disdesc()">
							<option value="" selected>Select Job</option>
							<?php
							$query_job = "select iJobId,vJobTitle from cpo_jobmaster where iStatus='1' AND dDate >='".date('Y-m-d')."'";
							$result_job = runquery($query_job);
							$nos = 0;
							if($result_job)
							{
								$nos = mysqli_num_rows($result_job);
							}
							if($nos>0)
							{
								$tutor_ids='';
								while($result_job_info = mysqli_fetch_array($result_job))
								{
								?>
									<option value="<?php echo $result_job_info['iJobId'];?>" <?php if ($result_job_info['iJobId'] == $jobid) { ?> selected <?php } ?>><?php echo $result_job_info['vJobTitle'];?></option>	
								<?php
								}//while end
								
							} // if end
							?>
            </select>
          </td>
        </tr>
        <tr>
        <td colspan="2">
        <hr width="100%">
        </td>
        </tr>
        <tr> 
            <td align=right class="bodytext"> <div align="left">&nbsp; 
                    Job Title</div></td>
                <td align=left class="bodytext"><?php echo $rslist["vJobTitle"]; ?> 
                </td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td valign="top" class="bodytext"><div align="left">&nbsp; Job 
                    Description </div></td>
                <td align=left class="bodytext"><?php echo $rslist["tJobDesc"]; ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Contact 
                    Address </div></td>
                <td align=left class="bodytext"><?php echo $rslist["vContactAdd"]; ?></td>
              </tr>
			    <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Contact 
                    Person</div></td>
                <td align=left class="bodytext"><?php echo $rslist["vContactPerson"]; ?></td>
              </tr>
			    <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Contact 
                    Phone</div></td>
                <td align=left class="bodytext"><?php echo $rslist["vContactPhone"]; ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; E-mail Address
                     </div></td>
                <td align=left class="bodytext"><?php echo $rslist["vJobEmailId"]; ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Validation 
                    Date</div></td>
                <td align=left class="bodytext"><?php  $d=explode("-",$rslist["dDate"]);
												$rdate=$d[2]."/".$d[1]."/".$d[0];
												echo $rdate; ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Category</div></td>
                <td align=left class="bodytext"><?php $fetch="select vCategoryName from cpo_categorymaster where iCategoryId='$rslist[iCategoryId]'";
												$result=runquery1($fetch);
												$count=mysqli_num_rows($result);
												if($count==1)
												{
													$name=mysqli_result($result,0,0);
													echo $name;
												}?>
											</td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Institute</div></td>
                <td align=left class="bodytext"><?php $fetch="select vInstituteName from cpo_institutemaster where iInstituteId='$rslist[iInstituteId]'";
												$result=runquery1($fetch);
												$count=mysqli_num_rows($result);
												if($count==1)
												{
													$name=mysqli_result($result,0,0);
													echo $name;
												}?>
                </td>
              </tr>
      </table>
     </td>
   </tr>
   <tr> 
     <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
     <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:window.close()"></div></td>
     <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
   </tr>            
</table>
</form>
