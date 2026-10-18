<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';

if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} ?>
<html>
<head>
<title>Add Job</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="./calendar1.js"></script> 
<script language="JavaScript">
function validation()
{
	if(document.frmjob.txtJobName.value=="")
	{
		alert("Job Title can not be blank!");
		document.frmjob.txtJobName.focus();
		return false;
	}
	if(document.frmjob.txtJobDesc.value=="")
	{
		alert("Job Description can not be blank!");
		document.frmjob.txtJobDesc.focus();
		return false;
	}
	if(document.frmjob.txtLocation.value=="")
	{
		alert("Job Location can not be blank!");
		document.frmjob.txtLocation.focus();
		return false;
	}
	
	if(document.frmjob.txtContactAdd.value=="")
	{
		alert("Contact Address can not be blank!");
		document.frmjob.txtContactAdd.focus();
		return false;
	}
	
	if(document.frmjob.txtEmail.value=="")
	{
		alert("Please Enter E-mail Address");
		document.frmjob.txtEmail.focus();
		return false;
	}
	else
	{
		var x = document.frmjob.txtEmail.value;
		var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/;  
		if (!filter.test(x))
		{
				alert("Enter a valid E-mail Address");
				document.frmjob.txtEmail.value="";
				document.frmjob.txtEmail.focus();
			return false;
		}
	}
	if(document.frmjob.txtPerson.value=="")
	{
		alert("Contact Person can not be blank!");
		document.frmjob.txtPerson.focus();
		return false;
	}
	if(document.frmjob.txtPhone.value=="")
	{
		alert("Contact Phone can not be blank!");
		document.frmjob.txtPhone.focus();
		return false;
	}
	if(document.frmjob.txtCategoryId.value=="-")
	{
		alert("Please Select Category");
		document.frmjob.txtCategoryId.focus();
		return false;
	}
	if(document.frmjob.txtInstituteId.value=="-")
	{
		alert("Please Select Institute");
		document.frmjob.txtInstituteId.focus();
		return false;
	}
	return true;
}

function win_onload()
{
document.frmjob.txtJobName.focus();
}

