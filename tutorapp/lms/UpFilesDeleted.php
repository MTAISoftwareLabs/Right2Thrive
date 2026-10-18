<?
include "dbConnection.php";

if (!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
function getIcon($filename)
{
	switch(substr($filename,strlen($filename)-3,strlen($filename)))
	{
		case "swf" : 
			return "images/swf.gif";
			break;
		case "doc" : 
			return "images/doc.gif";
			break;			
		case "jpg" : 
			return "images/jpg.gif";
			break;			
		case "peg" : 
			return "images/jpg.gif";
			break;			
		case "gif" : 
			return "images/gif.gif";
			break;			
		case "pdf" : 
			return "images/pdf.gif";								
			break;
		default : 
			return "NONE";				
			break;			
	}
}
?>
<html>
<head>
<title><? echo sitename;?>Upload files</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<?
	if(isset($HTTP_GET_VARS['id']))
	{
		$id=$HTTP_GET_VARS['id'];
		
		$qry="select * from cpo_uploadfiles where iFileId=".$id;
		$rsfile=runquery($qry);
		if($rsfile)
		{
			$numrows=mysqli_num_rows($rsfile);
			if($numrows>0)
			{
				$res_file=mysqli_fetch_array($rsfile);
				if($res_file)
				{
					$filename=$res_file['vFilePath'];
					$userid=$res_file['iUserId'];
				}
			}
		}
		
		$qry="delete from cpo_uploadfiles where iFileId=".$id;
		$res=runquery($qry);
		
		if($res)
		{
			
			if(file_exists("upload/".$userid."/".$filename))
			{
				unlink("upload/".$userid."/".$filename);
			}
			$msg="File '".$filename."' deleted successully !";
		}
		
	}
?>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><? include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
      <? include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
  </tr>
  <tr> 
    <td valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
   
		<tr>
			<td>
						
			  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr> 
					<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
					<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr> 
						  <td class="welcome">Deleted Files</td>
						  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
						</tr>
					  </table></td>
					<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
				  </tr>
				  <tr> 
	                
                <td height="50" colspan="3" class="bodytext" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center">&nbsp; 
                  <strong><? echo $msg ;?></strong> </td>
				  </tr>
				  <tr> 
                <td height="30" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center">&nbsp; 
						<a href="UploadFiles.php"><img src="images/goback.gif" border="0" alt="Go Back"></a>
                </td>
				  </tr>
				  <tr> 
					<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
					<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"> 
                  </div></td>
					<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
				  </tr>
				</table>
			</td>
		</tr>

      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
 <? include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>

</html>
