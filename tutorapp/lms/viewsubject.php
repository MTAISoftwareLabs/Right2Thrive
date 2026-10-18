<?
include_once 'dbConnection.php';
if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}


	$sql="select us.I_user_subid,us.I_subjectid,us.V_sublevel,sb.vSubjectName,sb.iSubjectId,um.iUserId, um.vUserName    from cpo_usermaster as um, cpo_user_subject as us, cpo_subjectmaster as sb where us.I_studentid =".$_SESSION['user_id']." and sb.iSubjectId = us.I_subjectid and us.I_tutorid = um.iUserId group by us.I_subjectid";
	$result1=runquery1($sql);
	$count=mysqli_num_rows($result1);
	$page=Ceil($count/page_size);
	if(isset($_GET['curpage']))
	{
		$curpage = $_GET['curpage'];
		if($curpage==0)
		{
			$sql.=" order by sb.vSubjectName Limit 0,".page_size;
		}
		else
		{
		$current=page_size*($curpage);
		$sql.=" order by sb.vSubjectName Limit " .$current. ",".page_size;
		}
	}
	else
	{
		$sql.=" order by sb.vSubjectName Limit 0,".page_size;
		$curpage=0;
	}
	 $rID = runquery1($sql);
	 $num = $rID ? mysqli_num_rows($rID) : 0 ;
	

?>
<html>
<head>
<title><? echo sitename?>Subjects</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>


</head>
<body>
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<form name="frmex" method="post">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
 
  <tr> 
    <td rowspan="2" valign="top" width="25%" bgcolor="#FFFFFF"> 
      <? include "leftpanel.php";?>
    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top">
	<table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td>&nbsp;</td></tr>
         <tr> 
          <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td height="22"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                              <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="77%" class="welcome" valign="top"><b>Subjects</b></td>
                                    <td width="20%" class="welcome"></td>
                                    <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                                  </tr>
                                </table></td>
                              <td width="1%"><img src="images/changep_right_cor.jpg"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
											<td  class="forborder" valign="top">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td valign="top">
															<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="DFEAF2">
																<tr> 
																	<td width="33%" align="left" class="bodytext" style="padding-left:5px" nowrap="nowrap"><strong>Subject</strong></td>
																	<td width="33%" align="left" class="bodytext" style="padding-left:5px"><strong>Subject Level </strong></td>
																    <td  align="left" class="bodytext" style="padding-left:5px"><strong>Tutor </strong></td>
                                                                </tr>
									 <? if($num > 0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
					?>
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" align="left" class="bodytext" style="padding-left:5px"><a class="c" href="sub_lesson.php"><?php echo ucfirst($rs['vSubjectName']);?></a></td>
										<td height="25" align="left" class="bodytext" style="padding-left:5px"><a href="#"><? echo ucfirst($rs['V_sublevel']);?></a></td>
                                        <td height="25" align="left" class="bodytext" style="padding-left:5px"><? echo ucfirst($rs['vUserName']);?></td>
										
									  </tr>
							 <?
							$cnt++;
							}
						}
						else
						{?>
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" align="center" colspan="4" class="bodytext"><b>No Records found.</b></td>
									  </tr>
						<?
						}
					?>
                               
														</table>														</td>
													</tr>
												</table>											</td>
										</tr>
                      <tr> 
                        <td><table width="550" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                              <td width="96%" background="images/changebttm_center_cor.jpg">
							  	<div align="right" class="bodytext"><?	if($page>1){ 
												echo "Page : ";
											 for($i=1;$i<=$page;$i++)
											 {
												if($i==($curpage+1))
												{
											 ?>
												<b><? echo $i?></b>
											 <?
												}
												else
												{
													$str="";
											?>
												<a href="viewsubject.php?curpage=<? echo $i-1;?>"><b><? echo $i;?></b></a>
											 <?
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
	  <table align="center">
        <tr>
          <td width="596"><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
        </tr>
      </table>	  <p>&nbsp;</p></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
      <? include "includebottom.php";?>
</table>
</form>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
