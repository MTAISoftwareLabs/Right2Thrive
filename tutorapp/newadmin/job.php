<?php
include_once 'dbConnection.php';

	$sql="SELECT * FROM cpo_jobmaster where iJobId=".$_GET['id'];
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
<title>Job Information - Careerpaths Online</title><body topmargin="0">
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
                      <td width="417" class="headingtd"> Job Detail</td>
                      <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
                    Job Title</div></td>
                <td align=left width="77%"> &nbsp;&nbsp; <?php echo $rslist["vJobTitle"]; ?> 
                </td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Job 
                    Description </div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["tJobDesc"]; ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Contact 
                    Address </div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["vContactAdd"]; ?></td>
              </tr>
			    <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Contact 
                    Person</div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["vContactPerson"]; ?></td>
              </tr>
			    <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Contact 
                    Phone</div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["vContactPhone"]; ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; E-mail Address
                     </div></td>
                <td align=left>&nbsp;&nbsp; <?php echo $rslist["vJobEmailId"]; ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Validation 
                    Date</div></td>
                <td align=left>&nbsp;&nbsp; <?php  $d=explode("-",$rslist["dDate"]);
												$rdate=$d[2]."/".$d[1]."/".$d[0];
												echo $rdate; ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Category</div></td>
                <td align=left>&nbsp;&nbsp; <?php $fetch="select vCategoryName from cpo_categorymaster where iCategoryId='$rslist[iCategoryId]'";
												$result=runquery1($fetch);
												$count=mysqli_num_rows($result);
												if($count==1)
												{
													$name=mysqli_result($result,0,0);
													echo $name;
												}?>
											</td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Institute</div></td>
                <td align=left>&nbsp;&nbsp; <?php $fetch="select vInstituteName from cpo_institutemaster where iInstituteId='$rslist[iInstituteId]'";
												$result=runquery1($fetch);
												$count=mysqli_num_rows($result);
												if($count==1)
												{
													$name=mysqli_result($result,0,0);
													echo $name;
												}?>
                </td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
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

