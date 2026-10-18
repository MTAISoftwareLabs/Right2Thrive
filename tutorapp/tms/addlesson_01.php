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
var myvar = 1;

function validation()
{
	if (document.frm_addlesson.cmbsubject.value == "")
	{	
		alert("Please select subject!");
		document.frm_addlesson.cmbsubject.focus();
		return false;
	}
	oSelect = document.getElementById ('student');

    var iNumSelected = 0;

    for (var iCount=0; oSelect.options[iCount]; iCount++) {
        if (oSelect.options[iCount].selected == true) {
            iNumSelected ++;
        }
    }

	if (iNumSelected == 0) {
		alert ('Please select learner!');
		return false;
	}
	
	//alert(document.getElementById('toggleCheckbox').checked);
	if( document.getElementById('toggleCheckbox').checked == true)
	{
	
		if(document.frm_addlesson.txt_addlsn.value == '')
		{
			alert('Please enter lesson name!');
			document.frm_addlesson.txt_addlsn.focus();
			return false;
		}
	}
	else
	{
		if (document.frm_addlesson.cmblesson.value == "")
		{	
			alert("Please select lesson name!");
			document.frm_addlesson.cmblesson.focus();
			return false;
		}
	}
  	if (document.frm_addlesson.tadesc.value == "")
	{	
		alert("Please enter lesson description!");
		document.frm_addlesson.tadesc.focus();
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
	var temp = document.frm_addlesson.lessdate.value.split('/');
	var duedate = temp[2]+temp[1]+temp[0];
	
	var tempa = document.frm_addlesson.duedate.value.split('/');
	var assign = tempa[2]+tempa[1]+tempa[0];
	if(today > assign)
	{
		alert("Assign date must be greater than or equal to current date.");
		document.frm_addlesson.lessdate.focus();
		return false;
	}
	if(assign > duedate)
	{
		alert("Due date must be greater than or equal to assign date.");
		document.frm_addlesson.duedate.focus();
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
	
		var query = "getlesson.php?id="+id;
	}
	else
	{
		document.getElementById('id_learner').style.display='none';
		document.getElementById('id_lesson').style.display='none';
		document.getElementById('learn').style.display = 'none'; 
		document.getElementById('lesson').style.display = 'none'; 
		document.getElementById('toggleLyr1').style.display = 'none'; 
		document.getElementById('toggleLyr2').style.display = 'none'; 
		document.getElementById('toggleLyr3').style.display = 'none';
		return false;
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			var number1 = xmlHttp.responseText;
			num = number1.split('//');
			document.getElementById('learn').style.display = 'block'; 
			document.getElementById('lesson').style.display = 'block';
			document.getElementById('id_learner').innerHTML= num[0];
			document.getElementById('id_learner').style.display='block';
			document.getElementById('id_lesson').innerHTML= num[1];
			document.getElementById('id_lesson').style.display='block';
			
		}
	}
	xmlHttp.open("GET",query,true);
	xmlHttp.send(null);
}
function les_txb(obj)
{

   var checkbox = document.getElementById(obj);          
	if (checkbox.checked == true) 
	{
		document.getElementById('toggleLyr1').style.display = 'block'; 
		document.getElementById('toggleLyr2').style.display = 'block'; 
		document.getElementById('toggleLyr3').style.display = 'block';
		document.getElementById('sel_lesson').disabled = true; 
		 
	}     
	else 
	{ 
		document.getElementById('toggleLyr1').style.display = 'none'; 
		document.getElementById('toggleLyr2').style.display = 'none'; 
		document.getElementById('toggleLyr3').style.display = 'none';
		document.getElementById('sel_lesson').disabled = false; 
	}   
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frm_addlesson'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
}				
</script>
<script language="JavaScript" src="calendar1.js"></script> 
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0" <?php if(!isset($_GET['next'])){?>onLoad="document.frm_addlesson.cmbsubject.focus();"<?php } ?>>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
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
        <tr><td align="right" class="bodytext" style="padding-right:30px"><a href="lessons.php"><b>Back</b></a></td></tr>
	<tr><td height="20"></td></tr>
        <tr>
          <td><form name="frm_addlesson" method="post" action="addlesson.php?next=1" onSubmit="return validation();">
              <?php
			if (!isset($_GET['next']))
			{
			?>
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                  <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="welcome"><b>Add/Assign Lesson </b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
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
                        <td width="28%" height="42" class="bodytext">Subject</td>
                        <td width="72%" align="left" >&nbsp;
                            <select name="cmbsubject" class="textbox" onChange="get_learner(this.value)">
                                <option value="">Select Subject</option>
                                <?php 
								 $sqls = "select us.I_user_subid ,us.I_subjectid , sb.vSubjectName  from cpo_user_subject as  us, cpo_subjectmaster  as sb where  sb.iSubjectId =us.I_subjectid and us.I_tutorid  =".$_SESSION['user_id']." group by us.I_subjectid";
								$querys = runquery1($sqls);
								while($rows = mysqli_fetch_array($querys))
								{								
								?> 
                                <option value="<?php=$rows['I_subjectid']?>">
                                <?php=$rows['vSubjectName']?>
                                </option>
                                <?php }?>
                        </select>                            &nbsp;<font color="#FF0000">*</font></td>
                      </tr>
					  <tr id="learn" style="display:none;"><td colspan="2"><div id="id_learner" style="display:none" ></div></td></tr>
						<tr id="lesson" style="display:none;"><td colspan="2"><div id="id_lesson" style="display:none" ></div></td></tr>
						<tr id="toggleLyr1" style="display:none;">
						  <td class="bodytext" align="left">Lesson Title </td>
						  <td colspan="2" class="bodytext" align="left"><input name="txt_addlsn" type="text" class="textbox" value=""></td>
						</tr>
                     
                      <tr id="toggleLyr2" style="display:none;">
                        <td width="28%" height="30" class="bodytext">Lesson Description </td>
                        <td width="72%">
                          <textarea name="tadesc" rows="4" class="textbox"></textarea>
                        &nbsp;<font color="#FF0000"><sup>*</sup></font></td>
                      </tr>
					  <tr id="toggleLyr3" style="display:none;">
                        <td width="28%" height="30" class="bodytext">Upload Lesson File </td>
                        <td width="72%">
                          <textarea name="upload" class="textbox" rows="4">Upload  File to go here</textarea>
                        &nbsp;</td>
                      </tr>
                      
					  <tr><td colspan="2"><div id="id_learner" style="display:block"></div></td></tr>
                      <tr>
                        <td width="28%" height="30" class="bodytext">Assign Date </td>
                        <td width="72%">&nbsp;
                          <input name="lessdate" type="text" class="textbox"  value="<?php echo date("d/m/Y");?>">
                        &nbsp;<a href="javascript:pickdate('lessdate')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>&nbsp;<font color="#FF0000"><sup>*</sup></font></td>
                      </tr>
					   <tr><td colspan="2"><div id="id_learner" style="display:block"></div></td></tr>
                      <tr>
                        <td width="28%" height="30" class="bodytext">Due Date </td>
                        <td width="72%">&nbsp;
                          <input name="duedate" type="text" class="textbox"  value="<?php echo date("d/m/Y");?>">
                        &nbsp;<a href="javascript:pickdate('duedate')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>&nbsp;<font color="#FF0000"><sup>*</sup></font></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                  <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right">
                      <input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17" >
                      <input type="hidden" name="hdnsubmit" value="1">
                    </div></td>
                  <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                </tr>
              </table>
              <?php
			  }

