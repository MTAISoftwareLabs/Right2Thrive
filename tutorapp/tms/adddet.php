<?php
include_once 'dbConnection.php';

if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}


?>
<html>
<head>
<title><?php echo sitename;?>Lesson Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function win_load()
{
document.frm_det.cmbstudent.focus();
}
function validation()
{
var frm = document.frm_det;
	var count =0;
	for(var i=0; i<document.frm_det.length; i++)	
	{
			if(document.frm_det[i].checked == true && document.frm_det[i].type == 'radio')
		{									
			count = count + 1;
		}
		
	}
	if(count == 0)
	{
		alert("Please select Detention or Exclusion!");
		return false;
	}
	var d = new Date();	
	date = d.getDate();
	month = d.getMonth()+1;
	year = d.getFullYear();

	for(var i=0; i <10; i++)
	{		
		if(month == i)
		{
			month = "0"+month;	
		}
		if(date == i)
		{
			date = "0"+date;	
		}
	}

	var today = year+month+date;
	var temp = document.frm_det.txtddate.value.split('/');
	var ldate = temp[2]+temp[1]+temp[0];
	if(document.frm_det.cmbstudent.value=="")
	{
		alert("Learner must be selected!");
		document.frm_det.cmbstudent.focus();
		return false;
	}
	if(today > ldate)
	{
		alert("Detention date must be greater than or equal to current date.");
		 document.frm_det.txtddate.focus();
		return false;
	}
	if(document.frm_det.txtreason.value=="")
	{
		alert("Detention reason cannot be blank!");
		document.frm_det.txtreason.focus();
		return false;
	}	
	
	return true;
}
function select_page(val)
{
	document.frm_det.action='adddet.php?type='+val;
	document.frm_det.submit();
	
}

function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frm_det'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
}


</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0"  <?php if(!isset($_GET['next']) && isset($_GET['type'])){?>onLoad="win_load()"<?php } ?>>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc">
      <?php include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="frm_det" method="post" action="adddet.php?next=1" onSubmit="return validation();">
			<?php
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome"><b>Add Detention/Exclusion</b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong><a href="viewdet.php" class="welcome">View Detention/Exclusion</a>&nbsp;&nbsp;::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td height="10" colspan="2" class="bodytext" align="right">All (<font color="red">*</font>) mark are compulsory fields</td>
						</tr>
							<tr>
								
											<td width="41%" height="30" class="bodytext" colspan="2" align="center"><input type="radio" name="rad_d" value="D" <?php if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'D'){?> checked="checked"<?php } else {?> checked="checked" <?php } ?> onClick="select_page(this.value)"> Detention &nbsp;<input type="radio" name="rad_d" value="E" onClick="select_page(this.value)" <?php if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'E'){?> checked="checked"<?php } ?>> Exclusion</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<?php  if(isset($_REQUEST['type']) || !isset($_REQUEST['type']))
										{ 
										
										 if(isset($_REQUEST['type']) )
										 {
										 	 $type = $_REQUEST['type'];
										 	if ($type =='E'){ $t = 'Exclusion';}else{$t = 'Detention';}
										 }
										 else
										 {
										 	 $type = 'D';
											 $t = 'Detention';
										 }
										
										?>
									
						<tr>
							<td colspan="2">
							<div id="show_add" >
							<table width="100%">
				<tr>
								<td class="bodytext" height="32">Select Learner </td>
								<td class="bodytext"><?php
 $sqls = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us.I_studentid  =sb.iUserId  and us.I_tutorid  =".$_SESSION['user_id'];
$querys = runquery1($sqls);
while($rows = mysqli_fetch_array($querys))
{
	$option .='	<option value='.$rows['I_studentid'].'>'.$rows['vUserName'].'</option>';
}

					?><select name="cmbstudent" class="textbox" >
                                                                        <option value="">Select Learner</option>
                   <?php echo $option;?></select>&nbsp;<font color="red">*</font> </td>
				</tr>
				<tr>
								<td class="bodytext" height="32"><?php echo $t;?> Date</td>
								<td class="bodytext"><input name="txtddate" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">
												&nbsp;<a href="javascript:pickdate('txtddate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a> <font color="#FF0000">*</font> </td>
				</tr>
				<tr>
								<td width="41%" height="30" class="bodytext">Reason of <?php echo $t;?> </td>
								<td width="59%"><input type="text" name="txtreason" maxlength="100" size="40" class="textbox" >
												&nbsp;<font color="red">*</font> </td>
				</tr>
				<tr>
								<td width="41%" height="30" class="bodytext">What do learner need to improve?</td>
									<td width="59%"><textarea name="taimprove"  class="textbox" cols="30"></textarea></td>
				</tr>
				<tr>
								<td width="41%" height="30" class="bodytext">Tutor Comments</td>
								<td width="59%"><textarea name="tutorcomment" class="textbox" cols="30" ></textarea></td>
				</tr>
				<tr>
								<td colspan="2">&nbsp;</td>
				</tr>
</table>
<input type="hidden" name="hdn_type" value="<?php echo $type;?>"> 
							</div>
							</td>
						</tr>
						<?php } ?>
					</table>
				</td>
              </tr>
              <tr> <input type="hidden" name="hdn_submit" value="1">
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?php
			  }
	 if(isset($_GET['next']) &&  isset($_POST['hdn_submit']))
{

	$student_name = $_POST['cmbstudent'];
	$tutor_name = $_SESSION['user_id'];
	$deten_date = $_POST['txtddate'];
	$reason = $_POST['txtreason'];
	$improve = $_POST['taimprove'];
	$tcmt = $_POST['tutorcomment'];
	$typ = $_POST['rad_d'];
	if($typ == 'E')
	{$rr = 'Exclusion' ;}
	else
	{ $rr = 'Detention' ;}
	
	$sdate=explode("/",$deten_date);
	
	$date = $sdate[2]."-".$sdate[1]."-".$sdate[0];	
	
	//check for duplicate
	 $select = " SELECT I_userid, i_tutorid, D_detention FROM cpo_detention where I_userid='".$student_name."' and i_tutorid='".$tutor_name."' and D_detention='".$date."' and C_flag ='".$typ."'";
	 $record=runquery1($select);
	 $num = mysqli_num_rows($record);
	 
	 if($num >0)
	 {
		 $msg= $rr." Already Exists!";
		 $flg = "red";
	}
	else
	{
	  $addsql = "INSERT INTO cpo_detention (I_userid, i_tutorid, D_detention, V_reason, T_improve,T_tcomments,  C_flag) values ('".$student_name."','".$tutor_name."','".$date."','".$reason."','".$improve."','".$tcmt."','".$typ."') ";
	
	$record=runquery1($addsql) or die("could not execute query".mysqli_error());
	if($record)
	$msg=$rr." Added Successfully";
	else
	$msg="Error in Insert";	}
					?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tr> 
                        <td class="welcome"><b>Add Detention/Exclusion</b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong><a href="viewdet.php" class="welcome">View Detention/Exclusion</a>&nbsp;&nbsp;::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<?php echo $color;?>"><b><?php echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='./'"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>					
	           <?php }
			  ?>
			
			</form></td>
        </tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <?php include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
