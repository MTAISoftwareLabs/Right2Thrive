<?php
include_once 'dbConnection.php';

	$sql="SELECT * FROM cpo_usermaster where iUserID=".$_GET['id'];
    $rID=runquery1($sql);
	if(isset($rID))
	{
		$rslist = mysqli_fetch_array($rID);
	}
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
<title>Tutor Information - Careerpaths Online</title>
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
                      <td width="417" class="headingtd"> Tutor Information</td>
                      <td class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
                    Tutor Name </div></td>
                <td align=left width="77%"> &nbsp;&nbsp; <?php echo $rslist["vUserName"]; ?> 
                </td>
              </tr>
			  <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
                    Password</div></td>
                <td align=left width="77%"> &nbsp;&nbsp; <?php echo $rslist["vUserPassword"]; ?> 
                </td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Address</div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["vUserAddress"]; ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Phone 
                    No </div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["vUserMobile"]; ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Mobile 
                    No </div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["vUserPhone"]; ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Email 
                    Id </div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["vUserEmailId"]; ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Qualification</div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["TUserQualification"]; ?> 
                </td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Achievements</div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["TUserAchive"]; ?></td>
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

