<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
if(isset($_GET['id']))
{
	$sql="select * from cpo_usermaster where I_schoolid = ".$_GET['id'];
	$result=runquery1($sql);
	$cname=mysqli_fetch_array($result);
	$num  =mysqli_num_rows($result);
	if($num>0)
	{
		 $flg="red";
	}
	else
	{
		$sql="delete from cpo_school where I_schoolid=".$_GET['id'];
		$rscheck=runquery1($sql);
	}	
}  
elseif($_POST['txtcnt']>1)
{
	$sql1="select * from cpo_usermaster where I_schoolid !=0";
	$result1=runquery1($sql1);
	while($rslist = mysqli_fetch_array($result1))
	{
		$id = @array_push($id,$rslist["I_schoolid"]);
	}
	for($i=0;$i<=$_POST['txtcnt'];$i++)
	{
		$val = $_POST['cbo'.$i];
		if($_POST['cbo'.$i] != '')
		{
			$sql="select * from cpo_usermaster where I_schoolid = ".$_POST['cbo'.$i];
			$rIDPass=runquery1($sql);
			$rIDans=mysqli_num_rows($rIDPass);
			$sqle="select * from cpo_school where I_schoolid =".$_POST['cbo'.$i];
			$resulte=runquery1($sqle);
			$cname=mysqli_fetch_array($resulte);
			if($rIDans>0)
			{
				$flg="red";
				 $msg=$msg.ucfirst($cname['I_schoolname']).",";
				$flg1="true";
				break;
			}
			else
			{
				$sql="delete from cpo_school where I_schoolid=" .$_POST['cbo'.$i];
				$rscheck=runquery1($sql);
				$flg1="false";
			}
		}
	}
}
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete School</title>
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
            <td class="schoolfont" align="left">School Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=school" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addschool.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listschool.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">School Information</td>
                                              </tr>
												<?php if($flg=="red")
											{?>
													
													<tr> 
					<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
				</tr>
				<tr>
					<td colspan="2" align="center" height="35" class="error">School already assigned to learner.</td>
				</tr>
											<?php }
											 else
											 {?>
												<tr> 
												  <td height="35" colspan="2" class="fontblue" align="center">Selected entry(ies) deleted successfully.</td>
												</tr>
											<?php }?>
												
												<tr> 
												  <td colspan="2" ><div align="right">&nbsp; 
													  <a href="viewschool.php"><img src="images/edit1.gif"  border="0"></a>
													  <font face=verdana size=2><b><a href="overview.php?id=school"><img src="images/cancel.gif"  border="0"></a></b></font>&nbsp;&nbsp; 
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
