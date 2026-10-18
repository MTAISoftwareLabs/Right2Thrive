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
?>
<html>
<head>
<title>Upload Time Table</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function validation()
{
	if (document.frm.TXFILE.value == "")
	{
		alert("First select file !")
		return false;
	}
	document.frm.submit();
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact">
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_GET['next']))
{
if ($_FILES['TXFILE']['type'] == "application/msword")
{
	move_uploaded_file($_FILES['TXFILE']['tmp_name'],"../Course_Timetable.doc");
	$upload = "File Uploaded Successfully !";	
}
else
{
	$flg = 'red';
	$upload = "Please Upload Only .documents file Only !";
}		
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Upload Time Table Admin</td>
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
                     <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
					<td width="25%" align="center" class="midtabgreen">Remove Course</td>
					<td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
					 <td width="0%" align="right"></td>
					<td width="25%" align="center" ></td>
					<td width="0%" align="left"></td>
					<td width="0%" align="right"></td>
					<td width="25%" align="center" ></td>
					<td width="0%" align="left"></td>
					<td width="0%" align="right"></td>
					<td width="25%" align="center" ></td>
					<td width="0%" align="left"></td>
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
                                              <td class="toheaderbg" colspan="3">Upload Time Table Information</td>
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
										<td align="center"><font class="comment"><b><?php echo $msg ?></b></font> </td>
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
                                        <td align="center"><div align="right"><a href="timetable.php"><img src="images/go_back.gif"  border="0"></a> &nbsp;</div></td>
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
  <form name="frm" action="timetable.php?next=yes" method="post" enctype="multipart/form-data">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Upload Time Table Admin</td>
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
                         <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
						<td width="25%" align="center" class="midtabgreen">Upload Time Table</td>
						<td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"></td>
                        <td width="25%" align="center"></td>
                        <td width="0%" align="left"></td>
                        <td width="0%" align="right"></td>
                        <td width="25%" align="center"></td>
                        <td width="0%" align="left"></td>
                        <td width="0%" align="right"></td>
                        <td width="25%" align="center" ></td>
                        <td width="0%" align="left"></td>
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
                                                <td class="toheaderbg" colspan="3">Upload Time Table</td>
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
                  <td  width="36%" height="25">&nbsp;&nbsp;Upload File</td>
                  <td width="64%" height="25" > <input type="file" name="TXFILE" class="textbox"> 
                    <font color="red">&nbsp;*</font>&nbsp;<img style="cursor:hand" src="images/upload.gif" onClick="validation()" align="absmiddle"> </td>
                </tr>
							  <tr> 
								<td height="15">&nbsp;</td>
								<td><font color="red">Only .doc file allowed.</font></td>
								</tr>
								<tr><td></td></tr>
								
									
								
										
											    															
    						<tr><td colspan="2">&nbsp;</td></tr>															
	  					
							<tr bgcolor="#FFFFFF"> 																	
								  <td class="toheaderbg2" colspan="5"  >&nbsp;</td>
							</tr> 
							<tr > 																	
								  <td class="toheaderbg1" colspan="5" height="1" ></td>
							</tr>
							 <tr bgcolor="#FFFFFF"> 																	
								  <td class="toheaderbg2" colspan="5" height="10"  >&nbsp;</td>
							</tr> 		
										
								
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
							<tr>
                              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                  <tr>
                                    <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                        <tr>
                                          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td class="toheaderbg" colspan="3">Current 
                        Time Table File</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                  </tr>
                                  <tr>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        <tr><td height="15"></td></tr>
										<tr> 
										 <?php $path = "../Course_Timetable.doc"; ?>
										<td  width="85%" height="25" align="center">&nbsp;Click Preview to Download/Preview the Current Time Table File &nbsp;<a href="<?php echo $path?>" title="Upload File"><img border="0" src="images/preview.gif" align="absmiddle"></a></td>
										</tr>	
										 <tr><td height="15"></td></tr>	
										
								
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
