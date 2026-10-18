<?php
include_once 'dbConnection.php';
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d-m-Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}
if(isset($_GET['id']))
{
	
	$sqlselect="SELECT * FROM cpo_bookchattime where iChatId=".$_GET['id'];
	$result_info=runquery($sqlselect);
	$num = $result_info ? mysqli_num_rows($result_info) : 0;
	if($num > 0)
	{
						$rs = mysqli_fetch_array($result_info);
						$sqltutor = "select vUserName from cpo_usermaster where iUserId=".$rs[2];
						$rstutor = runquery($sqltutor);
						$num1 = $rstutor ? mysqli_num_rows($rstutor) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rstutor);
							$tutorname = $rsdata[0];
						}

						$stuname = "";
						$sqlstu = "select vUserName from cpo_usermaster where iUserId=".$rs[1];
						$rsstu = runquery($sqlstu);
						$num1 = $rsstu ? mysqli_num_rows($rsstu) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rsstu);
							$stuname = $rsdata[0];
						}

						$subname = "";
						$sqlsub = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$rs[3];
						$rssub = runquery($sqlsub);
						$num1 = $rssub ? mysqli_num_rows($rssub) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rssub);
							$subname = $rsdata[0];
						}
						 $sdt=explode(" ",$rs[3]); 
						 $sddt=explode("-",$sdt[0]);
						 $stdt=explode(":",$sdt[1]);
														
						$sdcon=$sddt[2]."/".$sddt[1]."/".$sddt[0];
						$stcon=$stdt[0].":".$stdt[1].":".$stdt[2];
						
						if($rs[8]==1)
						{
						
						$sdt1=explode(" ",$rs[6]); 
						 $sddt1=explode("-",$sdt1[0]);
						 $stdt1=explode(":",$sdt1[1]);
														
						$sdcon1=$sddt1[2]."/".$sddt1[1]."/".$sddt1[0];
						$stcon1=$stdt1[0].":".$stdt1[1].":".$stdt1[2];
						
						$sdt2=explode(" ",$rs[7]); 
						 $sddt2=explode("-",$sdt2[0]);
						 $stdt2=explode(":",$sdt2[1]);
														
						$sdcon2=$sddt2[2]."/".$sddt2[1]."/".$sddt2[0];
						$stcon2=$stdt2[0].":".$stdt2[1].":".$stdt2[2];
						}
	//}
?>
<style>
.bothfeatured3
{
	border-left:1px solid #88B4F9;
	border-right:1px solid #88B4F9;	
}
.flipv {
	FILTER: FlipV();
}
</style>
<link href="../admin/css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/css_styles.css" rel="stylesheet" type="text/css">
<title>Chat Time - Detail View - Careerpaths Online</title>
<body topmargin="0">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr> 
    <td colspan="4"><img src="images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td background="images/coupons3.jpg" class="flipv"><img src="images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="images/coupons3.jpg" class="flipv"><img src="images/coupons3.jpg" width="5" height="5"></td>
    <td background="images/coupons3.jpg" class="flipv"><div align="right"><img src="images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
  <tr> 
    <td colspan="4" class="bothfeatured3"><table width="100%" border="0" cellspacing="1" cellpadding="4">
        
		<tr><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
              <tr> 
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                      <td width="417" class="headingtd"> Learner Chating Detail</td>
                      <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
			     <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			   <tr> 
			<td width="85%"  colspan="2" valign="top" class="headingtd" style="padding-right:10px" align="right"><div align="right"><a href="javascript:print();"><img src="../admin/images/print_this_page.jpg" width="16" height="16" border="0"></a>&nbsp;&nbsp;<a href="javascript:print();">Print this Page</a>&nbsp;&nbsp;</div></td>
        </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr > 
                <td height="22" class="bodytext"><b>Learner Name</b></td>
                <td height="22" class="bodytext">&nbsp;<?php echo $stuname ; ?></td>
              </tr>
			  <tr > 
                <td height="22" class="bodytext"><b>Tutor Name</b></td>
                <td height="22" class="bodytext">&nbsp;<?php echo $tutorname ?></td>
              </tr>
              <?php
						?>
              
              <tr > 
                <td width="27%" height="22" class="bodytext"><strong>Booking Date</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php echo $sdcon." ".$stcon;?></td>
              </tr>
			  <tr > 
                <td width="27%" height="22" class="bodytext"><strong>Is Urgent</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php if($rs[5]==1)
																		 echo "YES";
																		 else
																		 echo "NO" ;?></td>
              </tr>
			  <tr > 
                <td width="27%" height="22" class="bodytext"><strong>Approve</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php if($rs[8]==1)
																		 echo "YES";
																		 else
																		 echo "NO" ;?></td>
              </tr>
			  <?php if($rs[8]==1)
						{
				?>
			  <tr > 
                <td width="27%" height="22" class="bodytext"><strong>Chating Start 
                  Time </strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php echo $sdcon1." ".$stcon1;?></td>
              </tr>
			  <tr> 
                <td width="27%" height="22" class="bodytext"><strong>Chating Ending 
                  Time </strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php echo $sdcon2." ".$stcon2;?></td>
              </tr>
			  <?php
			  }
			  ?>
              <tr> 
                <td height="22" colspan="2" class="bodytext"><strong>Topic Discussed</strong></td>
              </tr>
              <tr > 
                <td height="22" colspan="2" class="bodytext"><?php echo $rs[4];?></td>
              </tr>
              <tr > 
                
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
            </table></td></tr>
        <tr> 
          <td colspan="2"><div align="right"><img src="images/close.gif"  onClick="javascript:window.close();" style="cursor:hand"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="images/coupons3.jpg"><img src="images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="images/coupons3.jpg"><img src="images/coupons3.jpg" width="5" height="5"></td>
    <td background="images/coupons3.jpg"><div align="right"><img src="images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>
 
</table>

