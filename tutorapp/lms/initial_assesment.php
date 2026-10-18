<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@ob_start();	
include "dbConnection.php";
if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
$aid=$_SESSION['user_id'];
$sqlspn = "Select * from initialass where student='$aid'";
								$res=runquery1($sqlspn);
								

?>
<html>
<head>
<title><? echo sitename;?>Edit Learner Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../functions.js"></script>
<script language="JavaScript" src="calendar1.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color:#DCEEFC;
}
-->
</style>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>

<body >
<pre>&nbsp;</pre>
<table width="900"  cellspacing="0" cellpadding="0" style="margin:auto" align="center">
  <tr>
    <td>
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>


<table width="911" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <th height="672"  align="center"><table width="905" border="0" align="center"  cellpadding="0" cellspacing="0">
      
      <tr>
        <th width="199" rowspan="3" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><? include "leftpanel.php"; ?></th>
      </tr>
      <tr>
        <th colspan="2" align="left" valign="top" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
          <tr>
            <td valign="top"><? include "includewelcome.php";?>            </td>
          </tr>
          <tr>
            <td valign="top" height="30">&nbsp;</td>
          </tr>
          <tr>
            <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="welcome">Initial Assessment</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr>
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                    <table class="" width="90%" align="center">
                         <tr>
						    <td height="15" class="bodytext" align="left"><strong>Document</strong></td>
						    <td height="15" class="bodytext" align="left">&nbsp;</td>
					      </tr>
						  <?php
						  while($intfetch=mysqli_fetch_array($res)){?>
						  
						  <tr>
                            <td width="11%" height="15" class="bodytext" align="left"> 
						 <p> <a href="../upload/<?=$intfetch['title']?>" target="_blank">
                            <?=$intfetch['title']?>
                          </a></p>						 </td>
                            <td width="10%" height="15" class="bodytext" align="left"><p> <a href="<?=$intfetch['website']?>" target="_blank">
                            <?=$intfetch['website']?>
                          </a></p></td>
                          </tr>
						   <? } ?>
                          <tr>
                            <td height="15" colspan="2">&nbsp;</td>
                          </tr>
                      </table></td>
              </tr>
              <tr>
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="closewin()" style="cursor:hand"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th colspan="2" align="center" valign="top" scope="col"></th>
      </tr>
     
      <tr>
        <th colspan="2" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><div align="center">
          <? include "includebottom.php";?>
        </div></th>
        </tr>
      
      
      
    </table>      
    </th>
  </tr>
</table>
<p class="table">&nbsp;</p>

<map name="Map" id="Map"><area shape="rect" coords="1,1,71,25" href="#" /></map>
<map name="Map2" id="Map2"><area shape="rect" coords="1,1,196,67" href="#" /></map>
<map name="Map3" id="Map3"><area shape="rect" coords="-4,-6,167,30" href="#" /></map></body>
</html>
