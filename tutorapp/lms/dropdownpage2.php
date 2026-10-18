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
<link rel="stylesheet" href="acc_css/jquery.ui.all.css">
	<link rel="stylesheet" href="acc_css/demos.css">
<script src="acc_js/jquery-1.8.3.js"></script>
	<script src="acc_js/jquery.ui.core.js"></script>
	<script src="acc_js/jquery.ui.widget.js"></script>
	<script src="acc_js/jquery.ui.accordion.js"></script>	
	<script>
	$(function() {
		$( "#accordion" ).accordion({
			event: "click hoverintent",
			heightStyle: "content",
			collapsible: true, active: false
		});
	});

	var cfg = ($.hoverintent = {
		sensitivity: 7,
		interval: 100
	});

	$.event.special.hoverintent = {
		setup: function() {
			$( this ).bind( "mouseover", jQuery.event.special.hoverintent.handler );
		},
		teardown: function() {
			$( this ).unbind( "mouseover", jQuery.event.special.hoverintent.handler );
		},
		handler: function( event ) {
			var that = this,
				args = arguments,
				target = $( event.target ),
				cX, cY, pX, pY;

			function track( event ) {
				cX = event.pageX;
				cY = event.pageY;
			};
			pX = event.pageX;
			pY = event.pageY;
			function clear() {
				target
					.unbind( "mousemove", track )
					.unbind( "mouseout", arguments.callee );
				clearTimeout( timeout );
			}
			function handler() {
				if ( ( Math.abs( pX - cX ) + Math.abs( pY - cY ) ) < cfg.sensitivity ) {
					clear();
					event.type = "hoverintent";
					// prevent accessing the original event since the new event
					// is fired asynchronously and the old event is no longer
					// usable (#6028)
					event.originalEvent = {};
					jQuery.event.handle.apply( that, args );
				} else {
					pX = cX;
					pY = cY;
					timeout = setTimeout( handler, cfg.interval );
				}
			}
			var timeout = setTimeout( handler, cfg.interval );
			target.mousemove( track ).mouseout( clear );
			return true;
		}
	};
	</script>
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
            <th height="6" colspan="4" align="left" bgcolor="#FFFFFF" style="padding:10px;" class="imagedec" scope="col"><img src="imgs/mye-portfolio_img.png" width="459" height="23" /></th>
          </tr>
          <tr>
            <th height="22" colspan="5" align="left" bgcolor="#FFFFFF" scope="col"></th>
          </tr>
         
          <tr>
            <th height="23" align="left" bgcolor="#FFFFFF" scope="col"></th>
            
            <td align="left" colspan="" scope="" style="padding:10px;background:#FFFFFF;">
<div id="accordion">
	<h3>Functional Skills</h3>
	<div>
		<ul>
			<li><a href="initial_assesment.php" class="textlink">Initial Assessment</a></li>
			<li><a href="diagonstic_assessment.php" class="textlink">Diagnostic Assessment</a></li>
			<li><a href="functionalskills.php" class="textlink">Functional Skills Resources</a></li>
			<li><a href="pretest.php" class="textlink">PreTest</a></li>
			<li><a href="editpinfo.php" class="textlink">Personal Information</a></li>
			<!--<li><a href="viewsubject.php" class="textlink">Subjects</a></li>
			<li><a href="sub_lesson.php" class="textlink">Lessons</a></li>-->			
			<li><a href="personaldev.php" class="textlink">Personal Development</a></li>
			<li><a href="UploadFiles.php" class="textlink">Upload Course Work</a></li>
			<li><a href="DownFiles.php" class="textlink">Download Course Work</a></li>
		</ul>
	</div>
        <h3>Homework</h3>
        <div>
             <ul>
                        <li><a href="viewhw.php" class="textlink">Homework</a></li>
             </ul>
        </div>    
	<h3>Individual Learning Plan</h3>
	<div>
		<ul>
			<li><a href="GetAssignPlan.php" class="textlink">Download</a></li>
			<li><a href="UploadPlan.php" class="textlink">Upload</a></li>		
		</ul>
	</div>
	<h3>Individual Learning Review</h3>
	<div>		
		<ul>
			<li><a href="GetAssignReview.php" class="textlink">Download</a></li>
			<li><a href="AssignReview.php" class="textlink">Upload</a></li>		
			<li><a href="javascript:downloadfile();" class="textlink">Evaluation Questionnaire</a></li>
		</ul>
	</div>
	<h3>Learner Log Book</h3>
	<div>
		<ul>
			<li><a href="StudentLogBook.php" class="textlink">Add Learner Log</a></li>
			<li><a href="ViewStudentLogBook.php" class="textlink">View Learner Log</a></li>					
		</ul>
	</div>
</div>
</div></td>
            </tr>
        
		   
          <tr>
            <th height="22" colspan="5" align="left" bgcolor="#FFFFFF" scope="col"></th>
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
