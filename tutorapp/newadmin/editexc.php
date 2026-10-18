<?php 
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';

if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
$exid = $_GET['id'];
?>
<html>
<head>
<title>Edit Exclusion</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript" src="./calendar1.js"></script> 
<script language="JavaScript">
function win_onload()
{
document.frmexclusion.selstudent.focus();
}
function validation()
{
	if(document.frmexclusion.selstudent.value=="")
	{
		alert("Student must be selected!");
		document.frmexclusion.selstudent.focus();
		return false;
	}
	if(document.frmexclusion.seltutor.value=="")
	{
		alert("Tutor must be selected!");
		document.frmexclusion.seltutor.focus();
		return false;
	}
	if(document.frmexclusion.txtreason.value=="")
	{
		alert("Exclusion reason cannot be blank!");
		document.frmexclusion.txtreason.focus();
		return false;
	}	
	return true;
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frmexclusion'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
}

</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact">
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0"   >
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">	<table width="97%"  border="0" cellspacing="0" cellpadding="0">
	<tr><td width="100%" colspan="3"><?php include_once('top_personal.php');?></td></tr>
  	<tr><td colspan="3"><table  width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder" align="center" >
        <tr> 
          <td bgcolor="F5F8FF">&nbsp;</td>
        </tr>
		
			
		<tr><td width="100%">
				<?php
