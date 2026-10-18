<?php
include_once 'dbConnection.php';

$sql="SELECT * FROM cpo_user_subject where I_user_subid=".$_GET['id'];
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
<title>Tutor-Subject-Learner Information - Careerpaths Online</title><body topmargin="0">
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
                      <td width="417" class="headingtd">Homework Detail</td>
                      <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
Subject</div></td>
                <td align=left width="77%"> &nbsp;&nbsp; 
				<?php
					$sqls = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$rslist["I_subjectid"];
					$querys = runquery1($sqls);
					$rows = mysqli_fetch_array($querys);
					echo $rows['vSubjectName'];
				 ?> 
                </td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Tutor </div></td>
                <td align=left>&nbsp;&nbsp; <?php 
				$sqlt = "select vUserName from cpo_usermaster where iUserId=".$rslist["I_tutorid"];
				$queryt = runquery1($sqlt);
				$rowt = mysqli_fetch_array($queryt);
				echo $rowt['vUserName'];
				?></td>
              </tr>
			  <tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp;  Learner</div></td>
                <td align=left><?php $sel = explode(';',$rslist["I_studentid"]);
				for($i=0;$i<(count($sel));$i++)
				{
					$selstudent = "select vUserName from cpo_usermaster where iUserId=".$sel[$i];
					$querystudent = runquery1($selstudent);
					$rowstudent = mysqli_fetch_array($querystudent);
					$student .=  "&nbsp;&nbsp;".ucfirst($rowstudent['vUserName'])."<br>";
				}
				echo $student;
				?></td>
              </tr>
			  <tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp;                   Level</div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["V_sublevel"]; ?></td>
              </tr>
			  <tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			 
			  <tr>
              <td colspan="2" height="2%">&nbsp;</td>
			  </tr>
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

