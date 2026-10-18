<?php
include_once 'dbConnection.php';

if(isset($_GET['id']))
{

	$sqlselect="select js.vOutcome,js.vActiontaken,js.dDateOfEntry,us.vUserName as student,j.vJobTitle as job,j.tJobDesc as jobDesc,j.vContactAdd as jobContact,j.vContactPerson as jobPerson,j.vContactPhone as jobPhone,j.dDate as jobDate,j.vJobEmailId as jobEmail,i.vInstituteName as institute,c.vCategoryName as category
	from cpo_jobsuggesioninfo js,cpo_usermaster us, cpo_jobmaster j, cpo_institutemaster as i, cpo_categorymaster as c
	where js.iTutorId = us.iUserId and js.iJobId = j.iJobId and j.iInstituteId=i.iInstituteId and j.iCategoryId=c.iCategoryId and js.iJobinfoId=".$HTTP_GET_VARS['id'];	
//	echo $sqlselect;
//	exit;
	$qryupdate = "update cpo_jobsuggesioninfo set iviewed=1 where iJobinfoId=".$HTTP_GET_VARS['id'];
	runquery($qryupdate);
	addlog(11);
	$result_info=runquery($sqlselect);
	$num = $result_info ? mysqli_num_rows($result_info) : 0;
	if($num > 0)
	{
		$result_info = mysqli_fetch_array($result_info);

?>
<style>
.bothfeatured3
{
	border-left:1px solid #88B4F9;
	border-right:1px solid #88B4F9;	
}
.flipv {
	FILTER: FlipV();
}
</style>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/css_styles.css" rel="stylesheet" type="text/css">
<title><? echo sitename;?>Job Suggestion - Detail View</title><body topmargin="0"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="10" colspan="4"><img src="../images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr valign="top"> 
    <td height="35" colspan="4"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><strong>CareerPaths 
      Online</strong></font></td>
  </tr>
  <tr> 
    <td colspan="4"><img src="../images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td background="../images/coupons3.jpg" class="flipv"><img src="../images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../images/coupons3.jpg" class="flipv"><img src="../images/coupons3.jpg" width="5" height="5"></td>
    <td background="../images/coupons3.jpg" class="flipv"><div align="right"><img src="../images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
  <tr> 
    <td colspan="4" class="bothfeatured3"><table width="100%" border="0" cellspacing="1" cellpadding="4">
        <tr> 
			<td></td>
          <td width="63%" valign="top"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><b></b></font></td>
          <td width="2%" valign="top"><div align="right"><a href="javascript:print();"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
          <td width="20%" valign="top"><div align="center"><a href="javascript:print();">Print this Page</a>&nbsp;&nbsp;</div></td>
        </tr>
        <tr> 
          <td colspan="4">
<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2" class="">
			  <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Tutor's Name</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<? echo $result_info['student'];?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Job Title</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<? echo $result_info['job'];?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Job Category</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<? echo $result_info['category'];?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Job Institute</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<? echo $result_info['institute'];?></td>
              </tr>
			   <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Job Description</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<? echo $result_info['jobDesc'];?></td>
              </tr>
			   <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Job Contact 
                  Address </strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<? echo $result_info['jobContact'];?></td>
              </tr>
			   <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>E-mail Address</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<? echo $result_info['jobEmail'];?></td>
              </tr>
			   <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Contact Person</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<? echo $result_info['jobPerson'];?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Contact Phone</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<? echo $result_info['jobPhone'];?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="37%" height="22" class="bodytext"><strong>Validation 
                  Date</strong></td>
                <td width="63%" height="22" class="bodytext">&nbsp;<? echo gdate($result_info['jobDate']);?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Action Taken</strong>&nbsp;</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><? echo $result_info['vActiontaken'];?></td>
              </tr>
              
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><strong>Outcomes</strong>&nbsp;</td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><? echo $result_info['vOutcome'];?></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right"><img src="../images/closebutton.gif" onClick="javascript:window.close();" style="cursor:hand">&nbsp;&nbsp;</div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="../images/coupons3.jpg"><img src="../images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../images/coupons3.jpg"><img src="../images/coupons3.jpg" width="5" height="5"></td>
    <td background="../images/coupons3.jpg"><div align="right"><img src="../images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>

<?
	}
}
?>