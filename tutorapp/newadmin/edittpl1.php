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
} ?>
<html>
<head>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<title>Edit Third Party - Learner Integration</title>
</head>

<script language="JavaScript">
function validation()
{
	
				
}



function win_focus()
{
	
}
</script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect" onLoad="win_focus()">
<?php
	$id = $_GET['id'];
	$tlid = $_GET['tlid'];
	//echo $tlid;
	//echo $id;
	
	$query = "select * from cpo_thirdpartylearner where iThirdLearnerId = ".$tlid;
	$result = runquery1($query); 
	$num = $result ? mysqli_num_rows($result) : 0;
?>
	
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
<?php 
if(isset($_POST['hdnsubmit'])  && $_POST['hdnsubmit'] ==1)
{
		$newlearnerid = $_POST['cmblearner'];
				$thirdpartyid = $_POST['tpid'];
				$oldlearnerid = $_POST['oldid'];
				
																							
				$selectdata="select vLearnerIds from cpo_thirdpartylearner where iTId='".$thirdpartyid."'";
				
			 	$result=runquery1($selectdata) or die('could'.mysqli_error());
				$count=mysqli_num_rows($result);
				//echo $count."count";
				$str="";
				$flg="";
			 		$id=mysqli_result($result,0,0);
			  $id1=mysqli_result($result,0,0);
			  $id1=explode(",",$id1);
			  $c=count($id1)-1;
			  $f=false;										
									for($i=0;$i<count($id1);$i++)
										{
												if($id1[$i]==$newlearnerid)
													{
													$msg="Learner Name is Already Integrate to that Third Party,Choose Another One";
													$f=true;
													}
												
										}
										if($f!=true)
										{
							
											$id=explode(",",$id);
											$c=count($id)-1;										
													for($i=0;$i<count($id);$i++)
														{
																if($id[$i]==$oldlearnerid)
																{
																	$str=$str.$newlearnerid.",";	
																}
																elseif($c!=$i)
																{
																	$str=$str.$id[$i].",";
																}
																else
																	$str=$str.$id[$i];
														}
															 $x=strlen($str);
															  $last=substr($str, $x-1, $x); 
															  if($last==',')
																	$str=substr($str, 0,$x-1); 	
															 
															
															//echo $str;
															
																			
															$sql="update cpo_thirdpartylearner set vLearnerIds='".$str."'  where iTId='".$thirdpartyid."'";
															runquery1($sql) or die('error'.mysqli_error().$sql);
															$msg="Record edited successfully.";
															$flg="green";
											}
									
													
				
					  ?>
									
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" class="schoolfont">Third Party - Learne<b>r</b> Admin</td>
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
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tpl" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addtpl.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listtpl.php" class="greendeactfont">List</a></td>
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
                                              <td class="toheaderbg" colspan="3"><b>Third Party - Learner</b> Integration  Information</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table>
                                </tr>
                                <tr>
                                  <td align="left"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1">
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>

								<tr> 
								<?php
									if($flg == "red")
									{
								?>
								<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
							</tr>
							<tr>
								<td colspan="2" align="center" height="35" class="error"><?php echo $msg; ?></td>
								<?php
								}
								else
								{
								?>
								<td colspan="2" align="center" height="35" class="fontblue"><?php echo $msg; }?></td>								
							</tr>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                     
                                     
                                    </table></td>
                                </tr>
								
							
                              </table></td>
                          </tr>
						  	<tr> 
								<td colspan="2" height="30" align="right" style="padding-right:10px">
									<a href="./viewtpl.php"><img src="./images/go_back.gif" alt="Edit Course" border="0"></a>
								</td>
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
      <?php } else {?>
 <form name="frmtutorintegrate" method="post" onSubmit="return validation()">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td align="left" class="schoolfont">Third Party - Learner Admin</td>
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
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tpl" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addtpl.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listtpl.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Edit <b>Third Party - Learner</b> Integration</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                  </tr>
                                  <tr>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        <tr>
                                          <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                                        </tr>
                       								
                		<tr> 
                  <td  width="36%" height="25">&nbsp;&nbsp;<b>Third Party</b></td>
                  <td width="64%" height="25">
				  <select name="cmbthird" class="textbox" disabled>
				  	<option value=0>Select Third Party</option>				  
				  <?php
//				  $stid=$_GET['stateid'];
				  $stqry="select * from cpo_usermaster";
				  $recourse=runquery1($stqry);
				  $num = $recourse ? mysqli_num_rows($recourse) : 0 ;
				if($num > 0)
				{
					while($rslist1 = mysqli_fetch_array($recourse))
					{
					if($rslist1['iUserId']==$tlid){?>
					<option value="<?php echo $rslist1['iUserId'];?>" selected><?php echo $rslist1['vUserName'];?></option>	
					<?php }else{ ?>
					<option value="<?php echo $rslist1['iUserId'];?>"><?php echo $rslist1['vUserName'];?></option>										
					<?php	}
					}
				}
				  ?>
				  </select>
				  <font color="red">&nbsp;*</font> </td>
				</tr>
				<tr> 
                  <td  width="36%" height="25">&nbsp;&nbsp;<b>Learner</b></td>
                  <td width="64%" height="25">
			  
  				  <select name="cmblearner" class="textbox">
				  <option value=0>Select Learner</option>
				  <?php
//				   $ctid=$_GET['cityid'];
				  $stqry="select * from cpo_usermaster where iUserType=2 and iUserStatus=1";
				  $resubject=runquery1($stqry);
				  $num = $resubject ? mysqli_num_rows($resubject) : 0 ;
				if($num > 0)
				{
					while($rslist1 = mysqli_fetch_array($resubject))
					{
					if($rslist1['iUserId']==$id){?>
					<option value="<?php echo $rslist1['iUserId'];?>" selected><?php echo $rslist1['vUserName'];?></option>	
					<?php }else{ ?>
					<option value="<?php echo $rslist1['iUserId'];?>"><?php echo $rslist1['vUserName'];?></option>										
					<?php	}
					}
				}
				  ?>
				  </select>
                    <font color="red">&nbsp;*</font> </td>
                </tr>
							
							  
                <tr>
							  <td colspan="2" height="2%">&nbsp;</td>
							</tr>
							  
							  
							  
							  
							  
							  
														
							<tr align="right"> 
								<td width="31%" height="40" class="">&nbsp;</td>
								<td width="69%"><input name="oldid" type="hidden" value="<?=$id ?>">&nbsp;
									<input name="tpid" type="hidden" value="<?=$tlid ?>">
									
									
                    <input type="hidden" name="hdnsubmit" value="1">
									<input type="image" name="imgaddarea" src="./images/update.gif" alt="Update Tutor Integrate" onClick="return validation()" class="mouse">&nbsp;
									<a href="edittplprocess1.php?tpid=<?phpecho $tlid;?>&oldid=<?phpecho $id?>">
					<img src="images/delete1.gif" border="0" alt="Cancel"></a> &nbsp;<a href="./viewtpl.php"><img src="./images/cancel.gif" border="0" alt="Cancel"></a> 
                  &nbsp;</td>
							</tr>
						
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
      </form>
      <?php }?>
    </td>
  </tr>
</table>
</body>
</html>
