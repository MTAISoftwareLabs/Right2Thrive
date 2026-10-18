<?php
//include_once '../config/config.php';
include "dbConnection.php";

	$sql="SELECT * FROM cpo_newsmaster where iNewsID=".cleancode($_GET['id']);
//	echo $sql;
    $rID=runquery($sql);
	//$rs = mysqli_fetch_row($rID);
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
.seffect
{

    
    BACKGROUND-COLOR: #ffffff;
    SCROLLBAR-FACE-COLOR: #ffffff;
    SCROLLBAR-HIGHLIGHT-COLOR: #ffffff;
    SCROLLBAR-SHADOW-COLOR:#A4BECB;
    SCROLLBAR-3DLIGHT-COLOR:#A4BECB;
    SCROLLBAR-ARROW-COLOR: #A4BECB;
    SCROLLBAR-TRACK-COLOR: #ffffff;
    SCROLLBAR-DARKSHADOW-COLOR: #eeeeee

}
</style>
<!--<link href="css/styles.css" rel="stylesheet" type="text/css">-->
<link href="style.css" rel="stylesheet" type="text/css">
<title>CareerPaths Online :: Courses</title>

<script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-34503062-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
</script>

<body topmargin="0" class="seffect">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="10" colspan="4"><img src="images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr valign="top"> 
    <td height="23" colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        
          <td width="100%" class="intheading"><img src="images/arrow.gif" width="14" height="14">&nbsp;Welcome 
            to News</td>
                      </tr>
                    </table></td>
  </tr>
  <tr> 
    <td width="1%"><img src="images/alhead_1.jpg" width="11" height="22"></td>
    <td width="77%" background="images/alhead_2.jpg" class="tableDetail">&nbsp;</td>
    <td width="20%" background="images/alhead_2.jpg" class="tableDetail"><strong>Date: 
      </strong> 
      <? $d=explode("-",$rs[3]);
	  echo $d[2]."/".$d[1]."/".$d[0]; ?>
    </td>
    <td width="2%"><img src="images/alhead_3.jpg" width="11" height="22"></td>
  </tr>
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
        <tr> 
		<?
		//echo "admin/upload/".$rs[0].".jpg";
if(file_exists("admin/upload/".$rs[0].".jpg"))
			{
				$file1="admin/upload/".$rs[0].".jpg";
			}
			else
			{
				$file1="images/noavailable_big.jpg";
			}
		?>
          <td width="15%"><div align="center"><img src="<? echo $file1; ?>" width="130" height="130" border="0"></div></td>
          <td width="63%" valign="top"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo $rs[1]?></b></font></td>
          <td width="2%" valign="top"><div align="right"><a href="javascript:print();"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
          <td width="20%" valign="top"><div align="center"><a href="javascript:print();">Print 
              this Page</a>&nbsp;&nbsp;</div></td>
        </tr>
        <tr> 
          <td colspan="4" class="welcomenote"><? echo $rs[2]?></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right"><img src="images/close.gif" width="73" height="22" onClick="javascript:window.close();" style="cursor:hand"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="images/coupons3.jpg"><img src="images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="images/coupons3.jpg"><img src="images/coupons3.jpg" width="5" height="5"></td>
    <td background="images/coupons3.jpg"><div align="right"><img src="images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>

