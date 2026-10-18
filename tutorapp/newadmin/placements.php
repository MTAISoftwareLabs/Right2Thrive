<?php
@ob_start();
include_once 'dbConnection.php';
if (!isset($_SESSION['user_id'])){?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CareerPaths Online Admin Panel</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<style>
h1 {
	margin-top: 0;
	margin-bottom: 10px;
	color: #595E66;
	background: transparent;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
}
td {
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.tabletoprow {
	background-color: #DEDEDE;
}
.tabletitles {
	color: #333;
	background-color: #DEDEDE;
	font-weight: bold;
	padding: 4px 8px;
}
.tabletitles a {
	color: #333;
	background-color: #DEDEDE;
	text-decoration: none;
}
.tabletitlessmall {
	color: #333;
	background-color: #DEDEDE;
	padding: 0px 8px 4px;
}
.tablefirstrow {
	background-color: #F7F7F7;
}
.tablesecondrow {
	background-color: #F7F7F7;
}
.formtext {
	font-weight: bold;
	padding: 5px;
	text-align: right;
	color: #666;
}
.formtextleft {
	padding: 5px;
}
.formtextleftsmall {
	padding: 5px;
}
.formtextleft3 {
	padding: 5px;
	font-weight: bold;
	color: #666;
}

</style>
</head>

<body onload="MM_preloadImages('/images/admin/icons/showcalendar_f2.gif')">
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208"><?php include_once('add.php')?></td>
	<td width="791" align="left" valign="top">
    <div id="contentinner">
		            
	<table width="97%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td height="10"></td>
	    </tr>
	  <tr>
	    <td class="schoolfont" align="left">Placement Search</td>
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
	        <td align="left"><table width="23%" border="0" cellspacing="0" cellpadding="0">
	          <tr>
	            <td width="16%" align="right"><img src="images/left-corn-ac.gif" /></td>
	            <td width="62%" align="center" class="midtabgreen"><a href="overview.php?id=category" class="greendeactfont">Overview</a></td>
	            <td width="22%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
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
	                            <td height="29" colspan="3" class="toheaderbg">&nbsp;</td>
	                            </tr>
	                          </table></td>
	                        </tr>
	                      </table></td>
	                    </tr>
	                  <tr>
	                    <td align="center">&nbsp;</td>
	                    </tr>
	                  <tr>
	                    <td align="center"><table width="64%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
	                      <tbody>
	                        <tr class="tabletoprow">
	                          <td class="tabletitles" colspan="2">Select the date range of Placement(s) you are looking for</td>
	                          </tr>
	                        <tr class="tablefirstrow">
	                          <td width="36%" class="formtext">From (Date):</td>
	                          <td width="64%"><input name="EmployedFrom2" class="textbox" type="textbox" />
	                            <img src="images/showcalendar.gif" alt="Select Date" name="EmployedFromCalendar" border="0" class="space" id="EmployedFromCalendar" title="Select Date" /></td>
	                          </tr>
	                        <tr class="tablefirstrow">
	                          <td class="formtext">To (Date):</td>
	                          <td><input name="EmployedTo2" class="textbox" type="textbox" />
	                            <img src="images/showcalendar.gif" alt="Select Date" name="EmployedToCalendar" border="0" class="space" id="EmployedToCalendar" title="Select Date" /></td>
	                          </tr>
	                        <tr class="tabletoprow">
	                          <td class="tabletitles" colspan="2">Vacancy information</td>
	                          </tr>
	                        <tr class="tablefirstrow">
	                          <td class="formtext">Vacancy ID:</td>
	                          <td><input name="VacancyID2" size="10" class="textbox" onblur="VerifyField(this)" onkeyup="VerifyField(this)" type="textbox" /></td>
	                          </tr>
	                        <tr class="tablefirstrow">
	                          <td class="formtext">Vacancy Title:</td>
	                          <td><input name="VacancyTitle2" size="40" class="textbox" onblur="VerifyField(this)" onkeyup="VerifyField(this)" type="textbox" /></td>
	                          </tr>
	                        <tr class="tabletoprow">
	                          <td class="tabletitles" colspan="2">Candidate information</td>
	                          </tr>
	                        <tr class="tablefirstrow">
	                          <td class="formtext">Forenames:</td>
	                          <td><input name="CandidateFirstName2" size="40" class="textbox" onblur="VerifyField(this)" onkeyup="VerifyField(this)" type="textbox" /></td>
	                          </tr>
	                        <tr class="tablefirstrow">
	                          <td class="formtext">Surname:</td>
	                          <td><input name="CandidateSurname2" size="40" class="textbox" onblur="VerifyField(this)" onkeyup="VerifyField(this)" type="textbox" /></td>
	                          </tr>
	                        <tr class="tablefirstrow">
	                          <td class="formtext">&nbsp;</td>
	                          <td><input type="image" name="submit2" id="submit2" src="images/search.gif" /></td>
	                          </tr>
	                        <script type="text/javascript">
					document.FilterForm.EmployedFrom.DataType="Date";
					document.FilterForm.EmployedTo.DataType = "Date";
					document.FilterForm.VacancyID.DataType = "Number";
				        </script>
	                        </tbody>
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
	<br />	            
  <h1>&nbsp; </h1>
</div>
    </td>
  </tr>
</table>


</body>
</html>
