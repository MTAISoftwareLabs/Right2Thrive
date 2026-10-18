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
} 
if(isset($_GET['id']))
{
		$selfile = "select iUserId,vFilePath from cpo_uploadfiles where iFileId=".$_GET['id'];
		$rsfile = runquery($selfile);
		$rsfile = mysqli_fetch_array($rsfile);		
		$uid = $rsfile[0];
		unlink(NEWADMIN_LMS_FILES_BASE . "/upload/" . $rsfile[0] . "/" . $rsfile[1]);		
        $sql="delete from cpo_uploadfiles where iFileId=".$_GET['id'];
		$rscheck=runquery1($sql);
		$selfile = "select vFilePath from cpo_uploadfiles where iUserId=".$uid;
		$rsfile = runquery($selfile);
		$num = $rsfile ? mysqli_num_rows($rsfile) : 0 ;
		if($num == 0)
		{
			rmdir(NEWADMIN_LMS_FILES_BASE . "/upload/" . $uid);
		}

}  
elseif($_POST['txtcnt']>1)
{
	for($count=1;$count<=$_POST['txtcnt'];$count++)
	{
	   if(isset($_POST['cbo'.$count]))
	   {
		   unlink(NEWADMIN_LMS_FILES_BASE . "/upload/" . $_POST['hbu' . $count] . "/" . $_POST['hbp' . $count]);			
		   $sql="delete from cpo_uploadfiles where iFileId=" .$_POST['hb'.$count];
		   $rscheck=runquery1($sql);
			$selfile = "select vFilePath from cpo_uploadfiles where iUserId=".$_POST['hbu'.$count];
			$rsfile = runquery($selfile);
			$num = $rsfile ? mysqli_num_rows($rsfile) : 0 ;
			if($num == 0)
			{
				rmdir(NEWADMIN_LMS_FILES_BASE . "/upload/" . $_POST['hbu' . $count]);
			}
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

  <?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td align="left" class="schoolfont"> Upload File Admin</td>
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
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=upfiles" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listuploadfile.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"></td>
    <td width="25%" align="center" ></td>
    <td width="0%" align="left"></td>
	
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
                                                <td class="toheaderbg" colspan="3"><b>Upload File Information </b></td>
                                              </tr>
												    <tr> 
                  <td height="35" colspan="2" class="comment" align="center">Selected 
                    entrie(s) deleted successfully..</td>
                </tr>
                <tr> 
                  <td colspan="2" ><div align="right">&nbsp; 
                      <a href="viewuploadfile.php?curpage=<?php echo $_GET['curpage'] ?>"><img src="images/edit1.gif" width="73" height="22" border="0"></a>
                      <font face=verdana size=2><b><a href="overview.php?id=upfile"><img src="images/cancel.gif" width="73" height="22" border="0"></a></b></font>&nbsp;&nbsp; 
                    </div></td>
                </tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                  </tr>
                                  <tr>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        
                                    
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
    </td>
  </tr>
</table>
  

</BODY>
</HTML>
