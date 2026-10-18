<?php
include_once 'dbConnection.php';
if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}


	//$sql="select sb.vSubjectName,sb.iSubjectId from cpo_subjectmaster as sb where us.I_tutorid=".$_SESSION['user_id']." and sb.iSubjectId = us.I_subjectid  group by us.I_subjectid";
	$sql = "select * from cpo_tutorforcourses where iUserID=".$_SESSION['user_id']."";
	//$result1=runquery1($sql);
	
	// sam removed $count=mysqli_num_rows($result1);
	//echo $count;
	//$page=Ceil($count/page_size);
	//if(isset($_GET['curpage']))
	//{
		//$curpage = $_GET['curpage'];
		//if($curpage==0)
		//{
			//$sql.=" order by sb.vSubjectName Limit 0,".page_size;
		//}
		//else
		//{
		//$current=page_size*($curpage);
		//$sql.=" order by sb.vSubjectName Limit " .$current. ",".page_size;
		//}
	//}
	//else
	//{
	//	$sql.=" order by sb.vSubjectName Limit 0,".page_size;
	//	$curpage=0;
	//}
	$rID = runquery1($sql);
	 $num = $rID ? mysqli_num_rows($rID) : 0 ;
	echo $num;

?>
<html>
<head>
<title><?php echo sitename?>Subjects</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">


</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<form name="frmex" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc"> 
      <?php include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" border="0" alt=""></td>
  </tr>
  <tr > 
    <td valign="top">
	<table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr > 
          <td valign="top">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top">
				  <table border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td height="22" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                              <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="77%" class="welcome"><b>Subjects</b> </td>
                                    <td width="20%" class="welcome"></td>
                                    <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                                  </tr>
                                </table></td>
                              <td width="1%"><img src="images/changep_right_cor.jpg"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr > 
											<td  class="forborder" valign="top">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td valign="top">
															<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="DFEAF2">
																<tr> 
																	<td width="53%" align="left" class="bodytext" style="padding-left:5px" nowrap="nowrap"><strong>Subject</strong></td>
																	<td width="47%" align="left" class="bodytext" style="padding-left:5px"><strong>Subject Level </strong></td>
																</tr>
									 <?php if($num > 0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
						?>
						<?php $id=explode(",", $rs["vSubjectIDs"]);
						$str="";
						for($i=0;$i<count($id);$i++)
						{
							$sql2="select vSubjectName from cpo_subjectmaster where iSubjectId= '".$id[$i]."'";
							$result2=runquery1($sql2) or die('could not execute query'.mysqli_error());
						    $num = $result2 ? mysqli_num_rows($result2) : 0;
							if ($num > 0)
								{
								$name=mysqli_result($result2,0,0); ?>
								<tr bgcolor="#FFFFFF"> 
										<td height="25" align="left" class="bodytext" style="padding-left:5px">
															<?php echo $name;?></td>
										<td align="left" class="bodytext" style="padding-left:5px"><?php echo ucfirst($rs['V_sublevel']);?></td>
										
									  </tr> 
							   <?php } ?>
						
					<?php	} ?>
															
							 <?php
					$cnt++;
					}
						}
						else
						{?>
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" align="center" colspan="4" class="bodytext"><b>No Subject found.</b></td>
									  </tr>
						<?php
						}
					?>
                               
														</table>														</td>
													</tr>
												</table>											</td>
										</tr>
                      <tr> 
                        <td valign="top"><table width="550" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                              <td width="96%" background="images/changebttm_center_cor.jpg">
							  	<div align="right" class="bodytext"><?php	if($page>1){ 
												echo "Page : ";
											 for($i=1;$i<=$page;$i++)
											 {
												if($i==($curpage+1))
												{
											 ?>
												<b><?php echo $i?></b>
											 <?php
												}
												else
												{
													$str="";
											?>
												<a href="viewsubject.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;</div>							  </td>
                              <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
			  </table>            </td>
        </tr>
      </table>
	  </td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
      <?php include "includebottom.php";?>
</table>
</form>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
