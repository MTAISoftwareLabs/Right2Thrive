<?php
include_once 'dbConnection.php';
	if($_GET['type'] == 'E')
	{
		$type = 'Exclusion';
	}
	else
	{
		$type='Detention';
	}
	$sql="SELECT * FROM cpo_detention where I_detentionid=".$_GET['sid'];
    $rID=runquery1($sql);
	$rslist = mysqli_fetch_array($rID);
	//tutor
	$sql_t = "select vUserName  from cpo_usermaster where iUserId =".$rslist['i_tutorid'];
	$res_t = runquery1($sql_t);
	$fet_t = mysqli_fetch_array($res_t);
	$tutor = $fet_t['vUserName'];
	//learner
	$sql_l = "select vUserName  from cpo_usermaster where iUserId =".$rslist['I_userid'];
	$res_l = runquery1($sql_l);
	$fet_l = mysqli_fetch_array($res_l);
	$learner = $fet_l['vUserName'];
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
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<title><?php echo $type;?> - Careerpaths Online</title><body topmargin="0">
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
                      <td width="417" class="headingtd"> <?php echo $type ?> Information</td>
                      <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr>
	              
                <td width="41%" height="2%">&nbsp;<strong>Tutor Name</strong></td>
				  <td width="59%"><?php echo ucfirst($tutor );?></td>
			  </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr>
	              
                <td width="41%" height="2%">&nbsp;<strong>Learner Name</strong></td>
				  <td width="59%"><?php echo ucfirst($learner);?></td>
			  </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr>
	              
                <td width="41%" height="2%">&nbsp;<strong>Detention Date</strong></td>
				  <td width="59%"><?php  $date = explode('-', $rslist['D_detention']); echo $date[2]."/".$date[1]."/".$date[0];?></td>
			  </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr>
	              
                <td width="41%" height="2%">&nbsp;<strong>Detention Reason</strong></td>
				  <td width="59%"><?php if( $rslist['V_reason'] != '') { echo $rslist['V_reason'];} else { echo "-";}?></td>
			  </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr>
	              
                <td width="41%" height="2%">&nbsp;<strong>Improvement</strong></td>
				  <td width="59%"><?php  if( $rslist['T_improve'] != '') {  echo $rslist['T_improve']; } else { echo "-";}?></td>
			  </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr>
	              
                <td width="41%" height="2%">&nbsp;<strong>Tutor Comments</strong></td>
				  <td width="59%"><?php   if( $rslist['T_tcomments'] != '') {  echo $rslist['T_tcomments'];  } else { echo "-";}?></td>
			  </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr>
	              
                <td width="41%" height="2%">&nbsp;<strong>Parent Comments </strong></td>
				  <td width="59%"><?php   if( $rslist['T_pcomments'] != '') {  echo $rslist['T_pcomments'];  } else { echo "-";}?></td>
			  </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr>
	              
                <td width="41%" height="2%">&nbsp;<strong>Student Comments</strong></td>
				  <td width="59%"><?php   if( $rslist['T_scomments'] != '') {  echo $rslist['T_scomments'];  } else { echo "-";}?></td>
			  </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  </table></td></tr>
        <tr> 
          <td colspan="2"><div align="right"><img src="images/close.gif" onClick="javascript:window.close();" style="cursor:hand"></div></td>
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

