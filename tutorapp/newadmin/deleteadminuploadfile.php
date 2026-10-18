<?php
@ob_start();
include_once 'dbConnection.php';
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
if(isset($_GET['id']))
{
		$selfile = "select * from cpo_uploadfilesadmin where iFileId=".$_GET['id'];
		$rsfile = runquery($selfile);
		$rsfile = mysqli_fetch_array($rsfile);		
		$uid = $rsfile[0];
        $ext = substr(strrchr($rsfile['vFilePath'], '.'), 1);		
		unlink("adminupload/".$rsfile[0].".".$ext);		
        $sql="delete from cpo_uploadfilesadmin where iFileId=".$_GET['id'];
		$rscheck=runquery1($sql);
}  
elseif($_POST['txtcnt']>1)
{
	for($count=1;$count<=$_POST['txtcnt'];$count++)
	{
	   if(isset($_POST['cbo'.$count]))
	   {
	   	 if(file_exists("adminupload/".$_POST['hb'.$count].".".$_POST['he'.$count]))
		 	unlink("adminupload/".$_POST['hb'.$count].".".$_POST['he'.$count]);
		 $sql="delete from cpo_uploadfilesadmin where iFileId=" .$_POST['hb'.$count];
		 $rscheck=runquery1($sql);
	   }
	}
}
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete Upload File</title>
</HEAD>
<BODY>

  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Admin Uploaded File Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
            <td width="1%"  height="23"><img src="./images/start.jpg" width="6" height="23"></td>
            <td width="18%" background="./images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Uploaded Files</font></div></td>
            <td width="1%" valign="top" background="./images/middle.jpg"><div align="center"><img src="./images/active_last.jpg" width="11" height="23"></div></td>
            <td width="80%" background="./images/middle_last.jpg"><div align="right"></div></td>
          </tr>
         
        </table></td>
	</tr>
	<tr> 
      <td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
          <tr> 
            <td bgcolor="F5F8FF">&nbsp;</td>
          </tr>
         
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="70%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
                <tr> 
                  <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                  <td width="652" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
                </tr>
                <tr> 
                  <td height="35" colspan="2" class="comment" align="center">Selected 
                    entrie(s) deleted successfully..</td>
                </tr>
                <tr> 
                  <td colspan="2" ><div align="right">&nbsp; 
                      <a href="viewadminuploadfile.php?curpage=<?php echo $_GET['curpage'] ?>"><img src="images/go_back.gif"  border="0"></a>
                      &nbsp;&nbsp; 
                    </div></td>
                </tr>
                <tr> 
                  <td class="headingtd" colspan="2">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
         
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
		</td>
	</tr>
</table>
</BODY>
</HTML>
