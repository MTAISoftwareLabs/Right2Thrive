<?php
include_once 'dbConnection.php';
include "../function.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><? echo sitename;?>Courses</title>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="functions.js"></script>
<script language="JavaScript">

function openwin1(obj)
{
	
	new1=window.open("moredesc_course.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
</script>
</head>
<body topmargin="0">
<?php require_once('includetop.php'); ?>
<table width="780" border="0" align="center">
  <tr> 
    <td width="25" height="15">&nbsp;</td>
    <td width="144" rowspan="2" class="tableDetail"><div align="center"> 
        <?php require_once('includeleft.php'); ?>
      </div></td>
    <td width="1" style="border-left:1px solid #cccccc;">&nbsp;</td>
    <td rowspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="30" valign="top"><img src="images/welcome.gif"></td>
        </tr>
		<tr> 
          <td>
			</td>
        </tr>
       <tr>
          <td>
			</td>
        </tr>
      </table>
      <table width="550" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr> 
          <td height="22"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="1%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                        <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              
                      <td width="77%" class="welcome"><strong> courses</strong></td>
                              <td width="20%" class="welcome"></td>
                              <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                            </tr>
                          </table></td>
                        <td width="1%"><img src="images/changep_right_cor.jpg"></td>
                      </tr>
                    </table></td>
        </tr>
        <tr> 
          <td  class="forborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
              <tr> 
                <td valign="top">
				<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="DFEAF2">
                    <tr> 
                      <td width="32%" align="center"><strong>&nbsp;Course Name</strong></td>
                      <td width="20%" align="center"><strong>&nbsp;Duration</strong></td>
                      <td width="16%" align="center"><strong>&nbsp;Fees(Pound)</strong></td>
                      <td width="32%"><strong>&nbsp;Subject</strong></td>
                    </tr>
					<?
					$sql="select * from cpo_coursemaster where iStatus=1";
						$result=runquery($sql);
						$num = mysqli_num_rows($result);
						$counter=1;	
						if($num > 0)
						{
						while($rslist = mysqli_fetch_array($result))
						{
					?>
                    <tr bgcolor="#FFFFFF"> 
                      <td height="25" align="center"><a href="#" onClick="javascript:openwin1(<? echo $rslist['iCourseId'] ?>)"><? echo $rslist["vCourseName"]; ?></a></td>
                      <td align="center"><? echo $rslist["vCourseDuration"]; ?></td>
                      <td align="center"><? echo $rslist["fCourseFees"]; ?></td>
					<td>
					<?
					$sql1="select * from cpo_subjectincourse where iCourseID='".$rslist[0]."'";
					$resc=runquery1($sql1);
					$rssub=mysqli_fetch_array($resc);
					$subjectids = explode(",",$rssub["vSubjectID"]);
					for ($i=0;$i <= count($subjectids)-1 ;$i++)	
					{
						$sql2="select iSubjectId,vSubjectName from cpo_subjectmaster where iSubjectId= ".$subjectids[$i]."";
						$result2=runquery($sql2);
						$num = $result2 ? mysqli_num_rows($result2) : 0;
						if ($num > 0)
						{
							$name=mysqli_fetch_array($result2);
							if ($i%3 == 0)
							{
							}?>	
								&nbsp;<? echo $name['vSubjectName']?>,
							<? }
						} ?>
					</td>	
                    </tr>
					<?
					$counter++;
					}
					}
					?>
			</table>
				</td>
              </tr>
            </table></td>
        </tr>
		<tr><td><table width="550" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right"></div></td>
                <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table></td></tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td style="border-left:1px solid #cccccc;">&nbsp;</td>
  </tr>
 
</table>
<table width="780" border="0" align="center" bgcolor="#DFEAF2">
  <tr>
    <td><?php include('../template/footer.php'); ?></td>
  </tr>
</table>
</body>
</html>
