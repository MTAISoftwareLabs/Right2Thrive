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
} ?>
<html>
<head>
<title>Add Tutor - Subject - Learner</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="./calendar1.js"></script> 
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
function win_onload()
{
document.frmtsl.selsubject.focus();
}
function validation()
{
	if(document.frmtsl.selsubject.value=="")
	{
		alert("Subject must be selected!");
		document.frmtsl.selsubject.focus();
		return false;
	}
	if(document.frmtsl.seltutor.value=="")
	{
		alert("Tutor must be selected!");
		document.frmtsl.seltutor.focus();
		return false;
	}
	var myDrop = document.frmtsl.elements['sellearner[]'];
	var selectCount = 0;
	var dropLength = myDrop.length
	for(var i=0; i<dropLength; i++)
	{
		if(myDrop.options[i].selected == true && myDrop.options[i].value !='')
		{
			selectCount++;
		}
	}
	if(selectCount<1)
	{
		alert('Please select at least one learner.');
		return false;
	}
	if(document.frmtsl.txtsublevel.value=="")
	{
		alert("Sublevel cannot be blank!");
		document.frmtsl.txtsublevel.focus();
		return false;
	}
	return true;
}
</script>
</head>

<body leftmargin="0" topmargin="0" class="seffact">
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
<?php 
if(isset($_POST['hdnsubmit'])  && $_POST['hdnsubmit'] ==1)
{
	$subject = $_POST['selsubject'];
	$tutor = $_POST['seltutor'];
	$sublevel = $_POST['txtsublevel'];
	
	for($i=0;$i<count($_POST['sellearner']);$i++)
	{
		$addsql="insert into cpo_user_subject(I_studentid,I_tutorid,I_subjectid,V_sublevel) values ('".$_POST['sellearner'][$i]."',".$tutor.",".$subject.",'".$sublevel."')";
		$record=runquery1($addsql) or die("could not execute query".mysqli_error());
		if($record)
		$msg="Record added successfully.";
		else
		$msg="Error in insert";
	}
		
?>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Tutor-Subject-Learner Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tsl" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewtsl.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listtsl.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
												<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 		
                            <td class="toheaderbg" colspan="3"><b>Tutor-Subject-Learner</b> Information</td>	
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            									<td align="left"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1" class="table">
                														
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
								<td colspan="2" align="center" height="35" class="fontblue"><?php echo $msg; }?></td>	
          																</tr>
                														<tr> 
                  																<td align="center">&nbsp;</td>
														                </tr>	
                														<tr> 
																                <td align="center"><div align="right"><a href="addtsl.php"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="overview.php?id=tsl"><img src="images/cancel.gif" border="0"></a> &nbsp;</div></td>
                														</tr>
                														<tr> 
                  																<td>&nbsp;</td>
                														</tr>
              													</table></td>
          								</tr>
        						</table>
						</td>
    			</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td></tr>
</table>
</td>
  </tr>
</table>
<?php } else {?>
<form action="" name="frmtsl" method="post" onSubmit="return validation();">
	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td align="left" class="schoolfont">Tutor-Subject-Learner Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tsl" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewtsl.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listtsl.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
																			<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">Add Tutor-Subject-Learner</td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            									<td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
<tr> 
																								<td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
																						</tr>
																						<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Subject </td>
   																	<td width="60%" ><select name="selsubject">
                                                                        <option value="">Select Subject</option>
                   <?php $sqls = "select iSubjectId,vSubjectName from cpo_subjectmaster where iStatus=1";
					$querys = runquery1($sqls);
					while($rows = mysqli_fetch_array($querys))
					{								
					?>
				<option value="<?=$rows['iSubjectId']?>"><?=$rows['vSubjectName']?></option>
				<?php }?>
                                                                    </select>
																    <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Tutor </td>
   																	<td width="60%" ><select name="seltutor">
                                                                        <option value="">Select Tutor</option>
                   <?php $sqlt = "select iUserId,vUserName from cpo_usermaster where iUserType=1";
					$queryt = runquery1($sqlt);
					while($rowt = mysqli_fetch_array($queryt))
					{								
					?>
				<option value="<?=$rowt['iUserId']?>"><?=$rowt['vUserName']?></option>
				<?php }?>
                                                                    </select>
																    <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Learner </td>
   																	<td width="60%" ><select name="sellearner[]" multiple="multiple" size="10" style="width:220px" >
                   <?php $sqlst = "select iUserId,vUserName from cpo_usermaster where iUserType=2";
					$queryst = runquery1($sqlst);
					while($rowst = mysqli_fetch_array($queryst))
					{								
					?>
				<option value="<?=$rowst['iUserId']?>"><?=$rowst['vUserName']?></option>
				<?php }?>
                                                                    </select>
																    <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Sub Level </td>
   																	<td width="60%" >
																	<input type="text" name="txtsublevel" value="" class="textbox">
																    <font color="#FF0000">*</font></td>
    															</tr>
				<tr> 
                          												
                          
                      <td> </td>
      																	
                          <td style="height:50px; padding-right:10px" align="right"  valign="middle"><input type="hidden" name="hdnsubmit" value="1"><input type="image" src="images/add.gif" border="0" alt="Add">&nbsp;&nbsp;<a href="overview.php?id=tsl"><img src="images/cancel.gif" border="0"></a></td>
    															</tr>
							
							
    															
</table></td>
          								</tr>
        						</table>
						</td>
    			</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td></tr>
</table>
</td>
  </tr>
</table>
		</form>
	<?php }?>
	</td>
  </tr>
</table>
</body>
</html>
