<?php
include_once 'dbConnection.php';
if($_GET['flag'] == 'D')
{
	$flag = 'Detention';
}
else
{
	$flag = 'Exclusion';
}
$sql="SELECT * FROM cpo_detention where I_detentionid=".$_GET['id'];
$rID=runquery1($sql);

if(isset($rID))
{
	$result_info = mysqli_fetch_array($rID);
}
?>
<form name="frmhw" method="post" action="personaldev.php?did=<?php echo $_GET['id']?>" onSubmit="return valid_deten()">
	<input type="hidden" name="hdn_det" value="1">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="10" colspan="4"><img src="../images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td colspan="4"><img src="../images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td background="../images/coupons3.jpg" class="flipv"><img src="../images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../images/coupons3.jpg" class="flipv"><img src="../images/coupons3.jpg" width="5" height="5"></td>
    <td background="../images/coupons3.jpg" class="flipv"><div align="right"><img src="../images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
  <tr> 
    <td colspan="4" class="bothfeatured3"><table width="100%" border="0" cellspacing="1" cellpadding="4">
       
        <tr> 
          <td colspan="4">
<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2" class="">
			    <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext">&nbsp;<strong>Date</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php  $date = explode('-', $result_info['D_detention']); echo $date[2]."/".$date[1]."/".$date[0];?></td>
              </tr>
			    <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext">&nbsp;<strong>Reason</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php if( $result_info['V_reason'] != '') { echo ucfirst($result_info['V_reason']);} else { echo "-";}?></td>
              </tr>
			    <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext" colspan="2">&nbsp;<strong>What do I need to improve?</strong></td>
              </tr>
				  <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext" colspan="2">&nbsp;<?php  if( $result_info['T_improve'] != '') {  echo ucfirst($result_info['T_improve']); } else { echo "-";}?></td>
             
              </tr>
			      <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext" colspan="2"><strong>Tutor  Comments</strong></td>
              </tr>
				   <tr bgcolor="#FFFFFF"> 
                <td class="bodytext" colspan="2">&nbsp;<?php   if( $result_info['T_tcomments'] != '') {  echo ucfirst($result_info['T_tcomments']);  } else { ?><textarea name="txttcomments" cols="60" rows="3"></textarea>   <?php }?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext" colspan="2"><strong>Student Comments</strong></td>
               
              </tr>
				  <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext">&nbsp;<?php if($result_info['T_scomments'] != ''){echo $result_info['T_scomments'];}else { echo "-"; }?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td colspan="2" height="22" class="bodytext"><strong>Parent Comments</strong></td>
              </tr>
				  <tr bgcolor="#FFFFFF"> 
                <td colspan="2" height="22" class="bodytext">&nbsp;<?php if($result_info['T_pcomments'] != ''){echo $result_info['T_pcomments'];}else { echo "-"; }?></td>
              </tr>
             
            
            </table></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right"><?php if($result_info['T_tcomments'] !=''){  }else {?>
				<input type="image" src="../admin/images/submitbttn.jpg"><?php }?>&nbsp;&nbsp;<img src="images/closebutton.gif" onClick="hide('<?php echo $_GET['flag']?>');" style="cursor:hand">&nbsp;&nbsp;</div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="../images/coupons3.jpg"><img src="../images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../images/coupons3.jpg"><img src="../images/coupons3.jpg" width="5" height="5"></td>
    <td background="../images/coupons3.jpg"><div align="right"><img src="../images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>
</form>