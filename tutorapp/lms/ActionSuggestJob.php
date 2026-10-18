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
?>
<html>
<head>
<title><? echo sitename;?>View Job Suggestion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
var myvar = 1;
function openwin(obj)
{
	new1=window.open("Detail_SuggestJob.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');
	return true;
}

</script>
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
<pre>&nbsp;</pre>
<table width="857"  cellspacing="0" cellpadding="0">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
 
  <tr> 
    <td rowspan="2" valign="top" width="25%" bgcolor="#FFFFFF"> 
      <? include "leftpanel.php";?>    </td>
    <td valign="top"> 
      <? include "includewelcome.php";?>    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top">
	<table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
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
                                    
                                  <td width="77%" class="welcome">Job Suggestion Action</td>
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
                              <td valign="top"> <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="DFEAF2">
                                  <tr> 
                                    <td width="38%" align="center" class="bodytext"><strong>Tutor Name</strong></td>
                                    <td width="39%" align="center" class="bodytext"><strong>&nbsp;Job Title</strong></td>
									<td width="13%" align="center" class="bodytext"><strong>&nbsp;Date</strong></td>
									<td width="10%" align="center" class="bodytext"><strong>&nbsp;Action</strong></td>
                                  </tr>
                                  <?
								$sqlspn="select js.iJobinfoId,us.vUserName as student,j.vJobTitle as job,js.dDateOfEntry
								from cpo_jobsuggesioninfo js ,cpo_usermaster us ,cpo_jobmaster j where 
								js.iTutorId = us.iUserId and js.iJobId=j.iJobId and js.iStudentId=".$user_id;
								$result=runquery($sqlspn);
						/////////
							$count=0;
							$page=0;
							if($result)
							{
								$count = mysqli_num_rows($result);
								$page=Ceil($count/page_size);
							}
							  if(isset($_GET['curpage']))
							  {
								$curpage = $_GET['curpage'];
								if($curpage==0)
								{
									 $sqlspn.=" Limit 0,".page_size;
								}
								else
								{
									$current=page_size*($curpage);
									$sqlspn.=" Limit " .$current. ",".page_size;
								}
							  }
							  else
							  {
							   $sqlspn.=" Limit 0,".page_size;
							   $curpage=0;
							  }
							  $result = runquery($sqlspn);
						////////
						$num = $result ? mysqli_num_rows($result):0;
						$counter=1;	
						if($num > 0)
						{
							while($rslist = mysqli_fetch_array($result))
							{
								
							?>
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" align="center" class="bodytext"><a class="sidelink" href="EditSuggestJob.php?id=<? echo $rslist['iJobinfoId'];?>"><? echo $rslist["student"];?></a></td>
										<td align="center" class="bodytext"><a class="sidelink" href="EditSuggestJob.php?id=<? echo $rslist['iJobinfoId'];?>"><? echo $rslist["job"];?></a></td>
										<td align="center" class="bodytext"><a class="sidelink" href="EditSuggestJob.php?id=<? echo $rslist['iJobinfoId'];?>"><? echo gdate($rslist['dDateOfEntry']);?></a></td>										
										<td align="center" class="bodytext"><a class="sidelink" href="EditSuggestJob.php?id=<? echo $rslist['iJobinfoId'];?>"><img src="images/jobaction.jpg" width="20" height="20" border="0"></a></td>
									  </tr>
							 <?
							$counter++;
							}
						}
						else
						{?>
									  <tr bgcolor="#FFFFFF"> 
										<td height="25" align="center" colspan="4" class="bodytext"><b>No Job Suggestion found.</b></td>
									  </tr>
						<?
						}
					?>
                                </table></td>
                            </tr>
                          </table></td>
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
												<a href="ActionSuggestJob.php?curpage=<? echo $i-1;?>"><b><? echo $i;?></b></a>
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
	<table>
      <tr>
        <td width="584"><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
      </tr>
    </table>
	<p>&nbsp;</p></td>
      
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  
      <? include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
