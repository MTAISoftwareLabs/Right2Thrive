<?php
@ob_start();
include_once 'dbConnection.php';
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete User</title>
</HEAD>
<?php
if (!isset($_SESSION['user_id']))
{?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
$flg="";
$msg="";
$msg1="";
$active1="";
$str="";
$filename="";
$status="";
if(isset($_GET['active']))
{
		for($count=1;$count<=$_POST['txtcnt']-1;$count++)
		{
				$str="chk".$count;
						if(isset($_POST[$str]))
						{
							$abc="hb".$count;
							$check="select iUserStatus from cpo_usermaster where iUserId=".$_POST[$abc];
							$resultfetchname=runquery1($check);
							$num1 = $resultfetchname ? mysqli_num_rows($resultfetchname) : 0 ;
							if ($num1 > 0)
								$status=mysqli_result($resultfetchname,0,0);
							if($status==0)
							{
								
											$query="update cpo_usermaster set iUserStatus=1 where iUserId=".$_POST[$abc];
											$query1="update cpo_usercourse set iCourseStatus=1 where iUserId=".$_POST[$abc];
											$rscheck=runquery1($query) or die('error'.mysqli_error());
											$rscheck=runquery1($query1) or die('error'.mysqli_error());
							
											$fetchname="select vUserEmailId,vUserName,vUserPassword from cpo_usermaster where iUserId=".$_POST[$abc];
											$resultfetchname=runquery1($fetchname);
											$emailid=mysqli_result($resultfetchname,0,0);
											$username=mysqli_result($resultfetchname,0,1);
											$pwd = mysqli_result($resultfetchname,0,2);
											$msg = "Congratulations ! Your account has been Approved successfully.";
										
								//Sending mail 
											$fromname="Administrator of CareerPaths Online";
											//$fromaddress=getAdminEmail();
											$toname=$username;
											$toaddress=$emailid;
											$subject="Member Registration approved for CareerPaths Online";
											$message=
											"<html><SPAN style='FONT-SIZE: 10pt; FONT-FAMILY: Verdana'>
												<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Dear ".$username." ,<?xml:namespace prefix = o ns = 'urn:schemas-microsoft-com:office:office' /><o:p></o:p></SPAN></P>
												<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>&nbsp;<o:p></o:p></SPAN></P>
								
												<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Welcome to <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>careerpathsonline.net</SPAN></B>!!! We, congratulate you on your decision to become a member of the CareerPaths Online – <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>careerpathsonline.net</SPAN></B>!!! <SPAN style='mso-spacerun: yes'>&nbsp;</SPAN><o:p></o:p></SPAN></P>
												<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>&nbsp;<o:p></o:p></SPAN></P>
												
												<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Your User Name : <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>".$emailid."</SPAN></B><SPAN style='mso-spacerun: yes'>&nbsp;</SPAN><o:p></o:p></SPAN></P>
												<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Your Password  : <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>".$pwd."</SPAN></B><SPAN style='mso-spacerun: yes'>&nbsp;</SPAN><o:p></o:p></SPAN></P>				
												<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>&nbsp;<o:p></o:p></SPAN></P>
												<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>&nbsp;<o:p></o:p></SPAN></P>
												<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Your Profile has been activated, please visit <a href='www.careerpathsonline.net'>www.careerpathsonline.net</a> to check the status. If the profile / postings is not active, please write to <a href='mailto:webmaster@careerpathsonline.net;'>webmaster@careerpathsonline.net</a><o:p></o:p></SPAN></P>				
												";
												$mailflg=SendingMail($fromname, admin_email,"Administrator" ,$toaddress, $subject, $message);
							}
							
						  }
	
	
						else
						{
							$abc="hb".$count;
							
							$query="update cpo_usermaster set iUserStatus=0 where iUserId=".$_POST[$abc];
							$query1="update cpo_usercourse set iCourseStatus=0,vTutorId='' where iUserId=".$_POST[$abc];
							$rscheck=runquery1($query) or die('error'.mysqli_error());
							$rscheck=runquery1($query1) or die('error'.mysqli_error());
							
						}
			}
  $active1="true";
}


if(isset($_GET['id']))
{
	$sql="select us.I_studentid,sm.iUserId,sm.vUserName from cpo_user_subject us, cpo_usermaster sm where sm.iUserId=us.I_studentid and us.I_studentid='".$_GET['id']."'";
	$result=runquery1($sql);
	$num=mysqli_fetch_row($result);
	if($num > 0)
	{
		while($rslist = mysqli_fetch_array($result))
		{
			$cname=$rslist['vUserName'];
			$flg="red";
			$msg='Student "'.$cname.'" cannot be deleted. It is already assigned a subject.';
			$flg1="true";
			break;						
		}
	}
	else
	{
		$sql = "select vLearnerIds,iTId from cpo_thirdpartylearner where vLearnerIds like '%".$_GET['id']."%'";
		$result=runquery1($sql);
		while($rslist = mysqli_fetch_array($result))
		{
			$id=$rslist['vLearnerIds'];
			$thirdpartyid=$rslist['iTId'];
			$id1=explode(",",$id);
			$str='';
			$c=count($id1);
			if($c==1)
			{
					$sql="delete from cpo_thirdpartylearner where iTId=".$thirdpartyid;
					runquery1($sql) or die('error'.mysqli_error().$sql);
			}
			else
			{
				$id=explode(",",$id);
				$c=count($id);										
				for($i=0;$i<count($id);$i++)
				{
					if($id[$i]==$_GET['id'])
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
			}
		}
		$sql = "select iUserId,iFileId,iTutorId,vFilePath from cpo_uploadfilestutor where iUserId like '%".$_GET['id']."%'";
		$result=runquery1($sql);
		while($rslist = mysqli_fetch_array($result))
		{
			$str='';
			$id=$rslist['iUserId'];
			$fileid=$rslist['iFileId'];
			$tutorid=$rslist['iTutorId'];
			$filename=$rslist['vFilePath'];
			$id1=explode(",",$id);
			$c=count($id1);
			if($c==1)
			{
				$sql="delete from cpo_uploadfilestutor where iFileId=".$fileid;
				runquery1($sql) or die('error'.mysqli_error().$sql);
				
				if(file_exists("../tms/upload/".$tutorid."/".$filename))
				{
						unlink("../tms/upload/".$tutorid."/".$filename);
				}
			}
			else
			{
				$id=explode(",",$id);
				$c=count($id);										
				for($i=0;$i<count($id);$i++)
				{
					if($id[$i]==$_GET['id'])
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
				
				$sql="update cpo_uploadfilestutor set iUserId ='".$str."'  where iFileId='".$fileid."'";
				runquery1($sql) or die('error'.mysqli_error().$sql);
			}
		}
		$query1="delete from cpo_usermaster where iUserId=".$_GET['id'];
		$query2="delete from cpo_usercourse where iUserId=".$_GET['id'];
		$query3="delete from cpo_studentinfo where iStudentid='".$_GET['id']."'";
		$query4="delete from cpo_studentlogbook where iStudentid='".$_GET['id']."'";
		$query5="delete from cpo_tutorlogbook where iStudentid='".$_GET['id']."'";
		$query6="delete from cpo_bookchattime where iUserid='".$_GET['id']."'";
		$query7="delete from cpo_ind_plan where iStudentId='".$_GET['id']."'";
		$query8="delete from cpo_ind_review where iStudentId='".$_GET['id']."'";
		$sql = "select vFilePath from cpo_uploadfiles where iUserId='".$_GET['id']."'";
		$result=runquery1($sql);
		$num1 = $result ? mysqli_num_rows($result) : 0 ;
		if ($num1 > 0 )
		{
				$filename=mysqli_result($result,0,0);
		}
		$query9="delete from cpo_uploadfiles where iUserId='".$_GET['id']."'";
		if (file_exists(NEWADMIN_LMS_FILES_BASE . "/upload/" . $_GET['id'] . "/" . $filename))
		{
				unlink(NEWADMIN_LMS_FILES_BASE . "/upload/" . $_GET['id'] . "/" . $filename);
		}
		
		$query10="delete from cpo_jobsuggesioninfo where iStudentId='".$_GET['id']."'";
		$query11="delete from tracklogstudent where StudentId='".$_GET['id']."'";
		$rscheck=runquery1($query1);
		$rscheck=runquery1($query2);
		$rscheck=runquery1($query3);
		$rscheck=runquery1($query4);
		$rscheck=runquery1($query5);
		$rscheck=runquery1($query6);
		$rscheck=runquery1($query7);
		$rscheck=runquery1($query8);
		$rscheck=runquery1($query9);
		$rscheck=runquery1($query10);
		$rscheck=runquery1($query11);
	}
}
elseif($_POST['txtcnt']>1)
{
	for($count=1;$count<=$_POST['txtcnt'];$count++)
	{
	   if(isset($_POST['cbo'.$count]))
	   { 
			
			$sql="select us.I_studentid,sm.iUserId,sm.vUserName from cpo_user_subject us, cpo_usermaster sm where sm.iUserId=us.I_studentid and us.I_studentid='".$_GET['id']."'";
			$result=runquery1($sql);
			$num=mysqli_fetch_row($result);
			if($num > 0)
			{
				while($rslist = mysqli_fetch_array($result))
				{
					$cname=$rslist['vUserName'];
					$flg="red";
					$msg='Student "'.$cname.'" cannot be deleted. It is already assigned a subject.';
					$flg1="true";
					break;						
				}
			}
			else
			{
				$sql = "select vLearnerIds,iTId from cpo_thirdpartylearner where vLearnerIds like '%".$_POST['hb'.$count]."%'";
				
				$result=runquery1($sql);
				while($rslist = mysqli_fetch_array($result))
				{
					$str='';
					$id=$rslist['vLearnerIds'];
					$thirdpartyid=$rslist['iTId'];
					
					$id1=explode(",",$id);
					$c=count($id1);
					if($c==1)
					{
						$sql="delete from cpo_thirdpartylearner where iTId=".$thirdpartyid;
						runquery1($sql) or die('error'.mysqli_error().$sql);
					}
					else
					{
						$id=explode(",",$id);
						$c=count($id);										
						for($i=0;$i<count($id);$i++)
						{
							if($id[$i]==$_POST['hb'.$count])
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
					}
				}
									
				$sql = "select iUserId,iFileId,iTutorId,vFilePath from cpo_uploadfilestutor where iUserId like '%".$_POST['hb'.$count]."%'";
				$result=runquery1($sql);
				while($rslist = mysqli_fetch_array($result))
				{
					$str='';
					$id=$rslist['iUserId'];
					$fileid=$rslist['iFileId'];
					$tutorid=$rslist['iTutorId'];
					$filename=$rslist['vFilePath'];
					$id1=explode(",",$id);
					$c=count($id1);
					if($c==1)
					{
						$sql="delete from cpo_uploadfilestutor where iFileId=".$fileid;
						runquery1($sql) or die('error'.mysqli_error().$sql);
						
						if(file_exists("../tms/upload/".$tutorid."/".$filename))
						{
							unlink("../tms/upload/".$tutorid."/".$filename);
						}
					}
					else
					{
						$id=explode(",",$id);
						$c=count($id);										
						for($i=0;$i<count($id);$i++)
						{
							if($id[$i]==$_POST['hb'.$count])
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
						
						$sql="update cpo_uploadfilestutor set iUserId ='".$str."'  where iFileId='".$fileid."'";
						runquery1($sql) or die('error'.mysqli_error().$sql);
					}
				}					
				$query1="delete from cpo_usermaster where iUserId=".$_POST['hb'.$count];
				$query2="delete from cpo_usercourse where iUserId=".$_POST['hb'.$count];
				$query3="delete from cpo_studentinfo where iStudentid='".$_POST['hb'.$count]."'";
				$query4="delete from cpo_studentlogbook where iStudentid='".$_POST['hb'.$count]."'";
				$query5="delete from cpo_tutorlogbook where iStudentid='".$_POST['hb'.$count]."'";
				$query6="delete from cpo_bookchattime where iUserid='".$_POST['hb'.$count]."'";
				$query7="delete from cpo_ind_plan where iStudentId='".$_POST['hb'.$count]."'";
				$query8="delete from cpo_ind_review where iStudentId='".$_POST['hb'.$count]."'";
				$sql = "select vFilePath from cpo_uploadfiles where iUserId='".$_POST['hb'.$count]."'";
				$result=runquery1($sql);
				$num1 = $result ? mysqli_num_rows($result) : 0 ;
				if ($num1 > 0 )
				{
						$filename=mysqli_result($result,0,0);
				}
				$query9="delete from cpo_uploadfiles where iUserId='".$_POST['hb'.$count]."'";
				if (file_exists(NEWADMIN_LMS_FILES_BASE . "/upload/" . $_POST['hb' . $count] . "/" . $filename))
				{
					unlink(NEWADMIN_LMS_FILES_BASE . "/upload/" . $_POST['hb' . $count] . "/" . $filename);
				}
				$query10="delete from cpo_jobsuggesioninfo where iStudentId='".$_POST['hb'.$count]."'";
				$query11="delete from tracklogstudent where StudentId='".$_POST['hb'.$count]."'";								                                        						
				$rscheck=runquery1($query1);
				$rscheck=runquery1($query2);
				$rscheck=runquery1($query3);
				$rscheck=runquery1($query4);
				$rscheck=runquery1($query5);
				$rscheck=runquery1($query6);
				$rscheck=runquery1($query7);
				$rscheck=runquery1($query8);
				$rscheck=runquery1($query9);
				$rscheck=runquery1($query10);
				$rscheck=runquery1($query11);
			}
		}
	}
}
?>
<BODY>
<?php include_once('top.php');?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left"> Learner Admin</td>
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
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=learner" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
            		  <td width="25%" align="center" class="graymid"><a href="addlearner.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listuser.php" class="greendeactfont">List</a></td>
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
                                                <td class="toheaderbg" colspan="3">Learner Information</td>
                                              </tr>
												<tr> 
                  <td height="35" colspan="2" class="fontblue" align="center"><?php if($active1=="true")
				  																echo "Selected entries updated successfully.";
																																					
																				elseif($flg ==  'red')
																				{echo "<span class='error'>$msg</span>";
																				}
																				else
																				{
																						echo "Selected learner deleted successfully.";
																				} 
																						
																				?></td>
				  
																				
																					 
                </tr>
												<tr> 
												  <td colspan="2" ><div align="right">&nbsp; 
													  <a href="viewuser.php?curpage=<?php echo $_GET['curpage'] ?>"><img src="images/edit1.gif"  border="0"></a>
													  <font face=verdana size=2><b><a href="overview.php?id=learner"><img src="images/cancel.gif"  border="0"></a></b></font>&nbsp;&nbsp; 
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
  

</BODY>
</HTML>
