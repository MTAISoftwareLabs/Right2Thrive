<?php
include_once 'dbConnection.php';

	$sql="SELECT * FROM cpo_usercourse where iUserID=".$_GET['id']." and iCourseId=".$_GET['cid']."";
    $rID=runquery1($sql);
	if(isset($rID))
	{
		$rslist = mysqli_fetch_array($rID);
		$reS=explode(",",$rslist['vSubjectId']);
		$reT=explode(",",$rslist['vTutorId']);
		$reST=explode(",",$rslist['vSubjectStatus']);
		$total=count($reS);   
	}
	$sqlL="select vUserName from cpo_usermaster where iUserId=".$_GET['id']."";
	$rL=runquery1($sqlL);
	$resL = mysqli_fetch_array($rL);
	
	$sqlC="select vCourseName from cpo_coursemaster where iCourseId=".$_GET['cid']."";
	$rC=runquery1($sqlC);
	$resC = mysqli_fetch_array($rC);
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
<head>
<title>Learner Course Information</title>
</head>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">

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
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                      <td width="417" class="headingtd"> Learner Course Information</td>
                      <td class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="3" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
                    Learner Name </div></td>
                <td align=left width="77%" colspan="2"> &nbsp;&nbsp; <?php echo $resL["vUserName"]; ?> 
                </td>
              </tr>
			  <tr> 
                <td colspan="3" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
                    Course Name</div></td>
                <td align=left width="77%" colspan="2"> &nbsp;&nbsp; <?php echo $resC["vCourseName"]; ?> 
                	</td>
              </tr>
              <tr> 
                <td colspan="3" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td  class="bodytext" width="34%" height="20">&nbsp; Subject Name</td>
				<td class="bodytext" width="33%" height="20">&nbsp; Tutor 
                    Name </td>
				<td class="bodytext" width="33%" height="20">&nbsp; Status 
                     </td>
              
              </tr>
			  
			  <?php for($i=0;$i<$total;$i++)
			  { ?>
			  <tr>
			    <td align=left height="20">&nbsp; 
					<?php $sub="";
					
						$sqlS="select vSubjectName from cpo_subjectmaster where iSubjectId=".$reS[$i]."";
						$rS=runquery1($sqlS);
						$resS = mysqli_fetch_array($rS);
						$sub=$resS['vSubjectName'];
						echo $sub; ?>
				</td>
				
				 <td align=left height="20">&nbsp; 
					<?php  $tutor="";

					 $sqlT="select vUserName from cpo_usermaster where iUserId=".$reT[$i]."";
                     $rT=runquery1($sqlT);
					 $resT = mysqli_fetch_array($rT);
					 $tutor=$resT['vUserName'];
					 echo $tutor;  ?>
				</td>
				
				<td align=left height="20">&nbsp;
				<?php $st='';

						if($reST[$i]==0)
						{
							$st="InComplete";
						}
						else
						{
							$st="Complete";
						}
						echo $st; ?>
				</td>
				
			  </tr>
			 <?php } ?>
			  <tr>
              <td colspan="3" height="2%">&nbsp;</td>
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

