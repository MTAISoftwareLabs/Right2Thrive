<?php
include_once 'dbConnection.php';

	$sql="SELECT * FROM cpo_usermaster where iUserID=".$_GET['id'];
    $rID=runquery1($sql);
	if(isset($rID))
	{
		$rslist = mysqli_fetch_row($rID);
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
<title>Learner Information - Careerpaths Online</title><body topmargin="0">
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
                      <td width="417" class="headingtd"> User Information</td>
                      <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
                    User Name </div></td>
                <td align=left width="77%"> &nbsp;&nbsp; <?php if($rslist[1] != '' ){ echo ucfirst($rslist[1]); }else { echo " - ";} ?> 
                </td>
              </tr>
			  <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
                    Password </div></td>
                <td align=left width="77%"> &nbsp;&nbsp; <?php if($rslist[2] != ''){ echo ucfirst($rslist[2]); }else { echo " - ";} ?> 
                </td>
              </tr>
			  
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Address</div></td>
                <td align=left>&nbsp;&nbsp; <?php if($rslist[3] != '' ){ echo ucfirst($rslist[3]); }else { echo " - ";} ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Postal 
                    Code </div></td>
                <td align=left>&nbsp;&nbsp; <?php if($rslist[4] != '' ){ echo ucfirst($rslist[4]); }else { echo " - ";} ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Country</div></td>
                <td align=left>&nbsp;&nbsp;&nbsp;<?php if($rslist[5] != '' ){ echo ucfirst($rslist[5]); }else { echo " - ";} ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Mobile</div></td>
                <td align=left>&nbsp;&nbsp; <?php if($rslist[6] != '' ){ echo ucfirst($rslist[6]); }else { echo " - ";} ?></td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Phone</div></td>
                <td align=left>&nbsp;&nbsp; <?php if($rslist[7] != '' ){ echo ucfirst($rslist[7]); }else { echo " - ";} ?> 
                </td>
              </tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; EmailId</div></td>
                <td align=left>&nbsp;&nbsp;&nbsp;<?php if($rslist[8] != '' ){ echo ucfirst($rslist[8]); }else { echo " - ";} ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; What 
                    qualifications (if any) do &nbsp;&nbsp;you have?</div></td>
                <td align=left>&nbsp;&nbsp; <?php if($rslist[10] != '' ){ echo ucfirst($rslist[10]); }else { echo " - ";} ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Registration 
                    Date </div></td>
                <td align=left>&nbsp;&nbsp;  <?php if($rslist[12] != '' ){  $d=explode("-",$rslist[12]);
												$rdate=$d[2]."/".$d[1]."/".$d[0];
												echo $rdate; }else { echo " - ";} ?> </td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Birth 
                    Date </div></td>
                <td align=left>&nbsp;&nbsp;   <?php if($rslist[13] != '' ){  $d=explode("-",$rslist[13]);
												$rdate=$d[2]."/".$d[1]."/".$d[0];
												echo $rdate;}else { echo " - ";} ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Ethenticity</div></td>
                <td align=left>&nbsp;&nbsp;&nbsp;<?php if($rslist[14] != '' ){ echo ucfirst($rslist[14]); }else { echo " - ";} ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Gender</div></td>
                <td align=left>&nbsp;&nbsp; <?php if($rslist[15] != '' ){  if($rslist[15]==1)
												 echo "Male";
												else
												 echo "Female"; }else { echo " - ";} ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; School</div></td>
                <td align=left>&nbsp;&nbsp; <?php if($rslist[24] != '' )
				{
				 $sql1 ="select * from cpo_school where I_schoolid=".$rslist[24];
												$res1 = runquery1($sql1);
												$fet1 = mysqli_fetch_array($res1);
												echo ucfirst($fet1['I_schoolname']);
												}
												else
												{ echo "-"; } ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Year</div></td>
                <td align=left>&nbsp;&nbsp; <?php  if( $rslist[25] != 0) { echo $rslist[25];}?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Class</div></td>
                <td align=left>&nbsp;&nbsp;  <?php  if( $rslist[26] != '') { echo $rslist[26];}?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Are you in work?</div></td>
                <td align=left>&nbsp;&nbsp; <?php if($rslist[16] != '' ){
												if($rslist[16]==1)
												 echo "Yes";
												else
												 echo "No"; }else {echo "-";}?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; If yes, 
                    what is your job?<br>
                    &nbsp;&nbsp;OR &nbspIf no, how long have<br>
                    &nbsp;&nbsp;you been &nbspout of work?</div></td>
                <td align=left>&nbsp;&nbsp; <?php  if($rslist[17] != '' ) {echo $rslist[17];}else {echo "-";} ?></td>
              </tr>
			   <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; What 
                    career interests you?</div></td>
                <td align=left>&nbsp;&nbsp;  <?php  if($rslist[18] != '' ) { echo $rslist[18]; }else {echo "-";} ?></td>
              </tr>
			   <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; What 
                    qualifications do&nbsp;<br>
                    &nbsp; you want to gain?</div></td>
                <td align=left>&nbsp;&nbsp;  <?php  if($rslist[19] != '' ) {echo $rslist[19]; }else {echo "-";} ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; What 
                    skills do you have?</div></td>
                <td align=left>&nbsp;&nbsp;  <?php  if($rslist[20] != '' ) { echo $rslist[20];}else {echo "-";}  ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; What 
                    are your hobbies?</div></td>
                <td align=left>&nbsp;&nbsp; <?php  if($rslist[21] != '' ) { echo $rslist[21]; }else {echo "-";} ?></td>
              </tr>
			  <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Do you 
                    have a disability?</div></td>
                <td align=left>&nbsp;&nbsp;  <?php  if($rslist[22] != '' ) { if($rslist[22]==1)
												 echo "Yes";
												else
												 echo "No"; }else {echo "-";} ?></td>
              </tr>
			   <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; If yes,Please 
                    Explain</div></td>
                <td align=left>&nbsp;&nbsp;  <?php  if($rslist[23] != '' ) { echo $rslist[23]; }else {echo "-";}  ?></td>
              </tr>
			   <td colspan="2" height="2%">&nbsp;</td>
			  
			 
			  <?php
				$sql="SELECT * FROM cpo_usercourse where iUserId=".$_GET['id'];
				$rID=runquery1($sql);
				$numId = mysqli_num_rows($rID);
				if($numId > 0)
				{ ?>  <tr> 
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                      <td width="417" class="headingtd"> Course Information</td>
                      <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
			  <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
				
			  <?php
						while($row=mysqli_fetch_array($rID))
						{	?> 
             			 <tr> 
                <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
                    Course Applied For</div></td>
                <td align=left width="77%"> &nbsp;&nbsp; <?php 		
									$sql1="select vCourseName from cpo_coursemaster where iCourseId = '".$row["iCourseId"] ."'";
									
									$result1=runquery1($sql1) or die('could not execute query'.mysqli_error());
									$count=mysqli_num_rows($result1);
									if($count>0)
									{
										$name=mysqli_result($result1,0,0);
									
									echo $name;
									}
									 ?>	
                </td>
              </tr>
						  <?php
						  }
			
		 		}//rows
						  ?>
			  
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

