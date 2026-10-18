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
				
						 $sql="delete from cpo_notice where noticeid=".$_GET['id'];
						 $rscheck=runquery1($sql);
						 $msg1="Notice Deleted Successfully";
				
}  
elseif($_POST['txtcnt']>1)
        {
	
			
            for($count=1;$count<=$_POST['txtcnt'];$count++)
            {
               if(isset($_POST['cbo'.$count]))
               {
			   
			   
                   			$sql="delete from cpo_notice where noticeid=" .$_POST['hb'.$count];
							$rscheck=runquery1($sql);
							$msg1="Third party deleted successfully.";
              
	           
               
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
<BODY topmargin="0" leftmargin="0" class="seffact">
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Third Party Student Admin</td>
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
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=thirdparty" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addnotice.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listnotice.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Notice</td>
                                              </tr>
												<?php if($flg=="red")
											{?>
											<tr> 
					<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
				</tr>
				<tr>
					<td colspan="2" align="center" height="35" class="error"><?php echo $msg."<br>";?>Subject Cannot be Deleted!<br>They are Integrated to Course And Tutors First Remove From There</td>
				</tr>
											<?php }
											else
											{?>
												<tr> 
												  <td height="35" colspan="2" class="fontblue" align="center"><?php echo $msg1;?></td>
												</tr>
											<?php }?>
												<tr> 
												  <td colspan="2" ><div align="right">&nbsp; 
                      <a href="viewnotice.php?curpage=<?php echo $_GET['curpage'] ?>"><img src="images/edit1.gif"  border="0"></a>
                      <font face=verdana size=2><b><a href="overview.php?id=notice"><img src="images/cancel.gif"  border="0"></a></b></font>&nbsp;&nbsp; 
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
