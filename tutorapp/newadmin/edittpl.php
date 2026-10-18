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
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>
<script language="JavaScript">
function deleteope(third,learner)
{
	document.location = "editsubjectintegrateprocess1.php?cid="+course+"&sid="+subject;
}
function validation()
{
	if(document.frmEditSub.cmbsubject.value==0)
	{
		alert("Please Select Subject");
		document.frmEditSub.cmbsubject.focus();
		return false;
	}
	document.frmEditSub.method = "post";
	document.frmEditSub.action = "editsubjectintegrateprocess.php";
	return true;
}

function CheckDup(val)
{
	var selindex = document.frmEditSub.cmbsubject.selectedIndex;
	var selmake = document.frmEditSub.cmbsubject.options[selindex].value;
	for(var j = 0; j<subject.length; j++)
	{
		if (subject[j] == selmake)
		{
			alert("This item already exists");
			for (i=0;i<document.frmEditSub.cmbsubject.options.length;i++)
			{
				//alert(document.frmEditSub.cmbsubject.options[i].value + "/" + val );
				if (document.frmEditSub.cmbsubject.options[i].value == val)
				{
					document.frmEditSub.cmbsubject.options[i].selected = true;
				}
			}
			document.frmEditSub.cmbsubject.focus();
			return false;
		}
	}
}
function win_focus()
{
	//document.frmEditSub.txtdealer.focus();
}
</script>


<?php
	$id = $_GET['id'];
	$tlid = $_GET['tlid'];
	$query = "select * from cpo_thirdpartylearner where iThirdLearnerId = ".$tlid;
	$result = runquery1($query); 
	$num = $result ? mysqli_num_rows($result) : 0;
?>	
<body class="seffect" onLoad="win_focus()">
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b>Third Party - Learner Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=tpl">Overview</a></div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></div></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><font color="#000099"><a class="tablink" href="addtpl.php">Add</a></font></div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Edit 
                / Delete</div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listtpl.php">List</a></div></td>
            <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            <td width="34%" background="images/middle_last.jpg"></td>
          </tr>
        </table></td>
	</tr>
	<tr> 
		<td> 
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
				<tr> 
					<td bgcolor="F5F8FF">&nbsp;</td>
				</tr>
				<tr> 
					<td bgcolor="#FFFFFF">&nbsp;</td>
				</tr>
				<tr> 

					<td bgcolor="#FFFFFF">
						<form name="frmEditSub">
<?php
/*if (!isset($HTTP_SESSION_VARS['username']))
{
	header('location:index.htm');
}*/
?>						
						<table width="65%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
							<tr> 
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr> 
											<td width="3"><img src="./images/round_corner.gif" width="3" height="20"></td>
											
                        <td width="497" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Edit 
                          Third Party-Learner</strong></font></td>
											<td width="500" class="headingtd"><div align="right"><img height=20 src="./images/img_header_gradient.jpg" width=147></div></td>
										</tr>
										<tr> 
											<td height="19" colspan="3" class="bodytext" ><div align="right">( fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
										</tr>
									</table>
								</td>
							</tr>
<?php
	 if($num > 0)
	{
		$rslist = mysqli_fetch_array($result);
		//$cid = $rslist['iCourseID'];
?>
	<!--		<tr> 
                  <td  width="36%" height="25">&nbsp;&nbsp;<b>Dealer Name:</b></td>
                  <td width="64%" height="25"> <input name="txtdealer" type="text" class="textbox" value="<?php echo $rslist["dealer_name"] ?>">
                    <font color="red">&nbsp;*</font> </td>
                </tr> -->
				<tr> 
                  <td  width="36%" height="25">&nbsp;&nbsp;<b>Third Party</b></td>
                  <td width="64%" height="25">
				  <select name="cmbthird" class="textbox" disabled>
				  	<option value=0>Select Third Party</option>				  
				  <?php
//				  $stid=$HTTP_GET_VARS['stateid'];
				  $stqry="select * from cpo_usermaster";
				  $recourse=runquery1($stqry);
				  $num = $recourse ? mysqli_num_rows($recourse) : 0 ;
				if($num > 0)
				{
					while($rslist1 = mysqli_fetch_array($recourse))
					{
					if($rslist1['iUserId']==$tlid){?>
					<option value="<?php echo $rslist1['iUserId'];?>" selected><?php echo $rslist1['vUserName'];?></option>	
					<?php }else{ ?>
					<option value="<?php echo $rslist1['iUserId'];?>"><?php echo $rslist1['vUserName'];?></option>										
					<?php	}
					}
				}
				  ?>
				  </select>
				  <font color="red">&nbsp;*</font> </td>
				</tr>
				<tr> 
                  <td  width="36%" height="25">&nbsp;&nbsp;<b>Learner</b></td>
                  <td width="64%" height="25">
			  
  				  <select name="cmbsubject" class="textbox" onChange="CheckDup(<?php echo $id;?>)">
				  <option value=0>Select Learner</option>
				  <?php
//				   $ctid=$HTTP_GET_VARS['cityid'];
				  $stqry="select * from cpo_usermaster";
				  $resubject=runquery1($stqry);
				  $num = $resubject ? mysqli_num_rows($resubject) : 0 ;
				if($num > 0)
				{
					while($rslist1 = mysqli_fetch_array($resubject))
					{
					if($rslist1['iUserId']==$id){?>
					<option value="<?php echo $rslist1['iUserId'];?>" selected><?php echo $rslist1['vUserName'];?></option>	
					<?php }else{ ?>
					<option value="<?php echo $rslist1['iUserId'];?>"><?php echo $rslist1['vUserName'];?></option>										
					<?php	}
					}
				}
				  ?>
				  </select>
                    <font color="red">&nbsp;*</font> </td>
                </tr>
				<tr><td colspan="2">&nbsp;</td></tr>
							<tr> 
								<td width="31%" height="40" class="">&nbsp;</td>
								<td width="69%">
								<input name="thridid" value="<?php echo $tlid; ?>" type="hidden">
								<input name="learnerid" value="<?php echo $id;?>" type="hidden">								
									<input type="image" name="imgupdategenre" src="./images/update.gif" alt="Update Learner Integrate" onClick="return validation()" class="mouse">
									<img name="imgdelete" src="./images/delete1.gif" alt="Delete Learner" onClick="return deleteope(<?php echo $tlid; ?>,<?php echo $id;?>)" style="cursor:hand">									
									<a href="./viewtpl.php"><img src="./images/cancel.gif" border="0"></a>
								</td>
							</tr>
<?php 
		}
		else
		{
?>
			<tr>
				<td colspan="2" align="center" class="error"><?php echo "No Record Found";}?></td>
			</tr>
						</table>
						</form>
					</td>

				</tr>
				<tr> 
					<td bgcolor="#FFFFFF">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</body>
</html>
