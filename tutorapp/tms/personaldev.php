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
if(isset($_GET['did']))
{
	$comment	= $_POST['txttcomments'];
	$insql = "update cpo_detention set T_tcomments  ='".$comment."' where I_detentionid =".$_GET['did'];
	$ininfo=runquery($insql);
	if($ininfo)
	{?>
		<script language="javascript">
		window.location="personaldev.php";
	</script>
	<?php  }
	else
	{
		$msg = "Sorry comment cannot be inserted";
		$flg = "red";
	}
}
if(isset($_GET['did']))
{
	$comment	= $_POST['txttcomments'];
	$insql = "update cpo_detention set T_tcomments  ='".$comment."' where I_detentionid =".$_GET['did'];
	$ininfo=runquery($insql);
	if($ininfo)
	{?>
		<script language="javascript">
		window.location="personaldev.php";
	</script>
	<?php  }
	else
	{
		$msg = "Sorry comment cannot be inserted";
		$flg = "red";
	}
}
if(isset($_POST['hdn_submit']) &&  isset($_POST['hdn_submit']))
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
		$msg = "Report for $month/$year Already Exists!";
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
}
 if(isset($_POST['hdn_detention']) &&  isset($_POST['hdn_detention']))
{
	$student_name = $_POST['cmbstudent'];
	$tutor_name = $_SESSION['user_id'];
	$deten_date = $_POST['txtddate'];
	$reason = $_POST['txtreason'];
	$improve = $_POST['taimprove'];
	$tcmt = $_POST['tutorcomment'];
	$flag = 'D';
	
	$sdate=explode("/",$deten_date);
	
	$date = $sdate[2]."-".$sdate[1]."-".$sdate[0];	
	
	//check for duplicate
	 $select = " SELECT I_userid, i_tutorid, D_detention FROM cpo_detention where I_userid='".$student_name."' and i_tutorid='".$tutor_name."' and D_detention='".$date."' and C_flag ='".$flag."'";
	 $record=runquery1($select);
	 $num = mysqli_num_rows($record);
	 
	 if($num >0)
	 {
		 $msg= "Detention Already Exists!";
		 $flg = "red";
	}
	else
	{
	  $addsql = "INSERT INTO cpo_detention (I_userid, i_tutorid, D_detention, V_reason, T_improve,T_tcomments,  C_flag) values ('".$student_name."','".$tutor_name."','".$date."','".$reason."','".$improve."','".$tcmt."','".$flag."') ";
	
	$record=runquery1($addsql) or die("could not execute query".mysqli_error());
	if($record)
	$msg="Detention Added Successfully";
	else
	$msg="Error in Insert";	}
}
 if(isset($_POST['hdn_exclusion']) &&  isset($_POST['hdn_exclusion']))
{
	$student_name = $_POST['cmbstudent'];
	$tutor_name = $_SESSION['user_id'];
	$deten_date = $_POST['txtddate'];
	$reason = $_POST['txtreason'];
	$improve = $_POST['taimprove'];
	$tcmt = $_POST['tutorcomment'];
	$flag = 'E';
	
	$sdate=explode("/",$deten_date);
	
	$date = $sdate[2]."-".$sdate[1]."-".$sdate[0];	
	
	//check for duplicate
	 $select = " SELECT I_userid, i_tutorid, D_detention FROM cpo_detention where I_userid='".$student_name."' and i_tutorid='".$tutor_name."' and D_detention='".$date."' and C_flag ='".$flag."'";
	 $record=runquery1($select);
	 $num = mysqli_num_rows($record);
	 
	 if($num >0)
	 {
		 $msg= "Exclusion Already Exists!";
		 $flg = "red";
	}
	else
	{
	  $addsql = "INSERT INTO cpo_detention (I_userid, i_tutorid, D_detention, V_reason, T_improve,T_tcomments,  C_flag) values ('".$student_name."','".$tutor_name."','".$date."','".$reason."','".$improve."','".$tcmt."','".$flag."') ";
	
	$record=runquery1($addsql) or die("could not execute query".mysqli_error());
	if($record)
	$msg= "Exclusion Added Successfully";
	else
	$msg="Error in Insert";	}
}
?>
<html>
<head>
<title><?php echo sitename;?>Personal Development</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="calendar1.js"></script>
<script language="JavaScript">
function win_load()
{
document.frm_det.cmbstudent.focus();
}
function validation_det()
{
var frm = document.frm_det;
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
function validation_exc()
{
var frm = document.frm_exc;
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
	var temp = document.frm_exc.txtddate.value.split('/');
	var ldate = temp[2]+temp[1]+temp[0];
	if(document.frm_exc.cmbstudent.value=="")
	{
		alert("Learner must be selected!");
		document.frm_exc.cmbstudent.focus();
		return false;
	}
	if(today > ldate)
	{
		alert("Exclusion date must be greater than or equal to current date.");
		 document.frm_exc.txtddate.focus();
		return false;
	}
	if(document.frm_exc.txtreason.value=="")
	{
		alert("Exclusion reason cannot be blank!");
		document.frm_exc.txtreason.focus();
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
function hideaddreport()
{
	document.getElementById('addreport').style.display = 'none';
}
function hidevreport()
{
	document.getElementById('report').style.display = 'none';
}
function openreport(obj)
{

	var new1=window.open("detail_report.php?id="+obj,"",'height=300,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function hidedet(f)
{
	if(f == 'D')
	{
		document.getElementById('add_det').style.display = 'none';
	}
	else
	{
		document.getElementById('add_exc').style.display = 'none';
	}
}
function hide(f)
{
	if(f == 'D')
	{
		document.getElementById('show_det').style.display = 'none';
	}
	else
	{
		document.getElementById('show_exc').style.display = 'none';
	}
}
function get_report(id)
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
	
		var query = "getreport.php?id="+id;
	}
	else
	{
		document.getElementById('id_report').style.display='none';
		document.getElementById('report').style.display='none';
		return false;
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			var number1 = xmlHttp.responseText;
			document.getElementById('report').style.display = '';
			document.getElementById('id_report').style.display='';
			document.getElementById('id_report').innerHTML= number1;
		}
	}
	xmlHttp.open("GET",query,true);
	xmlHttp.send(null);
}
function add_report()
{
	document.getElementById('addreport').style.display='';
}
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
function valid_deten()
{
	if(document.frmhw.txttcomments.value == '')
	{
		alert('Please enter your comments');
		document.frmhw.txttcomments.focus();
		return false;
	}
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
function get_deten(id,flag)
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
	if(!isNaN(id) && id!='Adddet' && id!='Addexc' )
	{
		if(id == '' && flag =='D')
		{
			document.getElementById('show_det').style.display='none';
			document.getElementById('add_det').style.display='none';
		}
		else if(id == '' && flag =='E')
		{
			document.getElementById('show_exc').style.display='none';
			document.getElementById('add_exc').style.display='none';
		}
		else
		{
			var query = "getdeten.php?id="+id+"&flag="+flag;
		}
	}
	else if(id == 'Adddet')
	{
		document.getElementById('add_det').style.display='';
		document.getElementById('show_det').style.display='none';
		return false;
	}
	else if(id=='Addexc')
	{
		document.getElementById('add_exc').style.display='';
		document.getElementById('show_exc').style.display='none';
		return false;
	}
	else 
	{
		document.getElementById('show_det').style.display='none';
		document.getElementById('show_exc').style.display='none';
		return false;
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			var number1 = xmlHttp.responseText;
			if(flag == 'D')
			{
				document.getElementById('show_det').style.display = '';
				document.getElementById('id_deten').style.display='';
				document.getElementById('id_deten').innerHTML= number1;
			}
			else
			{
				document.getElementById('show_exc').style.display = '';
				document.getElementById('id_exc').style.display='';
				document.getElementById('id_exc').innerHTML= number1;
			}
			
		}
	}
	xmlHttp.open("GET",query,true);
	xmlHttp.send(null);
}
</script>
<script language="JavaScript" src="calendar1.js"></script> 
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr>
    <td colspan="2" valign="top"><?php include "includetop.php";?></td>
  </tr>
  <tr>
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc"><?php include "includeleft.php";?>
    </td>
    <td valign="top"><?php include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
       
        <tr>
          <td>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                  <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="welcome"><b>Personal Development </b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                      </tr>
                    </table></td>
                  <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                    <table class="" width="90%" align="center">
						  <tr>
						  	<td colspan="2"><?php if(isset($flg)) {echo "<font color='red'><b><center>".$msg."<center></b></font>";}else{echo "<span class='bodytext'><b><center>".$msg."<center></b></span>"; }?></td>
						  </tr>
					  <form name="frm_report" method="post" action="">
					  <tr>
                        <td width="40%" height="42" class="bodytext">Monthly Progress Report</td>
                        <td width="60%" >&nbsp;
                            <select name="cmbmonth" class="textbox" onChange="get_report(this.value)">
                               <option value="">Month</option>
							   <option value="1">January</option>
							   <option value="2">February</option>
							   <option value="3">March</option>
							   <option value="4">April</option>
							   <option value="5">May</option>
							   <option value="6">June</option>
							   <option value="7">July</option>
							   <option value="8">August</option>
							   <option value="9">September</option>
							   <option value="10">August</option>
							   <option value="11">November</option>
							   <option value="12">December</option>
                            </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="sidelink"  onClick="add_report()" ><b>Add Report</b></a>&nbsp;</td>
                      </tr>
							 </form>
					  <tr id="report" style="display:none"><td width="100%" colspan="2"><div id="id_report"></div></td></tr>
					   <tr id="addreport" style="display:none"><td width="100%" colspan="2">
						<table width="100%">
							<tr> 
          <td><form name="frmreport" method="post" action="personaldev.php" onSubmit="return validation();">
			<?php
			if (!isset($_GET['hdn_submit']))
			{
			?>
		  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome"><b>Add Monthly Progress Report</b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong>&nbsp;&nbsp;::</strong></font></div></td>
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
                <td   background="images/changebttm_center_cor.jpg"><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">&nbsp;&nbsp;<img src="images/closebutton.gif" onClick="hideaddreport();" style="cursor:hand"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?php
			  }?>
	 
			</form></td>
        </tr>						
						</table>
						
						</td></tr>
					  <form name="frm_deten" method="post" action="">
					  <tr>
                        <td width="40%" height="42" class="bodytext">Detention</td>
                        <td width="60%" >&nbsp;
                            <select name="cmbdeten" class="textbox" onChange="get_deten(this.value,'D')">
							  <option value="">Select One Option</option>
                               <option value="Adddet">Enter Detention Record</option>
										 <?php $sqldet="SELECT * FROM cpo_detention where  C_flag='D' and I_tutorid  =".$_SESSION['user_id']." order by I_detentionid";
										 	$resdet=runquery1($sqldet);
											$countdet = mysqli_num_rows($resdet);
											for($i=0;$i<$countdet;$i++)
											{
												$rsdet = mysqli_fetch_array($resdet);
											?>
												<option value="<?php echo $rsdet['I_detentionid']?>"><?php echo $rsdet['V_reason']?></option>
											<?php }
										 ?>
                            </select> &nbsp;</td>
                      </tr>
							 </form>
							 <tr id="show_det" style="display:none"><td width="100%" colspan="2"><div id="id_deten"></div></td></tr>
							  <tr id="add_det" style="display:none"><td width="100%" colspan="2">
							  <form name="frm_det" method="post" action="personaldev.php" onSubmit="return validation_det();">
			
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome"><b>Add Detention</b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong>&nbsp;&nbsp;::</strong></font></div></td>
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
							<td colspan="2">
							
							<table width="100%">
				<tr>
								<td class="bodytext" height="32">Select Learner </td>
								<td class="bodytext"><?php
 $sqls = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us.I_studentid  =sb.iUserId  and us.I_tutorid  =".$_SESSION['user_id'] ." group by  us.I_studentid";
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
								<td class="bodytext" height="32">Date</td>
								<td class="bodytext"><input name="txtddate" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">&nbsp;<a href="javascript:pickdate('txtddate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>&nbsp;<font color="#FF0000">*</font> </td>
				</tr>
				<tr>
								<td width="41%" height="30" class="bodytext">Reason of Detention </td>
								<td width="59%"><input type="text" name="txtreason" maxlength="100" size="40" class="textbox" >
												&nbsp;<font color="red">*</font> </td>
				</tr>
				<tr>
								<td width="41%" height="30" class="bodytext">What do I need to improve?</td>
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
							
							</td>
						</tr>
					</table>
				</td>
              </tr>
              <tr> <input type="hidden" name="hdn_detention" value="1">
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">&nbsp;&nbsp;<img src="images/closebutton.gif" onClick="hidedet('D');" style="cursor:hand"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>			
			</form>
							  
							  
							  
							  </td></tr>
							 <form name="frm_exec" method="post" action="">
					  <tr>
                        <td width="40%" height="42" class="bodytext">Exclusion</td>
                        <td width="60%" >&nbsp;
                            <select name="cmbexec" class="textbox" onChange="get_deten(this.value,'E')">
                               <option value="">Select One Option</option>
							   <option value="Addexc">Enter Exclusion Record</option>
										 <?php $sqldet="SELECT * FROM cpo_detention where  C_flag='E' and I_tutorid  =".$_SESSION['user_id']." order by I_detentionid";
										 	$resdet=runquery1($sqldet);
											$countdet = mysqli_num_rows($resdet);
											for($i=0;$i<$countdet;$i++)
											{
												$rsdet = mysqli_fetch_array($resdet);
											?>
												<option value="<?php echo $rsdet['I_detentionid']?>"><?php echo $rsdet['V_reason']?></option>
											<?php }
										 ?>
                            </select> &nbsp;</td>
                      </tr>
							 </form>
							   <tr id="show_exc" style="display:none"><td width="100%" colspan="2"><div id="id_exc"></div></td></tr>
							  <tr id="add_exc" style="display:none"><td width="100%" colspan="2">
							  <form name="frm_exc" method="post" action="personaldev.php" onSubmit="return validation_exc();">
			
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome"><b>Add Exclusion</b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong>&nbsp;&nbsp;::</strong></font></div></td>
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
							<td colspan="2">
							
							<table width="100%">
				<tr>
								<td class="bodytext" height="32">Select Learner </td>
								<td class="bodytext"><?php
 $sqlse = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us.I_studentid  =sb.iUserId  and us.I_tutorid  =".$_SESSION['user_id'] ." group by  us.I_studentid";
$queryse = runquery1($sqlse);
while($rowse = mysqli_fetch_array($queryse))
{
	$optione .='	<option value='.$rowse['I_studentid'].'>'.$rowse['vUserName'].'</option>';
}

					?><select name="cmbstudent" class="textbox" >
                     <option value="">Select Learner</option>
                   <?php echo $optione;?></select>&nbsp;<font color="red">*</font> </td>
				</tr>
				<tr>
								<td class="bodytext" height="32">Date</td>
								<td class="bodytext"><input name="txtddate" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">&nbsp;<a href="javascript:pickdate('txtddate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>&nbsp;<font color="#FF0000">*</font> </td>
				</tr>
				<tr>
								<td width="41%" height="30" class="bodytext">Reason of Exclusion </td>
								<td width="59%"><input type="text" name="txtreason" maxlength="100" size="40" class="textbox" >
												&nbsp;<font color="red">*</font> </td>
				</tr>
				<tr>
								<td width="41%" height="30" class="bodytext">What do I need to improve?</td>
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
							
							</td>
						</tr>
					</table>
				</td>
              </tr>
              <tr> <input type="hidden" name="hdn_exclusion" value="1">
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">&nbsp;&nbsp;<img src="images/closebutton.gif" onClick="hidedet('E');" style="cursor:hand"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>			
			</form>
							  
							  
							  </td></tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                  <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right">
                    </div></td>
                  <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                </tr>
              </table>
            </td>
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
