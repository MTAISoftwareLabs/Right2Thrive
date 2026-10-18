<?php
include_once 'dbConnection.php';

if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
?>
<html>
<head>
<title><?php echo sitename;?>View Learner Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
var myvar = 1;
function openwin(obj)
{
	new1=window.open("Detail_StudentInformation.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function validation()
{
	if (document.FRMSTUDENTLOGBOOK.CBOTUTOR.value == "")
	{	
		alert("Please select your tutor");
		document.FRMSTUDENTLOGBOOK.CBOTUTOR.focus();
		return false;
	}
	if (document.FRMSTUDENTLOGBOOK.TXSUBJECT.value == "")
	{	
		alert("Please enter the subject");
		document.FRMSTUDENTLOGBOOK.TXSUBJECT.focus();
		return false;
	}
	if (myvar == 0)
	{	
		if(document.FRMSTUDENTLOGBOOK.TASUGGESTION.value=="")
		{
			alert("Please enter your suggestion");
			document.FRMSTUDENTLOGBOOK.TASUGGESTION.focus();
			return false;
		}
	}
	document.FRMSTUDENTLOGBOOK.ISSATISFIED.value=myvar;
	return true;	
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc"> 
      <?php include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top">
	<table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
         <tr> 
          <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td height="22"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                              <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="77%" class="welcome"><strong>View Learner Information</strong></td>
                                    <td width="20%" class="welcome"></td>
                                    <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                                  </tr>
                                </table></td>
                              <td width="1%"><img src="images/changep_right_cor.jpg"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td  class="forborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td valign="top"> <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="DFEAF2">
                                  <tr> 
                                    <td width="50%" align="center" class="bodytext"><strong>&nbsp;Learner Name</strong></td>
                                    <td width="50%" align="center" class="bodytext"><strong>&nbsp;Subject</strong></td>
                                  </tr>
                                  <?php
								$sqlspn="select s.iSinfoId,us.vUserName AS student,sj.vSubjectName AS subject FROM cpo_studentinfo s,cpo_usermaster us, cpo_subjectmaster sj WHERE s.iStudentId = us.iUserId AND s.iSubjectId = sj.iSubjectId AND s.iTutorId=".$user_id;
//								echo $sqlspn;
								$result=runquery($sqlspn);
						/////////
							$count=0;
							$page=0;
							if($result)
							{
								$count = mysqli_num_rows($result);
								$page=Ceil($count/page_size);
							}
							  if(isset($_GET['curpage']))
							  {
								$curpage = $_GET['curpage'];
								if($curpage==0)
								{
									 $sqlspn.=" Limit 0,".page_size;
								}
								else
								{
									$current=page_size*($curpage);
									$sqlspn.=" Limit " .$current. ",".page_size;
								}
							  }
							  else
							  {
							   $sqlspn.=" Limit 0,".page_size;
							   $curpage=0;
							  }
							  $result = runquery($sqlspn);
						////////
						$num = $result ? mysqli_num_rows($result):0;
						$counter=1;	
						if($num > 0)
						{
							while($rslist = mysqli_fetch_array($result))
							{?>
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" align="center" class="bodytext"><a class="sidelink" href="#" onClick="javascript:openwin(<?php echo $rslist['iSinfoId'];?>)"><?php echo $rslist["student"];?></a></td>
										<td align="center" class="bodytext"><a href="#" class="sidelink" onClick="javascript:openwin(<?php echo $rslist['iSinfoId'] ?>)"><?php echo $rslist["subject"];?></a></td>
									  </tr>
							 <?php
							$counter++;
							}
						}
						else
						{?>
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" align="center" colspan="3" class="bodytext"><b>No Records found.</b></td>
									  </tr>
						<?php
						}
					?>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td><table width="550" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                              <td width="96%" background="images/changebttm_center_cor.jpg">
							  	<div align="right" class="bodytext"><?php	if($page>1){ 
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
												<a href="ViewStudentInformation.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;</div>
							  </td>
                              <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </td>
        </tr>
		
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <?php include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
