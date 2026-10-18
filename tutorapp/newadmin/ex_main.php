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
if(isset($_REQUEST['search']))
{
	 $learner = $_POST['CMBLEARNER'];
	$tutor = $_POST['CMBTUTOR'];
	if($learner != 0)
	{
		$sqlspn .= "  and I_userid=".$learner;
	}
	if($tutor != 0)
	{
		$sqlspn .= "  and i_tutorid=".$tutor;
	}
	
}
else
{
	$sqlspn =$sqlspn;
}

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
<title>Edit / Delete  Exclusion</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript" src="./calendar1.js"></script> 
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
function win_onload()
{
document.frm_exclusion.CMBTUTOR.focus();
}
function search_det()
{

/*	if(document.frm_exclusion.CMBTUTOR.value == "0"  &&  document.frm_exclusion.CMBLEARNER.value == "0")
	{
		alert("Please select tutor or learner!");
		
		return false;
	}*/
	document.frm_exclusion.action ='ex_main.php?rid=exc&search=yes';
	document.frm_exclusion.method ='post';
	document.frm_exclusion.submit();
}
function validation()
{
	var len=document.all.length;
	var flag = 0;
	for(i=0;i<len;i++)
	{
		if(document.all(i).type=="checkbox" && document.all(i).id==1)
		{
			if (document.all(i).checked == true)
			{
				flag = 1;
			}
		}
	}
	if (flag == 0)
	{
		alert("First Select Item !");
		return false;
	}	
	return true;
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact" onLoad="win_onload()">
	
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0"   >
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

<table width="97%"  border="0" cellspacing="0" cellpadding="0">
	<tr><td width="100%" colspan="3"><?php include_once('top_personal.php');?></td></tr>
  	<tr><td colspan="3"><table  width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder" align="center" >
       	<tr><td width="100%">
				<form name="frm_exclusion" method="post" action="deleteexc.php?curpage=<?php echo $curpage;?>&rid=exc" onSubmit="return validation();">
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
	<td width="2%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="30%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="2%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="1%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a href="listex.php?rid=exct" class="greendeactfont">List</a></td>
    <td width="5%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
	</tr>
</table>
						</td>
				  </tr>
				  <tr> 
				  		<td width="100%" class="" colspan="3"> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder">
								<tr>
                                              <td class="toheaderbg" colspan="3">Edit / Delete Exclusion Report</td>
                                            </tr>
       <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
          <tr> 
            <td class="bodytext" align="center">&nbsp;Select Tutor&nbsp; 
              <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster as  um,cpo_detention as d where um.iUserId =d.i_tutorid order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select name="CMBTUTOR" class="textbox">
					<option value="0">Select Tutor</option>
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor['iUserId']?>" <?php if (isset($_POST['CMBTUTOR']) && $_POST['CMBTUTOR'] == $rstutor[1]) {?> selected <?php }?>><?php echo $rstutor[0]?></option>
					<?php }
				?>
				</select>
              &nbsp;&nbsp;&nbsp;Select Learner&nbsp;&nbsp; 
              <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster as  um,cpo_detention as d where um.iUserId=d.I_userid order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select class="textbox" name="CMBLEARNER">
				<option value="0">Select Learner</option>				
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor['iUserId']?>" <?php if (isset($_POST['CMBLEARNER']) && $_POST['CMBLEARNER'] == $rstutor[1]) {?> selected <?php }?>><?php echo $rstutor[0]?></option>
					<?php }
				?>				

				</select>&nbsp;&nbsp;
				<img src="./images/search.gif" style="cursor:hand" onClick="search_det();" align="absmiddle">
			</td>
            <td>&nbsp;</td>			
          </tr>
		  <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF" colspan="2"><table width="100%" cellSpacing=0 cellPadding=0 border=0 class="" align="center">
                
               <tr> 
                  <td width="5%" height="32" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td width="18%" class="lighttd2"><b>Tutor </b></td>
                  <td width="18%" class="lighttd2"><b>Learner</b></td> 
				  <td width="18%" class="lighttd2"><b>Exclusion Date</b></td>
				  <td width="18%" class="lighttd2"><b>Exclusion Reason</b></td>
                  <td width="7%" align="center" class="lighttd2"><b>Delete</b></td>
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
                <td align="center" height="28"> <input type="checkbox" id="1" name="cbo<?php echo $cnt;?>"><input type="hidden" name="hb<?php echo $cnt;?>" value=<?php echo $rs['I_detentionid'];?>></td>
                <td><a href="editexc.php?rid=exc&id=<?php echo $rs['I_detentionid'];?>"><?php echo ucfirst($tutor); ?></a></td>
                <td><?php echo ucfirst($learner);?></td>
				<td><?php  $date = explode('-', $rs['D_detention']); echo $date[2]."/".$date[1]."/".$date[0];?></td>
				<td><?php echo ucfirst($rs['V_reason']);?></td>
                <td align="center"><a href="deleteexc.php?rid=exc&id=<?php echo $rs['I_detentionid'];?>&curpage=<?php echo $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					
				 ?>
				  <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="6"  >&nbsp;</td>
				</tr> 
				<tr > 																	
                      <td class="toheaderbg1" colspan="6" height="1" ></td>
				</tr>
				 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="6"  >&nbsp;</td>
				</tr> 
                <tr >
                <tr > 
                  <td height="30" colspan="2" style="padding-left:20px"><input name="image" type="image" src="images/delete1.gif" ><input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                 <td colspan="7">&nbsp;</td>
                </tr>
				<?php
				}
				 else
				  { ?>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="8" align="center" class="error">No Exclusion Report Found.</td>
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
                    <a href="ex_main.php?rid=exc&curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a> 
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
