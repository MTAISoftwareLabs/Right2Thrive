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
function getIcon($filename)
{
	switch(substr($filename,strlen($filename)-3,strlen($filename)))
	{
		case "swf" : 
			return "../tms/images/swf.gif";
			break;
		case "doc" : 
			return "../tms/images/doc.gif";
			break;			
		case "jpg" : 
			return "../tms/images/jpg.gif";
			break;			
		case "peg" : 
			return "../tms/images/jpg.gif";
			break;			
		case "gif" : 
			return "../tms/images/gif.gif";
			break;			
		case "pdf" : 
			return "../tms/images/pdf.gif";								
			break;
		case "avi" : 
			return "../tms/images/avi.gif";								
			break;
		case "mpg" : 
			return "../tms/images/mpeg.gif";								
			break;
		default : 
			return "../tms/images/gif.gif";				
			break;			
	}
}
?>
<html>
<head>
<title><? echo sitename;?>Learner Uploaded Files</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function getnewwin(obj,fid)
{
	new1=window.open("viewdownload.php?id="+obj+"&fid="+fid);
}
function submitpage()
{
	if (document.FRMUPLOAD.CMBLEARNER.value != "0")
	{
		document.FRMUPLOAD.action = "DownFiles.php?next=1&id="+document.FRMUPLOAD.CMBLEARNER.value;
		document.FRMUPLOAD.submit();
	}	
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
	<form name="FRMUPLOAD" method="post">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td height="10">&nbsp;</td>
        </tr>
        <?
			$sqllearner = "select vTutorId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
			$rslearner = runquery($sqllearner);
			$num = $rslearner ? mysqli_num_rows($rslearner) : 0 ; ?>
        <tr>
          <td class="bodytext" align="center">Select Tutor&nbsp;&nbsp;
              <select name="CMBLEARNER" class="textbox" onChange="submitpage()">
                <option value="">Select Tutor</option>
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
									$query_tutor_info = "select iUserId,vUserName from cpo_usermaster where iUserId in (".$tutor_ids.")";
									$result_tutor_info = runquery($query_tutor_info);
									$nos = 0;
									if($result_tutor_info)
									{
										$nos = mysqli_num_rows($result_tutor_info);
									}
									if($nos>0)
									{
										//$firstid ='';									
										while($result_tutor = mysqli_fetch_array($result_tutor_info))
										{
											if(isset($_POST['CMBLEARNER']))
											{
												if($_POST['CMBLEARNER']==$result_tutor['iUserId'])
												{?>
                <option value="<? echo $result_tutor['iUserId'];?>" selected><? echo $result_tutor['vUserName'];?></option>
                <?
												}
												else
												{?>
                <option value="<? echo $result_tutor['iUserId'];?>"><? echo $result_tutor['vUserName'];?></option>
                <?
												}
											}
											else
											{
												if($firstid=='')
												{?>
                <option value="<? echo $result_tutor['iUserId'];?>" selected><? echo $result_tutor['vUserName'];?></option>
                <?
												}
												else
												{?>
                <option value="<? echo $result_tutor['iUserId'];?>"><? echo $result_tutor['vUserName'];?></option>
                <?
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
                <option value="" selected>No Tutor Exists</option>
                <? }
							?>
              </select>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
        </tr>
        <tr>
          <td height="10">&nbsp;</td>
        </tr>
        <?		$tid = 0;
				$tid = isset($_GET['id'])?$_GET['id']:$firstid;
				$sqlfiles = "select iFileId,vFilePath,vUploadDate from cpo_uploadfilestutor where iTutorId=".$tid." and iUserId like '%".$user_id."%' order by vUploadDate desc";
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ 		?>
        <tr>
          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="welcome">Uploaded Files by Tutor</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr>
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                    <table width="90%" align="center">
                      <tr>
                        <td colspan="3" class="bodytext">Uploaded Files :</td>
                      </tr>
                      <?
											while($rsdata = mysqli_fetch_array($rsfiles))
											{ 
												$path = $tid."/".$rsdata['vFilePath']; //"../tms/upload/".
											?>
                      <tr>
                        <td class="bodytext" width="40%"><font color="#FF0000"><a href="#" onClick="javascript:getnewwin('<? echo $path;?>','<? echo $rsdata['iFileId'];?>');"><? echo $rsdata['vFilePath'];?></a></font></td>
                        <td width="35%" class="bodytext"><? echo gdate($rsdata['vUploadDate']);?></td>
                        <td width="25%" class="bodytext" align="center"><a href="#" onClick="javascript:getnewwin('<? echo $path;?>','<? echo $rsdata['iFileId'];?>');"><img border="0`"src="<? echo getIcon($rsdata['vFilePath'])?>"></a></td>
                      </tr>
                      <tr>
                        <td colspan="3" height="5"><hr width="100%"></td>
                      </tr>
                      <? 	} ?>
                      <tr>
                        <td colspan="3" height="10"></td>
                      </tr>
                  </table></td>
              </tr>
              <tr>
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"> </div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
          </table></td>
        </tr>
        <?
				}
				else
				{ ?>
        <tr>
          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td width="11"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="493" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="welcome">Uploaded Files by Tutor</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                </table></td>
                <td width="11" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext">No Files Uploaded</td>
              </tr>
              <tr>
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;</td>
              </tr>
              <tr>
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"> </div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
          </table></td>
        </tr>
       
        <? }
			//}
			//else
			//{ ?>
             <tr>
          <td><div align="right"><strong><a href="javascript:history.back();" class="textlink">Back</a></strong></div></td>
        </tr>
        <!--				<tr>
					<td>
					  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr> 
							<td width="11"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
							<td width="493" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr> 
								  <td class="welcome">Uploaded Files</td>
								  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
								</tr>
							  </table></td>
							<td width="11" background="images/changep_right_cor.jpg">&nbsp;</td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;</td>
						  </tr>
						  <tr> 
							<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
							<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"> 
						  </div></td>
							<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
						  </tr>
						</table>
					</td>
				</tr> -->
        <? //}
			?>
<tr></tr>
	  </table>
    <div align="right"></div><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	</table>
    </form></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
 <? include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>

</html>