else
{

	$subject = $_POST['cmbsubject'];
	$adate = $_POST['lessdate'];
	$ddate = $_POST['duedate'];
	$asd = explode('/',$adate);
	$ddd = explode('/',$ddate);
	
	$assign = $asd[2].'-'.$asd[1].'-'.$asd[0];
	$due   = $ddd[2].'-'.$ddd[1].'-'.$ddd[0];
	
	
	$user_subid = $_POST['hdn_usersubid'];
	$tutor_id = $_SESSION['user_id'];
	
	if($_POST['cmblesson'] != '')
	{	$lesson_name = $_POST['cmblesson'];}
	else
	{	$lesson_name = $_POST['txt_addlsn'];
	$lesson_name1 = $_POST['txt_addlsn'];}
	
	$lesson_desc=addslashes($_POST['tadesc']);

	for($i=0;$i<count($_POST['cmbstudent']);$i++)
	{
		 $sqluserid = "select I_user_subid from cpo_user_subject where I_studentid =".$_POST['cmbstudent'][$i]." and I_tutorid=".$tutor_id." and I_subjectid=".$subject;
		$usersub =runquery1($sqluserid);
		$user_sub_id = mysqli_fetch_array($usersub);
		
		$sql="select count(*) from cpo_lessons where V_name='".$lesson_name."' and I_user_subjectid=".$user_sub_id['I_user_subid'];
		$rIDPass=runquery1($sql);
		$rIDans=mysqli_fetch_row($rIDPass);
		if($rIDans[0]>0)
		{
			if(count($_POST['sel_learner']) == 1)
			{
				$msg="Lesson Already assigned to learner";
				$flg = "red";
			}
		}
		else
		{
			$addsql="insert into cpo_lessons (V_name,T_desc,D_date,D_duedate,I_user_subjectid) values ('".$lesson_name."','".$lesson_desc."','".$assign."','".$due."',".$user_sub_id['I_user_subid'].")";
			$record=runquery1($addsql) or die("could not execute query".mysqli_error());
			if($record)
			$msg="Lesson Assigned Successfully";
			else
			$msg="Error in Insert";
		}
		
	}
?>
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                  <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="welcome"><b>Add/Assign Lesson</b></td>
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
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table></td>
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
