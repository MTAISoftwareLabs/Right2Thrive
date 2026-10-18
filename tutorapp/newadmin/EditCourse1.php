<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
if (!isset($_SESSION['user_id']))
{?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
function clean_string($str)
{
//	$str = htmlspecialchars(str_replace("\'", "'", trim($str)));
//	$str = rtrim($str);	
//	$str = str_replace("'", "\'", $str);
	return $str;
}
$courseid = $_GET['id'];
$query = "select * from cpo_coursemaster where iCourseId = ".$courseid."";
$result = runquery1($query) or die('could note execute'.mysqli_error());
$num = mysqli_num_rows($result);
$rslist = mysqli_fetch_array($result);
?>
<html>
<head>
<title>Edit Course</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="txteditor.js"></script>
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript" src="./txteditor.js"></script>
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
function validation(aid)
{
	if(document.frmcourse.txtCourseName.value=="")
	{
		alert("Course Name can not be blank!");
		document.frmcourse.txtCourseName.focus();
		return false;
	}
	if(Composition.document.body.innerHTML=='')
	{
		alert('Please enter Course Summary.');
		return false;
	}
	if(Composition.document.body.innerHTML!="")
	{
		var str;
		str	=Composition.document.body.innerHTML;
		str1=str.indexOf("<IMG");
	
		if(parseInt(str1)!=-1)
		{
			alert('You are not allowed to enter images in features');
			return false;
		}
		else
		{
			document.frmcourse.features.value=Composition.document.body.innerHTML;
		}
	}
	if(document.frmcourse.txtCourseDuration.value=="")
	{
		alert("Course Duration can not be blank!");
		document.frmcourse.txtCourseDuration.focus();
		return false;
	}
	if(document.frmcourse.txtCourseDurationwords.value=="")
	{
		alert("Course Duration (in words) can not be blank!");
		document.frmcourse.txtCourseDurationwords.focus();
		return false;
	}
	return true;
}
function onload()
{
	document.frmcourse.txtCourseName.focus();
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_POST['txtCourseName'])) {?> onLoad="onload()" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top"><?php 

if(isset($_POST['txtCourseName']))
{
	$Course_id=$_POST['id'];
	$Course_name=$_POST['txtCourseName'];
	$Course_desc=addslashes($_POST['features']);
	$Course_duration=$_POST['txtCourseDuration'];
	$Course_durationwords=$_POST['txtCourseDurationwords'];
	$Course_fees=$_POST['txtCourseFees'];
	if(isset($_POST['chkactive']))
	{
		$active=1;
	}
	else
	{
		$active=0;
	}
	$sql="update cpo_coursemaster set vCourseName='". $Course_name ."',tCourseDesc='".$Course_desc."', iCourseDuration='".$Course_duration."',fCourseFees='".$Course_fees."',iStatus='".$active."', vCourseDuration='".$Course_durationwords."' where iCourseId=".$Course_id;
	$rscheck=runquery1($sql) or die('could not'.mysqli_error());
	$flg="green";
	$msg='Course "'.$Course_name.'" successfully edited.';
			?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">Course Admin</td>
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
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=course" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
					   <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="addcourse.php" class="greendeactfont">Add</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listcourse.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3">Course Information</td>
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

									 <?php if($flg == 'red')
																					{?>
									  <tr>
										<td height="35" align="center"><img src="./images/alert.gif" border="0"></td>
									  </tr>
									  <tr>
										<td  align="center" height="35" class="error"><?php echo $msg; ?></td>
									  </tr>
									  <?php }else
																											{?>
									  <tr>
										<td align="center"><font class="fontblue"><b><?php echo $msg ?></b></font> </td>
									  </tr>
									  <tr>
										<td align="center">&nbsp;</td>
									  </tr>
									  <?php
																					
																					} ?>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="center"><div align="right"><a href="./viewcourse.php"><img src="./images/go_back.gif" alt="Edit Course" border="0"></a> &nbsp;</div></td>
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
     <form action="EditCourse.php?id=<?php echo $courseid;?>" name="frmcourse" method="post" onSubmit="return validation(<?php echo $rslist["iCourseId"]; ?>);">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Course Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=course" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addcourse.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit/Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listcourse.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Edit Course</td>
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
                  <td width="24%" height="30" class="" >&nbsp;&nbsp;Course Name &nbsp;&nbsp;</td>
								<td width="76%" >&nbsp;&nbsp;<input name="txtCourseName" type="text" class="textbox" size="40" value="<?php echo $rslist["vCourseName"]; ?>">
                    <font color="#FF0000"> *</font></td>
							</tr>
							<tr>
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							 <script language="JavaScript">
bLoad=false
pureText=true
bodyTag="<BODY class=textbox  MONOSPACE STYLE=\"font:10pt arial,sans-serif\">"
bTextMode=false
public_description=new Editor

function Editor() {
	this.put_html=SetHtml;
	this.get_html=GetHtml;
	this.put_text=SetText;
	this.get_text=GetText;
	this.CompFocus=GetCompFocus;
}
function GetCompFocus() {
	Composition.focus();
}

function GetText() {
	return Composition.document.body.innerText;
}

function SetText(text) {
	text = text.replace(/\n/g, "<br>")
	Composition.document.body.innerHTML=text;
}

function GetHtml() {
	if (bTextMode) 
		return Composition.document.body.innerText;
	else {
		cleanHtml();
		cleanHtml();
		return Composition.document.body.innerHTML;
	}
}

function SetHtml(sVal) {
	if (bTextMode) Composition.document.body.innerText=sVal;
	else Composition.document.body.innerHTML=sVal;
}

var YInitialized = false;
function document.onreadystatechange(){
	if (YInitialized) return;
	YInitialized = true;
	var i, s, curr;
	// Find all the toolbars and initialize them.
	for (i=0; i<document.body.all.length; i++) {
		curr=document.body.all[i];
		if (curr.className == "Btn" && !InitBtn(curr))
			alert("Toolbar: " + curr.id + " failed to initialize. Status: false");
	}

}

function InitBtn(btn) {
	btn.onmouseover = BtnMouseOver;
	btn.onmouseout = BtnMouseOut;
	btn.onmousedown = BtnMouseDown;
	btn.onmouseup = BtnMouseUp;
	btn.ondragstart = YCancelEvent;
	btn.onselectstart = YCancelEvent;
	btn.onselect = YCancelEvent;
	btn.YUSERONCLICK = btn.onclick;
	btn.onclick = YCancelEvent;
	btn.YINITIALIZED = true;
	return true;
}

// Hander that simply cancels an event
function YCancelEvent() {
	event.returnValue=false;
	event.cancelBubble=true;
	return false;
}

function BtnMouseOver() {
	if (event.srcElement.tagName != "IMG") return false;
	var image = event.srcElement;
	var element = image.parentElement;
	if (image.className == "Ico") element.className = "BtnMouseOverUp";
	else if (image.className == "IcoDown") element.className = "BtnMouseOverDown";
	event.cancelBubble = true;
}

function BtnMouseOut() {
	if (event.srcElement.tagName != "IMG") {
		event.cancelBubble = true;
		return false;
	}
	var image = event.srcElement;
	var element = image.parentElement;
	yRaisedElement = null;
	element.className = "Btn";
	image.className = "Ico";
	event.cancelBubble = true;
}

function BtnMouseDown() {
  if (event.srcElement.tagName != "IMG") {
    event.cancelBubble = true;
    event.returnValue=false;
    return false;
  }
  var image = event.srcElement;
  var element = image.parentElement;

  element.className = "BtnMouseOverDown";
  image.className = "IcoDown";

  event.cancelBubble = true;
  event.returnValue=false;
  return false;
}

function BtnMouseUp() {
  if (event.srcElement.tagName != "IMG") {
    event.cancelBubble = true;
    return false;
  }

  var image = event.srcElement;
  var element = image.parentElement;

  if (element.YUSERONCLICK) eval(element.YUSERONCLICK + "anonymous()");

  element.className = "BtnMouseOverUp";
  image.className = "Ico";

  event.cancelBubble = true;
  return false;
}



// Check if toolbar is being used when in text mode
function validateMode() {
  if (! bTextMode) return true;
  alert("Please uncheck the \"View HTML source\" checkbox to use the toolbars");
  Composition.focus();
  return false;
}

function sendHtml(){
	if(bTextMode){
		document.composeForm.body.value = public_description.get_text();
		return true;
	}
	else{
		document.composeForm.body.value = public_description.get_html();
		return true;
	}
}

//Formats text in composition.
function formatC(what,opt) {
  if (!validateMode()) return;
  if (opt=="removeFormat") {
    what=opt;
    opt=null;
  }
  if (opt==null) Composition.document.execCommand(what);
  else Composition.document.execCommand(what,"",opt);
  pureText = false;
  Composition.focus();
}

//Switches between text and html mode.
function setMode(newMode) {
  bTextMode = newMode;
  var cont;
  if (bTextMode) {
    cleanHtml();
    cleanHtml();
    cont=Composition.document.body.innerHTML;
    Composition.document.body.innerText=cont;
  } else {
    cont=Composition.document.body.innerText;
    Composition.document.body.innerHTML=cont;
  }
  
  Composition.focus();
}

//Finds and returns an element.
function getEl(sTag,start) {
  while ((start!=null) && (start.tagName!=sTag)) start = start.parentElement;
  return start;
}

function createLink() {
  if (!validateMode()) return;
  
  var isA = getEl("A",Composition.document.selection.createRange().parentElement());
  var str=prompt("Enter url:", isA ? isA.href : "http:\/\/");
  
  if ((str!=null) && (str!="http://")) {
    if (Composition.document.selection.type=="None") {
      var sel=Composition.document.selection.createRange();
      sel.pasteHTML("<A HREF=\""+str+"\" target='_blank'>"+str+"</A> ");
      sel.select();
    }
    else formatC("CreateLink",str);
  }
  else Composition.focus();
}

//Sets the text color.
function foreColor() {
  if (! validateMode()) return;
  var arr = showModalDialog("/ym/ColorSelect?3", "", "font-family:Verdana; font-size:12; dialogWidth:30em; dialogHeight:35em");
  if (arr != null) formatC('forecolor', arr);
  else Composition.focus();
}

//Sets the background color.
function backColor() {
  if (!validateMode()) return;
  var arr = showModalDialog("/ym/ColorSelect?3", "", "font-family:Verdana; font-size:12; dialogWidth:30em; dialogHeight:35em");
  if (arr != null) formatC('backcolor', arr);
  else Composition.focus()
}
function cleanHtml() {
  var fonts = Composition.document.body.all.tags("FONT");
  var curr;
  for (var i = fonts.length - 1; i >= 0; i--) {
    curr = fonts[i];
    if (curr.style.backgroundColor == "#ffffff") curr.outerHTML = curr.innerHTML;
  }
}
function getPureHtml() {
  var str = "";
  var paras = Composition.document.body.all.tags("P");
  if (paras.length > 0) {
    for (var i=paras.length-1; i >= 0; i--) str = paras[i].innerHTML + "\n" + str;
  } else {
    str = Composition.document.body.innerHTML;
  }
  return str;
}
		</script>
							  <tr> 
								
                  <td class="bodytext">&nbsp;&nbsp;Course Summary</td>
								<td align=left>&nbsp;&nbsp;<table width="95%" border="0" align="left" cellpadding="3" cellspacing="1" class="table1">
                      <tr bgcolor="#eeeeee"> 
                        <td width="80%" height="25"> <div align="left"> 
                            <table cellpadding="3" cellspacing="0" border="0">
                              <tr> 
                                <td height="119"> <div class="yToolbar" id="ParaToolbar"> 
                                    <div class="TBHandle"> </div>
                                    <select name="select" class="TBGen" id="ParagraphStyle" title="Paragraph Format" onChange="formatC('formatBlock',this[this.selectedIndex].value);this.selectedIndex=0" language="javascript">
                                      <option class="heading" selected> Paragraph 
                                      <option value="&lt;H1&gt;"> Heading 1 &lt;H1&gt; 
                                      <option value="&lt;H2&gt;"> Heading 2 &lt;H2&gt; 
                                      <option value="&lt;H3&gt;"> Heading 3 &lt;H3&gt; 
                                      <option value="&lt;H4&gt;"> Heading 4 &lt;H4&gt; 
                                      <option value="&lt;H5&gt;"> Heading 5 &lt;H5&gt; 
                                      <option value="&lt;H6&gt;"> Heading 6 &lt;H6&gt; 
                                      <option value="&lt;PRE&gt;"> Formatted &lt;PRE&gt; 
                                      <option value="removeFormat"> Remove All 
                                    </select>
                                    <select name="select" class="TBGen" id="FontName" title="Font Name" onChange="formatC('fontname',this[this.selectedIndex].value);this.selectedIndex=0" language="javascript">
                                      <option class="heading" selected> Font 
                                      <option value="Arial"> Arial 
                                      <option value="Arial Black"> Arial Black 
                                      <option value="Arial Narrow"> Arial Narrow 
                                      <option value="Comic Sans MS"> Comic Sans 
                                      MS 
                                      <option value="Courier New"> Courier New 
                                      <option value="System"> System 
                                      <option value="Times New Roman"> Times New 
                                      Roman 
                                      <option value="Verdana"> Verdana 
                                      <option value="Wingdings"> Wingdings 
                                    </select>
                                    <select name="select" class="TBGen" id="FontSize" title="Font Size" onChange="formatC('fontsize',this[this.selectedIndex].value);this.selectedIndex=0" language="javascript">
                                      <option class="heading" selected> Size 
                                      <option value="1"> 1 
                                      <option value="2"> 2 
                                      <option value="3"> 3 
                                      <option value="4"> 4 
                                      <option value="5"> 5 
                                      <option value="6"> 6 
                                      <option value="7"> 7 
                                    </select>
                                    <select name="select" class="TBGen" id="FontColor" title="Font Color" onChange="formatC('forecolor',this[this.selectedIndex].value);this.selectedIndex=0" language="javascript">
                                      <option class="heading" selected> Color 
                                      <option value="red"> Red 
                                      <option value="blue"> Blue 
                                      <option value="green"> Green 
                                      <option value="black"> Black 
                                    </select>
                                    <select name="select" class="TBGen" id="FontBackColor" title="Font Back Color" onChange="formatC('backcolor',this[this.selectedIndex].value);this.selectedIndex=0" language="javascript">
                                      <option class="heading" selected> Background 
                                      <option value="red"> Red 
                                      <option value="blue"> Blue 
                                      <option value="green"> Green 
                                      <option value="black"> Black 
                                      <option value="yellow"> Yellow 
                                      <option value=""> White 
                                    </select>
                                    <div class="TBSep"> </div>
                                    <!--<div id="EditMode" class="TBGen" title="Editing Mode"> 
                                <input type="checkbox" name="switchMode" LANGUAGE="javascript" onClick="setMode(switchMode.checked)">
                                <a href="#" onClick="document.composeForm.switchMode.click()"><font color="#000000" face="Arial" size="2"> 
                                View HTML source</font></a> | <a href="Javascript:formatC('formatBlock','removeFormat')"> 
                                <font color="#000000" face="Arial" size="2">Clear 
                                Format</font></a> </div>-->
                                  </div>
                                  <table>
                                    <tr> 
                                      <td><div class="Btn" title="Cut" language="javascript" onClick="formatC('cut')"><img class="Ico" src="images/cut.gif"></div></td>
                                      <td><div class="Btn" title="Copy" language="javascript" onClick="formatC('copy')"><img class="Ico" src="images/copy.gif"></div></td>
                                      <td><div class="Btn" title="Paste" language="javascript" onClick="formatC('paste')"><img class="Ico" src="images/paste.gif"></div></td>
                                      <td><div class="Btn" title="Bold" language="javascript" onClick="formatC('bold');"><img class="Ico" src="images/bold.gif"></div></td>
                                      <td> <div class="Btn" title="Italic" language="javascript" onClick="formatC('italic')"><img class="Ico" src="images/italic.gif"> 
                                        </div></td>
                                      <td> <div class="Btn" title="Underline" language="javascript" onClick="formatC('underline')"><img class="Ico" src="images/under.gif"> 
                                        </div></td>
                                      <td> <div class="Btn" title="Align Left" name="Justify" language="javascript" onClick="formatC('justifyleft')"><img class="Ico" src="images/aleft.gif"> 
                                        </div></td>
                                      <td> <div class="Btn" title="Center" name="Justify" language="javascript" onClick="formatC('justifycenter')"><img class="Ico" src="images/center.gif"> 
                                        </div></td>
                                      <td> <div class="Btn" title="Align Right" name="Justify" language="javascript" onClick="formatC('justifyright')"><img class="Ico" src="images/aright.gif"> 
                                        </div></td>
                                      <td> <div class="Btn" title="Numbered List" language="javascript" onClick="formatC('insertorderedlist')"><img class="Ico" src="images/nlist.gif"> 
                                        </div></td>
                                      <td> <div class="Btn" title="Bulletted List" language="javascript" onClick="formatC('insertunorderedlist')"><img class="Ico" src="images/blist.gif"> 
                                        </div></td>
                                      <td> <div class="Btn" title="Decrease Indent" language="javascript" onClick="formatC('outdent')"><img class="Ico" src="images/ileft.gif"> 
                                        </div></td>
                                      <td> <div class="Btn" title="Increase Indent" language="javascript" onClick="formatC('indent')"><img class="Ico" src="images/iright.gif"> 
                                        </div></td>
                                      <td> <div class="Btn" title="Create Hyperlink" language="javascript" onClick="createLink()"><img class="Ico" src="images/wlink.gif"> 
                                        </div></td>
                                    </tr>
                                  </table>
                                  <iframe class="Composition" width="100%" id="Composition" height="190" ></iframe> 
                                  <input type="hidden" name="detail" class="textbox"> 
                                  <script><!--
							Composition.document.open();
							Composition.document.write(bodyTag);
							Composition.document.close();
							Composition.document.designMode="On";
							// -->
							</script> 
                                  <input type="hidden" name="data" value="<?php echo ereg_replace("\"","'",$rslist["tCourseDesc"]);?>"> 
                                </td>
                              </tr>
                            </table>
                            <br>
                            <input type="hidden" name="hdstatus" value="1">
                            <input type="hidden" name="features" class="sampleTxtArea" value="">
                            <script language="JavaScript">
								alert('Do you want to edit course');
								Composition.document.body.innerHTML=document.frmcourse.data.value;
								//Composition.document.body.innerHTML=desc;
							</script>
                          </div></td>
                      </tr>
                    </table> 
                    </td>
							  </tr>
							<td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  
                <tr> 
                  <td class="bodytext">&nbsp;&nbsp;Course Duration</td>
								<td align=left>&nbsp;&nbsp;<input name="txtCourseDuration" type="text" class="textbox" size="9" value="<?php echo $rslist["iCourseDuration"]; ?>">
                    <font color="#FF0000"> *</font> (In Months)</td>
							  </tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
                <tr> 
                  <td class="bodytext">&nbsp;&nbsp;Course Duration (in words)</td>
								<td align=left>&nbsp;&nbsp;<input name="txtCourseDurationwords" type="text" class="textbox" size="40" value="<?php echo $rslist["vCourseDuration"];?>" maxlength="50">
                    <font color="#FF0000"> *</font></td>
							  </tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  <tr> 
								
                  <td class="bodytext">&nbsp;&nbsp;Course Fees</td>
								<td align=left>&nbsp;&nbsp;<input name="txtCourseFees" type="text" class="textbox" size="9" value="<?php echo $rslist["fCourseFees"]; ?>" onBlur="chkfloat(this)">
                    <font color="#FF0000"> *</font> (In Pounds) </td>
							  </tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  
							  <tr> 
                  <td  height="28" valign="top" class="bodytext">&nbsp;&nbsp;Active</td>
                  <td align=left valign="top">&nbsp;&nbsp;
                    <?php
					
				  if (intval($rslist["iStatus"])==0)
				  {
				  ?>
                    <input type="checkbox" name="chkactive" value="0"> 
                    <?php
				}
				else
				{
				?>
                    <input type="checkbox" name="chkactive" value="1" checked>
                    <?php
				 }
				 ?>
                    <input type="hidden" name="txtchk" value="1"><input type="hidden" name="txtnewsid" value="<?php echo $newsid ?>"> </td>
                </tr>
							  
							  
														
							<tr align="right"> 
								<td width="24%" height="40" class="">&nbsp;</td>
								<td width="76%">
									<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Course"  class="mouse">&nbsp;
									<input name="id" type="hidden" value="<?=$rslist["iCourseId"]?>">
									<a href="./viewcourse.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a>
								&nbsp;</td>
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
