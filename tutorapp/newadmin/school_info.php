<?php
include_once 'dbConnection.php';

	$sql="SELECT * FROM cpo_school where I_schoolid=".$_GET['sid'];
    $rID=runquery1($sql);
	$rslist = mysqli_fetch_array($rID);
	
?>
<style>

.flipv {
	FILTER: FlipV();
}
</style>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<title>School Information - Careerpaths Online</title><body topmargin="0">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr> 
    <td colspan="4"><img src="images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td background="images/coupons3.jpg"><img src="images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="images/coupons3.jpg"><img src="images/coupons3.jpg" width="5" height="5"></td>
    <td background="images/coupons3.jpg"><div align="right"><img src="images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
  <tr> 
    <td colspan="4" class="bothfeatured3"><table width="100%" border="0" cellspacing="1" cellpadding="4">
        
		<tr><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
              <tr> 
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                      <td width="417" class="headingtd"> School Information</td>
                      <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr>
	              
                <td width="41%" height="2%">&nbsp;<strong>School Name</strong></td>
				  <td width="59%"><?php echo $rslist[1];?></td>
			  </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			<tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
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

