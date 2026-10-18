<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
if (!isset($_SESSION['user_id']))
{?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
$instituteid = $_GET['id'];
$query = "select * from cpo_institutemaster where iInstituteId = ".$instituteid."";
$result = runquery1($query) or die('could note execute'.mysqli_error());
$num = mysqli_num_rows($result);
$rslist = mysqli_fetch_array($result);
$sdate=explode('-',$rslist["dDate"]);
?>
<html>
<head>
<title>Edit Category</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function onload()
{
	document.frminstitute.txtInstituteName.focus();
}
function validation(aid)

{
	if(document.frminstitute.txtInstituteName.value=="")
	{
		alert("Institue Name can not be blank!");
		document.frmcourse.txtInstituteName.focus();
		return false;
	}
	if(document.frminstitute.txtInstituteDesc.value=="")
	{
		alert("Institute Description can not be blank!");
		document.frminstitute.txtInstituteDesc.focus();
		return false;
	}
	if(document.frminstitute.txtInstituteLocation.value=="")
	{
		alert("Institue Location can not be blank!");
		document.frminstitute.txtInstituteLocation.focus();
		return false;
	}
	
	return true;
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_POST['txtInstituteName'])) {?> onLoad="onload();" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_POST['txtInstituteName']) )
{
	$Institute_name=$_POST['txtInstituteName'];
	$Institute_desc=$_POST['txtInstituteDesc'];
	$Institute_location=$_POST['txtInstituteLocation'];
	
	
	if(isset($_POST['chkactive']))
	{
		$active=1;
	}
	else
	{
		$active=0;
	}				
	
	$sql="update cpo_institutemaster set vInstituteName='". $Institute_name ."',vInstituteLocation='".$Institute_location."',iStatus='".$active."',vInstituteDesc='".$Institute_desc."' where iInstituteId=".$instituteid;
	$rscheck=runquery1($sql) or die('could not'.mysqli_error());
	$flg="green";
	$msg='Institute "'.$Institute_name.'"updated successfully.';
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Institute Admin</td>
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
                <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=institute" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
					   <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="addinstitute.php" class="greendeactfont">Add</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listinstitute.php" class="greendeactfont">List</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
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
                                              <td class="toheaderbg" colspan="3">Institute Information</td>
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
								<td colspan="2" align="center" height="35" class="fontblue"><?php echo $msg; ?></td><?php }?>	
								</tr>	
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr> 
								<td colspan="2" height="30" align="right">
									<a href="./viewinstitute.php"><img src="./images/go_back.gif" alt="View School" border="0"></a>
								</td>
							</tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
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
      </table>
      <?php } else {?>
     <form action="EditInstitute.php?id=<?php echo $instituteid;?>" name="frminstitute" method="post" onSubmit="return validation();">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Institute Admin</td>
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
                  <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=institute" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addinstitute.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listinstitute.php" class="greendeactfont">List</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
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
                                                <td class="toheaderbg" colspan="3">Edit Institute</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                  </tr>
                                  <tr>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        <tr>
                                          <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                                        </tr>
                                        <tr> 
                  <td width="30%" height="30" class="">&nbsp;Institute Name</td>
				  <td width="70%" >&nbsp;&nbsp;<input name="txtInstituteName" value="<?php echo $rslist["vInstituteName"] ?>" type="text" class="textbox" size="50" maxlength="255"><font color="#FF0000">&nbsp;*</font></td>
				</tr>
				<tr>
					<td colspan="2" height="2%">&nbsp;</td>
				</tr>
 			    <tr> 
					<td>&nbsp;Institute Description: </td>
					<td align=left>&nbsp;&nbsp;<textarea name="txtInstituteDesc" maxlength =255  rows="3" cols="52" class="textbox"><?php echo ereg_replace('<br />',  '' , $rslist["vInstituteDesc"]);?></textarea> <font color="#FF0000">&nbsp;*</font></td>
			    </tr>
				<tr> 
					<td colspan="2" height="2%">&nbsp;</td>
				</tr>
				<tr> 
                  <td width="30%" height="30">&nbsp;Institute Location</td>
				  <td width="70%" >&nbsp;&nbsp;<input name="txtInstituteLocation" type="text" class="textbox" size="40" value="<?php echo $rslist["vInstituteLocation"]?>"> <font color="#FF0000">&nbsp;*</font></td>
				</tr>  			  								
				<tr> 
                  <td height="28"  class="bodytext"> &nbsp;Active</td>
                  <td align=left valign="top">&nbsp;&nbsp;
                    <?php
				  if (intval($rslist["iStatus"])==0)
				  {
				  ?>
                    <input type="checkbox" name="chkactive" value="0"> 
                    <?php
				}
				else
				{
				?>
                    <input type="checkbox" name="chkactive" value="1" checked>
                    <?php
				 }
				 ?>
                    <input type="hidden" name="txtchk" value="1"><input type="hidden" name="txtnewsid" value="<?php echo $newsid ?>"> </td>
                </tr>
				<tr align="right"> 
					<td width="30%">&nbsp;</td>
					<td width="70%">
						<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Institute" class="mouse">&nbsp;
						<input name="id" type="hidden" value="<?=$rslist["iInstituteId"]?>">
						<a href="./viewinstitute.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>
					&nbsp;</td>
				</tr>
                                      </table></td>
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
        </table>
      </form>
      <?php }?>
    </td>
  </tr>
</table>
</body>
</html>
