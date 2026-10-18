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
<title>Add Third Party Student</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="txteditor.js"></script>
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
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
          alert("Please Enter Email Address");
          document.frmtstudent.txtId.focus();
          return false;
     }
	else
	{
		
			var x = document.frmtstudent.txtId.value;
			var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/;  
			if (!filter.test(x))
			{
					alert("Enter a valid email Address");
					document.frmtstudent.txtId.value="";
					document.frmtstudent.txtId.focus();
				return false;
			}
	}
	if(document.frmtstudent.txtPass.value=="")
	{
		alert("Third Party Password can not be blank!");
		document.frmtstudent.txtPass.focus();
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
function onload()
{
	document.frmtstudent.txtName.focus();
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_POST['txtName'])){?> onLoad="onload()" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_POST['txtName']))
{
	$name=$_POST['txtName'];
	$id=$_POST['txtId'];
	$pass=$_POST['txtPass'];
	
	
   if(isset($_POST['chkactive']))
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
	
	$sql="select vUserEmailId from cpo_usermaster where vUserEmailId='".$id."'";
	$result=runquery1($sql);
	$num = mysqli_num_rows($result);
	if($num > 0)
	{
		$flg = 'red';
		$msg = "Email-Id already exist.";
		
	}
	else
	{
    $addsql="insert into cpo_usermaster (vUserName,vUserPassword,vUserEmailId,iUserStatus,iUserType) values ('".$name."','".$pass."','".$id."','".$status."','4')";
	   $record=runquery1($addsql) or die('error'.mysqli_error());
	$msg='Thrid party student "'.$name.'" added successfully.';
	}
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Third Party Student Admin</td>
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
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=thirdparty" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Add</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="viewtstudent.php" class="greendeactfont">Edit / Delete</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listtstudent.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3">Third Party Student Information</td>
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
									 <?php if($flg == 'red')
																					{?>
									  <tr>
										<td height="35" align="center"><img src="./images/alert.gif" border="0"></td>
									  </tr>
									  <tr>
										<td  align="center" height="35" class="error"><?php echo $msg; ?></td>
									  </tr>
									  <?php }
																											else
																											{?>
									  <tr>
										<td align="center"><font class="fontblue"><b><?php echo $msg ?></b></font> </td>
									  </tr>
									  <tr>
										<td align="center">&nbsp;</td>
									  </tr>
									  <?php
																					
																					} ?>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="center"><div align="right"><a href="addtstudent.php"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="overview.php?id=thirdparty"><img src="images/cancel.gif" border="0"></a> &nbsp;</div></td>
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
     <form action="addtstudent.php" name="frmtstudent" method="post" onSubmit="return validation();">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Third Party Student Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=thirdparty" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Add</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="viewtstudent.php" class="greendeactfont">Edit / Delete</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listtstudent.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Add Third Party Student</td>
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
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Name</td>
      																	<td width="60%" ><input name="txtName" type="text" class="textbox" size="40" maxlength="70"> <font color="#FF0000">*</font></td>
    															</tr>
																
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp; Email Id</td>
      																	<td width="60%" ><input name="txtId" type="text" class="textbox" size="40" maxlength="70"> <font color="#FF0000">*</font></td>
    															</tr>
    															
    															<tr> 
                          												
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Password</td>
      																	
                          <td width="60%" ><input name="txtPass" type="password" class="textbox" size="16" maxlength="70"> <font color="#FF0000">*</font>
                      </td>
    															</tr>
	  															
																<tr> 
                  <td align=right ><div align="left">&nbsp; Active</div></td>
                      <td height="22" align=left> 
                        <input name="chkactive" type="checkbox" value="1" checked> 
                    <input type="hidden" name="txtcheck" value="1"></td>
                </tr>
							
									 <tr> 
                  <td colspan="2" > <div align="right"><font face=verdana size=2><b> 
                      &nbsp;&nbsp; 
                      <input name="image" type="image" src="images/add.gif" >
                      &nbsp;&nbsp;<a href="overview.php?id=thirdparty"><img src="images/cancel.gif"  border="0"></a> 
                      </b></font> </div></div>
                    </td>
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
