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
$userid = $_GET['id'];
$query = "SELECT cpo_notice.noticeid, cpo_notice.iUserId, cpo_notice.notice, cpo_notice.iUserStatus, cpo_usermaster.vUserName, cpo_usermaster.iUserId
FROM cpo_notice
LEFT OUTER JOIN cpo_usermaster ON cpo_notice.iUserId = cpo_usermaster.iUserId
WHERE cpo_notice.noticeid = ".$userid."";
$result = runquery1($query) or die('could note execute'.mysqli_error());
$num = mysqli_num_rows($result);
$rslist = mysqli_fetch_array($result);
?>
<html>
<head>
<title>Edit Notice</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function onload()
{
	document.frmtstudent.txtName.focus();
}
function validation()
{
	if(document.frmtstudent.txtName.value=="")
	{
		alert("Third Party Name can not be blank!");
		document.frmtstudent.txtName.focus();
		return false;
	}
	if(document.frmtstudent.txtId.value=="")
	{
		alert("Third Party Id can not be blank!");
		document.frmtstudent.txtName.focus();
		return false;
	}
	if(document.frmtstudent.txtPass.value=="")
	{
		alert("Third Party Password can not be blank!");
		document.frmtstudent.txtName.focus();
		return false;
	}
	 if(document.frmtstudent.txtPass.value.length<4)
	{	
		alert("Password must be more than 4 character!");
		document.frmtstudent.txtPass.focus();
		return false;
	}
	if(document.frmtstudent.txtPass.value.length>16)
	{	
		alert("Password not more than 16 character!");
		document.frmtstudent.txtPass.focus();
		return false;
	}
	
			
	return true;
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_POST['txtName'])) {?> onLoad="onload();" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_POST['txtName']) )
{
	$txtName=$_POST['txtName'];
	

	if(isset($_POST['chkactive']))
	{
		$active=1;
	}
	else
	{
		$active=0;
	}
	
	$sql="update cpo_notice set notice ='". $txtName ."', iUserStatus='".$active."' where noticeid=".$userid;
  	
	$rscheck=runquery1($sql) or die('could not'.mysqli_error());
	$flg="green";
	$msg='Notice updated successfully.';
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Notice</td>
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
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=notice" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
					   <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="addnotice.php" class="greendeactfont">Add</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listnotice.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3">Notice Information</td>
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
									<a href="./viewnotice.php"><img src="./images/go_back.gif" alt="View School" border="0"></a>
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
     <form action="" name="frmtstudent" method="post" onSubmit="return validation();">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Notice</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=notice" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addnotice.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listnotice.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Edit Notice</td>
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
                  <td width="29%" height="30" class="" valign="top">&nbsp;&nbsp;Notice</td>
								<td width="71%" >&nbsp;&nbsp;
                                <textarea name="txtName" type="text" class="textbox" style="width:260px;height:100px;"><?php echo $rslist["notice"]; ?></textarea>
                                <font color="#FF0000">&nbsp;*</font></td>
							
							 
							  <tr> 
                  <td  height="28" valign="top" class="bodytext">&nbsp; 
                    &nbsp;Active</td>
                  <td align=left valign="top">&nbsp; 
                    <?php
					
				  if (intval($rslist["iUserStatus"])==0)
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
                     </td>
                </tr>
							  
							  
														
							<tr align="right"> 
								<td width="29%" height="40" class="">&nbsp;</td>
								<td width="71%">
									<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Third Party"  class="mouse">&nbsp;
									<input name="id" type="hidden" value="<?=$rslist["iUserId"]?>">
									<a href="./viewnotice.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>
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
