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
document.frmreport.cmbsubject.focus();
}
function validation()
{
	
	if(document.frmreport.cmbsubject.value=="")
	{
		alert("Subject must be selected!");
		document.frmreport.cmbsubject.focus();
		return false;
	}
	if(document.frmreport.cmbstudent.value=="")
	{
		alert("Learner must be selected!");
		document.frmreport.cmbstudent.focus();
		return false;
	}
	if(document.frmreport.selyear.value=="")
	{
		alert("Year must be selected!");
		document.frmreport.selyear.focus();
		return false;
	}
	if(document.frmreport.selmonth.value=="")
	{
		alert("Month must be selected!");
		document.frmreport.selmonth.focus();
		return false;
	}
	return true;
}
function get_learner(id)
{

	var xmlHttp;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	if(id !='')
	{
		var query = "getlearner.php?id="+id;
	}
	else
	{
		document.getElementById('id_learner').style.display='none';
		return false;
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			var number1 = xmlHttp.responseText;
			document.getElementById('id_learner').innerHTML= number1;
			document.getElementById('id_learner').style.display='block';
			
		}
	}
	xmlHttp.open("GET",query,true);
	xmlHttp.send(null);
}


</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0"  <?php if(!isset($_GET['next'])){?>onLoad="win_load()"<?php } ?>>
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
          <td><form name="frmreport" method="post" action="addreport.php?next=1" onSubmit="return validation();">
			<?php
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome"><b>Add Monthly Progress Report</b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong><a href="viewreport.php" class="welcome">View Report</a>&nbsp;&nbsp;::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
					<tr><td height="10" colspan="2" class="bodytext" align="right">All (<font color="red">*</font>) mark are compulsory fields</td></tr>
					<tr>
							<td class="bodytext" height="32">Select Subject </td>
							<td class="bodytext">
							<?php
						$sqls = "select us.I_user_subid ,us.I_subjectid , sb.vSubjectName  from cpo_user_subject as  us, cpo_subjectmaster  as sb where  sb.iSubjectId =us.I_subjectid and us.I_tutorid  =".$_SESSION['user_id']." group by us.I_subjectid";
					$querys = runquery1($sqls);
					?><select name="cmbsubject" class="textbox" onChange="get_learner(this.value)">
                                                                        <option value="">Select Subject</option>
                   
					<?php while($rows = mysqli_fetch_array($querys))
					{								
					?>
				<option value="<?php=$rows['I_subjectid']?>"><?php=$rows['vSubjectName']?></option>
				<?php }?>
                                                                    </select>&nbsp;<font color="red">*</font></td>
						</tr>
						<?php
						?>
						<tr><td colspan="2"><div id="id_learner" style="display:block" ></div></td></tr>
						<tr>
							<td width="41%" height="30" class="bodytext">Select Year and Month </td>
							<td width="59%">
			<select name="selmonth" class="textbox" >
			<option value="">Month</option>
			<?php 
			for ($m=1;$m<13;$m++){
			if($m<10)
			$m = "0".$m;
			
			?>
						<option value="<?php echo $m;?>"><?php echo $m;?></option>
						<?php }?>		
			</select> &nbsp;<select name="selyear" class="textbox">
			<option value="">Year</option>
			<?php 
					$yr = date('Y')-100;
					$year = date('Y')+1;
					for ($year;$year>$yr;$year--){
					?>
						<option value="<?php echo $year;?>" ><?php echo $year;?></option>
						<?php }?>
			</select>&nbsp;<font color="red">*</font></td>
						</tr>
						<tr>
							
                        <td width="41%" height="30" class="bodytext">Tutor Comments</td>
							<td width="59%"><textarea name="tadesc" ></textarea></td>
						</tr>
						
						<tr><td colspan="2">&nbsp;</td></tr>
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
	$subject = $_POST['cmbsubject'];
	$year = $_POST['selyear'];
	$month = $_POST['selmonth'];
	$tutor_cmt = $_POST['tadesc'];
	
	$sql = "select I_userid from cpo_progressreport  where I_userid=".$student_name." and  I_tutorid=".$tutor_name." and  I_subjectId =".$subject." and I_month=".$month." and I_year=".$year;
	$exists=runquery1($sql) or die("could not execute query".mysqli_error());
	$num = mysqli_num_rows($exists);
	if($num)
	{
		$msg = "Report for $month and $year Already Exists!";
		$flg = "red";
	}
	else
	{
		$addsql="insert into cpo_progressreport (I_userid,I_tutorid,I_subjectId,I_month,I_year,T_tcomments ) values (".$student_name.",".$_SESSION['user_id'].",".$subject.",".$month.",".$year.",'".$tutor_cmt."')";
		$record=runquery1($addsql) or die("could not execute query".mysqli_error());
		if($record)
		$msg="Monthly Report Added Successfully";
		else
		$msg="Error in Insert";
	}

					?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Monthly Progress Report</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
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
