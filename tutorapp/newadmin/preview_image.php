<?php
include_once 'dbConnection.php';

	$sql="SELECT * FROM cpo_newsmaster where iNewsID=".$_GET['id'];
    $rID=runquery1($sql);
	if(isset($rID))
	{
		$rs = mysqli_fetch_row($rID);
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
<link href="css/styles.css" rel="stylesheet" type="text/css">

<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan="4"><img src="images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td width="1%" background="images/coupons3.jpg" class="flipv"><img src="images/coupons2.jpg" width="5" height="5"></td>
    <td width="97%" colspan="2" background="images/coupons3.jpg" class="flipv"><img src="images/coupons3.jpg" width="5" height="5"></td>
    <td width="2%" background="images/coupons3.jpg" class="flipv"><div align="right"><img src="images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
  <tr> 
    <td colspan="4" class="bothfeatured3"><table width="100%" border="0" cellspacing="1" cellpadding="4">
        <tr> 
          <td align="center"><img src="upload/<?php echo $rs[0];?>.jpg" width="250" height="250"></td>
        </tr>
        <tr> 
          <td><div align="right"><img src="images/close.gif" onClick="javascript:window.close();" style="cursor:hand"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="images/coupons3.jpg"><img src="images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="images/coupons3.jpg"><img src="images/coupons3.jpg" width="5" height="5"></td>
    <td background="images/coupons3.jpg"><div align="right"><img src="images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>

