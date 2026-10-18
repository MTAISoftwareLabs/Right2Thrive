<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//include "../src/function.php";
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		document.location ="index.htm";
	</script> 
<?php
} 
$flg="";
$msg="";
$msg1="";
$active1="";

if(isset($_GET['active']))
{
for($count=1;$count<=$_POST['txtcnt']-1;$count++)
{
		
	$str="chk".$count;

	if(isset($_POST[$str]))
	{
		$abc="hb".$count;
		$query="update cpo_usermaster set iUserStatus=1 where iUserId=".$_POST[$abc];
		$query1="update cpo_usercourse set iCourseStatus=1 where iUserId=".$_POST[$abc];
		
		$fetchname="select vUserEmailId,vUserName,vUserPassword from cpo_usermaster where iUserId=".$_POST[$abc];
		$resultfetchname=runquery1($fetchname);
		$emailid=mysqli_result($resultfetchname,0,0);
		$username=mysqli_result($resultfetchname,0,1);
		$pwd = mysqli_result($resultfetchname,0,2);
			$msg = "Congratulations ! Your account has been Approved successfully.";
					
			//Sending mail 
			$fromname="Administrator of CPO.";
			//$fromaddress=getAdminEmail();
			$toname=$username;
			$toaddress=$emailid;
			$subject="Member Registration Approved For cpo";
			$message=
			"<html><SPAN style='FONT-SIZE: 10pt; FONT-FAMILY: Verdana'>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Dear ".$username." ,<?xml:namespace prefix = o ns = 'urn:schemas-microsoft-com:office:office' /><o:p></o:p></SPAN></P>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>&nbsp;<o:p></o:p></SPAN></P>

				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Welcome to <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>careerpathsonline.net</SPAN></B>!!! We, congratulate you on your decision to become a member of the Career Path Online – <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>careerpathsonline.net</SPAN></B>!!! <SPAN style='mso-spacerun: yes'>&nbsp;</SPAN><o:p></o:p></SPAN></P>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>&nbsp;<o:p></o:p></SPAN></P>
				
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Your User Name : <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>".$emailid."</SPAN></B><SPAN style='mso-spacerun: yes'>&nbsp;</SPAN><o:p></o:p></SPAN></P>
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>Your Password  : <B style='mso-bidi-font-weight: normal'><SPAN style='COLOR: black'>".$pwd."</SPAN></B><SPAN style='mso-spacerun: yes'>&nbsp;</SPAN><o:p></o:p></SPAN></P>				
				<P class=MsoNormal style='MARGIN: 0in 0in 0pt; TEXT-ALIGN: justify'><SPAN style='FONT-SIZE: 9pt; FONT-FAMILY: Verdana'>&nbsp;<o:p></o:p></SPAN></P>
				
				";
				$mailflg=SendingMail($fromname, "ajay@demowork.com","naresh khatri" ,$toaddress, $subject, $message);
		

	}
	else
	{
		$abc="hb".$count;
		
		$query="update cpo_usermaster set iUserStatus=0 where iUserId=".$_POST[$abc];
		$query1="update cpo_usercourse set iCourseStatus=0 where iUserId=".$_POST[$abc];
	}
		$rscheck=runquery1($query) or die('error'.mysqli_error());
		$rscheck=runquery1($query1) or die('error'.mysqli_error());
		

}

$active1="true";
}


