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
<title><?php echo sitename;?>Homework Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function win_load()
{
	document.frmhomework.cmbsubject.focus();
}
function validation()
{
	
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
	var temp = document.frmhomework.txtddate.value.split('/');
	var duedate = temp[2]+temp[1]+temp[0];
	
	var tempa = document.frmhomework.txtadate.value.split('/');
	var assign = tempa[2]+tempa[1]+tempa[0];
	if(document.frmhomework.cmbsubject.value=="")
	{
		alert("Subject must be selected!");
		document.frmhomework.cmbsubject.focus();
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
	if( document.getElementById('toggleCheckbox').checked == true)
	{
	
		if(document.frmhomework.txthomeworktitle.value=="")
		{
			alert("Homework Title can not be blank!");
			document.frmhomework.txthomeworktitle.focus();
			return false;
		}
	}
	else
	{
		if (document.frmhomework.sel_hw.value == "")
		{	
			alert("Please select homework!");
			document.frmhomework.sel_hw.focus();
			return false;
		}
	}
	if(today > assign)
	{
		alert("Assign date must be greater than or equal to current date.");
		document.frmhomework.txtadate.focus();
		return false;
	}
	if(assign > duedate)
	{
		alert("Due date must be greater than or equal to assign date.");
		document.frmhomework.txtddate.focus();
		return false;
	}
	return true;
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frmhomework'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
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
	
		var query = "get_hw.php?id="+id;
	}
	else
	{
		document.getElementById('id_learner').style.display='none';
		document.getElementById('id_lesson').style.display='none';
		document.getElementById('learn').style.display = 'none'; 
		document.getElementById('homework').style.display = 'none';
		return false;
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			var number1 = xmlHttp.responseText;
			num = number1.split('//');
			document.getElementById('learn').style.display = 'block'; 
			document.getElementById('homework').style.display = 'block';
			document.getElementById('id_learner').innerHTML= num[0];
			document.getElementById('id_learner').style.display='block';
			document.getElementById('homework').style.display='';
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
		document.getElementById('toggleLyr1').style.display = ''; 
		document.getElementById('sel_hw').disabled = true; 
		 
	}     
	else 
	{ 
		document.getElementById('toggleLyr1').style.display = 'none'; 
		document.getElementById('sel_hw').disabled = false; 
	}   
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
        <tr><td align="right" class="bodytext" style="padding-right:30px"><a href="homework.php"><b>Back</b></a></td></tr>
	<tr><td height="20"></td></tr>
        <tr> 
          <td valign="top"><form name="frmhomework" method="post" action="addhw.php?next=1" onSubmit="return validation();">
			<?php
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome"><b>Add/Assign Homework</b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
					<tr><td height="10" colspan="2" class="bodytext" align="right">All (<font color="red">*</font>) mark are compulsory fields</td></tr>
					<tr>
                        <td width="40%" height="42" class="bodytext"> &nbsp;Subject</td>
                        <td width="60%" ><select name="cmbsubject" class="textbox" onChange="get_learner(this.value)">
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
						
						 <tr id="learn" style="display:none;"><td colspan="2" align="left"><div id="id_learner" style="display:none" ></div></td></tr>
						 <tr id="homework" style="display:none;"><td colspan="2" width="100%"><div id="id_lesson" style="display:none" ></div></td></tr>
						
						<tr id="toggleLyr1" style="display:none;">
                        <td  width="41%" height="30" class="bodytext">Homework Title</td>
                        <td width="59%"><input name="txthomeworktitle" maxlength="100" class="textbox" size="33">
                          &nbsp;<font color="#FF0000"><sup>*</sup></font></td>
                      </tr>
					 
						<tr>
							<td width="41%" height="30" class="bodytext">Assign date </td>
							<td width="59%"><input name="txtadate" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">&nbsp;<a href="javascript:pickdate('txtadate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>&nbsp;<font color="red">*</font></td>
						</tr>
						<tr>
							
                        <td width="41%" height="30" class="bodytext">Due date</td>
							<td width="59%"><input name="txtddate" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">&nbsp;<a href="javascript:pickdate('txtddate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>&nbsp;<font color="red">*</font></td>
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
		$sub_id = $_POST['cmbsubject'];
		$tutor_id = $user_id;
		if($_POST['sel_hw'] != '')
		{
			$sqlhome = "select V_title from cpo_homework where I_homeworkid=".$_POST['sel_hw'];
			$qhome = 	runquery1($sqlhome);
			$reshome = mysqli_fetch_array($qhome);
			$homework_title = $reshome['V_title'];
		}
		else
		{	$homework_title = $_POST['txthomeworktitle'];
		$homework_title1=$_POST['txthomeworktitle'];}
		$due_date=$_POST['txtddate'];
		$assign_date=$_POST['txtadate'];
		$ddate=explode("/",$due_date);
		$adate=explode("/",$assign_date);
		$due = $ddate[2]."-".$ddate[1]."-".$ddate[0];
		$assign = $adate[2]."-".$adate[1]."-".$adate[0];
		
		for($i=0;$i<count($_POST['cmbstudent']);$i++)
		{
			$sqluserid = "select I_user_subid from cpo_user_subject where I_studentid =".$_POST['cmbstudent'][$i]." and I_tutorid=".$tutor_id." and I_subjectid=".$sub_id;
			$usersub =runquery1($sqluserid);
			$user_sub_id = mysqli_fetch_array($usersub);
			
			$sql="select count(*) from cpo_homework where V_title='".$homework_title."' and I_user_subjectid=".$user_sub_id['I_user_subid'];
			$rIDPass=runquery1($sql);
			$rIDans=mysqli_fetch_row($rIDPass);
			if($rIDans[0]>0)
			{
				if(count($_POST['cmbstudent']) == 1)
				{
					$msg="Homework already assigned to learner.";
					$flg = "red";
				}
			}
			else
			{
				$addsql="insert into cpo_homework (I_Subject,D_due_date,D_assign_date,V_title,I_user_subjectid,I_tutorid,I_studentid) values (".$sub_id.",'".$due."','".$assign."','".$homework_title."',".$user_sub_id['I_user_subid'].",".$tutor_id.",".$_POST['cmbstudent'][$i].")";
				$record=runquery1($addsql) or die("could not execute query".mysqli_error());
				if($record)
				$msg='Homework "'.$homework_title.'" added successfully.';
				else
				{$msg="Error in insert.";
				$flg = "red";}
			}
		}?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome"><b>Add/Assign Homework</b></td>
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
