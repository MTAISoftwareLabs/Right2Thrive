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
<title>Add Notice</title>
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
if($_POST['add']==' ')
{
	$student=$_POST['student'];
	$notice=$_POST['notice'];
	
   if(isset($_POST['chkactive']))
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
	
	
	if($_POST['add']==' ')
	{
		$addsql="insert into cpo_notice (iUserId,notice,iUserStatus) values ('".$student."','".$notice."','".$status."')";
	   	$record=runquery1($addsql) or die('error'.mysqli_error());
		$msg='Notice Added Successfully.';
	}
	
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
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Add</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="viewnotice.php" class="greendeactfont">Edit / Delete</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
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
                                              <td class="toheaderbg" colspan="3">Notice Bord</td>
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
                                        <td align="center"><div align="right"><a href="addnotice.php"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="overview.php?id=notice"><img src="images/cancel.gif" border="0"></a> &nbsp;</div></td>
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
     <form action="addnotice.php" name="frmnotice" method="post" onSubmit="return validation();">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Notice Bord</td>
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
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Add</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="viewnotice.php" class="greendeactfont">Edit / Delete</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
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
                                                <td class="toheaderbg" colspan="3">Add New Notice</td>
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
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;Select Student</td>
						<td width="60%" >
						<select name="student" class="textbox">
						<option value="">---Select Student---</option>
						<?php
						$fetch="select * from cpo_usermaster where iUserStatus=1 ORDER BY `vUserName` ASC";
						$result=runquery1($fetch);
						$count= $result ? mysqli_num_rows($result) : 0 ;
						while($row=mysqli_fetch_array($result))
						{
						?>
						<option value="<?php echo $row["iUserId"];?>"><?php echo $row["vUserName"];?></option>
						<?php
						}
						?>
						</select>
                        
                        </td>
    															</tr>
																
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="" valign="top">&nbsp;Notice</td>
      																	<td width="60%" ><textarea name="notice" class="textbox" maxlength="70" style="width:260px;height:100px;"></textarea> <font color="#FF0000">*</font></td>
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
                     <div align="right" style="float:right; margin-right:50px;">
                      <div style="width:10px; float:left;"><input type="submit" name="add" value=" " style="background-image:url(images/add.gif); width:42px; height:24px; border:none;" ></div>
                      &nbsp;&nbsp;<div style="width:10px; float:left; margin-left:50px;"><a href="overview.php?id=notice"><img src="images/cancel.gif"  border="0"></a></div>
                      
                      </div>
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
