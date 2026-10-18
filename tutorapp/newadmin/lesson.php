<?php
include_once 'dbConnection.php';

$sql="SELECT * FROM cpo_lessons where I_lid=".$_GET['id'];
$rID=runquery1($sql);
if(isset($rID))
{
	$rslist = mysqli_fetch_array($rID);
}
$lname = $rslist['V_name'];
 $sql = "select I_user_subjectid from  cpo_lessons where V_name ='".$lname."'";
$rs1 = runquery1($sql);
$id = array();
while($r1 = mysqli_fetch_array($rs1))
{
	$id[] = $r1['I_user_subjectid'];
}

for($i=0;$i<count($id);$i++)
{
	 $sql_l = "select us.I_user_subid ,us.I_studentid ,sb.iUserId,sb.vUserName  from cpo_user_subject as  us, cpo_usermaster  as sb where  us. I_user_subid   =".$id[$i]."  and  us.I_studentid=sb.iUserId";
	$rs_1 = runquery1($sql_l);
	while($rs_le = mysqli_fetch_array($rs_1))
	{
		$name .= '&nbsp;&nbsp;&nbsp;'.ucfirst($rs_le['vUserName'])."<br>";
	}
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
                      <td width="417" class="headingtd"> Lesson Detail</td>
                      <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Subject</div></td>
                <td align=left>&nbsp;&nbsp; <?php 
				$sqls = "select sub.vSubjectName,sub.iSubjectId,us.I_subjectid from cpo_subjectmaster as sub, cpo_user_subject as us,cpo_lessons as l where sub.iSubjectId=us.I_subjectid and l.I_user_subjectid=".$rslist["I_user_subjectid"]." and l.I_user_subjectid=us.I_user_subid";
						$querys = runquery1($sqls);
						$rows = mysqli_fetch_array($querys);
						echo ucfirst($rows['vSubjectName']); ?></td>
              </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Tutor</div></td>
                <td align=left>&nbsp;&nbsp; <?php 
				$sqls = "select sub.vUserName,sub.iUserId,us.I_tutorid from cpo_usermaster as sub, cpo_user_subject as us,cpo_lessons as l where sub.iUserId=us.I_tutorid and l.I_user_subjectid=".$rslist["I_user_subjectid"]." and l.I_user_subjectid=us.I_user_subid";
						$querys = runquery1($sqls);
						$rows = mysqli_fetch_array($querys);
						echo ucfirst($rows['vUserName']);
				
				  ?></td>
              </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			  <tr> 
                <td align=right class="bodytext" valign="top"><div align="left">&nbsp; Learner</div></td>
                <td align=left> <?php echo $name; ?></td>
              </tr>
			   <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right width="23%" class="bodytext"> <div align="left">&nbsp; 
                    Lesson Name</div></td>
                <td align=left width="77%"> &nbsp;&nbsp; <?php echo $rslist["V_name"]; ?> 
                </td>
              </tr>
              <tr> 
                <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext" width="23%" valign="top"><div align="left">&nbsp; Lesson Description </div></td>
                <td align=left width="77%">&nbsp;&nbsp;&nbsp;<?php echo $rslist["T_desc"]; ?></td>
              </tr>
			  <tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
              <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Assign 
                    Date</div></td>
                <td align=left>&nbsp;&nbsp; <?php  $d=explode("-",$rslist["D_date"]);
												$rdate=$d[2]."/".$d[1]."/".$d[0];
												echo $rdate; ?></td>
              </tr>
			  <tr>
              <td colspan="2" height="2%">&nbsp;</td>
              </tr>
			   <tr> 
                <td align=right class="bodytext"><div align="left">&nbsp; Due 
                    Date</div></td>
                <td align=left>&nbsp;&nbsp; <?php  $due=explode("-",$rslist["D_duedate"]);
												$date=$due[2]."/".$due[1]."/".$due[0];
												echo $date; ?></td>
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

