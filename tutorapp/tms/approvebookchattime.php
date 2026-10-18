<?php
include "dbConnection.php";

if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
$user_id = $_SESSION['user_id'];
?>
<html>
<head>
<title><?php echo sitename;?>Approve Chat Time</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function validation()
{
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
	
	if(hour>12)
	{
		alert("You can't make chat more than 12 hours");	
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
</head>
<?php
	$chatid=$_GET['chatid'];
	$sqlchkflg="select * from cpo_bookchattime where iChatId=".$chatid."";
	$ressqlchkflg=runquery($sqlchkflg);
	$res=mysqli_fetch_array($ressqlchkflg);

	$sqluname="select vUserName from cpo_usermaster where iUserId=".$res['iUserId']."";
	$resuname=runquery($sqluname);
	if($resuname)
	{
		$resuname=mysqli_fetch_array($resuname);
	}
?>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
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
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="FRMBOOKCHATTIME" method="post" action="approvebookchattime.php?next=1&chatid=<?php echo $chatid; ?>" onSubmit="return validation()">
			<?php
			if (!isset($_GET['next']))
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Approve Chat Time</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
                        <td width="36%" height="30" class="bodytext">Learner Name</td>
							<td width="36%" height="30" class="bodytext"><input type="text" name="TXUSERNAME" class="textbox" size="30" value="<?php echo $resuname['vUserName']; ?>"></td>
							<td width="36%" height="30" class="bodytext">&nbsp;</td>
						</tr>
						<tr>
							<td width="36%" height="30" class="bodytext">Start Approval Date Time</td>
							<?php
							if($res['iIsApproved']==1)
							{ 
							?>
							<td width="36%" height="30" class="bodytext"><input type="text" name="TXSTARTDATE" class="textbox" readonly value="<?php echo datetime($res['StartApprovalDateTime']);?>" size="30"></td>
							<?php } else { ?>
														
							<td width="36%" height="30" class="bodytext"><input type="text" name="TXSTARTDATE" class="textbox" readonly value="<?php echo date("d/m/Y H:i:s");?>" size="30"></td>
							<?php } ?>							
							<td width="36%" height="30" class="bodytext"><a href="javascript:pickdate('TXSTARTDATE')"><IMG src="images/cal.gif" border="0" alt="Click Here to Pick up the date"></a></td>
						</tr> 
						<tr>
							<td width="36%" height="30" class="bodytext">End Approval Date Time</td>
							<?php
							if($res['iIsApproved']==1)
							{ 
							?>
							<td width="36%" height="30" class="bodytext"><input type="text" name="TXENDDATE" class="textbox" readonly value="<?php echo datetime($res['EndApprovalDateTime']);?>" size="30"></td>
							<?php } else { ?>
							<td width="36%" height="30" class="bodytext"><input type="text" name="TXENDDATE" class="textbox" readonly value="<?php echo date("d/m/Y H:i:s");?>" size="30"></td>
							<?php } ?>							
							<td width="36%" height="30" class="bodytext"><a href="javascript:pickdate('TXENDDATE')"><IMG src="images/cal.gif" border="0" alt="Click Here to Pick up the date"></a></td>
						</tr> 
						<tr>
							<td width="36%" height="30" class="bodytext">Topic to discuss</td>
							<td colspan="2" height="30" class="bodytext"><?php echo $res['vTopicToDiscuss'];?></td>
						</tr> 
						<tr><td colspan="3">&nbsp;</td></tr>
						
					</table> 
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?php
			  }
			  else
			  {
			  		
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
					
    			$sqlchk="select StartApprovalDateTime,EndApprovalDateTime from cpo_bookchattime where iTutorId=".$user_id." and iChatId<>".$_GET['chatid']." and (StartApprovalDateTime between '".$sdcon1." " .$stcon1."' and '".$edcon1." " .$etcon1."' or EndApprovalDateTime between '".$sdcon1." " .$stcon1."' and '".$edcon1." " .$etcon1."')";
				$ressqlchk=runquery($sqlchk);
				$num=$ressqlchk ? mysqli_num_rows($ressqlchk) : 0;
				if($num==0)
				{
					$sqlchk1="select iUserId from cpo_bookchattime where iChatId='".$_GET['chatid']."'";
					$ressqlchk1=runquery($sqlchk1);
					$num1=$ressqlchk1 ? mysqli_num_rows($ressqlchk1) : 0; 
					if($num1>0)
					{
						$ans=mysqli_fetch_array($ressqlchk1);
					  	$sqlchk2="select StartApprovalDateTime,EndApprovalDateTime from cpo_bookchattime where iUserId=".$ans['iUserId']." and iChatId<>".$_GET['chatid']." and iTutorId!=".$user_id." and (StartApprovalDateTime between '".$sdcon1." " .$stcon1."' and '".$edcon1." " .$etcon1."' or EndApprovalDateTime between '".$sdcon1." " .$stcon1."' and '".$edcon1." " .$etcon1."')";
						$ressqlchk2=runquery($sqlchk2);
						$num2=$ressqlchk2 ? mysqli_num_rows($ressqlchk2) : 0; 
						if($num2>0)
						{
							$num=1;
						}
					}
				}
					if($num>0)
					{
						$msg="This Chat time is already Booked !";
						$color = "black";
					}
					else
					{
			  			$sql="update cpo_bookchattime set StartApprovalDateTime='".$sdcon.$stcon."',EndApprovalDateTime='".$edcon.$etcon."',iIsApproved=1 where iChatId=".$_GET['chatid'];
						$sqllearner="select vUserEmailId,vUserName from cpo_usermaster where iUserId=".$res['iUserId']."";
						$sqltutor="select vUserEmailId,vUserName from cpo_usermaster where iUserId=".$user_id."";

						$result=runquery($sql);
						$resultsqllearner=runquery($sqllearner);
						$resultsqltutor=runquery($sqltutor);
						
						$resultsqllearner=mysqli_fetch_array($resultsqllearner);
						$resultsqltutor=mysqli_fetch_array($resultsqltutor);
						
						$fromname =$resultsqltutor['vUserName']; 
						$fromaddress=$resultsqltutor['vUserEmailId'];
						
						$toname=$resultsqllearner['vUserName'];
						$toaddress=$resultsqllearner['vUserEmailId'];
						
						$subject="Chat time for the ".$resultsqllearner['vUserName']." Approved By ".$resultsqltutor['vUserName'];
						
						$message="<br><b>Dear " .$resultsqllearner['vUserName']."</b><br><p>";
						$message.="<b> Your request for the Chat has been approved </b><br><p>";
						$message.="<b> So be Online on </b>";
						$message.="<br><b>Chat Date From : </b>".$sdt[0]. "  " .$sdt[1]. " <b>To : </b>" .$edt[0]. "  ".$edt[1]."<br>";
						$message.="<br><b>Warm Regards,</b>"."<br>";
						$message.="<b>".$resultsqltutor['vUserName']. " [CareerPaths Online Team]" . "</b>";
						
						$flgmail=SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
						if($flgmail)
						{
					  		$msg="Chat Approved Successfully !";
							$color = "black";
						}
						else
						{
							$msg="Error In Sending E-mail !";
							$color = "black";
						}
					}
					?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Approve Chat Time</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<?php echo $color;?>"><b><?php echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='bookchattime.php'"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>					
	           <?php }
			  ?>
			</form></td>
        </tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <tr> 
    <td colspan="2"> 
      <?php include "includebottom.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="30" border="0" alt=""></td>
  </tr>
</table>
</body>
</html>
