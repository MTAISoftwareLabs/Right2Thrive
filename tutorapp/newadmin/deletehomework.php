<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
if(isset($_GET['id']))
{
	$sqlh = "select * from cpo_user_homework where I_hid =".$_GET['id'];
	$queryh = runquery1($sqlh);
	$numr = @mysqli_num_rows($queryh);
	if($numr>0)
	{
		$flg = "green";
	}
	else
	{
		$sql="delete from cpo_homework where I_homeworkid=".$_GET['id'];
		$rscheck=runquery1($sql);
	}
}  
elseif($_POST['txtcnt']>1)
{
	for($count=1;$count<=$_POST['txtcnt'];$count++)
	{
		if(isset($_POST['cbo'.$count]))
		{
			$sqlh = "select * from cpo_user_homework where I_hid=".$_POST['hb'.$count];
			$queryh = runquery1($sqlh);
			$numr = @mysqli_num_rows($queryh);
			if($numr>0)
			{
				$flg = "green";
			}
			else
			{
				$sql="delete from cpo_homework where I_homeworkid =" .$_POST['hb'.$count];
				$rscheck=runquery1($sql);
			}
		}             
	}
}
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete Homework</title>
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
            <td class="schoolfont" align="left">Homework Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=homework" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addhomework.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listhomework.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Homework Information</td>
                                              </tr>
												 <?php
					if($flg == "green")
					{
					?>
					<tr> 
					<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
				</tr>
				<tr>
					<td colspan="2" align="center" height="35" class="error">Homework is already assigned.</td>
				</tr>
					<?php
					}
					else
					{
					?>
					<tr>
					<td colspan="2" align="center" height="35" class="fontblue">Selected 
						entry(ies) deleted successfully.</td>								
				</tr>
				<?php }?>
												<tr> 
												  <td colspan="2" ><div align="right">&nbsp; 
													  <a href="viewhomework.php"><img src="images/edit1.gif"  border="0"></a>
													  <font face=verdana size=2><b><a href="overview.php?id=homework"><img src="images/cancel.gif"  border="0"></a></b></font>&nbsp;&nbsp; 
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
</body>
</html>
