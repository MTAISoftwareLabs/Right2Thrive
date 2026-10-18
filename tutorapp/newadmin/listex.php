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

$curpage = 0;
$page_size=10;
$sqlspn ='select * from  cpo_detention  where C_flag = "E" ';
$result = runquery1($sqlspn) or die('could not execuate'.mysqli_error());
$count = mysqli_num_rows($result);
if(isset($_GET['curpage']))
	{
		$curpage = $_GET['curpage'];
		if($curpage==0)
		{
			$sqlspn.=" order by D_detention Limit 0,".page_size;
		}
		else
		{
			$current=page_size*($curpage);
			$sqlspn.=" order by D_detention Limit " .$current. ",".page_size;
		}
	}
	else
	{
		$sqlspn.=" order by D_detention Limit 0,".page_size;
		$curpage=0;
	}
	$result1=runquery1($sqlspn);
	$count1=mysqli_num_rows($result1);
	?>
<html>
<head>
<title>List Exclusion</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript" src="./calendar1.js"></script> 
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
function display(sid)
{
	window.open("listex_info.php?type=E&sid="+sid,null,"width=700,height=350,scrollbars=yes");
}

</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" >
	
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0"   >
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

<table width="97%"  border="0" cellspacing="0" cellpadding="0">
	<tr><td width="100%" colspan="3"><?php include_once('top_personal.php');?></td></tr>
  	<tr><td colspan="3"><table  width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder" align="center" >
       	<tr><td width="100%">
			<form name="frm_exclusion" method="post" >
			<input type="hidden" name="rid" value="exc">
  		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr> 
						<td colspan="3" class="schoolfont">Exclusion Admin</td>
				</tr>
				<tr>
						<td colspan="3">&nbsp;</td>
				</tr>
				<tr> 
						<td colspan="3"> 
								
								<table width="69%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="2%" align="left"><img src="images/left-corn-de.gif" /></td>
    <td width="27%" align="center" class="graymid"><a  href="addex.php?rid=exc" class="greendeactfont">Add</a></td>
       <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="2%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="27%" align="center" class="graymid"><a href="ex_main.php?rid=exc" class="greendeactfont">Edit / Delete</a></td>
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
                                              <td class="toheaderbg" colspan="3">List of Exclusion Report </td>
                                            </tr>
       
        
          <tr> 
            <td bgcolor="#FFFFFF" colspan="2"><table width="100%" cellSpacing=0 cellPadding=0 border=0 class="" align="center">
                
            <tr> 
				<td width="5%" height="28"  class="lighttd2"></td>
                   <td width="18%" class="lighttd2"><b>Tutor </b></td>
                  <td width="18%" class="lighttd2"><b>Learner</b></td> 
				  <td width="18%" class="lighttd2"><b>Exclusion Date</b></td>
				  <td width="18%" class="lighttd2"><b>Exclusion Reason</b></td>
                 </tr>
                 <?php if($count1>0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($result1))
                    { 
						//tutor
						$sql_t = "select vUserName  from cpo_usermaster where iUserId =".$rs['i_tutorid'];
						$res_t = runquery1($sql_t);
						$fet_t = mysqli_fetch_array($res_t);
						$tutor = $fet_t['vUserName'];
						//learner
						$sql_l = "select vUserName  from cpo_usermaster where iUserId =".$rs['I_userid'];
						$res_l = runquery1($sql_l);
						$fet_l = mysqli_fetch_array($res_l);
						$learner = $fet_l['vUserName'];
						
                    	?>
                <tr class="whittd"> 
				<td width="5%"></td>
                <td  height="28"><a href="#" onClick="display(<?php echo $rs['I_detentionid'];?>)"><?php echo ucfirst($tutor); ?></a></td>
                <td><?php echo ucfirst($learner);?></td>
				<td><?php  $date = explode('-', $rs['D_detention']); echo $date[2]."/".$date[1]."/".$date[0];?></td>
				<td><?php echo ucfirst($rs['V_reason']);?></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					
				}
				 else
				  { ?>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="5" align="center" class="error">No Exclusion Report Found.</td>
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
                    <a href="listex.php?rid=exc&curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a> 
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
