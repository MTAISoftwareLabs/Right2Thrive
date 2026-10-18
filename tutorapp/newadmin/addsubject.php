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
<title>Add Subject</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function validation()
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
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact">

<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	<?php 
$maxsql="select max(iSubjectId)+1 from cpo_subjectmaster";
$result=runquery1($maxsql) or die('coudl'.mysqli_error());
if($result)
{
	$id=mysqli_fetch_row($result);
	$id=$id[0];
} 

if(isset($_POST['txtSubjectName']))
{
	$Subject_name=$_POST['txtSubjectName'];
	$Subject_desc=addslashes($_POST['txtSubjectDesc']);
	
	$sql="select count(*) from cpo_subjectmaster where vSubjectname='".$Subject_name."'";
	$rIDPass=runquery1($sql);
	$rIDans=mysqli_fetch_row($rIDPass);
	if($rIDans[0]>0)
	{
		$msg="Subject of this name already exists.";
	}
	else
	{
		$userfile_name = $id.".swf";
		$userfile_tmp = $_FILES['userfile']['tmp_name']; 
		$userfile_tmp1 = $_FILES['userfile']['type']; 
	
		if (isset($_FILES['userfile']['name']))  
		{ 
			$prod_img = $filedir.$userfile_name; 
			move_uploaded_file($userfile_tmp, $prod_img); 
		} 
	
		if(isset($_POST['chkactive']))
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
	
		$addsql="insert into cpo_subjectmaster values ('','".$Subject_name."','".$Subject_desc."',".$status.",'')";
		$record=runquery1($addsql) or die("could not execute query".mysqli_error());
		if($record)
		$msg='Subject "'.$Subject_name.'" added successfully.';
		else
		{
		$msg="Error in insert.";			
		$flg = "red";
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
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=subject" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewsubject.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listsubject.php" class="greendeactfont">List</a></td>
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
                            <td class="toheaderbg" colspan="3">Subject Information</td>	
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
																                <td align="center"><div align="right"><a href="addsubject.php"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="overview.php?id=subject"><img src="images/cancel.gif"  border="0"></a> &nbsp;</div></td>
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
<form action="addsubject.php" enctype="multipart/form-data" name="frmsubject" method="post" onSubmit="return validation();">
		<input type="hidden" name="MAX_FILE_SIZE" value="500000000">
	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Subject Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=subject" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewsubject.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listsubject.php" class="greendeactfont">List</a></td>
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
																								
																								
                            <td class="toheaderbg" colspan="3">Add Subject</td>
																								
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
										  								
                          
                      <td width="25%" height="42" class="">&nbsp;&nbsp;Subject 
                        Name</td>
      																	<td width="75%" ><input name="txtSubjectName" type="text" class="textbox" maxlength="70" size="40"> <font color="#FF0000">*</font></td>
    															</tr>
    															<tr> 
                          												
                          
                      <td  height="42" class="">&nbsp;&nbsp;Subject 
                        Description </td>
      																	
                          <td ><textarea name=txtSubjectDesc value="" rows="10" cols="45" class="textbox"></textarea> <font color="#FF0000">*</font> </td>
    															</tr>
																
																<tr> 
										  								
                          
                      <td height="42" class="">&nbsp;&nbsp;File Name</td>
      																	<td ><input name="userfile" type="file"/>
 </td>
    															</tr>
    															
	  					
                      
																
					<tr> 
                  <td align=right class="bodytext"><div align="left">&nbsp; Active</div></td>
                  <td height="22" align=left>&nbsp;&nbsp; <input name="chkactive" type="checkbox" value="1" checked> 
                    <input type="hidden" name="txtcheck" value="1"></td>
                </tr>
				<tr> 
                          												
                          
                      <td> </td>
      																	
                          <td  align="right" style="padding-right:10px; height:50px" valign="middle"><input name="image" type="image" src="images/add.gif" >
                      &nbsp;&nbsp;<a href="overview.php?id=subject"><img src="images/cancel.gif"  border="0"></a></td>
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
