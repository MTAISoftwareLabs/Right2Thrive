<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
$lessonid = $_GET['id'];
$query = "select * from cpo_lessons where I_lid =".$lessonid;
$result = runquery1($query) or die('could note execute'.mysqli_error());
$rslist = mysqli_fetch_array($result);
$sqls = "select sub.vSubjectName,sub.iSubjectId,us.I_tutorid,us.I_subjectid from cpo_subjectmaster as sub, cpo_user_subject as us,cpo_lessons as l where sub.iSubjectId=us.I_subjectid and l.I_user_subjectid=".$rslist["I_user_subjectid"]." and l.I_user_subjectid=us.I_user_subid";
$querys = runquery1($sqls);
$rows = mysqli_fetch_array($querys);
$sub_id = $rows['iSubjectId'];
$tutor = $rows['I_tutorid'];
$lesson = $rslist['V_name'];
$sdate=explode('-',$rslist["D_date"]);
$ddate=explode('-',$rslist["D_duedate"]);
?>
<html>
<head>
<title>Edit Lesson</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="./calendar1.js"></script> 
<script language="JavaScript">
function validation()
{
	var temp = document.frmlesson.txtldate.value.split('/');
	var ldate = temp[2]+temp[1]+temp[0];
	
	var tempa = document.frmlesson.txtddate.value.split('/');
	var duedate = tempa[2]+tempa[1]+tempa[0];
	var myDrop = document.frmlesson.elements['sel_learner[]'];
	var selectCount = 0;
	var dropLength = myDrop.length
	for(var i=0; i<dropLength; i++)
	{
		if(myDrop.options[i].selected == true && myDrop.options[i].value !='')
		{
			selectCount++;
		}
	}
	if(selectCount<1)
	{
		alert('Please select at least one learner.');
		return false;
	}
	if(document.frmlesson.txtlessonname.value=="")
	{
		alert("Lesson Name can not be blank!");
		document.frmlesson.txtlessonname.focus();
		return false;
	}
	if(document.frmlesson.txtlessondesc.value=="")
	{
		alert("Lesson Description can not be blank!");
		document.frmlesson.txtlessondesc.focus();
		return false;
	}
	if(ldate > duedate)
	{
		alert("Due date must be greater than or equal to assign date.");
		document.frmlesson.txtddate.focus();
		return false;
	}
	return true;
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frmlesson'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
}
function get_learn(tutor,subject,lesson)
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
	
	if(tutor !='' && subject !='')
	{
		var query = "getlearn.php?tid="+tutor+"&sub="+subject+"&lesson="+lesson;
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			var number = xmlHttp.responseText;
			document.getElementById('id_learner').innerHTML = number;
			document.getElementById('id_learner').style.display='';
		}
	}
	xmlHttp.open("GET",query,true);
	xmlHttp.send(null);
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact"  <?php if(!isset($_POST['txtlessonname']) ) { echo "hi";?> onLoad="get_learn('<?=$tutor?>','<?=$sub_id?>','<?=$lesson?>');" <?php } else {echo "no";}?> >
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_POST['hdnsubmit'])  && $_POST['hdnsubmit'] ==1)
{
	$sub_id = $_POST['hdn_sub'];
	$tutor_id = $_POST['hdn_tut'];
	$lesson_name=$_POST['txtlessonname'];
	$lesson_desc=addslashes($_POST['txtlessondesc']);
	$txtldate=$_POST['txtldate'];
	$ldate=explode("/",$txtldate);
	$due_date=$_POST['txtddate'];
	$ddate=explode("/",$due_date);
	$due = $ddate[2]."-".$ddate[1]."-".$ddate[0];
	$assign = $ldate[2]."-".$ldate[1]."-".$ldate[0];
	$sql = "delete from cpo_lessons where V_name='".$lesson."'";
	$del =runquery1($sql);
	
	for($i=0;$i<count($_POST['sel_learner']);$i++)
	{
		$sqluserid = "select I_user_subid from cpo_user_subject where I_studentid =".$_POST['sel_learner'][$i]." and I_tutorid=".$tutor_id." and I_subjectid=".$sub_id;
		$usersub =runquery1($sqluserid);
		$user_sub_id = mysqli_fetch_array($usersub);
		
		$addsql="insert into cpo_lessons (V_name,T_desc,D_date,D_duedate,I_user_subjectid) values ('".$lesson_name."','".$lesson_desc."','".$assign."','".$due."',".$user_sub_id['I_user_subid'].")";
		$record=runquery1($addsql) or die("could not execute query".mysqli_error());
		if($record)
		$msg='Lesson "'.$lesson_name.'" updated successfully.';
		else
		{$msg="Error in insert.";
		$flg = "red";}
	}
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Lesson Admin</td>
        </tr>
        <tr>
          <td class="graydotline">&nbsp;</td>
        </tr>

        <tr>
          <td height="30px;"></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=lesson" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
					   <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="addlesson.php" class="greendeactfont">Add</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listlesson.php" class="greendeactfont">List</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                <tr>
                                  <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                      <tr>
                                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td class="toheaderbg" colspan="3">Lesson Information</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table>
                                </tr>
                                <tr>
                                  <td align="left"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1">
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>

									<tr>
									<?php
									if($flg == "red")
									{
								?>
								<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
							</tr>
							<tr>
								<td colspan="2" align="center" height="35" class="error"><?php echo $msg; ?></td>
								<?php
								}
								else
								{
								?>
								<td colspan="2" align="center" height="35" class="fontblue"><?php echo $msg; ?></td><?php }?>	
								</tr>	
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr> 
								<td colspan="2" height="30" align="right">
									<a href="./viewlesson.php"><img src="./images/go_back.gif" alt="View School" border="0"></a>
								</td>
							</tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td width="0%"><img src="images/green_left_corn.gif" /></td>
                      <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                      <td width="0%"><img src="images/green_right_corn.gif" /></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <?php } else {?>
     <form action="editlesson.php?id=<?php echo $lessonid;?>" name="frmlesson" method="post" onSubmit="return validation();">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Lesson Admin</td>
          </tr>
          <tr>
            <td class="graydotline">&nbsp;</td>
          </tr>
          <tr>
            <td height="30px;"></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=lesson" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addlesson.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listlesson.php" class="greendeactfont">List</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                  <tr>
                                    <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                        <tr>
                                          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td class="toheaderbg" colspan="3">Edit Lesson</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                  </tr>
                                  <tr>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        <tr>
                                          <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                                        </tr>
                                        <tr> 
                      <td width="40%" height="42">&nbsp;&nbsp;Subject</td>
      						<td width="60%" ><select name="selsubject" class="textbox" disabled="disabled">
							<option value="">Select Subject</option>
							<?php $sqls = "select iSubjectId,vSubjectName from cpo_subjectmaster where iStatus=1";
								$querys = runquery1($sqls);
								while($rows = mysqli_fetch_array($querys))
								{								
								?>
							<option value="<?=$rows['iSubjectId']?>" <?php if($sub_id==$rows['iSubjectId']){?> selected="selected"<?php }?>><?=$rows['vSubjectName']?></option>
							<?php }?>
							</select>
							<input type="hidden" name="hdn_sub" value="<?=$sub_id?>">
							<input type="hidden" name="hdn_tut" value="<?=$tutor?>">&nbsp;<font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Tutor</td>
      						<td width="60%" ><select name="seltutor" class="textbox" disabled="disabled">
							<option value="">Select Tutor</option>
							<?php $sqls = "select iUserId,vUserName from cpo_usermaster where iUserId=".$tutor;
								$querys = runquery1($sqls);
								while($rows = mysqli_fetch_array($querys))
								{								
								?>
							<option value="<?=$rows['iUserId']?>" <?php if($tutor==$rows['iUserId']){?> selected="selected"<?php }?>><?=$rows['vUserName']?></option>
							<?php }?>
							</select><div id="id_tutor" style="display:none"></div>&nbsp;<font color="#FF0000">*</font></td>
    															</tr>
															
																<tr><td colspan="2"><div id="id_learner" style="display:none"></div></td></tr>
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Lesson Name</td>
      																	<td width="60%" ><input type="text" name="txtlessonname" class="textbox" size="30" value="<?=$rslist['V_name']?>"> <font color="#FF0000">*</font></td>
    															</tr>
    															<tr> 
                          												
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Lesson
                        Description </td>
      																	
                          <td width="60%" ><textarea name="txtlessondesc" value="" rows="10" cols="45" class="textbox"><?php echo ereg_replace('<br />',  '' , $rslist["T_desc"]);?></textarea> <font color="#FF0000">*</font> </td>
    															</tr>
																
																
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Assign Date</td>
      						<td width="60%" ><input name="txtldate" type="text" class="textbox" readonly value="<?php echo $sdate[2]."/".$sdate[1]."/".$sdate[0] ?>">&nbsp;<a href="javascript:pickdate('txtldate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>
 </td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Due Date</td>
      						<td width="60%" ><input name="txtddate" type="text" class="textbox" readonly value="<?php echo $ddate[2]."/".$ddate[1]."/".$ddate[0] ?>">&nbsp;<a href="javascript:pickdate('txtddate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>
 </td>
    															</tr>
							
    															<tr> 
      																	<td colspan="2" > <div align="right"><font face=verdana size=2><b> 
                      &nbsp;&nbsp; 
                     <input name="image" type="image" src="./images/update.gif" ><input type="hidden" name="hdnsubmit" value="1">
                      &nbsp;&nbsp;<a href="viewlesson.php"><img src="images/cancel.gif"  border="0"></a> 
                      </b></font> </div></div>
                    </td>
    															</tr>
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="0%"><img src="images/green_left_corn.gif" /></td>
                        <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                        <td width="0%"><img src="images/green_right_corn.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </form>
      <?php }?>
    </td>
  </tr>
</table>
</body>
</html>
