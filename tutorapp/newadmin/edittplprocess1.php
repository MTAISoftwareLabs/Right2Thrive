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
} ?>
<html>
<head>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>
<?php
			
				$thirdpartyid = $_GET['tpid'];
				$oldlearnerid = $_GET['oldid'];
				
				$selectdata="select vLearnerIds from cpo_thirdpartylearner where iTId='".$thirdpartyid."'";
			 	$result=runquery1($selectdata) or die('could'.mysqli_error());
				$str="";
				$flg="";
			 
			  		$id=mysqli_result($result,0,0);
					$id1=explode(",",$id);
					$c=count($id1);
					if($c==1)
					{
							$sql="delete from cpo_thirdpartylearner where iTId=".$thirdpartyid;
							runquery1($sql) or die('error'.mysqli_error().$sql);
							$msg="Learner removed successfully.";
					}
					else
					{
							$id=explode(",",$id);
							$c=count($id)-1;										
									for($i=0;$i<count($id);$i++)
										{
												if($id[$i]==$oldlearnerid)
												{
														
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
											 
										$sql="update cpo_thirdpartylearner set vLearnerIds='".$str."'  where iTId='".$thirdpartyid."'";
															runquery1($sql) or die('error'.mysqli_error().$sql);
															$msg1="Learner removed successfully.";
															
																				
															
																}
?>


<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete Third Party - Learner Integration</title>
</HEAD>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect">
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
            <td class="schoolfont" align="left">Third Party - Learner Admin</td>
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
                                                <td class="toheaderbg" colspan="3"><b>Third Party - Learner</b> Integration Information</td>
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
												
                                            </table></td>
                                        </tr><tr> 
								<td colspan="2" height="30" align="right" style="padding-right:10px">
									<a href="viewtpl.php"><img src="./images/go_back.gif" alt="Edit Course" border="0"></a>
								</td></tr>
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
