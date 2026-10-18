<?
include "dbConnection.php";

if (!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
function getlearnernames($ids)
{

	$strnames = '';
	if($ids)
	{	
		$strids = explode(',',$ids);
		
		for($i=0;$i<count($strids);$i++)
		{
			$sqlselect = "select vUserName from cpo_usermaster where iUserId=".$strids[$i];
			//echo $sqlselect.'<br>';
			$rssqlselect = runquery($sqlselect);
			if(isset($rssqlselect))
			{
				$rssqlselect1 = mysqli_fetch_array($rssqlselect);
				$strnames = $strnames.$rssqlselect1[0].' , ';
			}
		}
		$strnames = substr($strnames,0,strlen($strnames)-2);
	}
	return $strnames;
}

?>
<html>
<head>
<title><? echo sitename;?>Send Mail to Tutors</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">

function validation()
{

  	
		if (document.FRMUPLOADFILE.txtsubject.value == "")
	{
		alert("Please write message Subject !");
		document.FRMUPLOADFILE.txtsubject.focus();
		return false;
	}

	if (document.FRMUPLOADFILE.txtcontents.value == "")
	{
		alert("Please write message Contents !");
		document.FRMUPLOADFILE.txtcontents.focus();
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
    <td valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td> 
            <form name="FRMUPLOADFILE" method="post" onSubmit="return validation();" action="sendmail.php?next=1"  enctype="multipart/form-data">			
			 
					  		<?
								if(isset($_GET['next']) && $_GET['next'] == 1)
								{
								
								    $learner_id = "";	
                		foreach($_POST['CMBLEARNER'] as $value)
                		{
                			$learner_id.= $value. ",";
                		}
                		$learner_id = substr($learner_id,0,strlen($learner_id)-1);
                		if ($learner_id <> "-")
                		{
							$fromname=$_SESSION['user_name'];
							$subject=$_POST['txtsubject'];
							$message=$_POST['txtcontents'];
						
							foreach($_POST['CMBLEARNER'] as $value)
							{
								$idname =explode(',',$value);								  
								$toname=$idname[1];
								$toaddress=$idname[0];
								$mailflg=SendingMail($fromname, admin_email,$toname ,$toaddress, $subject, $message);
							}
									$msg = "Mail Sent to Tutor Successfully.";
						}
						else
						{
							  $msg = "First Select Tutor.";
						}
			            $color = "black";
						?>
								        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                      <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Send Mail to Learner</td>
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
								    
                 <?	
								}
								else
								{
								?>
								 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          				  <tr> 
          					<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
          					<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="">
          						<tr> 
          						  <td class="welcome">Send Mail to Learner</td>
          						  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
          						</tr>
          					  </table></td>
          					<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
          				  </tr>
          				  <tr> 
					
                  <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
					       <table class="" width="90%" align="center" bgcolor="#FFFFFF">
					       <?
                			$sqllearner = "select vTutorId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
                			$rslearner = runquery($sqllearner);
                			$num = $rslearner ? mysqli_num_rows($rslearner) : 0 ; ?>
			            <tr>
				              <td class="bodytext" >&nbsp;Select Tutor&nbsp;&nbsp;</td>
						        <td class="bodytext"><select name=CMBLEARNER[] class="textbox" multiple>
							
							<?
							$query_tutor_id = "select vTutorId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
							$result_tutor_id = runquery($query_tutor_id);
							$nos = 0;
							//***CHANGE BY ALPA BECAUSE OF ERROR ON LINE NO 169***//
							$firstid ='';
							//***CHANGE COMPLETE***//
							if($result_tutor_id)
							{
								$nos = mysqli_num_rows($result_tutor_id);
							}
							if($nos>0)
							{
								$tutor_ids='';

								while($result_tutor = mysqli_fetch_array($result_tutor_id))
								{
									$str_tutor_id=$result_tutor['vTutorId'];
									$str_tutor_length = strlen($str_tutor_id)-1;
									if(substr($str_tutor_id,$str_tutor_length-1,$str_tutor_length)<>',')
									{
										$str_tutor_id=$result_tutor['vTutorId'].',';
									}
									$tutor_ids.= $str_tutor_id;
								}
																	
								if($tutor_ids<>'')
								{
									$tutor_ids=substr($tutor_ids,0,strlen($tutor_ids)-1);								
									$query_tutor_info = "select vUserEmailId,vUserName from cpo_usermaster where iUserId in (".$tutor_ids.")";
									$result_tutor_info = runquery($query_tutor_info);
									$nos = 0;
									if($result_tutor_info)
									{
										$nos = mysqli_num_rows($result_tutor_info);
									}
									if($nos>0)
									{
										?>
										  <option value="-" selected>Select Tutor</option>
										<?
										while($result_tutor = mysqli_fetch_array($result_tutor_info))
										{
											if(isset($_POST['CMBLEARNER']))
											{
												if($_POST['CMBLEARNER']==$result_tutor['iUserId'])
												{?><option value="<? echo $result_tutor['vUserEmailId'].",".$result_tutor['vUserName'];?>"><? echo $result_tutor['vUserName'];?></option><?
												}
												else
												{?><option value="<? echo $result_tutor['vUserEmailId'].",".$result_tutor['vUserName'];?>"><? echo $result_tutor['vUserName'];?></option><?
												}
											}
											else
											{
												if($firstid=='')
												{?><option value="<? echo $result_tutor['vUserEmailId'].",".$result_tutor['vUserName'];?>"><? echo $result_tutor['vUserName'];?></option><?
												}
												else
												{?><option value="<? echo $result_tutor['vUserEmailId'].",".$result_tutor['vUserName'];?>"><? echo $result_tutor['vUserName'];?></option><?
												}
											}
											if($firstid=='')
											{
												$firstid = $result_tutor['iUserId'];
											}
										}									
									}
								}
							}
							else
							{?>
								<option value="-" selected>No Tutor Exists</option>
							<? }
							?></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					  </td>
					  </tr>
							</tr>
								<tr>
								<td class="bodytext">&nbsp;Message Subject</td>
								<td class="bodytext"><input name="txtsubject" type="text" class="textbox" size="50"></td>
							</tr>	
					  	<tr>
								<td class="bodytext">&nbsp;Message Contents</td>
								<td class="bodytext"><textarea name="txtcontents" class="textbox" rows="8" cols="50"></textarea></td>
							</tr>		
							
					  </table>
                  </td>
				  </tr>
				  <tr> 
					<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
					<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right">
                      <input name="image" type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">
                    </div></td>
					<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
				  </tr>
				
				</table>
				<?
        }
        ?>
				
				</form>				
		  	</td>
		</tr>
 <tr>
        <th align="right" valign="top" scope="col" colspan="2"><a href="javascript:history.back();" class="textlink">Back</a></th>
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
