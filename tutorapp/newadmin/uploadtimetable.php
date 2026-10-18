<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} ?>
<html>
<head>
<title>Admin Upload Time Table/title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
if(isset($_GET['next']))
    {
	
			if ($_FILES['TXFILE']['type'] == "application/pdf")
			{
				move_uploaded_file($_FILES['TXFILE']['tmp_name'],"../Course_Timetable.doc");
				$upload = "File Uploaded Successfully !";	
			}
			else
			{
				$upload = "Please Upload Only .documents file Only !";
			}
			
				
				
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td>&nbsp;</td>
	</tr>
   <tr> 
    <td><h3><b>Upload Time Table Admin</b></h3></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="1%"  height="23"><img src="./images/start.jpg" width="6" height="23"></td>
          <td width="18%" background="./images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Upload 
              Time Table</font></div></td>
          <td width="1%" valign="top" background="./images/middle.jpg"><div align="center"><img src="./images/active_last.jpg" width="11" height="23"></div></td>
          <td width="80%" background="./images/middle_last.jpg"><div align="right"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td> <table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
        <tr> 
          <td bgcolor="F5F8FF">&nbsp;</td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td> <table align="center" width="70%" class="table" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="3"><img src="./images/round_corner.gif" width="3" height="20"></td>
                      <td width="100%" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
                    </tr>
                  </table></td>
              </tr>
			  
              <tr> 
                <td height="30" align="center" class="comment"><?php echo $upload; ?></td>
              </tr>
              <tr> 
                <td align="right"> <a href="./uploadtimetable.php"><img src="./images/go_back.gif" border="0" alt="Go Back">&nbsp; </a>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF" > 
                <td height="28" colspan="3" class="flipv" background="./images/line.jpg">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<?php
}
else
{

?>

	<form name="frm" action="./uploadtimetable.php?next=yes" method="post">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td><h3><b>Upload Time Table Admin</b></h3></td>
    </tr>
    <tr> 
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%"  height="23"><img src="./images/start.jpg" width="6" height="23"></td>
            <td width="18%" background="./images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Upload Time Table
                </font></div></td>
            <td width="1%" valign="top" background="./images/middle.jpg"><div align="center"><img src="./images/active_last.jpg" width="11" height="23"></div></td>
            <td width="80%" background="./images/middle_last.jpg"><div align="right"></div></td>
          </tr>
        </table> </td>
    </tr>
    <tr> 
      <td> <table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
          <tr> 
            <td bgcolor="F5F8FF">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"> <table align="center" width="70%" cellspacing="0" cellpadding="0" class="table">
                <tr> 
                  <td height="24" colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="./images/round_corner.gif" width="3" height="20"></td>
                        <td class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Upload 
                          Time Table File</strong></font></td>
                        <td width="246" class="headingtd"><div align="right"><img height=20 src="./images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="25">&nbsp;</td>
                  <td height="25" ><div align="right">&nbsp;(&nbsp;Fields marked 
                      with <font color="#FF0000">*</font>are compulsary&nbsp;)&nbsp;</div></td>
                </tr>
                <tr> 
                  <td  width="36%" height="25">&nbsp;&nbsp;Upload File</td>
                  <td width="64%" height="25" > <input type="file" name="TXFILE" class="textbox"> 
                    <font color="red">&nbsp;*</font><img style="cursor:hand" src="images/upload.gif"> </td>
                </tr>
                
                
                <tr> 
                  <td colspan="2" align="right">&nbsp;  </td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
  <?php
}
?>
</form>
</body>
</html>

