<?
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
<title><? echo sitename;?>View Student Log Book</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
var myvar = 1;
function openwin(obj)
{
	new1=window.open("Detail_LogBook.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
	return true;
}

function getIsStaisfied()
{
	myvar = 0;
	document.getElementById("TASUGGESTION").disabled = false;
}
function setIsStaisfied()
{
	myvar = 1;
	document.getElementById("TASUGGESTION").value="";
	document.getElementById("TASUGGESTION").disabled = true;
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
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top" ><table width="99%" border="0" cellspacing="0" cellpadding="0" style="border-right : 1pt solid  #E2E2E2;">
        <tr> 
          <td width="100%"  valign="top">
            <? include "includetop.php";?>
          </td>
          <td  ></td>
        </tr>
      </table></td>
    <td width="3%">&nbsp;</td>
  </tr>
  <tr> 
    
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
  </tr>
  <tr>
    <td height="24" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
							<tr> 
								<td colspan="2" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
										  <tr> 
											
											
                        <td width="17%" class="bodytext"><strong> Select Learner 
                          :</strong></td>
											<td width="17%"><select name="cmbcategory" class="bodytext">
												<option value="" selected>ALL</option>
												<?
						   							$fetch1="select * from cpo_thirdpartylearner where iTId=".$user_id;
													$result1=runquery1($fetch1);
													$count=mysqli_num_rows($result1);
													if($count > 0)
													{
															$result_info = mysqli_fetch_array($result1);
							
															$idlearner=explode(",",$result_info['vUserName']);
																										
																for($j=0;$j<count($idlearner);$j++)
																	{
																				$fetchname="select * from cpo_usermaster where iUserId=".$idlearner[$j];
																				$resultfetchname=runquery1($fetchname);
																				$tutorname=mysqli_result($resultfetchname,0,1);
																			?>
																				<option value="<? echo $rslist["iUserID"];?>"><? echo $tutorname;?></option>
																			 <?
																			
																	}
													}
																																					
													?>
											  </select></td>
											  <? if ($getct<>'')
												{?>  
											  <script language="JavaScript">getselected('<? echo $getct;?>',document.listuserfortutor.cmbcategory);</script>
												<?
												}?>
											<td>
											<img src="file://///Www/web/Concept/ReelBrokers/admin/images/search.gif" width="73" height="21" style="cursor:hand" onClick="javascript:getsearch();">
											<input type="hidden" name="selecteditems" value="<? if (isset($_POST['selecteditems'])){ echo $_POST['selecteditems'];}?>">
											</td>
										  </tr>
										</table></td>
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
                                    <td width="77%" class="welcome"><strong>View Student Log Book</strong></td>
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
                                    <td width="29%" align="center" class="bodytext"><strong>&nbsp;Entry Date</strong></td>
                                    <td width="32%" align="center" class="bodytext"><strong>&nbsp;Tutor Name</strong></td>
                                    <td width="39%" align="center" class="bodytext"><strong>&nbsp;Subject</strong></td>
                                  </tr>
                                  <?
						$sql="select s.iLogId,t.vUserName,s.dEntryDate,sm.vSubjectName from cpo_studentlogbook s,cpo_usermaster t,cpo_subjectmaster sm where s.iTutorId = t.iUserId and s.iSubjectId = sm.iSubjectId and s.iStudentId and s.iStudentId=".$user_id." order by s.dEntryDate desc";
						$result=runquery($sql);
						$num = $result ? mysqli_num_rows($result):0;
						$counter=1;	
						if($num > 0)
						{
							while($rslist = mysqli_fetch_array($result))
							{
								$dispdate = gdate($rslist["dEntryDate"]);
								?>
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" align="center" class="bodytext"><a href="#" onClick="javascript:openwin(<? echo $rslist['iLogId'] ?>)"><? echo $dispdate; ?></a></td>
										<td align="center" class="bodytext"><a href="#" onClick="javascript:openwin(<? echo $rslist['iLogId'] ?>)"><? echo $rslist["vUserName"]; ?></a></td>
										<td align="center" class="bodytext"><a href="#" onClick="javascript:openwin(<? echo $rslist['iLogId'] ?>)"><? echo $rslist["vSubjectName"]; ?></a></td>
									  </tr>
							 <?
							$counter++;
							}
						}
						else
						{?>
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" align="center" colspan="3" class="bodytext"><b>No Records found</b></td>
									  </tr>
						<?
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
                              <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"></div></td>
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
  <tr> 
    <td colspan="2"> 
      <? include "includebottom.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="30" border="0" alt=""></td>
  </tr>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
