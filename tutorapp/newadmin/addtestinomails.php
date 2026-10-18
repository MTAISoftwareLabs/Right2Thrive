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
<title>Add Success Story</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="txteditor.js"></script>
<script language="JavaScript">
function validation()
{
	if(document.frmtestimonials.txtName.value=="")
	{
		alert("Success Story Name can not be blank!");
		document.frmtestimonials.txtName.focus();
		return false;
	}
	if(document.frmtestimonials.txtContent.value=="")
	{
		alert("Success Story Description can not be blank!");
		document.frmtestimonials.txtContent.focus();
		return false;
	}
	if(document.frmtestimonials.txtWebsite.value=="")
	{
		alert("Website Url can not be blank!");
		document.frmtestimonials.txtWebsite.focus();
		return false;
	}
	if(document.frmtestimonials.txtEmail.value=="")
	{
		alert("Please Enter E-mail Address");
	  	document.frmtestimonials.txtEmail.focus();
	  	return false;
	}
	else
	{
		var x = document.frmtestimonials.txtEmail.value;
		var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/;  
		if (!filter.test(x))
		{
			alert("Enter a valid E-mail Address");
			document.frmtestimonials.txtEmail.value="";
			document.frmtestimonials.txtEmail.focus();
			return false;
		}
	}
	return true;
}
function onload()
{
	document.frmtestimonials.txtName.focus();
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frmtestimonials'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
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
        $desc=addslashes($_POST['txtContent']);
		$website=$_POST['txtWebsite'];
		$txtemail=$_POST['txtEmail'];
		$txtstdate=$_POST['txtstdate'];
		$sdate=explode("/",$txtstdate);
		if(isset($_POST['chkactive']))
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$addsql="insert into cpo_testinomailsmaster values ('','".$name."','".$txtemail."','".$desc."','".$website."','$sdate[2].$sdate[1].$sdate[0]',".$status.")";
		$record=runquery1($addsql) or die('could not execute'.mysqli_error());
		$msg='Success story "'.$name.'" added successfully.';
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Success Story Admin</td>
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
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=testimonails" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Add</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="viewtestimonails.php" class="greendeactfont">Edit / Delete</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listtestimonails.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3">Success Story Information</td>
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
                                        <td align="center"><div align="right"><a href="addtestinomails.php"><img src="images/add_new.gif" border="0"></a>&nbsp;<a href="overview.php?id=testimonails"><img src="images/cancel.gif"  border="0"></a> &nbsp;</div></td>
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
   <form action="addtestinomails.php" name="frmtestimonials" method="post" onSubmit="return validation();">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Success Story Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=testimonails" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Add</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="viewtestimonails.php" class="greendeactfont">Edit / Delete</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listtestimonails.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Add Success Story</td>
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
										  								
                          
                      <td width="40%" height="32" class="">&nbsp;&nbsp;Name</td>
      																	<td width="60%" ><input name="txtName" type="text" class="textbox" size="40" maxlength="70"> <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="40%" height="32" class="">&nbsp;&nbsp;E-mail Address</td>
      																	<td width="60%" ><input name="txtEmail" type="text" class="textbox" size="40" maxlength="70"> <font color="#FF0000">*</font></td>
    															</tr>
																
    															
																<tr> 
                          												
                          
                      <td width="40%" class="">&nbsp;&nbsp;Content</td>
      																	
                          <td width="60%" ><textarea name=txtContent value="" rows="3" cols="45" class="textbox"></textarea> <font color="#FF0000">*</font> </td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="40%" height="32" class="">&nbsp;&nbsp;Website 
                        Address </td>
      																	<td width="60%" ><input name="txtWebsite" type="text" class="textbox" size="40" maxlength="70"> <font color="#FF0000">*</font></td>
    															</tr>
										
							<tr> 
                      <td  width="36%" height="32">&nbsp; Date :</td>
                  <td width="64%" height="25"><input name="txtstdate" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">
							  <a href="javascript:pickdate('txtstdate')"><img src="../admin/images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>
                    <font color="red">&nbsp;*</font> </td>
                </tr>
																
																
															    															
											
	  															
																<tr> 
                  <td width="36%" align="right" ><div align="left">&nbsp; Active</div></td>
                  <td height="32" align="left"><input name="chkactive" type="checkbox" value="1" checked> 
                    <input type="hidden" name="txtcheck" value="1"></td>
                </tr>
							
									 <tr> 
                  <td colspan="2" > <div align="right"><font face=verdana size=2><b> 
                      &nbsp;&nbsp; 
                      <input name="image" type="image" src="images/add.gif" >
                      &nbsp;&nbsp;<a href="overview.php?id=testimonails"><img src="images/cancel.gif" border="0"></a> 
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
