<?php
include_once 'dbConnection.php';

$sql="SELECT * FROM cpo_progressreport where I_progressid=".$_GET['id'];
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
<title>Lesson Information - Careerpaths Online</title><body topmargin="0">
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
                      <td width="417" class="headingtd"> Monthly Progress Report Detail</td>
                      <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width="34%"><div align="left">&nbsp;&nbsp;<strong>Learner Name</strong></div></td>
                <td align=left width="66%">&nbsp;&nbsp;<?php
				$sqlstu = "select vUserName from cpo_usermaster where iUserId=".$rslist["I_userid"];
				$rsstu = runquery($sqlstu);
				$nums = $rsstu ? mysqli_num_rows($rsstu) : 0 ;
				if ($nums > 0 )
				{
					$rsdatas = mysqli_fetch_array($rsstu);
					$stuname = $rsdatas['vUserName'];
				}
				else
				{
					$stuname = "No student";
				}
				echo $stuname;
				  ?>                </td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right><div align="left">&nbsp;&nbsp;<strong>Tutor Name</strong></div></td>
                <td align=left>&nbsp;&nbsp;<?php 
				$sqltutor = "select vUserName from cpo_usermaster where iUserId=".$rslist["I_tutorid"];
				$rstutor = runquery($sqltutor);
				$num1 = $rstutor ? mysqli_num_rows($rstutor) : 0 ;
				if ($num1 > 0 )
				{
					$rsdata = mysqli_fetch_array($rstutor);
					$tutorname = $rsdata['vUserName'];
				}
				else
				{
					$tutorname = "No tutor";
				}
				echo $tutorname;
				?></td>
              </tr>
			  <tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			   <tr> 
                <td align=right ><div align="left">&nbsp;&nbsp;<strong>Year/Month</strong></div></td>
                <td align=left>&nbsp;&nbsp;<?php echo $rslist['I_year']."/".$rslist['I_month'];?></td>
              </tr>
			  <tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right><div align="left">&nbsp;&nbsp;<strong>Students Comments</strong></div></td>
                <td align=left>&nbsp;&nbsp;<?php if(!$rslist["T_scomments"])
				{echo "-";
				}
				else
				{
					echo $rslist["T_scomments"];
				}?></td>
              </tr>
			   <tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right><div align="left">&nbsp;&nbsp;<strong>Tutors Comments</strong></div></td>
                <td align=left>&nbsp;&nbsp;<?php if(!$rslist["T_tcomments"])
				{echo "-";
				}
				else
				{
					echo $rslist["T_tcomments"];
				}?></td>
              </tr>
			   <tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right><div align="left">&nbsp;&nbsp;<strong>Parents Comments</strong></div></td>
                <td align=left>&nbsp;&nbsp;<?php if(!$rslist["T_pcomments"])
				{echo "-";
				}
				else
				{
					echo $rslist["T_pcomments"];
				}?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
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

