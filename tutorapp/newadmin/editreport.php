<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 

$reportid = $_GET['id'];
$query = "select * from cpo_progressreport where I_progressid = ".$reportid."";
$result = runquery1($query) or die('could note execute'.mysqli_error());
$num = mysqli_num_rows($result);
$rslist = mysqli_fetch_array($result);

?>

<html>
<head>
<title>Edit Monthly Progress Report</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript" src="./calendar1.js"></script> 
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
function win_onload()
{
document.frmreport.sellearner.focus();
}
function validation()
{
	if(document.frmreport.sel_learner.value=="")
	{
		alert("Learner must be selected!");
		document.frmreport.sel_learner.focus();
		return false;
	}
	if(document.frmreport.selmonth.value=="")
	{
		alert("Month must be selected!");
		document.frmreport.selmonth.focus();
		return false;
	}
	if(document.frmreport.selyear.value=="")
	{
		alert("Year must be selected!");
		document.frmreport.selyear.focus();
		return false;
	}
	return true;
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact">
	
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0"   >
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	<table width="97%"  border="0" cellspacing="0" cellpadding="0">
	<tr><td width="100%" colspan="3"><?php include_once('top_personal.php');?></td></tr>
  	<tr><td colspan="3"><table  width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder" align="center" >
        <tr> 
          <td bgcolor="F5F8FF">&nbsp;</td>
        </tr>
		
			
		<tr><td width="100%">
		<?php 
if(isset($_POST['hdnsubmit'])  && $_POST['hdnsubmit'] ==1)
{
	$subject = $_POST['subject'];
	$student_name = $_POST['learner'];
	$tutor_name = $_POST['tutor'];
	$year = $_POST['selyear'];
	$month = $_POST['selmonth'];
	
	$sql = "select I_userid from cpo_progressreport where I_userid=".$student_name." and I_tutorid=".$tutor_name." and I_month=".$month." and I_year=".$year." and I_progressid!=".$reportid;
	$res = runquery1($sql);
	$num1 = mysqli_num_rows($res);
	if($num1>0)
	{
		$msg = "Report for $month and $year already exists";
		$flg = "red";
	}
	else
	{
		$addsql="update cpo_progressreport set I_month=".$month.",I_year=".$year." where I_progressid=".$reportid;
		$rscheck=runquery1($addsql);
		if($rscheck)
		{
			$msg="Monthly report successfully edited.";
			$flg = "green";
		}
		else
		{
			$msg = "Error in Updation.";
			$flg = "red";
		}	
	}	?>		
      <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" class="schoolfont">Monthly Progress Report Admin</td>
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
    <td width="27%" align="center" class="graymid"><a  href="addreport.php?rid=report" class="greendeactfont">Add</a></td>
       <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="2%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="30%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="2%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="1%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a href="listreport.php?rid=report" class="greendeactfont">List</a></td>
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
								<td height="35" align="center"><img src="./images/alert.gif" border="0"></td>
							</tr>
							<tr>
								<td  align="center" height="35" class="error"><?php echo $msg; ?></td>
								<?php
								}
								else
								{
								?>
								<td align="center" height="35" class="fontblue"><?php echo $msg; }?></td>
          																</tr>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                   
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
								   <tr>
                                        <td  height="30" align="right" style="padding-right:30px">
									<a href="mon_main.php?rid=report"><img src="./images/go_back.gif" alt="Edit Job" border="0"></a>
								</td>
                                      </tr>
                              </table></td>
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
	 
  		<p>&nbsp;</p>
      <?php } else {?>
	<form action="" name="frmreport" method="post" onSubmit="return validation();">
			<input type="hidden" name="rid" value="report">
  		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				
				<tr> 
						<td colspan="3" class="schoolfont">Monthly Progress Report Admin</td>
				</tr>
				<tr>
						<td colspan="3">&nbsp;</td>
				</tr>
			
				<tr> 
						<td colspan="3"> 
								
								
<table width="69%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="2%" align="left"><img src="images/left-corn-de.gif" /></td>
    <td width="27%" align="center" class="graymid"><a  href="addreport.php?rid=report" class="greendeactfont">Add</a></td>
       <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="2%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="30%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="2%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="1%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a href="listreport.php?rid=report" class="greendeactfont">List</a></td>
    <td width="5%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
	</tr>
</table>
						</td>
				  </tr>
				  <tr> 
				  		<td width="100%" class="" colspan="3"> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder">
								<tr>
                                              <td class="toheaderbg" colspan="3">Add Monthly Progress Report </td>
                                            </tr>
           
          <tr> 
            <td bgcolor="#FFFFFF" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        <tr>
                                          <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                                        </tr>
                               <tr> 
										  								
                          
                      <td width="31%" height="42" class="">&nbsp;&nbsp;Select Subject </td>
   																	<td width="69%" ><select name="selsubject" disabled="disabled">
                                                                        <option value="">Select Subject</option>
                   <?php $sqlsu = "select iSubjectId,vSubjectName from cpo_subjectmaster where iStatus=1";
					$querysu = runquery1($sqlsu);
					while($rowsu = mysqli_fetch_array($querysu))
					{								
					?>
				<option value="<?=$rowsu['iSubjectId']?>" <?php if($rowsu['iSubjectId'] == $rslist['I_subjectId']){?> selected="selected"<?php }?>><?=$rowsu['vSubjectName']?></option>
				<?php }?>
                                                                    </select>
																    <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="31%" height="42" class="">&nbsp;&nbsp;Select Tutor </td>
   																	<td width="69%" ><select name="seltutor" disabled="disabled">
                                                                        <option value="">Select Tutor</option>
                   <?php $sqls = "select iUserId,vUserName from cpo_usermaster where iUserType=1";
					$querys = runquery1($sqls);
					while($rows = mysqli_fetch_array($querys))
					{								
					?>
				<option value="<?=$rows['iUserId']?>" <?php if($rows['iUserId'] == $rslist['I_tutorid']){?> selected="selected"<?php }?>><?=$rows['vUserName']?></option>
				<?php }?>
                                                                    </select>
																    <font color="#FF0000">*</font></td>
    															</tr>
																<input type="hidden" name="learner" value="<?=$rslist['I_userid']?>">
																<input type="hidden" name="tutor" value="<?=$rslist['I_tutorid']?>">
																<input type="hidden" name="subject" value="<?=$rslist['I_subjectId']?>">
																<tr>    
                      <td width="31%" height="42" class="">&nbsp;&nbsp;Select Learner </td>
   																	<td width="69%" ><select name="sel_learner" disabled="disabled">
                                                                        <option value="">Select Learner</option>
                   <?php $sqls = "select iUserId,vUserName from cpo_usermaster where iUserType=2";
					$querys = runquery1($sqls);
					while($rows = mysqli_fetch_array($querys))
					{								
					?>
				<option value="<?=$rows['iUserId']?>" <?php if($rows['iUserId'] == $rslist['I_userid']){?> selected="selected"<?php }?>><?=$rows['vUserName']?></option>
				<?php }?>
                                                                    </select>
																    <font color="#FF0000">*</font></td>
    															</tr>
																
																<tr> 
										  								
                          
                      <td width="31%" height="42" class="">&nbsp;&nbsp;Select Month and Year </td>
      																	<td width="69%" >
			<select name="selmonth"  >
			<option value="">Month</option>
			<?php 
			for ($m=1;$m<13;$m++){
			if($m<10)
			$m = "0".$m;
			?>
						<option value="<?php echo $m;?>" <?php if($m == $rslist['I_month']){?> selected="selected"<?php }?>><?php echo $m;?></option>
						<?php }?>		
			</select>&nbsp;<select name="selyear">
			<option value="">Year</option>
			<?php 
					$yr = date('Y')-100;
					$year = date('Y')+1;
					for ($year;$year>$yr;$year--){
					?>
						<option value="<?php echo $year;?>" <?php if($year == $rslist['I_year']){?> selected="selected"<?php }?>><?php echo $year;?></option>
						<?php }?>
			</select> <font color="#FF0000">*</font></td>
    															</tr>
																
							
    															<tr> 
      																	<td colspan="2"  style="padding-right:10px"> <div align="right"><font face=verdana size=2><b> 
                      &nbsp;&nbsp; 
                      <input name="image" type="image" src="./images/update.gif" ><input type="hidden" name="hdnsubmit" value="1">
                      &nbsp;&nbsp;<a href="mon_main.php?rid=report"><img src="images/cancel.gif" border="0"></a></b></font> </div>
      																	</div>                    </td>
    															</tr>
                                      </table> </td>
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
