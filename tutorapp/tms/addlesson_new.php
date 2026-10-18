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
	if(document.frm_addlesson.txt_addlsn.value == '')
		{
			alert('Please enter lesson name!');
			document.frm_addlesson.txt_addlsn.focus();
			return false;
		}
	
  	if (document.frm_addlesson.tadesc.value == "")
	{	
		alert("Please enter lesson description!");
		document.frm_addlesson.tadesc.focus();
		return false;
	}
	var today=new Date();
	var temp = document.frm_addlesson.lessdate.value.split('/');
	var duedate = new Date(temp[2],temp[1],temp[0]);
	var tempa = document.frm_addlesson.duedate.value.split('/');
	var assign = new Date(tempa[2],tempa[1],tempa[0]);
	if(assign.valueOf() <= today.valueOf())
	{
		alert("Assign date must be greater than or equal to current date.");
		document.frm_addlesson.lessdate.focus();
		return false;
	}


	if(duedate.valueOf() > assign.valueOf())
	{
		alert("Due date must be greater than or equal to assign date.");
		document.frm_addlesson.duedate.focus();
		return false;
	}
	return true;	
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frm_addlesson'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
}				

function filevalidation()
{
	if (document.FRMUPLOADFILE.userfile.value == "")
	{
		alert("Please select file !");
		return false;
	}
	flag = 0;	
	file = document.FRMUPLOADFILE.userfile.value.split("\\"); 
	for(var j = 0; j<files.length; j++)
	{
		if (files[j][1] == file[file.length-1])
		{
			flag = 1;
		}
	}
	if (flag == 1)
	{
		var cn = confirm("File already uploaded ! Do you want to overwrite");
		if (cn)
		{
			return true;
		}
		else
		{
			document.FRMUPLOADFILE.userfile.value = "";
			return false;
		}	
	}		
	return true;
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
          <td>
		  <form name="frm_addlesson" method="post" action="addlesson_new.php?next=1" onSubmit="return validation();">
           <?php
			if (!isset($_GET['next']))
			{
			?>
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                  <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="welcome"><b>Step 1: Add Lesson </b></td>
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
                        
                        <?php $sql = "select * from cpo_tutorforcourses where iUserID=".$_SESSION['user_id'].""; 
						$rID = runquery1($sql);
	 					$num = $rID ? mysqli_num_rows($rID) : 0 ;
						?>
                            <select name="cmbsubject" class="listbox">
							    <option value="">Select Subject</option>
                                <?php 
							//	 $sqls = "select us.I_user_subid ,us.I_subjectid , sb.vSubjectName  from cpo_user_subject as  us, cpo_subjectmaster  as sb where  sb.iSubjectId =us.I_subjectid and us.I_tutorid  =".$_SESSION['user_id']." group by us.I_subjectid";
								//$querys = runquery1($sqls);
								//while($rows = mysqli_fetch_array($querys))
								//{ ?>
					<?php if($num > 0)
                  		{
                    	$cnt=1;
                    	while ($rs = mysqli_fetch_array($rID))
                    		{
							$id=explode(",", $rs["vSubjectIDs"]);
						    $str="";
						    for($i=0;$i<count($id);$i++)
						        	{
									$sql2="select vSubjectName, iSubjectId from cpo_subjectmaster where iSubjectId= '".$id[$i]."'";
									$result2=runquery1($sql2) or die('could not execute query'.mysqli_error());
						    		$num = $result2 ? mysqli_num_rows($result2) : 0;
									if ($num > 0)
									{
								$name=mysqli_result($result2,0,0); 
								$lesid=mysqli_result($result2,0,1);
								?>
									
                                    <option value="<?php echo $lesid?>">
                                <?php echo $name?>
                                	</option> 
							   <?php } ?>
						
					<?php	} ?>
															
							 <?php
					$cnt++;
					}
						}
								
								?> 
                                
                               
                        </select>                            &nbsp;<font color="#FF0000">*</font></td>
                      </tr>
					  
						<tr id="toggleLyr1" style="display:block;">
						  <td class="bodytext" align="left">Students</td>
						  <td class="bodytext" align="left">&nbsp;</td>
					  </tr>
						<tr id="toggleLyr1" style="display:block;">
						  <td class="bodytext" align="left">Lesson Title </td>
						  <td class="bodytext" align="left"> &nbsp;
						    <input name="txt_addlsn" type="text" class="textbox" value=""></td>
						</tr>
                     
                      <tr id="toggleLyr2" style="display:block;">
                        <td width="28%" height="30" class="bodytext">Lesson Description </td>
                        <td width="72%">&nbsp;
                          <textarea name="tadesc" rows="4" class="textbox"></textarea>
                        &nbsp;<font color="#FF0000"><sup>*</sup></font></td>
                      </tr>
					  <tr id="toggleLyr3" style="display:block;">
                        <td colspan="2" height="30" class="bodytext">You can upload a file for this lesson on the next page</td>
                      </tr>
                      
					
                      <tr>
                        <td width="28%" height="30" class="bodytext">Assign Date </td>
                        <td width="72%">&nbsp;
                          <input name="lessdate" type="text" class="textbox"  value="<?php echo date("d/m/Y");?>">
                        &nbsp;<a href="javascript:pickdate('lessdate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>&nbsp;<font color="#FF0000"><sup>*</sup></font></td>
                      </tr>
					   <tr><td colspan="2"><div id="id_learner" style="display:block"></div></td></tr>
                      <tr>
                        <td width="28%" height="30" class="bodytext">Due Date </td>
                        <td width="72%">&nbsp;
                          <input name="duedate" type="text" class="textbox"  value="<?php echo date("d/m/Y");?>">
                        &nbsp;<a href="javascript:pickdate('duedate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>&nbsp;<font color="#FF0000"><sup>*</sup></font></td>
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

else if(isset($_GET['next']) && ($_GET['next'] == 1)){


	$subject = $_POST['cmbsubject'];
	$adate = $_POST['lessdate'];
	$ddate = $_POST['duedate'];
	$asd = explode('/',$adate);
	$ddd = explode('/',$ddate);
	
	$assign = $asd[2].'-'.$asd[1].'-'.$asd[0];
	$due   = $ddd[2].'-'.$ddd[1].'-'.$ddd[0];
	
	$tutor_id = $_SESSION['user_id'];
	
	if($_POST['cmblesson'] != '')
		{	$lesson_name = $_POST['cmblesson'];}
		else
		{	$lesson_name = $_POST['txt_addlsn'];
			//$lesson_name1 = $_POST['txt_addlsn'];}
	
			$lesson_desc=addslashes($_POST['tadesc']);
         }

$addsql="insert into cpo_lessons_new (V_name,T_desc,D_date,D_duedate,I_lesson_fid,I_tid,I_sid) values ('".$lesson_name."','".$lesson_desc."','".$assign."','".$due."','0','".$_SESSION[user_id]."','".$subject."')";
$record=runquery1($addsql) or die("could not execute query".mysqli_error());
$LessonId = mysqli_insert_id();			
			if($record) {
			$msg="Lesson Created Successfully. LessonId=".$LessonId;
			}else{
			$msg="Error in Insert";
		  	}
 ?>
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                  <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="welcome"><b>Add Lesson</b></td>
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
              <p>
                
              </p>
              <p>&nbsp;                </p>
          </form></td>
        </tr>
<?php } 
if(isset($_GET['next']) && (($_GET['next'] == 1) || ($_GET['next'] == 2))){
?>
		<tr><td>
		<form id="upload" name="FRMUPLOADFILE" enctype="multipart/form-data" method="POST" onSubmit="return filevalidation();" action="addlesson_new.php?next=2">			
			  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr> 
					<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
					<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr> 
						  <td class="welcome">Step 2: Upload Files</td>
						  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
						</tr>
					  </table></td>
					<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
				  </tr>
				  <tr> 
					
                  <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
<table class="" width="94%" align="center">
<tr>
<td>
	<?php
	if(isset($_GET['next']) && $_GET['next'] == 2){
	
	//echo $_GET['LessonId'];
			$val = 0;
			//echo $_FILES['userfile']['type'];
			if ($_FILES['userfile']['type'] == "application/x-shockwave-flash" || 
				$_FILES['userfile']['type'] == "image/pjpeg" || 
				$_FILES['userfile']['type'] == "application/msword" || 
				$_FILES['userfile']['type']=="application/pdf" || 
				$_FILES['userfile']['type']== "image/gif" || 
				$_FILES['userfile']['type']== "application/octet-stream" || 
				$_FILES['userfile']['type']== "application/vnd.ms-powerpoint" || 
				$_FILES['userfile']['type']== "application/vnd.ms-excel" ||
				$_FILES['userfile']['type']== "video/avi" ||
				$_FILES['userfile']['type']== "video/mpeg")
									{
										//echo "./upload/".$_SESSION['user_name'].$_SESSION['user_id']."/".$_FILES['userfile']['name'];
										if ((file_exists("./upload/".$_SESSION['user_id']."/".$_FILES['userfile']['name'])))
										{
											echo "File Exists";
										}
									 	if (!file_exists("./upload/".$_SESSION['user_id']))
											mkdir("./upload/".$_SESSION['user_id'],0755);
										//move_uploaded_file($_FILES['FLUPFILE']['tmp_name'],"./upload/".$_SESSION['user_id']."/".$_FILES['userfile']['name']);
										//$uploaddir = './upload/'.$_SESSION['user_id'].'/';
										$uploaddir = '/home/careerp/public_html/tms/upload/'.$_SESSION['user_id'].'/';
										$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

										move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile);
										//print_r($_FILES);

										$UserId=0;
										$LessonId = $_POST['LessonId'];
										$sqladd = "insert into cpo_uploadfilestutor(iUserId,iTutorId,iLessonId,vFilePath,vUploadDate) values ('".$UserId."',".$_SESSION['user_id'].",'".$LessonId."','".$_FILES['userfile']['name']."','".date("Y-m-d")."')";
										//echo $sqladd;
										$test=runquery1($sqladd) or die("could not execute query".mysqli_error());
										$myFileId = mysqli_insert_id();
										//printf("Last inserted record has id %d\n", $myFileId);
										$fileupdate = "update cpo_lessons_new set I_lesson_fid ='".$myFileId."'where I_lid ='".$LessonId."'"; 
										//echo $fileupdate;
										$test2=runquery1($fileupdate) or die("could not execute query".mysqli_error());
										
										$msg="File Upload Sucessful";
										?>
										<tr><td class="bodytext"><?php echo $msg ?></td></tr>
										<tr><td colspan="2"> <a class="bodytext" href="assignlesson_new.php">Assign Students to this Lesson</a> </td></tr><?php
									}
							
						}	
								else {
								?> 
					  		<tr>
								<td class="bodytext">&nbsp;Upload File</td>
								<td class="bodytext"><input type="file" name="userfile" id="userfile" class="textbox" size="50"></td>
							</tr>		
							<tr><td colspan="2" height="10" class="bodytext" align="center"><font color="red">(Only *.pdf, *.doc, *.xls, *.ppt, *.swf, *.gif, *.jpeg, *.avi, *.mpeg files can upload)</font></td></tr>
				    </table>
                  </td>
				  </tr>
				  <tr> 
					<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
					<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right">
					 <input name="LessonId" type="hidden" value="<?php echo $LessonId ?>">
                      <input name="image" type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">
                    </div></td>
					<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
				  </tr>
				  <tr><td>&nbsp;</td></tr>
			  </table>
			</form><?php
			}
			}
if(isset($_GET['next']) && $_GET['next'] == 2){
  	?>
  	<tr>
	<td><?php } ?></td>
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
