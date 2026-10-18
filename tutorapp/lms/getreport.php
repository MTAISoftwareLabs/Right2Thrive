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

$id = $_GET['id'];
$sqlmonth="SELECT * FROM cpo_progressreport where I_month =".$id." and I_userid=".$user_id;
$rID=runquery1($sqlmonth);
$count = $rID ? mysqli_num_rows($rID) : 0;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
					<td height="22"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr> 
						  <td width="1%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
						  <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr> 
								<td width="36%" class="welcome" nowrap="nowrap"><strong>View Monthly Progress Report</strong></td>
								<td width="12%" class="welcome"></td>
								<td width="52%"><div align="right"><font color="#FFFFFF"><strong>&nbsp;&nbsp;::</strong></font></div></td>
							  </tr>
							</table></td>
						  <td width="1%"><img src="images/changep_right_cor.jpg"></td>
						</tr>
					  </table></td>
				  </tr>
	<tr> 
				<td class="forborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr> 
					  <td valign="top"> <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="DFEAF2">
						  <tr> 
						  <td width="30%" align="left" class="bodytext" style="padding-left:5px"><strong>Tutor Name</strong></td>
						  <td width="33%" align="left" class="bodytext" style="padding-left:5px"><strong>Subject</strong></td>
							<td width="13%" class="bodytext" align="center" ><strong>View</strong></td>
						
						  </tr>
						   <? if($count)
		  {
			$cnt=1;
			while ($rs = mysqli_fetch_array($rID))
			{
				$sqltutor = "select vUserName from cpo_usermaster where iUserId=".$rs['I_tutorid'];
				$rstutor = runquery($sqltutor);
				
				$rsdata = mysqli_fetch_array($rstutor);
				$tutorname = $rsdata['vUserName'];
				
				$sqls = "select  sb.vSubjectName  from  cpo_progressreport  as  us, cpo_subjectmaster  as sb where  sb.iSubjectId =".$rs['I_subjectId']." and us.I_userid  =".$_SESSION['user_id']." group by us.I_subjectid";
				$querys = runquery1($sqls);
				$fets = mysqli_fetch_array($querys);
				$subject = $fets['vSubjectName'];
				?>
							  <tr bgcolor="#FFFFFF"> 
								<td height="25" align="left" class="bodytext" style="padding-left:5px"><? echo ucfirst($tutorname);?></a></td>
								<td align="left" class="bodytext" style="padding-left:5px"><? echo $subject;?></td>
								<td align="center" class="bodytext"><a  href="#" onClick="javascript:openreport(<? echo $rs['I_progressid'];?>)">Click</a></td>
								
							  </tr>
					 <?
					$cnt++;
					}
				}
				else
				{?>
							  <tr bgcolor="#FFFFFF"> 
								<td height="25" align="center" colspan="4" class="bodytext"><b>No Records found.</b></td>
							  </tr>
				<?
				}
			?>
						</table></td>
					</tr>
				<tr> 
                        <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                              <td width="96%" background="images/changebttm_center_cor.jpg">
							  	<div align="right" class="bodytext">
&nbsp;&nbsp;<img src="images/closebutton.gif" onClick="hidevreport();" style="cursor:hand">&nbsp;&nbsp;</div>
							  </td>
                              <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                            </tr>
                          </table></td>
                      </tr>	
					
				  </table></td>
			  </tr>
</table>