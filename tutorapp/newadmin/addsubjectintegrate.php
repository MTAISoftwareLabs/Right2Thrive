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
<title>Add Subject - Course</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">

<script language="JavaScript">
function validation()
{
	if(document.frmsubjectintegrate.txtCourseId.value=="-")
	{
		alert("Please Select Course Name");
		document.frmsubjectintegrate.txtCourseId.focus();
		return false;
	}
/*	if(document.frmsubjectintegrate.txtSubjectId[].options.length == 0)
	{
		alert("Please Select Subject!");
		document.frmsubjectintegrate.txtSubjectId.focus();
		return false;
	}*/
	
	
	return true;
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
if(isset($_POST['txtCourseId']))
{
		$Subject_id = "";	
		foreach($_POST['txtSubjectId'] as $value)
		{
			$Subject_id.= $value. ",";
		}
		$Subject_id = substr($Subject_id,0,strlen($Subject_id)-1);
		if ($Subject_id <> "-")
		{
			$Course_id=$_POST['txtCourseId'];
				
			 $selectdata="select vSubjectID,iCourseID from cpo_subjectincourse where iCourseID=".$Course_id."";
			 $result=runquery1($selectdata);
			 $count= $result ? mysqli_num_rows($result) : 0 ;
			 if($count==1)
			 {
					$Subject_id = "";	
					$id1=mysqli_result($result,0,0);
					$tutorcourseid=mysqli_result($result,0,1);
					$id=explode(",", $id1);
					$Subject_id = $id1.",";
					$change = 0;
					foreach($_POST['txtSubjectId'] as $value)
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
							$Subject_id = $Subject_id . $value .",";		
							$change = 1;
						}
					}
					$Subject_id = substr($Subject_id,0,strlen($Subject_id)-1);
					if($change == 0)
						$msg="Record already exist.";
					else
					{
						$sql="update cpo_subjectincourse set vSubjectID = '". $Subject_id ."' where iCourseID=".$Course_id;
						runquery1($sql);
						$msg="Record updated successfully.";
					}
				}
				else
				{
					$addsql="insert into cpo_subjectincourse (vSubjectID,iCourseID)  values ('".$Subject_id."',".$Course_id.")";
					$record=runquery1($addsql);
					$msg="Subject integrated to course successfully.";
				}
			}
			else
			{
				$msg="First select subjects.";
			}	?>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Subject - Course Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=subjectincourse" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewsubjectintegrate.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listsubjectintegrate.php" class="greendeactfont">List</a></td>
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
                            <td class="toheaderbg" colspan="3">Subject - Course Information</td>	
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
																                <td align="center"><div align="right"><a href="addsubjectintegrate.php"><img src="images/add_new.gif"border="0"></a>&nbsp;<a href="overview.php?id=subjectincourse"><img src="images/cancel.gif"  border="0"></a> &nbsp;</div></td>
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
<form action="addsubjectintegrate.php" name="frmsubjectintegrate" method="post" onSubmit="return validation();">
		<input type="hidden" name="MAX_FILE_SIZE" value="500000000">
	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Subject - Course Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=subjectincourse" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewsubjectintegrate.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listsubjectintegrate.php" class="greendeactfont">List</a></td>
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
																								
																								
                            <td class="toheaderbg" colspan="3">Add Subject - Course</td>
																								
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
										  								
                          
                      <td width="25%" height="42" class="">&nbsp;&nbsp;Select 
                        Course </td>
      					<td width="75%" ><select name="txtCourseId">
							<option value="-">Select Course </option>
					
					<?php
						   $fetch="select * from cpo_coursemaster where iStatus=1";
							$result=runquery1($fetch);
							$count= $result ? mysqli_num_rows($result) : 0 ;
							
							while($row=mysqli_fetch_array($result))
							{
							?>
								<option value="<?php echo $row["iCourseId"];?>"><?php echo $row["vCourseName"];?></option>
        	              	<?php
							}
							?>
                    		</select> <font color="#FF0000">*</font></td>
    															</tr>
    															<tr> 
                          												
                          
                      <td  class="">&nbsp;&nbsp;Select 
                        Subject </td></tr>
      																	
                       <tr>   
                      <td  ></td><td> <font color="#FF0000">
					  <select name=txtSubjectId[] multiple>
					  <option value="-" selected>Select Subjects</option>
					<?php
						   $fetch="select * from cpo_subjectmaster where iStatus=1";
							$result=runquery1($fetch);
							$count= $result ? mysqli_num_rows($result) : 0;
							
							while($row=mysqli_fetch_array($result))
							{
						?>
							<option value="<?php echo $row["iSubjectId"]?>"><?php echo $row["vSubjectName"];?></option>
                      	<?php
						}
						?>
                    </select>*</font> </td>
							</tr>
	  					
                      
																
					<tr> 
                  <td align=right class="bodytext"><div align="left">&nbsp; Active</div></td>
                  <td height="22" align=left>&nbsp;&nbsp; <input name="chkactive" type="checkbox" value="1" checked> 
                    <input type="hidden" name="txtcheck" value="1"></td>
                </tr>
				<tr> 
                          												
                          
                      <td> </td>
      																	
                          <td style="height:50px; padding-right:10px" align="right" valign="middle"><input type="image" src="images/add.gif" border="0" alt="Add">&nbsp;&nbsp;<a href="overview.php?id=subjectincourse"><img src="images/cancel.gif"  border="0"></a></td>
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
