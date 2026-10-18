<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@ob_start();	
include "dbConnection.php";
//echo $_SESSION['user_id'];
//exit;
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		document.location ="../user_login.php";
	</script> 
<?
}
else
{
		$user_id = $_SESSION['user_id'];
}
function getIcon($filename)
{
	switch(substr($filename,strlen($filename)-3,strlen($filename)))
	{
		case "swf" : 
			return "../lms/images/swf.gif";
			break;
		case "doc" : 
			return "../lms/images/doc.gif";
			break;			
		case "jpg" : 
			return "../lms/images/jpg.gif";
			break;			
		case "peg" : 
			return "../lms/images/jpg.gif";
			break;			
		case "gif" : 
			return "../lms/images/gif.gif";
			break;			
		case "pdf" : 
			return "../lms/images/pdf.gif";								
			break;
		default : 
			return "NONE";				
			break;			
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo sitename;?>Learner Home</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>
<link href="css.css" rel="stylesheet" type="text/css" />
<link href="lms.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.style1 {color: #FF3333}
-->
</style>
</head>

<body >

<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>

<table width="911" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <th height="672"  align="center"><table width="905" border="0" align="center"  cellpadding="0" cellspacing="0">
      <tr>
        <th width="199" rowspan="3" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><? include "leftpanel.php"; ?></th>
        <th height="10" align="left" valign="top" scope="col"><? include "includewelcome.php";?></th>
        </tr>
      <tr>
        <th align="center" valign="top" scope="col"><table width="646" border="0" align="center" cellpadding="0" cellspacing="0">
         <br /><tr>
            <th width="6" align="left" scope="col"><img src="imgs/topleftcorner.png" width="6" height="8" /></th>
            <th height="8" colspan="5" align="left" background="imgs/top_line.png" scope="col"></th>
            <th width="6" height="8" align="left" scope="col"><img src="imgs/toprightcorner.png" width="6" height="8" /></th>
          </tr>
          <tr>
            <th width="6" height="146" rowspan="36" align="left" background="imgs/left_line.png" scope="col"></th>
            <th height="23" colspan="5" align="left" bgcolor="#FFFFFF" scope="col"></th>
            <th width="6" rowspan="35" align="left" background="imgs/right_line.png" scope="col"></th>
          </tr>
          <tr>
            <th height="6" align="left" bgcolor="#FFFFFF" class="imagedec" scope="col"></th>
            <th height="6" colspan="4" align="left" bgcolor="#FFFFFF" class="imagedec" scope="col"><img src="imgs/mye-portfolio_img.png" width="459" height="23" /></th>
          </tr>
          <tr>
            <th height="22" colspan="5" align="left" bgcolor="#FFFFFF" scope="col"></th>
          </tr>
          <tr>
            <th height="23" align="left" bgcolor="#FFFFFF" scope="col"></th>
            <th height="23" align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" class="textlink" scope="col"><span class="textdecore3">Functional Skills </span></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th height="23" align="left" bgcolor="#FFFFFF"  scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th height="23" align="left" bgcolor="#FFFFFF" scope="col"></th>
            <th height="23" align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" class="textlink" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th height="23" align="left" bgcolor="#FFFFFF"  scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th height="28" align="left" bgcolor="#FFFFFF" scope="col"></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="initial_assesment.php" class="textlink">Initial Assessment</a></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="diagonstic_assessment.php" class="textlink">Diagnostic Assessment</a></th>
          </tr>
          
          <tr>
            <th height="29" align="left" bgcolor="#FFFFFF" scope="col"></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="functionalskills.php" class="textlink">Functional Skills Resources</a></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="pretest.php" class="textlink">PreTest</a></th>
          </tr>
          
          <tr>
            <th width="12" height="20" align="left" bgcolor="#FFFFFF" scope="col"></th>
            <th width="20" height="20" align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th width="290" align="left" bgcolor="#FFFFFF" class="textlink" scope="col"><a href="editpinfo.php" class="textlink">Personal Information</b></a><a href="#" class="textlink"></a></th>
            <th width="22" align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th width="290" height="20" align="left" bgcolor="#FFFFFF"  scope="col"><a href="viewsubject.php" class="textlink">Subjects</a><a href="#" class="textlink"></a></th>
          </tr>
          <tr>
            <th rowspan="27" align="left" bgcolor="#FFFFFF" scope="col"></th>
            <th align="left" bgcolor="#FFFFFF" scope="col"></th>
            <th align="left" bgcolor="#FFFFFF" scope="col"></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" class="textlink" scope="col"><a href="sub_lesson.php" class="textlink">Lessons</a><a href="#" class="textlink"></a></b></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" class="textlink" scope="col"><a href="viewhw.php" class="textlink">Homework</a><a href="#" class="textlink"></a></th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" class="textlink" scope="col"><a href="personaldev.php" class="textlink">Personal Development</a><a href="#" class="textlink"></a></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" class="textlink" scope="col"><a href="UploadFiles.php" class="textlink">Upload Course Work</a><a href="#" class="textlink"></a></th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" class="textlink" scope="col"><a href="DownFiles.php" class="textlink">Download Course Work</a><a href="#" class="textlink"></a></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
        
          
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><span class="textdecore3">Individual 
      Learning Plan</span></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><span class="textdecore3">Individual Learning Review</span></th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="GetAssignPlan.php" class="textlink">Download</a></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="GetAssignReview.php" class="textlink">Download</a></th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="UploadPlan.php" class="textlink">Upload</a></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="AssignReview.php" class="textlink">Upload</a></th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="javascript:downloadfile();" class="textlink">Evaluation Questionnaire</a><a href="AssignReview.php" class="textlink"></a><a href="AssignReview.php" class="textlink"></a></th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><span class="textdecore3">Learner 
              Log Book:</span></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="StudentLogBook.php" class="textlink">Add 
              Learner Log</a><a href="UploadPlan.php" class="textlink"></a></th>
            <th align="left" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
            <th align="left" bgcolor="#FFFFFF" scope="col"><a href="ViewStudentLogBook.php" class="textlink">View 
              Learner Log</a></th>
          </tr>
		  
		  
		          
          <tr>
            <th height="8" colspan="5" align="left"></th>
            <th align="left" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th height="8" colspan="5" align="left" background="imgs/bottom_line.png" scope="col"></th>
            <th width="6" align="left" scope="col"><img src="imgs/bottomrightcorner.png" width="6" height="8" /></th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th align="center" valign="top" scope="col"><a href="javascript:history.back();" class="textlink">Back</a></th>
      </tr>
      <tr>
        <th colspan="2" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><div align="center">
          <? include "includebottom.php";?>
        </div></th>
        </tr>
      
      
      
    </table>      
    </th>
  </tr>
</table>
<p class="table">&nbsp;</p>

<map name="Map2" id="Map2"><area shape="rect" coords="1,1,196,67" href="#" /></map>
<map name="Map3" id="Map3"><area shape="rect" coords="-4,-6,167,30" href="#" /></map></body>
</html>
