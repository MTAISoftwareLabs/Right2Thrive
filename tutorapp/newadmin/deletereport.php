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
} 
if(isset($_GET['id']))
{
	$sql="delete from cpo_progressreport where I_progressid=".$_GET['id'];
	$rscheck=runquery1($sql);
}  
elseif($_POST['txtcnt']>1)
{
	for($count=1;$count<=$_POST['txtcnt'];$count++)
	{
		if(isset($_POST['cbo'.$count]))
		{
			$sql="delete from cpo_progressreport where I_progressid=" .$_POST['hb'.$count];
			$rscheck=runquery1($sql);
		}             
	}
}
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete Monthly Progress Report</title>
</HEAD>
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0"   >
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

	<table width="97%"  border="0" cellspacing="0" cellpadding="0">
	<tr><td width="100%"><?php include_once('top_personal.php');?></td></tr>
  	<tr><td><table  width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout1" align="center" >
        <tr> 
          <td bgcolor="F5F8FF">&nbsp;</td>
        </tr>
		
			
		<tr><td width="100%">
		
      <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" class="schoolfont">Monthly Progress Report Admin</td>
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
                <td align="left"><table width="69%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="2%" align="left"><img src="images/left-corn-de.gif" /></td>
    <td width="27%" align="center" class="graymid"><a  href="addreport.php?rid=report" class="greendeactfont">Add</a></td>
       <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="2%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="30%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="2%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="1%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a href="listreport.php?rid=report" class="greendeactfont">List</a></td>
    <td width="5%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
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
                                              <td class="toheaderbg" colspan="3">Monthly Progress Report Information</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table>
                                </tr>
                                <tr>
                                  <td align="left"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="1">
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
							<tr>
				<td colspan="2" align="center" height="35" class="fontblue">Selected 
                    entry(ies) deleted successfully.</td>								
			</tr>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                     
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
						   <tr>
                                        <td align="center"><div align="right">&nbsp; 
                      <a href="mon_main.php?rid=report"><img src="images/edit1.gif" border="0"></a>
                      <font face=verdana size=2><b><a href="mon_main.php?rid=report"><img src="images/cancel.gif"  border="0"></a></b></font>&nbsp;&nbsp; 
                    </div></td>
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
	  <p>&nbsp;</p>
  		<p>&nbsp;</p>
  		<p>&nbsp;</p>
  
			</td>
		</tr>
      </table></td></tr>
	  </table></td></tr></table>
	
</BODY>
</HTML>
