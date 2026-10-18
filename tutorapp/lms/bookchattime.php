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
<title><? echo sitename;?>Book Chat Time</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function validation()
{
	if (document.FRMBOOKCHATTIME.TXTOPIC.value == "")
	{	
		alert("Please enter topic to discuss");
		document.FRMBOOKCHATTIME.TXTOPIC.focus();
		return false;
	}
	if (document.FRMBOOKCHATTIME.CBOTUTOR.value == "")
	{	
		alert("Please select your tutor");
		document.FRMBOOKCHATTIME.CBOTUTOR.focus();
		return false;
	}
	if (document.FRMBOOKCHATTIME.TXSTARTDATE.value == document.FRMBOOKCHATTIME.TXENDDATE.value)
	{	
		alert("Please enter Different Start & End Date Time ");
		document.FRMBOOKCHATTIME.TXSTARTDATE.focus();
		return false;
	}
	stdate=String(document.FRMBOOKCHATTIME.TXSTARTDATE.value).split(" "); 
	etdate=String(document.FRMBOOKCHATTIME.TXENDDATE.value).split(" ");
	
	sdate=stdate[0].split("/");
	stime=stdate[1].split(":");
	
	edate=etdate[0].split("/");
	etime=etdate[1].split(":");
	 
	startdate=new Date(sdate[2],sdate[1],sdate[0],stime[0],stime[1],stime[2]);
	enddate=new Date(edate[2],edate[1],edate[0],etime[0],etime[1],etime[2]);

	var one_day= 1000*60*60;
	hour=Math.ceil((enddate.getTime()-startdate.getTime())/(one_day));
	
	if(hour>2)
	{
		alert("You can't make chat more than 2 hours");	
		document.FRMBOOKCHATTIME.TXSTARTDATE.focus();
		return false;
	}
	if(hour<0)
	{
		alert("Please enter valid end Date-Time");
		document.FRMBOOKCHATTIME.TXSTARTDATE.focus();
		return false;
	}
	return true;	
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['FRMBOOKCHATTIME'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = true;
	mydatetime.popup();
}
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>
</head>
<body>
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc">
      <? include "leftpanel.php";?>    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="FRMBOOKCHATTIME" method="post" action="bookchattime.php?next=1" onSubmit="return validation();">
			<?
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Book Chat Time</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td width="36%" height="30" class="bodytext">Topic to discuss</td>
							<td width="64%" colspan="2">&nbsp;<input name="TXTOPIC" type="text" class="textbox" size="50"></td>
						</tr>
					<tr>
							<td class="bodytext" height="30">Select Tutor</td>
							<td colspan="2">&nbsp;<select name="CBOTUTOR" class="textbox">
							<option value="" selected>Select Tutor</option>
							<?
							$query_tutor_id = "select vTutorId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
							$result_tutor_id = runquery($query_tutor_id);
							$nos = 0;
							if($result_tutor_id)
							{
								$nos = mysqli_num_rows($result_tutor_id);
							}
							if($nos>0)
							{
								$tutor_ids='';
								while($result_tutor = mysqli_fetch_array($result_tutor_id))
								{
									$str_tutor_id=$result_tutor['vTutorId'];
									$str_tutor_length = strlen($str_tutor_id)-1;
									if(substr($str_tutor_id,$str_tutor_length-1,$str_tutor_length)<>',')
									{
										$str_tutor_id=$result_tutor['vTutorId'].',';
									}
									$tutor_ids.= $str_tutor_id;
								}
								if($tutor_ids<>'')
								{
									$tutor_ids=substr($tutor_ids,0,strlen($tutor_ids)-1);								
									$query_tutor_info = "select iUserId,vUserName from cpo_usermaster where iUserId in (".$tutor_ids.")";
//									echo $query_tutor_info;
//									exit;
									$result_tutor_info = runquery($query_tutor_info);
									$nos = 0;
									if($result_tutor_info)
									{
										$nos = mysqli_num_rows($result_tutor_info);
									}
									if($nos>0)
									{
										while($result_tutor = mysqli_fetch_array($result_tutor_info))
										{
										?>
											<option value="<? echo $result_tutor['iUserId'];?>"><? echo $result_tutor['vUserName'];?></option>	
										<?
										}									
									}
								}
							}
							?>
							</select></td>
						</tr>
						<tr>
							<td class="bodytext" height="30">Is it Urgent ?</td>
							<td colspan="2"><input type="checkbox" name="CHURGENT"></td>
						</tr>
												<tr>
							<td width="36%" height="30" class="bodytext">Chat Start Date Time</td>
							<td width="36%" height="30" class="bodytext">&nbsp;<input type="text" name="TXSTARTDATE" class="textbox" readonly value="<? echo date("d/m/Y H:i:s");?>" size="30"></td>
							<td width="36%" height="30" class="bodytext"><a href="javascript:pickdate('TXSTARTDATE')"><IMG src="images/cal.gif" border="0" alt="Click Here to Pick up the date"></a></td>
						</tr> 
						<tr>
							<td width="36%" height="30" class="bodytext">Chat End Date Time</td>
							<td width="36%" height="30" class="bodytext">&nbsp;<input type="text" name="TXENDDATE" class="textbox" readonly value="<? echo date("d/m/Y H:i:s");?>" size="30"></td>
							<td width="36%" height="30" class="bodytext"><a href="javascript:pickdate('TXENDDATE')"><IMG src="images/cal.gif" border="0" alt="Click Here to Pick up the date"></a></td>
						</tr> 
						<tr><td colspan="3" align="center" class="bodytext" height="20"><font color="#FF0000">Make booking for maximum 2 hours.</font></td></tr>
					</table>				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?
			  }
			  else
			  {
			  		$topic_discuss = clean_string($_POST['TXTOPIC']);
					$tutor_id = $_POST['CBOTUTOR'];
					$is_urgent = isset($_POST['CHURGENT'])?1:0;
					
					///// Check for existing booking of tutor for same timings
					$sdt=explode(" ",$_POST['TXSTARTDATE']); 
					$sddt=explode("/",$sdt[0]);
					$stdt=explode(":",$sdt[1]);
					
					$edt=explode(" ",$_POST['TXENDDATE']);
					$eddt=explode("/",$edt[0]);
					$etdt=explode(":",$edt[1]);
					
					$sdcon=$sddt[2].$sddt[1].$sddt[0];
					$stcon=$stdt[0].$stdt[1].$stdt[2];
					
					$sdcon1=$sddt[2]."-".$sddt[1]."-".$sddt[0];
					$stcon1=$stdt[0].":".$stdt[1].":".$stdt[2];
					
					$edcon=$eddt[2].$eddt[1].$eddt[0];
					$etcon=$etdt[0].$etdt[1].$etdt[2];
					
					$edcon1=$eddt[2]."-".$eddt[1]."-".$eddt[0];
					$etcon1=$etdt[0].":".$etdt[1].":".$etdt[2];
					
					//// Check for tutors booking for the same date and time
					$sqlchk="select StartApprovalDateTime,EndApprovalDateTime from cpo_bookchattime where iTutorId=".$tutor_id." and (StartApprovalDateTime between '".$sdcon1." " .$stcon1."' and '".$edcon1." " .$etcon1."' or EndApprovalDateTime between '".$sdcon1." " .$stcon1."' and '".$edcon1." " .$etcon1."')";
					$ressqlchk=runquery($sqlchk);
					$num=$ressqlchk ? mysqli_num_rows($ressqlchk) : 0;
					if($num==0)
					{
						//// Check for learners booking for the same date and time
						$sqlchk1="select StartApprovalDateTime,EndApprovalDateTime from cpo_bookchattime where iUserId=".user_id." and (StartApprovalDateTime between '".$sdcon1." " .$stcon1."' and '".$edcon1." " .$etcon1."' or EndApprovalDateTime between '".$sdcon1." " .$stcon1."' and '".$edcon1." " .$etcon1."')";
						$ressqlchk1=runquery($sqlchk1);
						$num1=$ressqlchk1 ? mysqli_num_rows($ressqlchk1) : 0; 
						if($num1>0)
						{
							$num=1;
						}
					}
					if($num>0)
					{
						$msg="This Chat time is already Booked.";
						$color = "black";
					}
					else
					{
						$insert_times="insert into cpo_bookchattime (iUserId,iTutorId,dBookingDate,vTopicToDiscuss,iIsUrgent,StartApprovalDateTime,EndApprovalDateTime,iIsApproved) values (".$user_id.",".$tutor_id.",'".date('Y-m-d H:i:s')."','".$topic_discuss."',".$is_urgent.",'".$sdcon.$stcon."','".$edcon.$etcon."',1)";
						runquery($insert_times);
						$msg = "Your request has been submited.";
						//////////// To Learner
						$fromname = $_SESSION['user_name'];
						$fromaddress = admin_email;
						$toname = $_SESSION['user_name'];
						$toaddress = $_SESSION['email_id'];
						$subject = "Chat time booking in CareerPaths Online";
						$message ="<html><body><p>Dear ".$_SESSION['user_name'].",</p>";
						$message .= "<p>Your request for chatting with tutor has been submited.</p>";
						$message .= "<p>Warm Regard From,</p>";
						$message .= "<p>CareerPaths Online Team</p></body></html>";
						SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
						//////////// To Tutor
						$seltutor = "select vUserName,vUserEmailId from cpo_usermaster where iUserId=".$tutor_id;
						$rstutor = runquery($seltutor);
						$tutor_name = '';
						$tutor_email = '';
						if($rstutor)
						{
							$rssettutor = mysqli_fetch_array($rstutor);
							$tutor_name = $rssettutor['vUserName'];
							$tutor_email = $rssettutor['vUserEmailId'];
						}
						
						$fromname = $_SESSION['user_name'];
						$fromaddress = $_SESSION['email_id'];
						$toname = $tutor_name;
						$toaddress = $tutor_email;
						$subject = "Chat time booking in CareerPaths Online";
						$message ="<html><body><p>Dear ".$tutor_name.",</p>";
						$message .= "<p>Request for chat time booking with you has been submited by ".$_SESSION['user_name'].".</p>";
						$message .= "<p>Warm Regard From,</p>";
						$message .= "<p>CareerPaths Online Team</p></body></html>";
						SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
						////////////		
						$color = "black";
						addlog(7);
					}
					?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Book Chat Time</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<? echo $color;?>"><b><? echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='./'"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>					
	           <? }
			  ?>
			</form></td>
        </tr>
		<?
		$sqlspn="select * from cpo_bookchattime where iUserId=".$user_id." and (iIsApproved=1 and  EndApprovalDateTime >='".date('Y-m-d G:i:s')."')";
		$result = runquery($sqlspn);
		$count = mysqli_num_rows($result);
		$page=Ceil($count/page_size);
		if(isset($_GET['curpage']))
		{
			$curpage = $_GET['curpage'];
			if($curpage==0)
			{
				 $sqlspn.=" order by dBookingDate desc Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by dBookingDate desc Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by dBookingDate desc Limit 0,".page_size;
		   $curpage=0;
		}
		$result = runquery($sqlspn);
		$num=$result ? mysqli_num_rows($result) : 0;
		?>
		<tr>
			<td>
			<?
			if($num>0)
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Chat Time Bookings</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="95%" align="center" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
						<tr >
	                        <td width="25%" height="20" class="bodytext"><b><font color="#0033CC">&nbsp;Tutor Name</font></b></td>
							<td width="25%" height="20" class="bodytext" align="center"><b><font color="#0033CC">Chat start date/time</font></b></td>
							<td width="25%" height="25" class="bodytext" align="center"><b><font color="#0033CC">Chat end date/time</font></b></td>
							<td width="25%" height="6" class="bodytext" align="center"><b><font color="#0033CC">Topic to discuss</font></b></td>
						</tr>
						<?
						while($res=mysqli_fetch_array($result))
						{
						$sqluser="select vUserName from cpo_usermaster where iUserId=".$res['iTutorId']."";
						$ressqluser=runquery($sqluser);
						$no=$ressqluser ? mysqli_num_rows($ressqluser) : 0;
						if($no>0)
						{
							$ressqluser=mysqli_fetch_array($ressqluser);
						}
						?>  <tr bgcolor="#FFFFFF">
							<td class="bodytext" height="25">&nbsp;<? echo $ressqluser['vUserName']; ?></td>
							<?
				            $sdt=explode(" ",$res['StartApprovalDateTime']); 
							$startdt=gdate($sdt[0]).' '.$sdt[1];

				            $edt=explode(" ",$res['EndApprovalDateTime']); 
							$enddt=gdate($sdt[0]).' '.$edt[1];
							?>
							<td class="bodytext" height="25" align="center"><? echo $startdt;?></td>
							<td class="bodytext" height="25" align="center"><? echo $enddt;?></td>
							<td class="bodytext" align="center">&nbsp;<? echo $res['vTopicToDiscuss']; ?></td>
							 </tr>
						<?  } ?>
						<?	if($page>1){ ?>
						<tr bgcolor="#FFFFFF"><td colspan="5">&nbsp;</td></tr>
						<tr bgcolor="#FFFFFF"><td colspan="5" align="right" class="bodytext">
						 
											<?	echo "Page : ";
											 for($i=1;$i<=$page;$i++)
											 {
												if($i==($curpage+1))
												{
											 ?>
												<b><? echo $i?></b>
											 <?
												}
												else
												{
													$str="";
											?>
												<a href="bookchattime.php?curpage=<? echo $i-1;?>"><b><? echo $i;?></b></a>
											 <?
												}									
											 }?>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;</td></tr><? } ?>
					</table>				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg"></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?
			  }
			  else
			  {
			  		$msg="No records exist in database !";		
					$color = "black";
					?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Chat Time Bookings</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<? echo $color;?>"><b><? echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='index.php'"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>					
	           <? }
			  ?>			</td>
		</tr>
		<tr>
		  <td><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
	    </tr>
		
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
