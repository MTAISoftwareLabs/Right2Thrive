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
$tid = $_GET['id'];
$query = "select * from cpo_testinomailsmaster where iTestimonailsId = ".$tid."";
$result = runquery1($query) or die('could note execute'.mysqli_error());
$rslist = mysqli_fetch_array($result);
$sdate=explode('-',$rslist["dDate"]);
?>
<html>
<head>
<title>Edit Success Story</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="./calendar1.js"></script> 
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
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frmtestimonials'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	//mydatetime.MX = obj.x;
	//mydatetime.MY = obj.y;	
	mydatetime.popup();
}
function onload()
{
	document.frmtestimonials.txtName.focus();
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact"  <?php if(!isset($_POST['txtName'])) {?> onLoad="onload();" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_POST['txtName']) )
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
	
	$sql="update cpo_testinomailsmaster set vName='". $name ."',tContent='". $desc ."',vEmailId='".$txtemail."',iStatus=".$status.",dDate='".$sdate[2].$sdate[1].$sdate[0]."',vWebsite='".$website."' where iTestimonailsId = ".$tid;
	$rscheck=runquery1($sql) or die('could not execute'.mysqli_error());
	if($rscheck)
	{
		$msg='Success Story "'.$name.'"  updated successfully.';
		$flg = "green";
	}
	else
	{
		$msg = "Error in update.";
		$flg = "red";
	}		

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
					   <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="addtestinomails.php" class="greendeactfont">Add</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
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
									<a href="./viewtestimonails.php"><img src="./images/go_back.gif" alt="View School" border="0"></a>
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
     <form action="EditTestimonails.php?id=<?php echo $tid;?>" name="frmtestimonials" method="post" onSubmit="return validation();">
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
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addtestinomails.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
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
                                                <td class="toheaderbg" colspan="3">Edit Success Story</td>
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
                  <td width="30%" height="30"class="bodytext">&nbsp;&nbsp;Name 
                    </td>
								<td width="70%" >&nbsp;&nbsp;<input name="txtName" type="text" class="textbox" size="40" value="<?php echo $rslist["vName"]; ?>"><font color="#FF0000">&nbsp;*</font></td>
							</tr>
							<tr>
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  <tr> 
								
                  <td width="30%" height="30" class="bodytext">&nbsp;&nbsp;E-mail Address</td>
								<td width="70%" >&nbsp;&nbsp;<input name="txtEmail" type="text" class="textbox" size="40" value="<?php echo $rslist["vEmailId"]; ?>"><font color="#FF0000">&nbsp;*</font></td>
							  </tr>
							
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
                
							  
							 
							  <tr> 
								
                  <td  class="bodytext">&nbsp;&nbsp;Content  </td>
								<td align=left>&nbsp;&nbsp;<textarea name="txtContent" maxlength =255  rows="3" cols="45"class="textbox"><?php echo ereg_replace('<br />',  '' , $rslist["tContent"]);?></textarea><font color="#FF0000">&nbsp;*</font>
								  </td>
							  </tr align=right class="bodytext">
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  <tr> 
								
                  <td width="30%" height="30" class="bodytext">&nbsp;&nbsp;Website 
                    Address</td>
								<td width="70%" >&nbsp;&nbsp;<input name="txtWebsite" type="text" class="textbox" size="40" value="<?php echo $rslist["vWebsite"]; ?>"><font color="#FF0000">&nbsp;*</font></td>
							  </tr>
							   <td colspan="2" height="2%">&nbsp;</td>
							  <tr> 
							  <tr> 
                  
							</tr>
							  
							  <tr> 
                  <td  width="36%" height="25" class="bodytext">&nbsp;&nbsp;Date 
                    </td>
				  
                  <td width="64%" height="25">&nbsp;&nbsp;<input name="txtstdate" type="text" class="textbox" readonly value="<?php echo $sdate[2]."/".$sdate[1]."/".$sdate[0] ?>">
							  <a href="javascript:pickdate('txtstdate')"><img src="../admin/images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>
                    <font color="red">&nbsp;*</font> </td>
                </tr>
				<tr> 
                  <td  height="28" valign="top" class="bodytext">&nbsp;&nbsp;Active</td>
                  <td align=left valign="top">&nbsp;&nbsp;&nbsp; 
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
								<td width="31%" height="40" class="">&nbsp;</td>
								<td width="69%">
									<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Job" class="mouse">&nbsp;
									<input name="id" type="hidden" value="<?=$rslist["iTestimonailsId"]?>">
									<a href="./viewtestimonails.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>
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
