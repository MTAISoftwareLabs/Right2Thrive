<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@ob_start();	
include "dbConnection.php";
if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
?>
<html>
<head>
<title><? echo sitename;?>Parent Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
function openwin(obj)
{
	new1=window.open("Detail_LogBook.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
}
</script>

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

</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><? include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
      <? include "includeleft.php";?>
    </td>
    <td background="images/welcome_bg.jpg" align="right" style="border-left:2px solid #ffffff" valign="top"> 
      <? include "includewelcome.php";?>
    </td>
  </tr>
 
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="98%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Welcome</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="11" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="35" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext">&nbsp;<b>Welcome 
                  to CareerPaths Online Parent Management System.</b></td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
		<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Notice Board</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
<?		$flag=0;
			if($flag==0)
			{
			  ?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4; padding-left:10px; padding-right:10px;" align="left" class="bodytext"><b>
                
                <?php
                	$query = "SELECT * FROM `cpo_notice` WHERE `iUserId`='".$user_id."'";
					$result = runquery1($query) or die('could note execute'.mysqli_error());
					$num = mysqli_num_rows($result);
				?>
                
              	<?php $i=1; while($rslist = mysqli_fetch_array($result)){?>
                	
                	<div style="100%; margin-top:5px;"><? echo $rslist["notice"]; ?></div>
                    
                    
                   <div style="width:100%; <?php if($num>$i) { ?> border-bottom:1px solid #999; <?php } $i++; ?> margin-top:-5px;">&nbsp;</div>
                  	
                <?php }?>
                </b></td>
              </tr>
			<?
			}
			else
			{
			?>
              <tr> 
                <td height="25" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;" align="center" class="bodytext">&nbsp;</td>
              </tr>
			  <?
			  }
			  ?>
              <tr> 
                <td width="2%" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                <td width="2%" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
      </table></td>
   <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
 <? include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
