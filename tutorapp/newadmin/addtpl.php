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
<title>Add Third Party - Learner</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">

<script language="JavaScript">
var myvar=1;
function validation()
{
	if(document.frmtpl.txtThirdId.value=="-")
	{
		alert("Please Select Third Party Name");
		document.frmtpl.txtThirdId.focus();
		return false;
	}
	if (myvar == 1)
	{	
			alert("Please Select Learner");
			return false;
		
	}
		return true;
	
}
function sel()
{
	myvar = 0;
	
}


function win_onload()
{
 //document.frmsubjectintegrate.txtCourseId.focus();
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
if(isset($_POST['txtThirdId']))
{
		$Learner_id = "";	
		foreach($_POST['txtLearnerId'] as $value)
		{
			$Learner_id.= $value. ",";
		}
		$Learner_id = substr($Learner_id,0,strlen($Learner_id)-1);
		if ($Learner_id <> "-")
		{
		
			 $Third_id=$_POST['txtThirdId'];
			 $selectdata="select vLearnerIds,iTid from cpo_thirdpartylearner where iTId=".$Third_id."";
			 $result=runquery1($selectdata);
			 $count= $result ? mysqli_num_rows($result) : 0 ;
			 if($count==1)
			 {
					$Learner_id = "";	
					$id1=mysqli_result($result,0,0);
					$tutorcourseid=mysqli_result($result,0,1);
					$id=explode(",", $id1);
					$Learner_id = $id1.",";
					$change = 0;
					foreach($_POST['txtLearnerId'] as $value)
					{
						$flag = 0;
						for($i=0;$i<=count($id)-1;$i++)
						{
							if ($value == $id[$i])
							{
								$flag = 1;
							}
						}
						if ($flag == 0)
						{
							$Learner_id = $Learner_id . $value .",";		
							$change = 1;
						}
					}
					$Learner_id = substr($Learner_id,0,strlen($Learner_id)-1);
					if($change == 0)
						$msg="Record already exist";
					else
					{
						$sql="update cpo_thirdpartylearner set vLearnerIds = '". $Learner_id ."' where iTId=".$Third_id;
						runquery1($sql);
						$msg="Record Updated Successfully";
					}
				}
				else
				{
					$addsql="insert into cpo_thirdpartylearner (vLearnerIds,iTId)  values ('".$Learner_id ."',".$Third_id.")";
					$record=runquery1($addsql);
					$msg="Learner Integrated to Third Party Successfully";
				}
			}
			else
			{
				$msg="First Select Learner";
			}	
			//$record=mysqli_query($addsql1,$HTTP_SESSION_VARS['conn']) or die("could not execute query".mysqli_error());	?>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Third Party - Learner Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tpl" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewtpl.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listtpl.php" class="greendeactfont">List</a></td>
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
                            <td class="toheaderbg" colspan="3">Third Party - Learner Information</td>	
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
            																	<td align="center"> 
			
              			<font class="fontblue"><b><?php echo $msg ?></b></font> 
               													</td>
          																</tr>
                														<tr> 
                  																<td align="center">&nbsp;</td>
														                </tr>	
                														
                														<tr> 
                  																<td>&nbsp;</td>
                														</tr>
              													</table></td>
          								</tr><tr> 
																                <td align="center"  style="padding-right:10px"><div align="right"><a href="addtpl.php"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="overview.php?id=tpl"><img src="images/cancel.gif" border="0"></a> &nbsp;</div></td>
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
	<form action="addtpl.php" name="frmtpl" method="post" onSubmit="return validation();">
	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Third Party - Learner Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tpl" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewtpl.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listtpl.php" class="greendeactfont">List</a></td>
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
																								
																								
                            <td class="toheaderbg" colspan="3">Add Third Party - Learner</td>
																								
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
							
					
					<td width="28%" height="30" class="">&nbsp;&nbsp;Select 
					Third Party</td>
					<td width="72%" ><select name="txtThirdId" class="textbox">
					<option value="-">Select Third Party </option>
					
					<?php
					$fetch="select * from cpo_usermaster where iUserStatus=1 and iUserType=4";
					$result=runquery1($fetch);
					$count= $result ? mysqli_num_rows($result) : 0 ;
					
					while($row=mysqli_fetch_array($result))
					{
					?>
					<option value="<?php echo $row["iUserId"];?>"><?php echo $row["vUserName"];?></option>
					<?php
					}
					?>
					</select> <font color="#FF0000">*</font></td>
					</tr>
					<tr> 
							
					
					<td width="28%" height="42" class="">&nbsp;&nbsp;Select 
					Learner</td>
							
					
					<td width="72%" > <font color="#FF0000">
					<select name=txtLearnerId[] multiple size="15" onChange="sel()" class="textbox">
					<option value="-" selected>Select Learner</option>
					<?php
					$fetch="select * from cpo_usermaster where iUserStatus=1 and iUserType=2";
					$result=runquery1($fetch);
					$count= $result ? mysqli_num_rows($result) : 0;
					
					while($row=mysqli_fetch_array($result))
					{
					?>
					<option value="<?php echo $row["iUserId"]?>"><?php echo $row["vUserName"];?></option>
					<?php
					}
					?>
					</select>*</font> </td>
					</tr>
					<tr><td colspan="2">&nbsp;</td></tr>															
	  					
				<tr> 
                          												
                          
                      <td> </td>
      																	
                          <td style="height:50px;" valign="middle" align="right"  style="padding-right:10px"><input type="image" src="images/add.gif" border="0" alt="Add">&nbsp;&nbsp;<a href="overview.php?id=tpl"><img src="images/cancel.gif"  border="0"></a></td>
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
