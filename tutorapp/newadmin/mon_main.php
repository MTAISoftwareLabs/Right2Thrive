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
if (isset($_REQUEST['selsubject']) && $_REQUEST['selsubject'] <> "0")
{
	$sql .= " and I_subjectId=".$_REQUEST['selsubject'];
}
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
<title>Edit / Delete Monthly Progress Report</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
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
function disppage(page)
{
	document.frmreport.action = "mon_main.php?curpage="+page+"&rid=report";
	document.frmreport.submit();
}
function submitpage()
{
	document.frmreport.action = "mon_main.php";
	document.frmreport.submit();
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
			<form name="frmreport" method="post" action="deletereport.php?curpage=<?php echo $curpage;?>&rid=report" onSubmit="return validation();">
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
	<td width="2%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="30%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="2%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="1%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a href="listreport.php?rid=report" class="greendeactfont">List</a></td>
    <td width="5%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
	</tr>
</table>
						</td>
				  </tr>
				  <tr> 
				  		<td width="100%" class="" colspan="3"> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder">
								<tr>
                                              <td class="toheaderbg" colspan="3">Edit / Delete <b>Monthly Progress Report</b></td>
                                            </tr>
       
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
          <tr> 
            <td class="bodytext" align="center" colspan="2">Select Subject&nbsp; 
              <?php
				$selsub = "select distinct um.vSubjectName,um.iSubjectId from cpo_subjectmaster um,cpo_progressreport ur where um.iSubjectId =ur.I_subjectId order by um.vSubjectName";
				$rst = runquery($selsub);
			?>
              <select name="selsubject" class="textbox">
					<option value="0">Select Subject</option>
				<?php
					while ($rssub = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rssub['iSubjectId']?>" <?php if (isset($_POST['selsubject']) && $_POST['selsubject'] == $rssub['iSubjectId']) {?> selected <?php }?>><?php echo $rssub['vSubjectName']?></option>
					<?php }
				?>
				</select>
			&nbsp;Select Tutor&nbsp; 
              <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_progressreport ur where um.iUserId =ur.I_tutorid order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select name="seltutor" class="textbox">
					<option value="0">Select Tutor</option>
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor['iUserId']?>" <?php if (isset($_POST['seltutor']) && $_POST['seltutor'] == $rstutor['iUserId']) {?> selected <?php }?>><?php echo $rstutor['vUserName']?></option>
					<?php }
				?>
				</select>
            &nbsp; Select Learner&nbsp;
              <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_progressreport uc where um.iUserId=uc.I_userid order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select class="textbox" name="sellearner">
				<option value="0">Select Learner</option>				
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor['iUserId']?>" <?php if (isset($_POST['sellearner']) && $_POST['sellearner'] == $rstutor['iUserId']) {?> selected <?php }?>><?php echo $rstutor['vUserName']?></option>
					<?php }
				?>				

				</select>
				<img src="./images/search.gif" style="cursor:hand" onClick="submitpage();" align="absmiddle"></td>
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
				  <td width="18%" class="lighttd2"><b>Month/Year</b></td>
                  <td width="7%" align="center" class="lighttd2"><b>Delete</b></td>
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
                <td align="center" height="28"> <input type="checkbox" id="1" name="cbo<?php echo $cnt;?>"><input type="hidden" name="hb<?php echo $cnt;?>" value=<?php echo $rs[0];?>></td>
                <td><a href="editreport.php?id=<?php echo $rs['I_progressid'];?>" ><?php echo ucfirst($tutorname); ?></a></td>
                <td><a href="editreport.php?id=<?php echo $rs['I_progressid'];?>" ><?php echo ucfirst($stuname);?></a></td>
				<td><?php echo $rs['I_month']."/".$rs['I_year'];?></td>
                <td align="center"><a href="deletereport.php?id=<?php echo $rs['I_progressid'];?>&curpage=<?php echo $curpage;?>&rid=report"><img src="images/delete.gif" width="14" height="13" border="0"></a></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					
				 ?>
				   <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="5"  >&nbsp;</td>
				</tr> 
				<tr > 																	
                      <td class="toheaderbg1" colspan="5" height="1" ></td>
				</tr>
				 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="5"  >&nbsp;</td>
				</tr> 
                <tr > 
                  <td height="30" colspan="2" style="padding-left:20px"><input name="image" type="image" src="images/delete1.gif" ><input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                 <td colspan="7">&nbsp;</td>
                </tr>
				<?php
				}
				 else
				  { ?>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="5" align="center" class="error">No Monthly Progress Report Found.</td>
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
  		<p>&nbsp;</p>
  		<p>&nbsp;</p>
  		<p>&nbsp;</p>
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