function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frmjob'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	//mydatetime.MX = obj.x;
	//mydatetime.MY = obj.y;	
	mydatetime.popup();
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
if(isset($_POST['addjob_x']))
{
	$Job_name=$_POST['txtJobName'];
	$Job_desc=addslashes($_POST['txtJobDesc']);
	$Job_locat=addslashes($_POST['txtLocation']);
	$Job_contact=addslashes($_POST['txtContactAdd']);
	$Job_category=$_POST['txtCategoryId'];
	$Job_Institute=$_POST['txtInstituteId'];
	$txtstdate=$_POST['txtstdate'];
	$txtemail=$_POST['txtEmail'];
	$txtperson=$_POST['txtPerson'];
	$txtphone=$_POST['txtPhone'];
	
	$sdate=explode("/",$txtstdate);
	if(isset($_POST['chkactive']))
	{
		$status=1;
	}
	else
	{
		$status=0;
	}
				         
	 $addsql="insert into cpo_jobmaster () values ('','".$Job_name."','".$Job_desc."','".$Job_locat."','".$Job_category."','$sdate[2].$sdate[1].$sdate[0]',".$status.",'".$Job_contact."','".$txtperson."','".$txtphone."','".$Job_Institute."','".$txtemail."')";
  
	 $record=runquery1($addsql);
	$msg="Job   ".$Job_name."  added successfully.";
?>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Job Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=job" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewjob.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listjob.php" class="greendeactfont">List</a></td>
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
                            <td class="toheaderbg" colspan="3">Job Information</td>	
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
																                <td align="center"><div align="right"><a href="addjob.php"><img src="images/add_new.gif" border="0"></a>&nbsp;<a href="overview.php?id=job"><img src="images/cancel.gif" border="0"></a> &nbsp;</div></td>
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
		<form action="addjob.php" name="frmjob" method="post" onSubmit="return validation();">
	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Job Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=job" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewjob.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listjob.php" class="greendeactfont">List</a></td>
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
																								
																								
                            <td class="toheaderbg" colspan="3">Add Job </td>
																								
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


<td width="25%" height="42" class="">&nbsp;&nbsp;Job Title</td>
<td width="75%" ><input name="txtJobName" type="text" class="textbox" size="45" maxlength="70"> <font color="#FF0000">*</font></td>
</tr>
<tr> 


<td class=""  height="42">&nbsp;&nbsp;Job Description</td>

<td  height="50"><textarea name=txtJobDesc value="" rows="3" cols="44" class="textbox"></textarea> <font color="#FF0000">*</font> </td>
</tr>
<tr>
  <td  class=""  height="42">Location</td>
  <td   height="50" ><select name="txtLocation" id="txtLocation">
  <option value="">- Select -</option>
  <option value="City of London">City of London</option>
  <option value="London Borough of Barking and Dagenham">London Borough of Barking and Dagenham</option>
  <option value="London Borough of Barnet">London Borough of Barnet</option>
  <option value="London Borough of Bexley">London Borough of Bexley</option>
  <option value="London Borough of Brent">London Borough of Brent</option>
  <option value="London Borough of Bromley">London Borough of Bromley</option>
  <option value="London Borough of Camden">London Borough of Camden</option>
  <option value="London Borough of Croydon">London Borough of Croydon</option>
  <option value="London Borough of Ealing">London Borough of Ealing</option>
  <option value="London Borough of Enfield">London Borough of Enfield</option>
  <option value="London Borough of Greenwich">London Borough of Greenwich</option>
  <option value="London Borough of Hackney">London Borough of Hackney</option>
  <option value="London Borough of Hammersmith & Fulham">London Borough of Hammersmith & Fulham</option>
  <option value="London Borough of Haringey">London Borough of Haringey</option>
  <option value="London Borough of Harrow">London Borough of Harrow</option>
  <option value="London Borough of Havering">London Borough of Havering</option>
  <option value="London Borough of Hillingdon">London Borough of Hillingdon</option>
  <option value="London Borough of Hounslow">London Borough of Hounslow</option>
  <option value="London Borough of Islington">London Borough of Islington</option>
  <option value="Royal Borough of Kensington & Chelsea">Royal Borough of Kensington & Chelsea</option>
  <option value="Royal Borough of Kingston upon Thames">Royal Borough of Kingston upon Thames</option>
  <option value="London Borough of Lambeth">London Borough of Lambeth</option>
  <option value="London Borough of Lewisham">London Borough of Lewisham</option>
  <option value="London borough of Merton">London borough of Merton</option>
  <option value="London Borough of Newham">London Borough of Newham</option>
  <option value="London Borough of Redbridge">London Borough of Redbridge</option>
  <option value="London Borough of Richmond upon Thames">London Borough of Richmond upon Thames</option>
  <option value="London Borough of Southwark">London Borough of Southwark</option>
  <option value="London Borough of Sutton">London Borough of Sutton</option>
  <option value="London Borough of Tower Hamlets">London Borough of Tower Hamlets</option>
  <option value="London Borough of Waltham Forest">London Borough of Waltham Forest</option>
  <option value="London Borough of Wandsworth">London Borough of Wandsworth</option>
  <option value="City of Westminster">City of Westminster</option>
  
  </select>
    <font color="#FF0000">*</font></td>
</tr>
<tr> 


<td  class=""  height="42">&nbsp;&nbsp;Contact 
Address </td>

<td   height="50" ><textarea name=txtContactAdd value="" rows="3" cols="44" class="textbox"></textarea> <font color="#FF0000">*</font> </td>
</tr>
<tr> 


<td  class=""  height="42">&nbsp;&nbsp;E-mail Address</td>
<td  ><input name="txtEmail" type="text" class="textbox" size="40" maxlength="70"> <font color="#FF0000">*</font></td>
</tr>
<tr> 


<td  class=""  height="42">&nbsp;&nbsp;Contact 
Person </td>
<td  ><input name="txtPerson" type="text" class="textbox" size="40" maxlength="70"> <font color="#FF0000">*</font></td>
</tr>
<tr> 


<td  class=""  height="42">&nbsp; Contact Phone</td>
<td  ><input name="txtPhone" type="text" class="textbox" size="40" maxlength="70"> <font color="#FF0000">*</font></td>
</tr>
<tr> 
<td >&nbsp; Validate Date :</td>
<td width="64%" height="42"><input name="txtstdate" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">
<a href="javascript:pickdate('txtstdate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>
<font color="red">&nbsp;*</font> </td>
</tr>


<tr> 


<td  class=""  height="42">&nbsp; Job&nbsp;Category</td>

<td  ><select name="txtCategoryId" class="textbox">
<option value="-">Select Category</option>

<?php
$fetch="select * from cpo_categorymaster where iStatus=1";
$result=runquery1($fetch);
$count= $result ? mysqli_num_rows($result) : 0 ;

while($row=mysqli_fetch_array($result))
{
?>
<option value="<?php echo $row["iCategoryId"];?>"><?php echo $row["vCategoryName"];?></option>
<?php
}
?>
</select>
<font color="#FF0000">*</font> </td>
</tr>
<tr> 


<td  class=""  height="42">&nbsp; Instittute</td>

<td  ><select name="txtInstituteId" class="textbox">
<option value="-">Select Institute</option>

<?php
$fetch="select * from cpo_institutemaster where iStatus=1";
$result=runquery1($fetch);
$count= $result ? mysqli_num_rows($result) : 0 ;

while($row=mysqli_fetch_array($result))
{
?>
<option value="<?php echo $row["iInstituteId"];?>"><?php echo $row["vInstituteName"];?></option>
<?php
}
?>
</select>
<font color="#FF0000">*</font> </td>
</tr>

<tr> 
<td align=right ><div align="left">&nbsp; Active</div></td>
<td height="22" align=left>&nbsp;&nbsp; <input name="chkactive" type="checkbox" value="1" checked> 
<input type="hidden" name="txtcheck" value="1"></td>
</tr>
				<tr> 
                          												
                          
                      <td> </td>
      																	
                          <td style="height:50px;" valign="middle"><input name="addjob" id="addjob" type="image" src="images/add.gif" >
                      &nbsp;&nbsp;<a href="overview.php?id=course"><img src="images/cancel.gif" border="0"></a></td>
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