if(isset($_GET['id']))
{
          
		 		$flg="green";
				$msg="";
				$msg1="";
				$flg1="false";

				$sql="select * from cpo_thirdpartylearner";
				$result=runquery1($sql);
				while($rslist = mysqli_fetch_array($result))
				{
							$id=explode(",",$rslist["vLearnerIds"]);
																							
									for($i=0;$i<count($id);$i++)
										{
												if($id[$i]==$_GET['id'])
												{
													echo "thirdparty";
													$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
													$result=runquery1($sql);
													$cname=mysqli_result($result,0,0);
													$flg="red";
													$msg=$msg.$cname." User Exists in Third Party - Learner Inegration";
													$flg1="true";
													break;
												}
												
										}
							
				}
				if($flg1!="true")
				{
							$sql="select count(*) from cpo_studentinfo where iStudentid='".$_GET['id']."'";
							$rIDPass=runquery1($sql);
							$rIDans=mysqli_fetch_row($rIDPass);
							if($rIDans[0]>0)
							{
											echo "studentinfo";
											$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
											$result=runquery1($sql);
											$cname=mysqli_result($result,0,0);
											$flg="red";
											$msg=$msg.$cname."  User Exists in Student Information Master";
											$flg1="true";
											
							}
				}
				if($flg1!="true")
				{
							$sql="select count(*) from cpo_studentlogbook where iStudentid='".$_GET['id']."'";
							$rIDPass=runquery1($sql);
							$rIDans=mysqli_fetch_row($rIDPass);
							if($rIDans[0]>0)
							{
											echo "studentlogbook";
											$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
											$result=runquery1($sql);
											$cname=mysqli_result($result,0,0);
											$flg="red";
											$msg=$msg.$cname." User Exists in Student Log Book";
											$flg1="true";
											
							}
				}
				if($flg1!="true")
				{
							$sql="select count(*) from cpo_tutorlogbook where iStudentid='".$_GET['id']."'";
							$rIDPass=runquery1($sql);
							$rIDans=mysqli_fetch_row($rIDPass);
							if($rIDans[0]>0)
							{
											$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
											$result=runquery1($sql);
											$cname=mysqli_result($result,0,0);
											$flg="red";
											$msg=$msg.$cname." User Exists in Tutor Log Book";
											$flg1="true";
											
							}
				}
				if($flg1!="true")
				{
							$sql="select count(*) from cpo_bookchattime where iUserid='".$_GET['id']."' and ilsApproved=0";
							$rIDPass=runquery1($sql);
							$rIDans=mysqli_fetch_row($rIDPass);
							if($rIDans[0]>0)
							{
											$sql="select vUserName from cpo_usermaster where iUserId='".$_GET['id']."'";
											$result=runquery1($sql);
											$cname=mysqli_result($result,0,0);
											$flg="red";
											$msg=$msg.$cname."  User Exists in Book Chat Time";
											$flg1="true";
											
							}
				}
				if($flg1!="true")
				{
							echo "hey";
							die();
							$sql="delete from cpo_usermaster where iUserId=".$_GET['id'];
		 					$sql1="delete from cpo_usercourse where iUserId=".$_GET['id'];
							
							$rscheck=runquery1($sql);
							$rscheck=runquery1($sq11);
						
							$msg1="Selected Entries Deleted Successfully";
				}  
				
}
	
