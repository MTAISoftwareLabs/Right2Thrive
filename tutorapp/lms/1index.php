<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@ob_start();	
include "dbConnection.php";
//echo $_SESSION['user_id'];
//exit;
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		document.location ="../user_login.php";
	</script> 
<?
}
else
{
		$user_id = $_SESSION['user_id'];
}
function getIcon($filename)
{
	switch(substr($filename,strlen($filename)-3,strlen($filename)))
	{
		case "swf" : 
			return "../lms/images/swf.gif";
			break;
		case "doc" : 
			return "../lms/images/doc.gif";
			break;			
		case "jpg" : 
			return "../lms/images/jpg.gif";
			break;			
		case "peg" : 
			return "../lms/images/jpg.gif";
			break;			
		case "gif" : 
			return "../lms/images/gif.gif";
			break;			
		case "pdf" : 
			return "../lms/images/pdf.gif";								
			break;
		default : 
			return "NONE";				
			break;			
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><? echo sitename;?>Learner Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="./txteditor.js"></script>
<script language="JavaScript" type="text/javascript">
function getnewwin(obj,fid)
{
	new1=window.open("viewdownload.php?id="+obj+"&fid="+fid);
}
function openwin(obj)
{
	new1=window.open("Detail_SuggestJob.php?id="+obj,"",'height=500,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
	<tr> 
	    <td colspan="2" valign="top"><? include "includetop.php";?></td>
	</tr>
    <tr>
    <td valign="top" width="25%" style="border-right:1px solid #cccccc;"> 
      <? include "includeleft.php";?>
    </td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top"><? include "includewelcome.php";?></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Welcome</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="35" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><div align="left">&nbsp;<b>Welcome 
                    to CareerPaths Online</b></div></td>
              </tr>
              <tr> 
                <td colspan="3" class="forborder"> <table class="" width="100%" align="center">
                    <?
						$sqllogin = "select count(*) as logintimes from tracklogstudent where OperationId=1 and StudentId=".$_SESSION['user_id'];
						$rslogin = runquery1($sqllogin);
						$num = $rslogin ? mysqli_num_rows($rslogin) : 0 ;
						$logintimes = 0;
						if ($num > 0 )
						{
						 	$rslogin = mysqli_fetch_array($rslogin);
							$logintimes = $rslogin['logintimes'];
						}
						
						$lastlogintimes = "";
						$ipaddress = "";
						$sqllastlogin = "select DateTime,IPAddress  from tracklogstudent where OperationId=1 and StudentId=".$_SESSION['user_id']." order by DateTime desc";
//						echo $sqllastlogin;
						$rslastlogin = runquery1($sqllastlogin) or die(mysqli_error());
							
						$num = $rslastlogin ? mysqli_num_rows($rslastlogin) : 0 ;
						$lastlogintimes = 0;
						if ($num > 0 )
						{
						 	$rslastlogin = mysqli_fetch_array($rslastlogin);
							$lastlogintimes = $rslastlogin['DateTime'];
							
							$sdt=explode(" ",$lastlogintimes); 
							$sddt=explode("-",$sdt[0]);
							$stdt=explode(":",$sdt[1]);
															
							$sdcon=$sddt[2]."-".$sddt[1]."-".$sddt[0];
							$stcon=$stdt[0].":".$stdt[1].":".$stdt[2];
						
							$ipaddress = $rslastlogin['IPAddress'];
						}
						
						$interactive = 0;
						$sqllastlogin = "select count(*) as intreactive from tracklogstudent where OperationId=5 and StudentId=".$_SESSION['user_id']." order by datetime desc";
						$rslastlogin = runquery1($sqllastlogin);
						$num = $rslastlogin ? mysqli_num_rows($rslastlogin) : 0 ;
						if ($num > 0 )
						{
						 	$rslastlogin = mysqli_fetch_array($rslastlogin);
							$interactive = $rslastlogin['intreactive'];
						}									
					?>
                    <tr> 
                      <td colspan="5"  class="forborder"><table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
                          <tr bgcolor="#FFFFFF" height="10"> 
                            <td colspan="2" class="bodytext" height="20"><strong>Number of Login</strong></td>
                            <td width="50%" colspan="3" class="bodytext">&nbsp;<? echo $logintimes;?></td>
                          </tr>
                          <tr bgcolor="#FFFFFF"> 
                            <td colspan="2" class="bodytext" height="19"><strong>Last Login Date/Time</strong></td>
                            <td colspan="3" class="bodytext">&nbsp;<? echo $sdcon." ".$stcon;?></td>
                          </tr>
                          <tr bgcolor="#FFFFFF"> 
                            <td colspan="2" class="bodytext" height="20"><strong>Last Login Ip Address</strong></td>
                            <td colspan="3" class="bodytext">&nbsp;<? echo $ipaddress;?></td>
                          </tr>
                          <tr bgcolor="#FFFFFF"> 
                            <td colspan="2" class="bodytext" height="20"><strong>Number of Intractive Courses started</strong></td>
                            <td colspan="3" class="bodytext">&nbsp;<? echo $interactive;?></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext">&nbsp;</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
		<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">New infomation for you</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
<?				$flag=0;
//////////////  New Entry in DOWNLOAD FILES

				$sqlfiles = "SELECT vUserName,cpo_usermaster.iUserId,cpo_uploadfilestutor.iFileId,vFilePath,vUploadDate FROM cpo_uploadfilestutor,cpo_usermaster,cpo_uploadfilesviewed WHERE cpo_uploadfilesviewed.iFileId=cpo_uploadfilestutor.iFileId AND cpo_uploadfilesviewed.iUserId=".$_SESSION['user_id']." AND cpo_uploadfilestutor.iTutorId=cpo_usermaster.iUserId AND cpo_uploadfilestutor.iUserId LIKE '%".$_SESSION['user_id']."%' ORDER BY vUploadDate DESC";
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ $flag=1;
				?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><div align="left">&nbsp;<b>Download files :</b></div></td>
              </tr>
              <tr> 
                <td colspan="3" class="forborder"> <table class="" width="100%" align="center">
                    <tr> 
                      <td colspan="5"  class="forborder"><table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
					  <? while($rsresult = mysqli_fetch_array($rsfiles))
					  {
					  	$path = $rsresult['iUserId']."/".$rsresult['vFilePath'];
						?>
					      <tr bgcolor="#FFFFFF" height="10"> 
                            <td class="bodytext" width="40%" height="20">&nbsp;<a href="#" onClick="javascript:getnewwin('<? echo $path;?>','<? echo $rsresult['iFileId'];?>');"><? echo $rsresult['vFilePath'];?></a></td>
                            <td class="bodytext" width="20%">&nbsp;<? echo gdate($rsresult['vUploadDate']);?></td>
							<td class="bodytext" width="40%">&nbsp;<? echo $rsresult['vUserName'];?></td>
                          </tr>
					  <?
					  }?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
			  <?
			  }

//////////////  New Entry in JOB SUGGESTION
				$sqlfiles="select js.iJobinfoId,us.vUserName as student,j.vJobTitle as job,js.dDateOfEntry from cpo_jobsuggesioninfo js ,cpo_usermaster us ,cpo_jobmaster j where js.iviewed=0 and js.iTutorId = us.iUserId and js.iJobId=j.iJobId and js.iStudentId=".$user_id;
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ $flag=1;?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><div align="left">&nbsp;<b>Job Suggestion :</b></div></td>
              </tr>
              <tr> 
                <td colspan="3" class="forborder"> <table class="" width="100%" align="center">
                    <tr> 
                      <td colspan="5"  class="forborder"><table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
					  <? while($rslist = mysqli_fetch_array($rsfiles))
					  {	?>
					      <tr bgcolor="#FFFFFF" height="10"> 
										<td class="bodytext" width="40%">&nbsp;<a class="sidelink" href="#" onClick="javascript:openwin(<? echo $rslist['iJobinfoId'];?>)"><? echo $rslist["job"];?></a></td>
										<td class="bodytext" width="20%">&nbsp;<a class="sidelink" href="#" onClick="javascript:openwin(<? echo $rslist['iJobinfoId'];?>)"><? echo gdate($rslist['dDateOfEntry']);?></a></td>										
										<td height="20" class="bodytext" width="40%">&nbsp;<a class="sidelink" href="#" onClick="javascript:openwin(<? echo $rslist['iJobinfoId'];?>)"><? echo $rslist["student"];?></a></td>
									  </tr>
					  <?
					  }?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
			  <?
			  }


//////////////  New Entry in LEARNING PLAN
				$sqlfiles="select cpo_usermaster.vUserName,iTutorId,dDate,iIndId from cpo_ind_plan,cpo_usermaster where cpo_usermaster.iUserId=cpo_ind_plan.iTutorId and iStudentId ='".$_SESSION['user_id']."' and iflag=0";
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ $flag=1;?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><div align="left">&nbsp;<b>Learning Plan :</b></div></td>
              </tr>
              <tr> 
                <td colspan="3" class="forborder"> <table class="" width="100%" align="center">
                    <tr> 
                      <td colspan="5"  class="forborder"><table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
					  <? while($result_tutor_info = mysqli_fetch_array($rsfiles))
					  {	?>
										<tr bgcolor="#FFFFFF">
	                        				<td class="bodytext" width="40%">&nbsp;<a target="_blank" href="../download.php?id=Individual_Learning_Plan.doc"><? echo $result_tutor_info['vUserName'];?></a>&nbsp;&nbsp;&nbsp;</td>
											<td class="bodytext">&nbsp;<? echo gdate($result_tutor_info['dDate']); ?></td>
										</tr>
					  <?
					  }?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
			  <?
			  }


//////////////  New Entry in LEARNING REVIEW
				$sqlfiles="select cpo_usermaster.vUserName,iTutorId,dDate,iIndId from cpo_ind_review,cpo_usermaster where cpo_usermaster.iUserId=cpo_ind_review.iTutorId and iStudentId ='".$_SESSION['user_id']."' and iflag=0";
				$rsfiles = runquery($sqlfiles);
				$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
				if ( $num > 0 )
				{ $flag=1;?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><div align="left">&nbsp;<b>Learning Review :</b></div></td>
              </tr>
              <tr> 
                <td colspan="3" class="forborder"> <table class="" width="100%" align="center">
                    <tr> 
                      <td colspan="5"  class="forborder"><table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
					  <? while($result_tutor_info = mysqli_fetch_array($rsfiles))
					  {	?>
										<tr bgcolor="#FFFFFF">
	                        				<td class="bodytext" width="40%">&nbsp;<a target="_blank" href="../download.php?id=Individual_Learning_Plan_Review.doc"><? echo $result_tutor_info['vUserName'];?></a>&nbsp;&nbsp;&nbsp;</td>
											<td class="bodytext">&nbsp;<? echo gdate($result_tutor_info['dDate']); ?></td>
										</tr>
					  <?
					  }?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
			  <?
			  }
/////////////
					
						//$sql="SELECT * FROM cpo_usercourse where iCourseStatus=1 and iUserId=$user_id";
						$sql="select uc.* from cpo_usercourse uc,cpo_coursemaster cm where cm.iCourseId=uc.iCourseId and uc.vTutorId<>'' and uc.iUserId=$user_id order by cm.iCourseOrder";
    				//echo $sql;
    				//exit;
    				$rID=runquery1( $sql);
						$count = mysqli_num_rows($rID);
						$sr=1;
						if($count>0)
						{ $flag=1;
						?>
							<tr> 
							<td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><div align="left">&nbsp;<b>Interactive Course :</b></div></td>
							</tr>						
							<tr><td colspan="3" class="forborder">
							<table width="100%" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
							<?
							while($rslist=mysqli_fetch_array($rID))
							{
									$sql1="select vCourseName from cpo_coursemaster where iCourseId = '".$rslist["iCourseId"]."' order by iCourseOrder";
									$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
									$num = $result1 ? mysqli_num_rows($result1) : 0;
							?>
											<tr height="10">
                        						<td width="207" height="20"  class="bodytext"><b><font color="#0033CC">&nbsp;Course 
                          						Name </font></b></td>
												
                        						<td colspan="2" width="292"  class="bodytext"><b>
												<? if ($num > 0)
												{
												$name=mysqli_result($result1,0,0); echo $sr."-   ".$name; } ?></b></td>
											</tr>
											<tr height="10">
	                        				<td colspan="3" width="207" height="20"  class="bodytext"><b><font color="#0033CC">&nbsp;Subjects</font></b></td>
											</tr>
											<?
									$sql1="select vSubjectID from cpo_subjectincourse where iCourseID = '".$rslist["iCourseId"]."'";
									$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
									$num = $result1 ? mysqli_num_rows($result1) : 0;
									if ($num > 0)
									{
									$name=mysqli_result($result1,0,0);
									
										$id=explode(",", $name);
																			
										for($i=0;$i<count($id);$i++)
											{
													$sql2="select iSubjectId,vSubjectName from cpo_subjectmaster where iSubjectId= ".$id[$i]."";
													$result2=runquery1($sql2);
													$num = $result2 ? mysqli_num_rows($result2) : 0;
													if ($num > 0)
													{
														$name=mysqli_fetch_array($result2);
														?>
																<tr bgcolor="#FFFFFF">
																<td class="bodytext">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $name[1] ?></td>
																<td colspan="2" class="bodytext"><a href="javascript:previewflash('<? echo $name[0];?>')"><img src="images/starttutorial2.jpg" alt="Start Tutorial" width="125" height="30" border="0"></a></td>
															    </tr>
														<?
													}
										
																												
                               
											}
										}
							?>
							<tr bgcolor="#FFFFFF">
								<td colspan="3"><hr style="height:1px" color="blue"></td>
							</tr>
							<?							  
									$sr=$sr+1;
							}
							}
						?>
						</table>
						</td></tr>
<?
////////////
			if($flag==0)
			{
			  ?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext"><b>No new information available</b></td>
              </tr>
			<?
			}
			else
			{
			?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext">&nbsp;</td>
              </tr>
			  <?
			  }
			  ?>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
		</td></tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <? include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>