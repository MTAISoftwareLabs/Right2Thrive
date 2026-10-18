<?php
//include_once '../config/config.php';
include_once 'dbConnection.php';
if(isset($_GET['id']))
{
	$sql="SELECT * FROM cpo_jobmaster where iJobId=".cleancode($_GET['id']);
	$rID=runquery($sql);
	
	if(isset($rID))
	{
		$rs = mysqli_fetch_array($rID);
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

<link href="style.css" rel="stylesheet" type="text/css">
<title>CareerPaths Online :: Jobs</title>

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

<body topmargin="0"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="10" colspan="4"><img src="images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr valign="top"> 
    <td height="35" colspan="4"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><strong>CareerPaths Online</strong></font></td>
  </tr>
  <tr> 
    <td width="1%"><img src="images/alhead_1.jpg" width="11" height="22"></td>
    <td width="77%" background="images/alhead_2.jpg" class="tableDetail">&nbsp;</td>
    <td width="20%" background="images/alhead_2.jpg" class="bodytext"><strong>Date: 
      </strong> 
      <? $d=explode("-",$rs[4]);
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
			<td></td>
          <td width="63%" valign="top" class="bodytext"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo $rs['vJobTitle']?></b></font></td>
          <td width="2%" valign="top"><div align="right"><a href="javascript:print();"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
          <td width="20%" valign="top"><div align="center">
              <p class="bodytext"><a href="javascript:print();">Print this Page</a>&nbsp;&nbsp;</p>
            </div></td>
        </tr>
        <tr> 
          <td colspan="4" class="bodytext"><table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2" class="">
              <tr bgcolor="#FFFFFF"> 
                <td height="22" class="bodytext" colspan="2"><b>Description</b></td>
               
              </tr>
            <tr bgcolor="#FFFFFF"> 
                <td height="22" colspan="2" class="bodytext"><? echo $rs['tJobDesc']; ?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Job contact address </strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<? echo $rs['vContactAdd'];?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Job contact person </strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<? echo $rs['vContactPerson'];?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Job contact phone </strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<? echo $rs['vContactPhone'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Email-Id</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<? echo $rs['vJobEmailId'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Job Category</strong></td>
<?
$sqlc="select * from cpo_categorymaster where iCategoryId=".$rs['iCategoryId']."";
$result=runquery($sqlc);
	
	if(isset($result))
	{
		$rsc= mysqli_fetch_array($result);
		$catname=$rsc['vCategoryName'];	
	}
?>				
                <td width="73%" height="22" class="bodytext">&nbsp;<? echo $catname;?></td>
              </tr>
             <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Company</strong></td>
<?
$sqli="select vInstituteName from cpo_institutemaster where iInstituteId=".$rs['iInstituteId']."";
$rsinam=runquery($sqli);
	
	if(isset($rsinam))
	{
		$rsi= mysqli_fetch_array($rsinam);
		//echo $rsi;
		//exit;
		$iname=$rsi['vInstituteName'];	
	}
?>				
                <td width="73%" height="22" class="bodytext">&nbsp;<? echo $iname;?></td>
              </tr>  
			   <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Active</strong></td>
				<td width="73%" height="22" class="bodytext">&nbsp;
				<? if($rs['iStatus']=1)
					{
						echo "Yes";
					}
					else
					{
						echo "No";
					}	
				?></td>
              </tr> 
            </table></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right"><img src="images/closebutton.gif" onClick="javascript:window.close();" style="cursor:hand"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="images/coupons3.jpg"><img src="images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="images/coupons3.jpg"><img src="images/coupons3.jpg" width="5" height="5"></td>
    <td background="images/coupons3.jpg"><div align="right"><img src="images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>
<?
	}
}
?>