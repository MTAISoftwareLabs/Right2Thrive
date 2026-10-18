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
$sql="SELECT * FROM cpo_user_subject where 1=1 ";
if (isset($_REQUEST['selsub']) && $_REQUEST['selsub'] <> "0")
{
	$sql .= " and I_subjectid=".$_REQUEST['selsub'];
}
if (isset($_REQUEST['seltutor']) && $_REQUEST['seltutor'] <> "0")
{
	$sql .= " and I_tutorid=".$_REQUEST['seltutor'];
}
if (isset($_REQUEST['sellearner']) && $_REQUEST['sellearner'] <> "0")
{
	$sql .= " and I_studentid=".$_REQUEST['sellearner'];
}
/*Paging Code*/
$result = runquery1($sql);
$count1  = mysqli_num_rows($result);
$page=Ceil($count1/page_size);
if(isset($_GET['curpage']))
{
	$curpage = $_GET['curpage'];
	if($curpage==0)
	{
		$sql.=" order by I_user_subid Limit 0,".page_size;
	}
	else
	{
	$current=page_size*($curpage);
	$sql.=" order by I_user_subid Limit " .$current. ",".page_size;
	}
}
else
{
	$sql.=" order by I_user_subid Limit 0,".page_size;
	$curpage=0;
}
$rID=runquery1($sql);
$count = $rID ? mysqli_num_rows($rID) : 0;
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>List Tutor-Subject-Learner </title>
<script language="JavaScript">
function submitpage()
{
	document.frmtsl.action = "listtsl.php";
	document.frmtsl.submit();
}
function openwin(obj)
{
	window.open("assignsub.php?id="+obj,"","height=500,width=700,scrollbars=1");
}
</script>
</HEAD>
<body leftmargin="0" topmargin="0" class="seffact">
<form name="frmtsl" method="post" >
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Tutor-Subject-Learner Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tsl" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addtsl.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewtsl.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">List</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td > 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
											<tr><td height="15"></td></tr>
																
																			<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a>&nbsp;<a href="javascript:print()">Print this page</a>&nbsp;&nbsp;</td>
							</tr>
							<tr><td height="15"></td></tr>
											<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">List  Tutor-Subject-Learner</td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr > 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
					  <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
          <tr> 
            <td class="bodytext" align="center">&nbsp;Select Subject&nbsp; 
              <?php
				$selsub = "select distinct um.vSubjectName,um.iSubjectId from cpo_subjectmaster um,cpo_user_subject ur where um.iSubjectId =ur.I_subjectid order by um.vSubjectName";
				$rst = runquery($selsub);
			?>
              <select name="selsub" class="textbox">
					<option value="0">Select Subject</option>
				<?php
					while ($rssubject = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rssubject['iSubjectId']?>" <?php if (isset($_POST['selsub']) && $_POST['selsub'] == $rssubject['iSubjectId']) {?> selected <?php }?>><?php echo $rssubject['vSubjectName']?></option>
					<?php }
				?>
				</select>&nbsp; Select Tutor&nbsp;
			  <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_user_subject ur where um.iUserId =ur.I_tutorid order by um.vUserName";
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
				</select>&nbsp; Select Learner&nbsp;
			  <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_user_subject ur where um.iUserId =ur.I_studentid order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select name="sellearner" class="textbox">
					<option value="0">Select Learner</option>
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor['iUserId']?>" <?php if (isset($_POST['sellearner']) && $_POST['sellearner'] == $rstutor['iUserId']) {?> selected <?php }?>><?php echo $rstutor['vUserName']?></option>
					<?php }
				?>
				</select>&nbsp;
				<img src="./images/search.gif" style="cursor:hand" onClick="submitpage();" align="absmiddle">
			</td>
            <td>&nbsp;</td>			
          </tr>
		  <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>											
					<tr > 
                  <td align='right' class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                  <td width="3%" height="15" align="center"  class="lighttd2"></td>
				  <td height="25"  class="lighttd2"><b>Subject</b></td>
				  <td height="25"  class="lighttd2"><b>Tutor</b> </td>
				  <td height="25"  class="lighttd2"><b>Learner</b></td>
				  <td width="10%" height="25"  class="lighttd2"><b>Level</b></td>
                  
                </tr>
                        <?php if($count>0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {?>
                <tr class="whittd"> 
                  <td align="center">
                  </td>
                  <td width="32%" height="30" align=left ><a href="javascript:openwin(<?php echo $rs["I_user_subid"] ?>);">
				  <?php $sqls = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$rs["I_subjectid"];
						$querys = runquery1($sqls);
						$rows = mysqli_fetch_array($querys);
						echo ucfirst($rows['vSubjectName']); ?></a>                  </td>
				  <td width="20%" height="30" align=left >
				   <?php $sqlt = "select vUserName from cpo_usermaster where iUserId=".$rs["I_tutorid"];
						$queryt = runquery1($sqlt);
						$rowt = mysqli_fetch_array($queryt);
						echo ucfirst($rowt['vUserName']); ?> </td>
				  <td width="22%" height="30" align=left >
				  <?php   $sel = explode(';',$rs['I_studentid']);
				  $sqltu = "select vUserName from cpo_usermaster where iUserId=".$sel[0];
						$querytu = runquery1($sqltu);
						$rowtu = mysqli_fetch_array($querytu);
						echo ucfirst($rowtu['vUserName']); if(count($sel) > 1){ echo "..";} ?></td> 
				   <td height="25" ><?php echo $rs['V_sublevel']?></td>
                
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                
               
                <tr > 
                  <td height="30" colspan="3" align=left></td>
                  <td align=left>&nbsp;</td>
                  <td align=left></td>
                </tr>
				<?php
				  }
				  else
				  { ?>
				  	 <tr class="whittd"> 
                              <td align="center" height="35" colspan="5"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="5" align="center" class="error" height="28">No Tutor - Learner -Subject Information Found</td>
					</tr>	
				  <?php
				  }
			?>
                          
                          </table></td></tr>
				
										<tr> 
											<td height="22" valign="top" align="right" class="bodytext">
													<?php	if($page>1){ 
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
												<a href="./listtsl.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
										</tr>
							
							
    															
</table></td>
											</tr>
        						</table>
						</td>
    			
				</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td ></tr>
</table>
</td >
  </tr>
</table>
	
	</td>
  </tr>
</table>
	</form>

</body>
</html>
