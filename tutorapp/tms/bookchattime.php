<?php
include "dbConnection.php";
if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
?>
<?php
$user_id = $_SESSION['user_id'];
?>
<html>
<head>
<title><?php echo sitename;?>Approve Chat Time</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
</head>
<?php
		$sqlspn="select * from cpo_bookchattime where iTutorId=".$user_id." and iIsApproved=0 or (iIsApproved=1 and  EndApprovalDateTime >='".date('Y-m-d G:i:s')."')";
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
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td></tr>
  <tr> 
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
          <td><form name="FRMBOOKCHATTIME" method="post">
			<?php
			//if (!isset($_GET['next']))
			if($num>0)
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
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
					<table class="" width="97%" align="center" cellspacing="1" cellpadding="0" bgcolor="#DFEAF2" border="0">
						<tr >
							
	                        <td width="30%" height="20" class="bodytext"><b><font color="#0033CC">&nbsp;Learner Name</font></b></td>
							<td width="25%" height="20" class="bodytext" align="center"><b><font color="#0033CC">Chat start date/time</font></b></td>
							<td width="25%" height="25" class="bodytext" align="center"><b><font color="#0033CC">Chat end date/time</font></b></td>
							<td width="25%" height="25" class="bodytext" align="center"><b><font color="#0033CC">Topic to discuss</font></b></td>
							<td width="15%" height="6" class="bodytext" align="center"><b><font color="#0033CC">Urgent</font></b></td>
						</tr>
						<?php
						while($res=mysqli_fetch_array($result))
						{
						$sqluser="select vUserName from cpo_usermaster where iUserId=".$res['iUserId']."";
						$ressqluser=runquery($sqluser);
						$no=$ressqluser ? mysqli_num_rows($ressqluser) : 0;
						if($no>0)
						{
							$ressqluser=mysqli_fetch_array($ressqluser);
						}
						?>  <tr bgcolor="#FFFFFF">
							<td class="bodytext" height="25">&nbsp;<?php echo $ressqluser['vUserName']; ?></td>
							<?php
				            $sdt=explode(" ",$res['StartApprovalDateTime']); 
							$startdt=gdate($sdt[0]).' '.$sdt[1];

				            $edt=explode(" ",$res['EndApprovalDateTime']); 
							$enddt=gdate($sdt[0]).' '.$edt[1];
							?>
							<td class="bodytext" height="25" align="center"><?php echo $startdt;?></td>
							<td class="bodytext" height="25" align="center"><?php echo $enddt;?></td>
							<td class="bodytext" height="25" align="center"><?php echo $res['vTopicToDiscuss']; ?></td>
							<?php if($res['iIsUrgent']==1)
							{ ?>
							<td class="bodytext" align="center">&nbsp;Yes</td> 
							<?php }
							else
							{
							 ?>
							 <td class="bodytext" align="center">&nbsp;No</td> 
							 <?php } ?>
							 </tr>
						<?php  } ?>
<!--						</tr> -->
						<?php	if($page>1){ ?>
						<tr bgcolor="#FFFFFF"><td colspan="5">&nbsp;</td></tr>
						<tr bgcolor="#FFFFFF"><td colspan="5" align="right" class="bodytext">
						 
											<?php	echo "Page : ";
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
												<a href="bookchattime.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }?>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;</td></tr><?php } ?>
					</table> 
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><!--<div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div>--></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?php
			  }
			  else
			  {
			  		$msg="No records exist in database !";		
					$color = "black";
					?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
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
							<td colspan="2" align="center" class="bodytext"><font color="<?php echo $color;?>"><b><?php echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='index.php'"></div></td>
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
  <?php include "includebottom.php";?>
</table>
</body>
</html>
