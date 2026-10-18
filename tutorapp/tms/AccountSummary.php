<?php
include "dbConnection.php";

if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
?>
<html>
<head>
<title><?php echo sitename;?>Tutor - Account Summary</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function complete()
{
	var len=document.all.length;
	var chkname;
	for(i=0;i<len;i++)
	{
		if(document.all(i).type=="checkbox" && document.all(i).checked == false)
		{
			name = document.all(i).name;
			id = String(eval("document.FRMACCSUMMARY."+name+"t").value).split("/");	
			temp = "document.FRMACCSUMMARY.t"+id[0]+"t";
			document.getElementById(id[0]).value = document.getElementById(id[0]).value + id[1] + ":";
		}
		else
		{
		}
	}	
	document.FRMACCSUMMARY.action = "AccountSummary.php?submit=1";
	return true;
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td></tr>
  <tr> 
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
      <?php include "includeleft.php";?>
    </td>
	
	<td valign="top"> 
	  <?php include "includewelcome.php";?>
	</td>
	 

  </tr>
  <tr> 
    <td valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td> <form name="FRMACCSUMMARY" method="post" onSubmit="return complete();">
		  <table width="100%" cellpadding="0" cellspacing="0"><tr>
                  <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                        <td width="98%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td class="welcome">Account Summary</td>
                              <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                            </tr>
                          </table></td>
                        <td width="11" background="images/changep_right_cor.jpg">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;"> 
                          <table class="" width="100%" align="center">
                            <?php
						if (isset($_GET['submit'])  && $_GET['submit'] == 1)
						{
							$sqlacc = "select * from cpo_usercourse where iCourseStatus=1 and vTutorId like '%".$_SESSION['user_id']."%' order by iUserId";
							$rsacc = runquery($sqlacc);
							$num = $sqlacc ? mysqli_num_rows($rsacc) : 0 ;
							if ($num > 0)
							{
								while ($rsdata = mysqli_fetch_array($rsacc))
								{
									$allsubject = explode(",",$rsdata['vSubjectId']);
									$alltutor = explode(",",$rsdata['vTutorId']);
									$status = explode(",",$rsdata['vSubjectStatus']);
									$value = $_POST["t".$rsdata['iUserCourseId']."t"];
									$t = explode(":",$value);
									$str = "";									
									if (count($allsubject) > 0)
									{
										for($i=0;$i<=count($allsubject)-1;$i++)
										{
											if (isset($_POST['CHK'.$rsdata['iUserCourseId'].$i]) && $_POST['CHK'.$rsdata['iUserCourseId'].$i] == "on")
											{
												$str .= "1,";		
											}
											else
											{
												$f = 0;
												for ($j = 0;$j<=count($t)-1;$j++)
												{
													if ($t[$j] == $i)
													{
														$f = 1;
													}
												}
												if ($f == 1)
												{
													$str .= "0,";												
												}
												else
												{
													$str .= $status[$i].",";
												}
											}
										}
									}
									else
									{
										for ($i=0;$i<=count($alltutor)-1;$i++)
										{
											if (isset($_POST['CHK'.$rsdata['iUserCourseId'].$i]) && $_POST['CHK'.$rsdata['iUserCourseId'].$i] == "on")
											{
												$str .= "1,";		
											}
											else
											{
												$f = 0;
												for ($j = 0;$j<=count($t)-1;$j++)
												{
													if ($t[$j] == $i)
													{
														$f = 1;
													}
												}
												if ($f == 1)
												{
													$str .= "0,";												
												}
												else
												{
													$str .= $status[$i].",";
												}
											}											
										}	
									}
									$sqlupdate = "update cpo_usercourse set vSubjectStatus='".substr($str,0,strlen($str)-1)."' where iUserCourseId=".$rsdata['iUserCourseId'];	
									runquery($sqlupdate);
								}
							}	
						}
						//else
						//{
							$sqlacc = "select * from cpo_usercourse where vTutorId<>'' and vTutorId like '%".$_SESSION['user_id']."%' order by iUserId";
							//echo $sqlacc;
							$rsacc = runquery1($sqlacc);
							$num = $rsacc ? mysqli_num_rows($rsacc) : 0 ;
							$cname = "";
							$uname = "";
							$once = 0;
							if ($num > 0 )
							{ 
								while ($rsdata = mysqli_fetch_array($rsacc))
								{ ?>
                            <input type="hidden" name="t<?php echo $rsdata['iUserCourseId'] ?>t" id="<?php echo $rsdata['iUserCourseId'] ?>">
                            <?php	$status = explode(",",$rsdata['vSubjectStatus']);
									if ($uname <> $rsdata['iUserId'])
									{
										$sqlcourse = "select vUserName from cpo_usermaster where iUserId=".$rsdata['iUserId'];
										$rscourse = runquery($sqlcourse);
										$num1 = $rscourse ? mysqli_num_rows($rscourse) : 0 ;
										if ( $num1 > 0 )
										{
											$rscs = mysqli_fetch_array($rscourse);
											$cname = $rscs['vUserName'];
										}
									}
									$uname = $rsdata['iUserId'];
										?>
                            <tr> 
                              <td colspan="5" class="forborder"> <table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
                                  <tr> 
                                    <td width="20%"></td>
                                    <td width="20%"></td>
                                    <td width="20%"></td>
                                    <td width="20%"></td>
                                    <td width="20%"></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2" class="bodytext"><strong>Learner 
                                      Name</strong></td>
                                    <td colspan="3" class="bodytext"><strong><?php echo $cname;?></strong></td>
                                  </tr>
                                  <?php
									$sqlsubject = "select vCourseName from cpo_coursemaster where iCourseId=".$rsdata['iCourseId'];
									$rssubject = runquery($sqlsubject);
									
									$sqlusers ="SELECT vSubjectName FROM cpo_subjectmaster WHERE iSubjectId in (".$rsdata['vSubjectId'].")";
									$rsusers = runquery($sqlusers);
									//echo $sqlusers;
									$num2 = $rssubject ? mysqli_num_rows($rssubject) : 0;
									if ($num2 > 0)
									{
										$rsc = mysqli_fetch_array($rssubject);
										$couname = $rsc['vCourseName'];
									}
									else
									{
										$couname = "";
									}
									$num3 = $rsusers ? mysqli_num_rows($rsusers) : 0;									
									if ($num3 > 0)
									{ ?>
                                  <tr> 
                                    <td colspan="2" class="bodytext"><b><font color="#0033CC">Course 
                                      Name</font></b></td>
                                    <td colspan="2" class="bodytext"><b><font color="#0033CC">Subject 
                                      Name</font></b></td>
                                    <td class="bodytext"><b><font color="#0033CC">Status</font></b></td>
                                  </tr>
                                  <?php
										$ind = 0;	
										$allsubject	= explode(",",$rsdata['vTutorId']);
										$allcomp = explode(",",$rsdata['vSubjectStatus']);
										while ($rssubjectids = mysqli_fetch_array($rsusers))
										{
											if ($allsubject[$ind] == $_SESSION['user_id'])
											{	
										?>
                                  <tr bgcolor="#FFFFFF"> 
                                    <td class="bodytext" colspan="2" height="10"><?php echo $couname;?></td>
                                    <td class="bodytext" colspan="2"><?php echo $rssubjectids['vSubjectName'];?></td>
                                    <?php
														$name = "CHK".$rsdata['iUserCourseId'].$ind;
													?>
                                    <td> <input type="checkbox" name="<?php echo $name;?>" <?php if ($allcomp[$ind] == 1) {?> checked  <?php } ?>> 
                                      <input type="hidden" name="<?php echo $name."t";?>" value="<?php echo $rsdata['iUserCourseId']."/".$ind ?>"></td>
                                  </tr>
                                  <?php					}	
											$ind++;		
										} // Inner while loop end
										?>
                                </table></td>
                            </tr>
                            <?php
										$once = 1;
									} 
								}// outer while loop end	
							}
							else
							{ ?>
                            <tr> 
                              <td colspan="5" align="center" class="bodytext"><b>No 
                                Summary Available.</b></td>
                            </tr>
                            <?php 	}
						if ($once == 1)
						{ ?>
                            <tr> 
                              <td colspan="5" align="right"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                            <?php }
						//}
						?>
                          </table></td>
                      </tr>
                    </table> </td>
                </tr><Tr><td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr > 
                <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td width="96%" height="22"background="images/changebttm_center_cor.jpg" ><div align="right">
                            <input name="image" type="image" src="images/submitbttn.jpg" align="submit">
                            </div></td>
                <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table></td></Tr></table></form></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
		
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <Tr><td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="100%"  valign="top"><?php include "includebottom.php";?></td>
        </tr>
      </table> </td></Tr>

</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>

</html>
