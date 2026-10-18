<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';


if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
}?>
<html>
<head>
<title>Add News</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="txteditor.js"></script>
<script language="JavaScript">
function ad()
{
	 if(document.frmnews.txttitle.value=="")
	 {
	  alert("Please Enter Title Value");
	  document.frmnews.txttitle.focus();
	  return false;
	 }
	if(Composition.document.body.innerHTML=='')
	{
		alert('Please enter News text.');
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
			document.frmnews.features.value=Composition.document.body.innerHTML;
		}
	}
	document.frmnews.method='post';
	document.frmnews.action='addnews.php';
	document.frmnews.submit();
}
function onload()
{
	document.frmnews.txttitle.focus();
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" <?php if(!isset($_POST['txttitle'])){?> onLoad="onload()" <?php } ?>>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_POST['txtcheck']))
{
	$title=$_POST['txttitle'];
	$description=addslashes($_POST['features']);
	$createdate=date("Y-m-d");
	if(isset($_POST['chkactive']))
	{
		$status=1;
	}
	else
	{
		$status=0;
	}
	
	$addsql="insert into cpo_newsmaster values ('','".$title."','".$description."','".$createdate."',".$status.",'')";
	
	$record=runquery1($addsql);
	if($record)
	{
		$msg='News "'. $title .'" added successfully.';
	}
	else
	{
		$msg="Error in insert.";
		$flg = 'red';
	}
	$maxsql="select max(iNewsID)+1 from cpo_newsmaster";
	$result=runquery1($maxsql);
	if($result)
	{
		$id=mysqli_fetch_row($result);
		$id=$id[0];
	}
?>
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="schoolfont" align="left">News Admin</td>
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
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=news" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen">Add</td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="viewnews.php" class="greendeactfont">Edit / Delete</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="listnews.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3">News Information</td>
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
									  <?php }
																											else
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
                                        <td align="center"><div align="right"><a href="addnews.php"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="overview.php?id=news"><img src="images/cancel.gif"  border="0"></a> &nbsp;</div></td>
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
    <form action="addnews.php" name="frmnews" method="post" onSubmit="return ad();">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">News Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=news" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Add</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="viewnews.php" class="greendeactfont">Edit / Delete</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listnews.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Add News</td>
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
                  <td align=right width="22%" class="bodytext"> <div align="left">&nbsp;News 
                      Title</div></td>
                  <td align=left width="78%"><input name="txttitle" value=""  maxlength =255 class="textbox" size="65"> <font color="#FF0000">*</font> 
                  </td>
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
  if (opt==null) 
  	Composition.document.execCommand(what);
  else 
  	Composition.document.execCommand(what,"",opt);
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
                  <td align=right valign="top" class="bodytext"><div align="left">&nbsp;News 
                      Description</div></td>
                  <td align=left><table width="95%" border="0" align="left" cellpadding="3" cellspacing="1" class="table1">
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
																</script> <input type="hidden" name="data" value=""> 
                                  <?php                             
?>
                                </td>
                              </tr>
                            </table> 
                            <input type="hidden" name="hdstatus" value="1">
                            <input type="hidden" name="features" class="sampleTxtArea">
                            <input type="hidden" name="mailids" size="100" value="<?php echo $_POST['selecteditems'];?>">
                          </div></td>
                      </tr>
                    </table> <font color="#FF0000">*</font></b></font>
                    </td>
                </tr>
                <tr> 
                  <td colspan="2" align=left class="bodytext">&nbsp;&nbsp;</td>
                </tr>
                <tr> 
                  <td align=left class="bodytext">&nbsp;Image</td>
                  <td height="22" align=left><img src="images/upload.gif" onClick="passval('<?php echo $id;?>')" style="cursor:hand"> 
                  </td>
                </tr>
                <tr> 
                  <td colspan="2" align=left class="bodytext">&nbsp;&nbsp;</td>
                </tr>
                <tr> 
                  <td align=right class="bodytext"><div align="left">&nbsp;Active</div></td>
                  <td height="22" align=left> <input name="chkactive" type="checkbox" value="1" checked> 
                    <input type="hidden" name="txtcheck" value="1"></td>
                </tr>
                <tr> 
                  <td colspan="2" height="2%">&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="2"><div align="right"><font face=verdana size=2><b>&nbsp;&nbsp;<input type="image" name="image" src="images/add.gif" style="cursor:hand"> 
                      &nbsp;&nbsp;<a href="overview.php?id=news"><img src="images/cancel.gif"  border="0"></a> 
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
