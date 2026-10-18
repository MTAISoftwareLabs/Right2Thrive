<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@ob_start();	
include "dbConnection.php";
if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><? echo sitename;?>Learner Account Summary</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="./txteditor.js"></script>
><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color:#DCEEFC;
}
-->
</style>
<link href="css.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<form name="frmex" method="post">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
 
  <tr>
    <td valign="top" width="25%" bgcolor="#FFFFFF"> 
      <? include "leftpanel.php";?>    </td> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td><? include "includewelcome.php";?></td>
      </tr>
      <tr>
        <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr> <br>
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
              <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="welcome">Account Summary</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                </table></td>
              <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
            </tr>
            <tr>
              <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;"><table class="" width="100%" align="center">
                  <?
						$sqlacc = "select uc.* from cpo_usercourse uc,cpo_coursemaster cm where cm.iCourseId=uc.iCourseId and uc.iUserId=".$_SESSION['user_id']." order by cm.iCourseOrder";
						//echo $sqlacc;
						$rsacc = runquery1($sqlacc);
						$num = $rsacc ? mysqli_num_rows($rsacc) : 0 ;
						$cname = "";
						$once = 0;
						if ($num > 0 )
						{ 
							if ($once <> 0 )
							{ ?>
                  <!--<tr><td colspan="5"><hr width="100%"></td></tr>-->
                  <? 
							}
							while ($rsdata = mysqli_fetch_array($rsacc))
							{
								$status = explode(",",$rsdata['vSubjectStatus']);
								$sqlcourse = "select vCourseName,iCourseDuration from cpo_coursemaster where iCourseId=".$rsdata['iCourseId'];
								$rscourse = runquery($sqlcourse);
								$num1 = $rscourse ? mysqli_num_rows($rscourse) : 0 ;
								$dur =0;
								if ( $num1 > 0 )
								{
									$rscs = mysqli_fetch_array($rscourse);
									$cname = $rscs['vCourseName'];
									$dur = $rscs['iCourseDuration'];
								}
									?>
                  <tr>
                    <td colspan="5"  class="forborder"><table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
                        <tr>
                          <td width="20%"></td>
                          <td width="20%"></td>
                          <td width="20%"></td>
                          <td width="20%"></td>
                          <td width="20%"></td>
                        </tr>
                        <tr bgcolor="#FFFFFF" height="10">
                          <td colspan="2" class="bodytext" height="20"><strong>Course Name</strong></td>
                          <td colspan="3" class="bodytext"><strong><? echo $cname;?></strong></td>
                        </tr>
                        <? 
								$temp = explode("-",$rsdata['dCourseDate']);
								?>
                        <tr bgcolor="#FFFFFF">
                          <td colspan="2" class="bodytext" height="20"><strong>Start Date</strong></td>
                          <td colspan="3" class="bodytext"><strong><? echo substr($temp[2],0,2)."/".$temp[1]."/".$temp[0];?></strong></td>
                        </tr>
                        <?
									
								?>
                        <tr bgcolor="#FFFFFF">
                          <td colspan="2" class="bodytext" height="20"><strong>End Date</strong></td>
                          <td colspan="3" class="bodytext"><strong><? echo date("d/m/Y",mktime(0,0,0,($temp[1]+$dur),substr($temp[2],0,2),$temp[0]));?></strong></td>
                        </tr>
                        <?	$sqlsubject = "select vSubjectName from cpo_subjectmaster where iSubjectId in (".$rsdata['vSubjectId'].")";
									$rssubject = runquery($sqlsubject);
									$tutorids = explode(",",$rsdata['vTutorId']);
									//echo $sqlsubject;
									$tind = 0;
									$num2 = $rssubject ? mysqli_num_rows($rssubject) : 0;
									if ($num2 > 0)
									{ ?>
                        <tr>
                          <td colspan="2" class="bodytext" height="20"><b><font color="#0033CC">Subject Name</font></b></td>
                          <td colspan="2" class="bodytext"><b><font color="#0033CC">Tutor Name</font></b></td>
                          <td class="bodytext"><b><font color="#0033CC">Status</font></b></td>
                        </tr>
                        <?
										$ind = 0;	
										while ($rssubjectids = mysqli_fetch_array($rssubject))
										{
											$sqlusers ="SELECT vUserName FROM cpo_usermaster WHERE iUserId=".$tutorids[$tind];
											//echo $sqlusers;
											$rsusers = runquery($sqlusers);
											$num3 = $rsusers ? mysqli_num_rows($rsusers) : 0;																			
											if ($num3 > 0)
											{
												$rstutor = mysqli_fetch_array($rsusers);
												$tname = $rstutor['vUserName'] ;
											}
											else
											{
												$tname = "";
											}
								?>
                        <tr bgcolor="#FFFFFF">
                          <td class="bodytext" colspan="2" height="20"><? echo $rssubjectids['vSubjectName'];?></td>
                          <td class="bodytext" colspan="2"><? echo $tname;?></td>
                          <?
												if (count($status) > 0)
												{
													if ($status[$ind] == 1) 
													{
													?>
                          <td class="bodytext">Complete</td>
                          <?
													}
													else
													{ ?>
                          <td class="bodytext">In Complete</td>
                          <? }
												}
												else
												{ ?>
                          <td class="bodytext">In Complete</td>
                          <?	}	
													?>
                        </tr>
                        <?						$tind++;
											$ind++;			
										} // Inner while loop end
										
									}else
									{?>
                        <tr>
                          <td colspan="5" class="bodytext" height="20" align="center"><b><font color="#0033CC">No Tutor Assigned</font></b></td>
                        </tr>
                        <?
									}
									?>
                    </table></td>
                  </tr>
                  <?
								$once = 1;
								}// outer while loop end	
					}
					else
					{ ?>
                  <tr>
                    <td colspan="5" align="center" class="bodytext">No Summary Available</td>
                  </tr>
                  <? }
					?>
              </table></td>
            </tr>
            <tr>
              <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
              <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
              <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
      </tr>
    </table>
    <p>&nbsp;</p></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
      <? include "includebottom.php";?>
</table>
</form>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
