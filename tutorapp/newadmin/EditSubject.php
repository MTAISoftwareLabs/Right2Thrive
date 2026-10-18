<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
$subjectid = $_GET['id'];
$query = "select * from cpo_subjectmaster where iSubjectId = ".$subjectid."";
$result = runquery1($query) or die('could note execute'.mysqli_error());
$rslist = mysqli_fetch_array($result);
?>
<html>
<head>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>
<script language="JavaScript" src="./txteditor.js"></script>
<script language="JavaScript">
function validation(aid)
{
	if(document.frmsubject.txtSubjectName.value=="")
	{
		alert("Subject Name can not be blank!");
		document.frmsubject.txtSubjectName.focus();
		return false;
	}
	if(document.frmsubject.txtSubjectDesc.value=="")
	{
		alert("Subject Description can not be blank!");
		document.frmsubject.txtSubjectDesc.focus();
		return false;
	}
	
			
	return true;
}

function win_focus()
{
	document.frmsubject.txtSubjectName.focus();
}
</script>

<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_POST['txtSubjectName'])) {?> onLoad="win_focus()" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top"><?php 

if(isset($_POST['txtSubjectName']))
{
		$Subject_id=$_POST['id'];
		$Subject_name=ereg_replace("'","''",$_POST['txtSubjectName']);
        $Subject_desc=ereg_replace("'","''",$_POST['txtSubjectDesc']);
		$New_file=$_FILES['txtNewFileName']['name'];
		$flag=true;
		if(isset($_POST['chkactive']))
		{
			$active=1;
		}
		else
		{
			$active=0;
		}				
		if($New_file =='')
		{
				$sql="update cpo_subjectmaster set vSubjectName='".$Subject_name."',tSubjectDesc='".$Subject_desc."',iStatus='".$active."' where iSubjectId=".$subjectid;
				$rscheck=runquery1($sql);
				$flg="green";
				$msg="Subject  '".$Subject_name."' successfully edited.";
				
		}
		else
		{
				$filedir = './flash/'; 
    	    	$userfile_name = $Subject_id.".swf";
			
       			$userfile_tmp = $_FILES['txtNewFileName']['tmp_name']; 
				$userfile_tmp1 = $_FILES['txtNewFileName']['type']; 
														
				if($userfile_tmp1=="application/x-shockwave-flash")
				{
			
		        $prod_img = $filedir.$userfile_name; 
         		move_uploaded_file($userfile_tmp, $prod_img); 
				 
								
				$sql="update cpo_subjectmaster set vSubjectName='". $Subject_name ."',tSubjectDesc='".$Subject_desc."',iStatus='".$active."' where iSubjectId=".$subjectid;
				$rscheck=runquery1($sql) or die('could not'.mysqli_error());
				$flg="green";
				$msg="Subject  '".$Subject_name."'   successfully edited.";
				}
				else
				{
					$flg="green";
					$msg="Unable to add subject,please upload flash file only.";
				}
		}

			?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Subject Admin</td>
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
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=subject" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
					   <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listsubject.php" class="greendeactfont">Add</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listsubject.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3">Subject Information</td>
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
									  <?php }else
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
                                        <td align="center"><div align="right"><a href="./viewsubject.php"><img src="./images/go_back.gif" alt="Edit Course" border="0"></a> &nbsp;</div></td>
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
     <form name="frmsubject" enctype="multipart/form-data" method="post" onSubmit="return validation(<?php echo $rslist["iSubjectId"]; ?>);">
						<input type="hidden" name="MAX_FILE_SIZE" value="500000000">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Subject Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=subject" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addsubject.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listsubject.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Edit Subject </td>
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
                  <td width="25%" height="30" class="">&nbsp;&nbsp;Subject Name 
                    </td>
								<td width="75%" >&nbsp;&nbsp;<input name="txtSubjectName" type="text" class="textbox" size="40" value="<?php echo $rslist["vSubjectName"]; ?>"><font color="#FF0000">&nbsp; *</font></td>
							</tr>
							<tr>
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  <tr> 
								
                  <td  >&nbsp;&nbsp;New Subject Description</td>
								<td align=left>&nbsp;&nbsp;<textarea name="txtSubjectDesc"  rows="10" cols="45"class="textbox"><?php echo ereg_replace('<br />',  '' , $rslist["tSubjectDesc"]);?></textarea><font color="#FF0000">&nbsp;*</font>
								  </td>
							  </tr>
							  <tr> 
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							<tr> 
                  <td width="25%" height="30" class="">&nbsp;&nbsp;File Name 
                    </td>
								
                  <td width="75%" >&nbsp;&nbsp;<a href="javascript:previewflash('<?php echo $rslist["iSubjectId"];?>')"><img border="0" src="images/preview.gif"  style='cursor:hand'></a></td>
							</tr>  	
									  								
                          <tr>
						  	<td colspan="2" height="2%">&nbsp;</td>
							</tr>
                      
                  <tr><td width="25%" height="42" class="">&nbsp;&nbsp;Edit File </td>
      																						
                  <td width="75%" > 
                    &nbsp;&nbsp;<input name="txtNewFileName" type="file"/>
 <font color="#FF0000">&nbsp;*</font></td>
    															</tr>
							
							 
							  <td colspan="2" height="2%">&nbsp;</td>
							  <tr> 
                  <td height="28" class="bodytext">&nbsp;&nbsp;Active</td>
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
								<td width="25%" height="40" class="">&nbsp;</td>
								<td width="75%">
									<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Course"  class="mouse">&nbsp;
									<input name="id" type="hidden" value="<?=$rslist["iCourseId"]?>">
									<a href="./viewsubject.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>
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