if(isset($_POST['hdnsubmit'])  && $_POST['hdnsubmit'] ==1)
{
	$student_name = $_POST['selstudent'];
	$tutor_name = $_POST['seltutor'];
	$deten_date = $_POST['txtddate'];
	$deten_reason = $_POST['txtreason'];
	$deten_improve = $_POST['taimprove'];	
	$sdate=explode("/",$deten_date);
	
	$date = $sdate[2]."-".$sdate[1]."-".$sdate[0];
	$flag = 'E';
	
	//check for duplicate
	 $select = " SELECT I_userid, i_tutorid, D_detention FROM cpo_detention where I_userid='".$student_name."' and i_tutorid='".$tutor_name."' and D_detention='".$date."' and C_flag='".$flag."' and I_detentionid !=".$exid ;
	 $record=runquery1($select);
	 $num = mysqli_num_rows($record);
	 
	 if($num >0)
	 {
		 $msg="Exclusion Already Exists!";
		 $flg = "red";
	}
	else
	{
		$updatesql = "UPDATE cpo_detention set  I_userid='".$student_name."', i_tutorid='".$tutor_name."', D_detention='".$date."', V_reason='".$deten_reason."', T_improve='".$deten_improve."' where C_flag='".$flag."' and I_detentionid =".$exid;
		$rscheck=runquery1($updatesql);
		if($rscheck)
		{
			$msg="Exclusion successfully edited.";
			$flg = "green";
		}
		else
		{
			$msg = "Error in updation.";
			$flg = "red";
		}
	}
		
			
	?>	
      <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" class="schoolfont">Exclusion Admin</td>
        </tr>
        <tr>
          <td class="graydotline">&nbsp;</td>
        </tr>

        <tr>
          <td height="30px;"></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left"><table width="69%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="2%" align="left"><img src="images/left-corn-de.gif" /></td>
    <td width="27%" align="center" class="graymid"><a  href="addex.php?rid=exc" class="greendeactfont">Add</a></td>
       <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="2%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="30%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="2%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="1%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a href="listex.php?rid=exct" class="greendeactfont">List</a></td>
    <td width="5%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
	</tr>
</table></td>
              </tr>
              <tr>
                <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                <tr>
                                  <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                      <tr>
                                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td class="toheaderbg" colspan="3"><b>Monthly Progress Report</b> Information</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table>
                                </tr>
                                <tr>
                                  <td align="left"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1">
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
	<tr> 
            																	
            <?php
									if($flg == "red")
									{
								?>
								<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
							</tr>
							<tr>
								<td colspan="2" align="center" height="35" class="error"><?php echo $msg; ?></td>
								<?php
								}
								else
								{
								?>
								<td width="13%" height="35" colspan="2" align="center" class="fontblue"><?php echo $msg; }?></td>
          																</tr>                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                   
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
								  
                              </table></td>
                          </tr><tr> 
								<td colspan="2" height="30" align="right" style="padding-right:10px">
									<a href="./ex_main.php?rid=exc"><img src="./images/go_back.gif" alt="Edit Job" border="0"></a>
								</td>
							</tr>
                        </table></td>
                    </tr>
					
                    <tr>
                      <td width="0%"><img src="images/green_left_corn.gif" /></td>
                      <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                      <td width="0%"><img src="images/green_right_corn.gif" /></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
		<tr><td  height="20">&nbsp;</td></tr>
      </table>
	
      <?php } else {?>
		<form action="" name="frmexclusion" method="post" onSubmit="return validation();">
			<input type="hidden" name="rid" value="exc">
  		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				
				<tr> 
						<td colspan="3" class="schoolfont">Exclusion Report Admin</td>
				</tr>
				<tr>
						<td colspan="3">&nbsp;</td>
				</tr>
			
				<tr> 
						<td colspan="3"> 
								
								
<table width="69%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="2%" align="left"><img src="images/left-corn-de.gif" /></td>
    <td width="27%" align="center" class="graymid"><a  href="addex.php?rid=exc" class="greendeactfont">Add</a></td>
       <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="2%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="30%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="2%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="1%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a href="listex.php?rid=exct" class="greendeactfont">List</a></td>
    <td width="5%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
	</tr>
</table>
						</td>
				  </tr>
				  <tr> 
				  		<td width="100%" class="" colspan="3"> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder">
								<tr>
                                              <td class="toheaderbg" colspan="3">Edit Exclusion  </td>
                                            </tr>
  
          <tr> 
            <td bgcolor="#FFFFFF" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        <tr>
                                          <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                                        </tr>
                             	<?php 
	
	$sqledit = "Select * from cpo_detention where C_flag='E' and I_detentionid =".$exid; 
	$rsedit = runquery1($sqledit);
	$num = $rsedit ? mysqli_num_rows($rsedit) : 0 ;
	if ($num > 0)
	{
		$rsdata = mysqli_fetch_array($rsedit);
?>	
																<tr> 
										  								
                          
                      <td width="25%" height="42" class="">&nbsp;&nbsp;Select Learner </td>
   																	<td width="75%" ><select name="selstudent" class="textbox">
                                                                        <option value="selstudent">Select </option>
                   <?php $sqls = "select vUserName,iUserId from cpo_usermaster where iUserType=2";
					$querys = runquery1($sqls);
					while($rows = mysqli_fetch_array($querys))
					{								
					?>
				<option value="<?=$rows['iUserId']?>" <?php if($rows['iUserId'] == $rsdata['I_userid']){?> selected="selected"<?php }?>><?=$rows['vUserName']?></option>
				<?php }?>
                                                                    </select>
																	
																    <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Select Tutor </td>
   																	<td width="60%" ><select name="seltutor" class="textbox">
                                                                        <option value="">Select </option>
                   <?php $sqls = "select iUserId,vUserName from cpo_usermaster where iUserType=1";
					$querys = runquery1($sqls);
					while($rows = mysqli_fetch_array($querys))
					{								
					?>
				<option value="<?=$rows['iUserId']?>" <?php if($rows['iUserId'] == $rsdata['i_tutorid']){?> selected="selected"<?php }?>><?=$rows['vUserName']?></option>
				<?php }?>
                                                                    </select>
																    <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Exclusion Date</td>
      						<td width="60%" ><input name="txtddate" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">&nbsp;<a href="javascript:pickdate('txtddate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a> <font color="#FF0000">*</font> </td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Reason of Exclusion </td>
      																	<td width="60%" ><input type="text" name="txtreason" maxlength="100" size="40" class="textbox" value="<?php echo $rsdata['V_reason'];?>" > <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;What do learner need to improve? </td>
      																	<td width="60%"  ><textarea name="taimprove"  class="textbox" cols="30"><?php echo $rsdata['T_improve']; ?></textarea></td>
    															</tr>
																
<?php } ?>							
    															<tr> 
      																	<td colspan="2" style="padding-right:10px" > <div align="right"><font face=verdana size=2><b> 
                      &nbsp;&nbsp; 
                      <input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Student Information" onClick="return validation()" class="mouse"><input type="hidden" name="hdnsubmit" value="1">
                      &nbsp;&nbsp;<a href="ex_main.php?rid=exc"><img src="images/cancel.gif"  border="0"></a> 
                      </b></font> </div></div>                    </td>
    															</tr>
                                      </table> </td>
          </tr>
                
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
        </table>
						</td>
    			</tr>
				<tr>
                    <td width="0%"><img src="images/green_left_corn.gif" /></td>
                      <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                      <td width="0%"><img src="images/green_right_corn.gif" /></td>
                   
              </tr>
  		</table>
  		
		</form>
		<?php } ?>
			</td>
		</tr>
      </table></td></tr>
	   <tr>
		  <td width="0%"><img src="images/green_left_corn.gif" /></td>
		  <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
		  <td width="0%"><img src="images/green_right_corn.gif" /></td>
        </tr>
	  </table></td></tr></table>
	


</form>
</body>
</html>
