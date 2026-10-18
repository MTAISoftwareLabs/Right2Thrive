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
<title><? echo sitename?>View Job Suggestion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
var myvar = 1;
function openwin(obj)
{
	new1=window.open("Detail_SuggestJob.php?id="+obj,"",'height=500,width=600,scrollbars=yes,top=50 left=150');
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
<link href="css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #FF3333}
-->
</style>
<link href="lms.css" rel="stylesheet" type="text/css">
</head>

<body >
<pre>&nbsp;</pre>
<table width="900"  cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<form name="interactive" action="" method="post">
<table width="911" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <th height="672"  align="center"><table width="905" border="0" align="center"  cellpadding="0" cellspacing="0">
      <tr>
        <th width="199" rowspan="2" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><? include "leftpanel.php"; ?></th>
        <th height="10" align="left" valign="top" scope="col"><? include "includewelcome.php";?></th>
        </tr>
      <tr>
        <th align="center" valign="top" scope="col"><table width="90%" border="0" cellspacing="0" cellpadding="0">
         <br><br>
          <tr>
            <td width="1%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
            <td width="96%"  class="welcome"  background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="77%" class="welcome">View Job Suggestion</td>
                  <td width="20%" class="welcome"></td>
                  <td width="3%"><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                </tr>
            </table></td>
            <td width="1%"><img src="images/changep_right_cor.jpg"></td>
          </tr>
        </table>
          <table width="90%" border="0" cellspacing="1" cellpadding="0" bgcolor="DFEAF2">
            <tr>
              <td width="38%" align="center" class="bodytext"><strong>Tutor 
                Name</strong></td>
              <td width="39%" align="center" class="bodytext"><strong>&nbsp;Job Title</strong></td>
              <td width="23%" align="center" class="bodytext"><strong>&nbsp;Date</strong></td>
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
              <td height="25" align="center" class="bodytext"><a class="sidelink" href="#" onClick="javascript:openwin(<? echo $rslist['iJobinfoId'];?>)"><? echo $rslist["student"];?></a></td>
              <td align="center" class="bodytext"><a class="sidelink" href="#" onClick="javascript:openwin(<? echo $rslist['iJobinfoId'];?>)"><? echo $rslist["job"];?></a></td>
              <td align="center" class="bodytext"><a class="sidelink" href="#" onClick="javascript:openwin(<? echo $rslist['iJobinfoId'];?>)"><? echo gdate($rslist['dDateOfEntry']);?></a></td>
            </tr>
            <?
							$counter++;
							}
						}
						else
						{?>
            <tr bgcolor="#FFFFFF">
              <td height="25" align="center" colspan="3" class="bodytext"><b>No Job Suggestion found.</b></td>
            </tr>
            <?
						}
					?>
          </table>
          <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="1%" background="images/changebttm_center_cor.jpg"><img src="images/changebttm_left_cor.jpg" width="11" height="25" /></td>
              <td width="96%" background="images/changebttm_center_cor.jpg"><div align="right" class="bodytext">
                <?	if($page>1){ 
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
                  <a href="ViewSuggestJob.php?curpage=<? echo $i-1;?>"><b><? echo $i;?></b></a>
                  <?
												}									
											 }}?>
                &nbsp;&nbsp;</div></td>
              <td width="3%" background="images/changebttm_center_cor.jpg"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25" /></div></td>
            </tr>
          </table>
          <table>
            <tr>
              <td width="584"><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
            </tr>
          </table>
          <p>&nbsp;</p></th>
      </tr>
      
      <tr>
        <th colspan="2" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><div align="center">
          <? include "includebottom.php";?>
        </div></th>
        </tr>
      
      
      
    </table>      
    </th>
  </tr>
</table>
<p class="table">&nbsp;</p>

<map name="Map2" id="Map2"><area shape="rect" coords="1,1,196,67" href="#" /></map>
<map name="Map3" id="Map3"><area shape="rect" coords="-4,-6,167,30" href="#" /></map>
</form>
</body>
</html>