elseif($_POST['txtcnt']>1)
        {
		
			$flg="green";
			$msg="";
			$msg1="";
			$flg1="false";
			
            for($count=1;$count<=$_POST['txtcnt'];$count++)
            {
               if(isset($_POST['cbo'.$count]))
               {
	   	   
			   		$sql="select * from cpo_thirdpartylearner";
										$result=runquery1($sql);
										while($rslist = mysqli_fetch_array($result))
										{
													$id=explode(",",$rslist["vLearnerIds"]);
																													
															for($i=0;$i<count($id);$i++)
																{
																		if($id[$i]==$_POST['hb'.$count])
																		{
																			$sql="select vUserName from cpo_usermaster where iUserId=".$_POST['hb'.$count];
																			$result=runquery1($sql);
																			$cname=mysqli_result($result,0,0);
																			$flg="red";
																			$msg=$msg.$cname.",";
																			$flg1="true";
																			break;
																		}
																		
																}
													
										}
										if($flg1!="true")
											{
														$sql="select count(*) from cpo_studentinfo where iStudentid=".$_POST['hb'.$count];
														$rIDPass=runquery1($sql);
														$rIDans=mysqli_fetch_row($rIDPass);
														if($rIDans[0]>0)
														{
																		$sql="select vUserName from cpo_usermaster where iUserId=".$_POST['hb'.$count];
																		$result=runquery1($sql);
																		$cname=mysqli_result($result,0,0);
																		$flg="red";
																		$msg=$msg.$cname."  User Exists in Student Information Master";
																		$flg1="true";
																		
														}
											}
											if($flg1!="true")
											{
														$sql="select count(*) from cpo_studentlogbook where iStudentid=".$_POST['hb'.$count];
														$rIDPass=runquery1($sql);
														$rIDans=mysqli_fetch_row($rIDPass);
														if($rIDans[0]>0)
														{
																		$sql="select vUserName from cpo_usermaster where iUserId=".$_POST['hb'.$count];
																		$result=runquery1($sql);
																		$cname=mysqli_result($result,0,0);
																		$flg="red";
																		$msg=$msg.$cname."  User Exists in Student Log Book";
																		$flg1="true";
																		
														}
											}
											if($flg1!="true")
											{
														$sql="select count(*) from cpo_tutorlogbook where iStudentid=".$_POST['hb'.$count];
														$rIDPass=runquery1($sql);
														$rIDans=mysqli_fetch_row($rIDPass);
														if($rIDans[0]>0)
														{
																		$sql="select vUserName from cpo_usermaster where iUserId=".$_POST['hb'.$count];
																		$result=runquery1($sql);
																		$cname=mysqli_result($result,0,0);
																		$flg="red";
																		$msg=$msg.$cname."  User Exists in Tutor Log Book";
																		$flg1="true";
																		
														}
											}
											if($flg1!="true")
											{
														$sql="select count(*) from cpo_bookchattime where iUserid=".$_POST['hb'.$count];
														$rIDPass=runquery1($sql);
														$rIDans=mysqli_fetch_row($rIDPass);
														if($rIDans[0]>0)
														{
																		$sql="select vUserName from cpo_usermaster where iUserId=".$_POST['hb'.$count];
																		$result=runquery1($sql);
																		$cname=mysqli_result($result,0,0);
																		$flg="red";
																		$msg=$msg.$cname."  User Exists in Tutor Log Book";
																		$flg1="true";
																		
														}
											}
											if($flg1!="true")
											{
													echo "here";
													die();
											
													$sql="delete from cpo_usermaster where iUserId=".$_POST['hb'.$count];
													$sql1="delete from cpo_usercourse where iUserId=".$_POST['hb'.$count];
													
						
													$rscheck=runquery1($sql);
													$rscheck=runquery1($sql1);
													$msg1="Selected Entries Deleted Successfully";
											}
                   
                
	           }
               
			}
	
}

		

?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete User</title>
</HEAD>
<BODY>

  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Approve/Disapporve User Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=approve">Overview</a></div></td>
            
            <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Edit 
                / Delete</div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listuser.php">List</a></div></td>
            <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            <td width="34%" background="images/middle_last.jpg"></td>
          </tr>
        </table></td>
	</tr>
	<tr> 
      <td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
          <tr> 
            <td bgcolor="F5F8FF">&nbsp;</td>
          </tr>
         
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="70%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
                <tr> 
                  <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                  <td width="652" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
                </tr>
                <tr> 
                  <td height="35" colspan="2" class="comment" align="center"><?php if($active1=="true")
				  																echo "Selected Entries Updated Successfully";
																				elseif($flg=="red")
																				echo $msg;
																				else
																				echo $msg1." First Remove All the Integration";?></td>
				  
																				
																					 
                </tr>
                <tr> 
                  <td colspan="2" ><div align="right">&nbsp; 
                      <a href="viewuser.php?curpage=<?php echo $_GET['curpage'] ?>"><img src="images/edit1.gif" width="73" height="22" border="0"></a>
                      <font face=verdana size=2><b><a href="overview.php?id=approve"><img src="images/cancel.gif" width="73" height="22" border="0"></a></b></font>&nbsp;&nbsp; 
                    </div></td>
                </tr>
                <tr> 
                  <td class="headingtd" colspan="2">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
         
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
         
        </table>
		</td>
	</tr>
</table>

</BODY>
</HTML>
