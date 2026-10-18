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
        $sql="delete from cpo_tutorforcourses where iTutorCourseID=".$_GET['id'];

		$rscheck=runquery1($sql) or die('could not execute'.mysqli_error());
}  
elseif($_POST['txtcnt']>1)
        {
            for($count=1;$count<=$_POST['txtcnt'];$count++)
            {
               if(isset($_POST['cbo'.$count]))
               {
                   $sql="delete from cpo_tutorforcourses  where iTutorCourseID=" .$_POST['hb'.$count];
//				   echo $sql;
				   $rscheck=runquery1($sql);
                  // echo $sql;
	           }
               
}

        }
      
        
		

?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete Course</title>
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
            <td align="left" class="schoolfont">Tutor - Course Admin</td>
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
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tutorincourse" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addtutorintegrate.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listtutorintegrate.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Tutor - Course Information</td>
                                              </tr>
												<tr> 
                  <td height="35" colspan="2" class="fontblue" align="center">Selected 
                    entry(ies) deleted successfully..</td>
                </tr>
												<tr> 
												  <td colspan="2" ><div align="right">&nbsp; 
													   <a href="viewtutorintegrate.php?curpage=<?php echo $_GET['curpage'] ?>"><img src="images/edit1.gif"  border="0"></a>
                      <font face=verdana size=2><b><a href="overview.php?id=tutorincourse"><img src="images/cancel.gif" border="0"></a></b></font>&nbsp;&nbsp; 
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
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Tutor - Course Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=tutorincourse">Overview</a></div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></div></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><font color="#000099"><a class="tablink" href="addtutorintegrate.php">Add</a></font></div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Edit 
                / Delete</div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listtutorintegrate.php">List</a></div></td>
            <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            <td width="27%" background="images/middle_last.jpg"></td>
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
                  <td height="35" colspan="2" class="fontblue" align="center">Selected 
                    entrie(s) deleted successfully.</td>
                </tr>
                <tr> 
                  <td colspan="2" ><div align="right">&nbsp; 
                      <a href="viewtutorintegrate.php?curpage=<?php echo $_GET['curpage'] ?>"><img src="images/edit1.gif"  border="0"></a>
                      <font face=verdana size=2><b><a href="overview.php?id=tutorincourse"><img src="images/cancel.gif"  border="0"></a></b></font>&nbsp;&nbsp; 
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
