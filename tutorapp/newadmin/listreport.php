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
$sql="SELECT * FROM cpo_progressreport where 1=1";
if (isset($_REQUEST['seltutor']) && $_REQUEST['seltutor'] <> "0")
{
	$sql .= " and I_tutorid=".$_REQUEST['seltutor'];
}
if (isset($_REQUEST['sellearner']) && $_REQUEST['sellearner'] <> "0")
{
	$sql .= " and I_userid=".$_REQUEST['sellearner'];
}
$rID=runquery1($sql);
$count = $rID ? mysqli_num_rows($rID) : 0;
/*Paging Code*/
$page=Ceil($count/page_size);
if(isset($_GET['curpage']))
{
	$curpage = $_GET['curpage'];
	if($curpage==0)
	{
		$sql.=" order by I_progressid Limit 0,".page_size;
	}
	else
	{
	$current=page_size*($curpage);
	$sql.=" order by I_progressid Limit " .$current. ",".page_size;
	}
}
else
{
	$sql.=" order by I_progressid Limit 0,".page_size;
	$curpage=0;
}
$rID=runquery1($sql);
$num = $rID ? mysqli_num_rows($rID) : 0 ;
?>
<html>
<head>
<title>List Monthly Progress Report</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
function disppage(page)
{
	document.frmreport.action = "listreport.php?curpage="+page+"&rid=report";
	document.frmreport.submit();
}
function openwin(obj)
{
	window.open("report.php?id="+obj+"&rid=report","",'height=300,width=600,scrollbars=yes,top=50 left=150');
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact">
	
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0"   >
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

	<table width="97%"  border="0" cellspacing="0" cellpadding="0">
	<tr><td width="100%" colspan="3"><?php include_once('top_personal.php');?></td></tr>
  	<tr><td colspan="3"><table  width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder" align="center" >
       	<tr><td width="100%">
			<form name="frmreport" method="post" >
			<input type="hidden" name="rid" value="report">
  		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr> 
						<td colspan="3" class="schoolfont">Monthly Progress Report Admin</td>
				</tr>
				<tr>
						<td colspan="3">&nbsp;</td>
				</tr>
				<tr> 
						<td colspan="3"> 
								
								<table width="69%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="2%" align="left"><img src="images/left-corn-de.gif" /></td>
    <td width="27%" align="center" class="graymid"><a  href="addreport.php?rid=report" class="greendeactfont">Add</a></td>
       <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="2%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="27%" align="center" class="graymid"><a href="mon_main.php?rid=report" class="greendeactfont">Edit / Delete</a></td>
    <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="2%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="30%" align="center" class="midtabgreen">List</td>
    <td width="6%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	
	</tr>
</table>
						</td>
				  </tr>
				  <tr> 
				  		<td width="100%" class="" colspan="3"> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder">
								<tr><td height="15"></td></tr>
																
																			<tr> 
								<td width="85%" align="right" colspan="3"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a>&nbsp;<a href="javascript:print()">Print this page</a>&nbsp;&nbsp;</td>
							</tr>
							<tr><td height="15"></td></tr>
								
								<tr>
                                              <td class="toheaderbg" colspan="3">List of Monthly Progress Report</td>
                                            </tr>
       
        
          <tr> 
            <td bgcolor="#FFFFFF" colspan="2"><table width="100%" cellSpacing=0 cellPadding=0 border=0 class="" align="center">
                
                <tr> 
                  <td width="6%" height="30" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td width="36%" class="lighttd2"><b>Tutor </b></td>
                  <td width="28%" class="lighttd2"><b>Learner</b></td> 
				  <td width="30%" class="lighttd2"><b>Month/Year</b></td>
                </tr>
                  <?php if($num)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
						$sqltutor = "select vUserName from cpo_usermaster where iUserId=".$rs['I_tutorid'];
						$rstutor = runquery($sqltutor);
						$num1 = $rstutor ? mysqli_num_rows($rstutor) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rstutor);
							$tutorname = $rsdata['vUserName'];
						}

						$sqlstu = "select vUserName from cpo_usermaster where iUserId=".$rs['I_userid'];
						$rsstu = runquery($sqlstu);
						$num1 = $rsstu ? mysqli_num_rows($rsstu) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rsstu);
							$stuname = $rsdata['vUserName'];
						}
                    	?>
                <tr class="whittd"> 
                <td align="center" height="28"> </td>
                <td><a href="javascript:openwin(<?php echo $rs['I_progressid'];?>);"><?php echo ucfirst($tutorname); ?></a></td>
                <td><a href="javascript:openwin(<?php echo $rs['I_progressid'];?>);"><?php echo ucfirst($stuname);?></a></td>
				<td><?php echo $rs['I_month']."/".$rs['I_year'];?></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					
				 ?>
				<?php
				}
				 else
				  { ?>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="4" align="center" class="error">No Monthly Progress Report Found.</td>
                </tr>
				  <?php }

					?>
			
              </table> </td>
          </tr>
                 <?php	if($page>1){ ?>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" class="bodytext"> 
                   <?php
												echo "Page : ";
											 for($i=1;$i<=$page;$i++)
											 {
												if($i==($curpage+1))
												{
											 ?>
                    <b><?php echo $i?></b> 
                    <?php
												}
												else
												{
													$str="";
											?>
                    <a href="javascript:disppage(<?php echo $i-1;?>)"><b><?php echo $i;?></b></a> 
                    <?php
												}									
											 }?>
                    &nbsp;&nbsp;</td>
					<td></td>
                </tr>
                <?php
				 }
			?>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
        </table>
						</td>
    			</tr>
				<tr>
                    <td width="0%"><img src="images/green_left_corn.gif" /></td>
                      <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                      <td width="0%"><img src="images/green_right_corn.gif" /></td>
                   
              </tr>
  		</table>
  	
		</form>
			</td>
		</tr>
      </table></td></tr>
	  <tr>
                    <td width="0%"><img src="images/green_left_corn.gif" /></td>
                      <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                      <td width="0%"><img src="images/green_right_corn.gif" /></td>
                   
              </tr>
	  </table></td></tr></table>
	


</form>
</body>
</html>
