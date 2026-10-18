<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
if(isset($_GET['id']))
{
	$flg="green";
	$msg="";
	$msg1="";
	
	$sql="select us.I_tutorid,sm.iUserId,sm.vUserName from cpo_user_subject us, cpo_usermaster sm where sm.iUserId=us.I_tutorid and us.I_tutorid='".$_GET['id']."'";
	$result=runquery1($sql);
	$num=mysqli_fetch_row($result);
	if($num > 0)
	{
		while($rslist = mysqli_fetch_array($result))
		{
				$cname=$rslist['vUserName'];
				$flg="red";
				$msg='Tutor "'.$cname.'" cannot be deleted. It is already assigned to learner.';
				$flg1="true";
				break;						
		}
	}
	else
	{
		$sql="select count(*) from cpo_tutorforcourses where iUserID='".$_GET['id']."'";
		$rIDPass=runquery1($sql);
		$rIDans=mysqli_fetch_row($rIDPass);
		if($rIDans[0]>0)
		{
			$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
			$result=runquery1($sql);
			$cname=mysqli_result($result,0,0);
			$flg="red";
			$msg=$msg.$cname."  Tutor exists in tutor - Course Integration.";
		}
		else
		{
			$sql="select count(*) from cpo_studentinfo where iTutorid='".$_GET['id']."'";
			$rIDPass=runquery1($sql);
			$rIDans=mysqli_fetch_row($rIDPass);
			if($rIDans[0]>0)
			{
				$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
				$result=runquery1($sql);
				$cname=mysqli_result($result,0,0);
				$flg="red";
				$msg=$msg.$cname."  Tutor exists in learner information utility.";	
			}
			else
			{
				$sql="select count(*) from cpo_studentlogbook where iTutorid='".$_GET['id']."'";
				$rIDPass=runquery1($sql);
				$rIDans=mysqli_fetch_row($rIDPass);
				if($rIDans[0]>0)
				{
					$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
					$result=runquery1($sql);
					$cname=mysqli_result($result,0,0);
					$flg="red";
					$msg=$msg.$cname."  Tutor exists in learner log book.";		
				}
				else
				{
					$sql="select count(*) from cpo_tutorlogbook where iTutorid='".$_GET['id']."'";
					$rIDPass=runquery1($sql);
					$rIDans=mysqli_fetch_row($rIDPass);
					if($rIDans[0]>0)
					{
						$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
						$result=runquery1($sql);
						$cname=mysqli_result($result,0,0);
						$flg="red";
						$msg=$msg.$cname."  Tutor exists in tutor log book.";
					}
					else
					{
						$sql="select count(*) from cpo_bookchattime where iTutorid='".$_GET['id']."'";
						$rIDPass=runquery1($sql);
						$rIDans=mysqli_fetch_row($rIDPass);
						if($rIDans[0]>0)
						{
							$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
							$result=runquery1($sql);
							$cname=mysqli_result($result,0,0);
							$flg="red";
							$msg=$msg.$cname."  Tutor exists in book chat time.";
						}
						else
						{
							$sql="select count(*) from cpo_ind_plan where iTutorid='".$_GET['id']."'";
							$rIDPass=runquery1($sql);
							$rIDans=mysqli_fetch_row($rIDPass);
							if($rIDans[0]>0)
							{
								$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
								$result=runquery1($sql);
								$cname=mysqli_result($result,0,0);
								$flg="red";
								$msg=$msg.$cname."  Tutor exists in learner plan.";
							}
							else
							{
												
								$sql="select count(*) from cpo_ind_review where iTutorid='".$_GET['id']."'";
								$rIDPass=runquery1($sql);
								$rIDans=mysqli_fetch_row($rIDPass);
								if($rIDans[0]>0)
								{
									$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
									$result=runquery1($sql);
									$cname=mysqli_result($result,0,0);
									$flg="red";
									$msg=$msg.$cname."  Tutor exists in learner review.";
								}
								else
								{
									 $sql="delete from cpo_usermaster where iUserId=".$_GET['id'];
									 $rscheck=runquery1($sql);
									 $msg1="Tutor deleted successfully.";
								}
							}
						}
					}
				}
			}
		}
	}
}  
elseif($_POST['txtcnt']>1)
{
	$flg="green";
	$msg="";
	$msg1="";
	
	for($count=1;$count<=$_POST['txtcnt'];$count++)
	{
	   if(isset($_POST['cbo'.$count]))
	   {
			$sql="select us.I_tutorid,sm.iUserId,sm.vUserName from cpo_user_subject us, cpo_usermaster sm where sm.iUserId=us.I_tutorid and us.I_tutorid='".$_POST['hb'.$count]."'";
			$result=runquery1($sql);
			$num=mysqli_fetch_row($result);
			if($num > 0)
			{
				while($rslist = mysqli_fetch_array($result))
				{
						$cname=$rslist['vUserName'];
						$flg="red";
						$msg='Tutor "'.$cname.'" cannot be deleted. It is already assigned to learner.';
						$flg1="true";
						break;						
				}
			}
			else
			{
				$sql="select count(*) from cpo_tutorforcourses where iUserID='".$_POST['hb'.$count]."'";
				$rIDPass=runquery1($sql);
				$rIDans=mysqli_fetch_row($rIDPass);
				if($rIDans[0]>0)
				{
					$sql="select vUserName from cpo_usermaster where iUserId='".$_POST['hb'.$count]."'";
					$result=runquery1($sql);
					$cname=mysqli_result($result,0,0);
					$flg="red";
					$msg=$msg.$cname."  Tutor exists in tutor - course integration."."!";
				}
				else
				{
					$sql="select count(*) from cpo_studentinfo where iTutorid='".$_POST['hb'.$count]."'";
					$rIDPass=runquery1($sql);
					$rIDans=mysqli_fetch_row($rIDPass);
					if($rIDans[0]>0)
					{
						$sql="select vUserName from cpo_usermaster where iUserId='".$_POST['hb'.$count]."'";
						$result=runquery1($sql);
						$cname=mysqli_result($result,0,0);
						$flg="red";
						$msg=$msg.$cname."  Tutor exists in learner information utility."."!";	
					}
					else
					{	
						$sql="select count(*) from cpo_studentlogbook where iTutorid='".$_POST['hb'.$count]."'";
						$rIDPass=runquery1($sql);
						$rIDans=mysqli_fetch_row($rIDPass);
						if($rIDans[0]>0)
						{
							$sql="select vUserName from cpo_usermaster where iUserId='".$_POST['hb'.$count]."'";
							$result=runquery1($sql);
							$cname=mysqli_result($result,0,0);
							$flg="red";
							$msg=$msg.$cname."  Tutor exists in learner log book."."!";
						}
						else
						{
							$sql="select count(*) from cpo_tutorlogbook where iTutorid='".$_POST['hb'.$count]."'";
							$rIDPass=runquery1($sql);
							$rIDans=mysqli_fetch_row($rIDPass);
							if($rIDans[0]>0)
							{
								$sql="select vUserName from cpo_usermaster where iUserId='".$_POST['hb'.$count]."'";
								$result=runquery1($sql);
								$cname=mysqli_result($result,0,0);
								$flg="red";
								$msg=$msg.$cname."  Tutor exists in tutor log book."."!";
							}
							else
							{
								$sql="select count(*) from cpo_bookchattime where iTutorid='".$_POST['hb'.$count]."'";
								$rIDPass=runquery1($sql);
								$rIDans=mysqli_fetch_row($rIDPass);
								if($rIDans[0]>0)
								{
									$sql="select vUserName from cpo_usermaster where iUserId='".$_POST['hb'.$count]."'";
									$result=runquery1($sql);
									$cname=mysqli_result($result,0,0);
									$flg="red";
									$msg=$msg.$cname."  Tutor exists in book chat time."."!";						
								}
								else
								{				
									$sql="select count(*) from cpo_ind_plan where iTutorid='".$_POST['hb'.$count]."'";
									$rIDPass=runquery1($sql);
									$rIDans=mysqli_fetch_row($rIDPass);
									if($rIDans[0]>0)
									{
										$sql="select vUserName from cpo_usermaster where iUserId='".$_POST['hb'.$count]."'";
										$result=runquery1($sql);
										$cname=mysqli_result($result,0,0);
										$flg="red";
										$msg=$msg.$cname."  Tutor exists in learner plan.";
									}
									else
									{
										$sql="select count(*) from cpo_ind_review where iTutorid='".$_POST['hb'.$count]."'";
										$rIDPass=runquery1($sql);
										$rIDans=mysqli_fetch_row($rIDPass);
										if($rIDans[0]>0)
										{
											$sql="select vUserName from cpo_usermaster where iUserId='".$_POST['hb'.$count]."'";
											$result=runquery1($sql);
											$cname=mysqli_result($result,0,0);
											$flg="red";
											$msg=$msg.$cname."  Tutor exists in learner review.";	
										}
										else
										{
											 $sql="delete from cpo_usermaster where iUserId='".$_POST['hb'.$count]."'";
											 $rscheck=runquery1($sql);
											 $msg1="Tutor deleted successfully.";
										}
									}
								}
							}
						}
					}
				}
			}
 		}
	}
}
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete Tutor</title>
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
            <td class="schoolfont" align="left">Tutor Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=tutor" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addtutor.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listtutor.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Lesson Information</td>
                                              </tr>
												 <?php
												if($flg == "red")
												{
												?>
												<tr> 
													<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
												</tr>
												<tr>
													<td colspan="2" align="center" height="35" class="error"><?php
					$id=explode("!",$msg);																							
					for($i=0;$i<count($id);$i++)
					{
						echo $id[$i];
					}
					echo "<br>First remove all the tutor information.";
													?></td>
												</tr>
												<?php
												}
												else
												{
												?>
					<tr>
					<td colspan="2" align="center" height="35" class="fontblue"><?php echo $msg1.".";?></td>								
				</tr>
				<?php }?>
												<tr> 
												  <td colspan="2" ><div align="right">&nbsp; 
													  <a href="viewtutor.php?curpage=<?php echo $_GET['curpage'] ?>"><img src="images/edit1.gif"  border="0"></a>
													  <font face=verdana size=2><b><a href="overview.php?id=tutor"><img src="images/cancel.gif"  border="0"></a></b></font>&nbsp;&nbsp; 
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
</body>
</html>
