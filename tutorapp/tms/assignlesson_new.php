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
	if (document.frm_addlesson.cmblesson.value == "")
	{	
		alert("Please select lesson!");
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
	
		var query = "getlesson_new.php?id="+id;
	}
	else
	{
		document.getElementById('id_learner').style.display='none';
		document.getElementById('id_lesson').style.display='none';
		document.getElementById('learn').style.display = 'none'; 
		document.getElementById('lesson').style.display = 'none'; 
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
          <td><form name="frm_assignlesson" method="post" action="assignlesson_new.php?next=1" onSubmit="return validation();">
              <?php
			if (!isset($_GET['next']))
			{
			?>
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                  <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="welcome"><b>Assign Lesson to Students </b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                      </tr>
                    </table></td>
                  <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                    <table class="" width="90%" align="center">
                      <tr>
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
						  <td colspan="2" class="bodytext" align="left"><?php echo "Lesson Name" ?>&nbsp;</td>
						</tr>
                     
                      <tr id="toggleLyr2" style="display:none;">
                        <td width="28%" height="30" class="bodytext">Lesson Description </td>
                        <td width="72%">&nbsp;
                          <textarea name="tadesc" rows="4" class="textbox"></textarea>
                        &nbsp;<font color="#FF0000"><sup>*</sup></font></td>
                      </tr>
					  <tr id="toggleLyr3" style="display:none;">
                        <td width="28%" height="30" class="bodytext">Upload Lesson File </td>
                        <td width="72%">&nbsp;
                          <textarea name="upload" class="textbox" rows="4">Upload  File to go here</textarea>
                        &nbsp;</td>
                      </tr>
                      
					  <tr><td colspan="2"><div id="id_learner" style="display:block"></div></td></tr>
                  
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

	//$lesson = $_POST['lessonid'];	
	$user_subid = $_POST['hdn_usersubid'];
	$tutor_id = $_SESSION['user_id'];
	$lesson_name = $_POST['cmblesson'];}
  //  echo "Lesson Name:".$lesson_name;
	for($i=0;$i<count($_POST['cmbstudent']);$i++)
	{
		$sql="select count(*) from cpo_user_lesson where I_lesson ='".$lesson_name."' and I_userid =". $_POST['cmbstudent'][$i];
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
			$addsql="insert into cpo_user_lesson (I_tutorid,I_userid,I_lesson) values ('".$tutor_id."','".$_POST['cmbstudent'][$i]."','".$lesson_name."')";
			$record=runquery1($addsql) or die("could not execute query".mysqli_error());
			if($record)
			echo "Lesson Assigned Successfully to Learner \n";
			else
			echo "Error in Insert";
		}
		
	}
?>
              <p>
                <?php //}
			  ?>
              </p>
              <p>&nbsp;                </p>
          </form></td>
        </tr>
		<tr><td>&nbsp;</td>
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
