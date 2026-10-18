<?php
include_once 'dbConnection.php';

$flash_file=$HTTP_GET_VARS['id'];
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
<link href="../admin/styles.css" rel="stylesheet" type="text/css">
<title><? echo sitename;?>Preview of Flash File</title><body topmargin="0">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan="4"><img src="../admin/images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td width="1%" background="../admin/images/coupons3.jpg" class="flipv"><img src="../admin/images/coupons2.jpg" width="5" height="5"></td>
    <td width="97%" colspan="2" background="../admin/images/coupons3.jpg" class="flipv"><img src="../admin/images/coupons3.jpg" width="5" height="5"></td>
    <td width="2%" background="../admin/images/coupons3.jpg" class="flipv"><div align="right"><img src="../admin/images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
  <tr> 
    <td colspan="4" class="bothfeatured3"><table width="100%" border="0" cellspacing="1" cellpadding="4">
        <tr>
		<?
			if(file_exists("../admin/flash/".$flash_file.".swf"))
			{
			?> 
          <td align="center"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="600">
              <param name="movie" value="http://www.careerpathsonline.net/admin/flash/<? echo $flash_file ?>.swf">
              <param name="quality" value="high">
              <embed src="http://www.careerpathsonline.net/admin/flash/<? echo $flash_file ?>.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="32" height="32"></embed></object> 
          </td>
		  <?
		  }
		  else
		  {
		  	?>
          	<td align="center">No file Available
         	 </td>
		  <?
		  }
		  ?>
        </tr>
        <tr> 
          <td height="328"><div align="right"><img src="../admin/images/close.gif" width="73" height="22" onClick="javascript:window.close();" style="cursor:hand"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="../admin/images/coupons3.jpg"><img src="../admin/images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../admin/images/coupons3.jpg"><img src="../admin/images/coupons3.jpg" width="5" height="5"></td>
    <td background="../admin/images/coupons3.jpg"><div align="right"><img src="../admin/images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>

