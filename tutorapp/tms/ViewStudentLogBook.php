<?php
include "dbConnection.php";

if (!isset($_SESSION['user_id']))
{ 
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}?>
<html>
<head>
<title><?php echo sitename;?>Learner Log Book</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function openwin(obj)
{
	new1=window.open("Detail_LogBook.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function openwintutor(obj)
{
	new1=window.open("Detail_LogBookTutor.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function validation(curp,curp1)
{
	document.FRMVIEWSTUDENTLOGBOOK.method="post";
	if(document.FRMVIEWSTUDENTLOGBOOK.CBOSTUDENT.value=="-")
	{
		document.FRMVIEWSTUDENTLOGBOOK.action="ViewStudentLogBook.php?curpage="+curp+"&curpage1="+curp1;
		document.FRMVIEWSTUDENTLOGBOOK.submit();
	}
	else
	{
		document.FRMVIEWSTUDENTLOGBOOK.action="ViewStudentLogBook.php?curpage="+curp+"&curpage1=0&flag=yes";
		document.FRMVIEWSTUDENTLOGBOOK.submit();
	}
}
function pag(curp,curp1)
{
	document.FRMVIEWSTUDENTLOGBOOK.method="post";
	if(document.FRMVIEWSTUDENTLOGBOOK.CBOSTUDENT.value=="-")
	{
		document.FRMVIEWSTUDENTLOGBOOK.action="ViewStudentLogBook.php?curpage="+curp+"&curpage1="+curp1;
		document.FRMVIEWSTUDENTLOGBOOK.submit();
	}
	else
	{
		document.FRMVIEWSTUDENTLOGBOOK.action="ViewStudentLogBook.php?curpage="+curp+"&curpage1="+curp1+"&flag=yes";
		document.FRMVIEWSTUDENTLOGBOOK.submit();
	}
}
</script>
</head>
<?php
		$sqlspn = "select * from cpo_tutorlogbook where iTutorId=".$user_id."";
		$result = runquery($sqlspn);
		$count = $result?mysqli_num_rows($result):0;
		$page=Ceil($count/page_size);
		if(isset($_GET['curpage']))
		{
			$curpage = $_GET['curpage'];
			if($curpage==0)
			{
				 $sqlspn.=" order by dEntryDate desc Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by dEntryDate desc Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by dEntryDate desc Limit 0,".page_size;
		   $curpage=0;
		}
		$result = runquery($sqlspn);
		$num=$result ? mysqli_num_rows($result) : 0;
?>

<?php
	if(isset($_GET['flag']))
	{
		$sqlspn1 = "select * from cpo_studentlogbook where iTutorId=".$user_id." and iStudentId=".$_POST['CBOSTUDENT']."";
	}
	else
	{
		$sqlspn1 = "select * from cpo_studentlogbook where iTutorId=".$user_id."";
	}
		$result1 = runquery($sqlspn1);
		$count1 = mysqli_num_rows($result1); 
		$page1=Ceil($count1/page_size);
		if(isset($_GET['curpage1']))
		{
			$curpage1 = $_GET['curpage1']; 
			if($curpage1==0)
			{
				 $sqlspn1.=" order by dEntryDate desc Limit 0,".page_size;
			}
			else
			{
				$current1=page_size*($curpage1);
				$sqlspn1.=" order by dEntryDate desc Limit " .$current1. ",".page_size;
			}
		}
		else
		{
		   $sqlspn1.=" order by dEntryDate desc Limit 0,".page_size;
		   $curpage1=0;
		}
		$result1 = runquery($sqlspn1);
		$num1=$result1 ? mysqli_num_rows($result1) : 0;
?>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
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
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><form name="FRMVIEWSTUDENTLOGBOOK" method="post">
			<?php
			//if (!isset($_GET['next']))
			if($num>0)
			{
			?>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Learner Log Book By Tutor</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table  cellspacing="1" cellpadding="0"  width="90%" align="center" bgcolor="#DFEAF2" border="0">
						<tr>
							<td width="36%" height="25" class="bodytext"><b><font color="#0033CC">&nbsp;Learner Name</font></b></td>
							<td width="20%" height="25" class="bodytext"><b><font color="#0033CC">&nbsp;Entry Date</font></b></td>
							<td width="36%" height="25" class="bodytext"><b><font color="#0033CC">&nbsp;Subject</font></b></td>
							<td width="26%" height="25" class="bodytext"><b><font color="#0033CC">&nbsp;Satisfied?</font></b></td>
						</tr>
<!--						<tr>-->
						<?php
						while($res=mysqli_fetch_array($result))
						{
						$sqluser="select vUserName from cpo_usermaster where iUserId=".$res['iStudentId']."";
						$sqlsub="select vSubjectName from cpo_subjectmaster where iSubjectId=".$res['vSubject']."";
						//echo $sqluser;
						$ressqluser=runquery($sqluser);
						$ressqlsub=runquery($sqlsub);
						
						$no=$ressqluser ? mysqli_num_rows($ressqluser) : 0;
						$nosub=$ressqlsub ? mysqli_num_rows($ressqlsub) : 0;
						
						if($no>0)
						{
							$ressqluser=mysqli_fetch_array($ressqluser);
						}
						
						if($nosub>0)
						{
							$ressqlsub=mysqli_fetch_array($ressqlsub);
						}
						?>  <tr  bgcolor="#FFFFFF">
<!--							<td class="bodytext" height="30"><a href="StudentLogBook1.php?logid=<?php //echo $res['iLogId']; ?>&username=<?php //echo $ressqluser['vUserName']; ?>"><?php //echo $ressqluser['vUserName']; ?></a></td> -->
							<td class="bodytext" height="25">&nbsp;<a href="#" onClick="javascript:openwintutor(<?php echo $res['iLogId']; ?>)"><?php echo $ressqluser['vUserName']; ?></a></td> 
							<?php
							$ddate=gdate($res['dEntryDate']);
							?>							
							<td class="bodytext" height="25">&nbsp;<?php echo $ddate; ?></td>
							<td class="bodytext" height="25">&nbsp;<?php echo $ressqlsub['vSubjectName']; ?></td>
							<?php if($res['iIsSatisfied']==1)
							{ ?>
							<td class="bodytext">&nbsp;Yes</td>
							<?php }
							else
							{
							 ?>
							 <td class="bodytext">&nbsp;No</td>
							 <?php } ?>
							 </tr>
						<?php  } ?>
<!--						</tr> -->
					<?php	if($page>1){  ?>
						<tr bgcolor="#FFFFFF"><td colspan="4">&nbsp;</td></tr>
						<tr bgcolor="#FFFFFF"><td colspan="4" align="right" class="bodytext">
						
										<?php		echo "Page : ";
												$c = 0;
												if (isset($_GET['curpage1']))
												{
													$c = $_GET['curpage1'];
												}
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
												<a href="javascript:pag(<?php echo $i-1;?>,<?php echo $c;?>)"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }?>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;</td></tr> <?php }?>
					</table> 
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><!--<div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div>--></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?php
			  }
			  else
			  {
			  		$msg="No records exist in database !";		
					$color = "black";
					?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Learner Log Book By Tutor</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<?php echo $color;?>"><b><?php echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='index.php'"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>					
	           <?php }
			  ?>
			
			<table>
			<tr><td>&nbsp;</td></tr>
			</table>
			<?php
			//if (!isset($_GET['next']))
			if($num1>0)
			{
				//if(!isset($_GET['flag']))
//				{
					$sqlstu="select distinct iStudentId from cpo_studentlogbook where iTutorId=".$user_id.""; 
					$resstu=runquery($sqlstu);
					$nostu=$resstu ? mysqli_num_rows($resstu) : 0 ;
			?>
			<!-- start-->
			<table width="90%" align="center" border="0">
			<tr>
			<td class="bodytext" align="right"><b>Select Learner </b></td>
			<td align="left" class="bodytext">
			<select name="CBOSTUDENT" onChange="return validation(<?php echo $curpage?>,<?php echo $curpage1 ?>)" class="textbox">
			<option value="-">Select Learner</option>
			<?php
				if($nostu>0)
				{
			while($resstu1=mysqli_fetch_array($resstu))
			{
				$sqlstuname="select vUserName from cpo_usermaster where iUserId=".$resstu1['iStudentId'].""; 
				$resstuname=runquery($sqlstuname);
				$resstuname=mysqli_fetch_array($resstuname);
				 ?>
				<option value="<?php echo $resstu1['iStudentId']?>" <?php if (isset($_POST['CBOSTUDENT']) && $_POST['CBOSTUDENT'] == $resstu1['iStudentId']) {?> selected <?php }?>><?php echo $resstuname['vUserName']?></option>
		<?php	}//}
			?>
			
						<?php //if(!isset($_POST['CBOSTUDENT'])){?>
						<!--<option value="All" selected>All</option> 
						<?php //} else { ?><option value="All">All</option> --> <?php //} ?>
						
			</select>
			</td>
			</tr>
			</table>
			<?php } ?>
			<!-- end-->			
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Learner Log Book By Learner</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center" bgcolor="#DFEAF2">
						<tr>
							
                        <td width="36%" height="25" class="bodytext"><b><font color="#0033CC">&nbsp;Learner Name</font></b></td>
							<td width="20%" height="25" class="bodytext"><b><font color="#0033CC">&nbsp;Entry Date</font></b></td>
							<td width="36%" height="25" class="bodytext"><b><font color="#0033CC">&nbsp;Subject</font></b></td>
							<td width="36%" height="25" class="bodytext"><b><font color="#0033CC">&nbsp;Satisfied?</font></b></td>
						</tr>
<!--						<tr>-->
						<?php
						while($res1=mysqli_fetch_array($result1))
						{
						$sqluser1="select vUserName from cpo_usermaster where iUserId=".$res1['iStudentId']."";
						$sqlsub1="select vSubjectName from cpo_subjectmaster where iSubjectId=".$res1['iSubjectId']."";
						//echo $sqluser;
						$ressqluser1=runquery($sqluser1);
						$ressqlsub1=runquery($sqlsub1);
						
						$no1=$ressqluser1 ? mysqli_num_rows($ressqluser1) : 0;
						$nosub1=$ressqlsub1 ? mysqli_num_rows($ressqlsub1) : 0;
						
						if($no1>0)
						{
							$ressqluser1=mysqli_fetch_array($ressqluser1);
						}
						
						if($nosub1>0)
						{
							$ressqlsub1=mysqli_fetch_array($ressqlsub1);
						}
						?>  <tr bgcolor="#FFFFFF">
							
<!--                        <td class="bodytext" height="30"><a href="approvebookchattime.php?logid=<?php //echo $res1['iLogId']; ?>&username=<?php //echo $ressqluser1['vUserName']; ?>"><?php //echo $ressqluser1['vUserName']; ?></a></td> -->

							<td class="bodytext" height="25">&nbsp;<a href="#" onClick="javascript:openwin(<?php echo $res1['iLogId']; ?>)"><?php echo $ressqluser1['vUserName']; ?></a></td> 							
							<?php
							$d1date=gdate($res1['dEntryDate']);
							?>							
							<td class="bodytext" height="25">&nbsp;<?php echo $d1date; ?></td>
							<td class="bodytext" height="25">&nbsp;<?php echo $ressqlsub1['vSubjectName']; ?></td>
							<?php if($res1['iIsSatisfied']==1)
							{ ?>
							<td class="bodytext">&nbsp;Yes</td>
							<?php }
							else
							{
							 ?>
							 <td class="bodytext">&nbsp;No</td>
							 <?php } ?>
							 </tr>
						<?php  } ?>
<!--						</tr> -->
						<?php	if($page1>1){ ?>
						<tr bgcolor="#FFFFFF"><td colspan="4">&nbsp;</td></tr>
						<tr bgcolor="#FFFFFF"><td colspan="4" align="right" class="bodytext">
						
											<?php	echo "Page : ";
												$c = 0;
												if (isset($_GET['curpage']))
												{
													$c = $_GET['curpage'];
												}
											 for($i=1;$i<=$page1;$i++)
											 {
												if($i==($curpage1+1))
												{
											 ?>
												<b><?php echo $i?></b>
											 <?php
												}
												else
												{
													$str="";
											?>
												<a href="ViewStudentLogBook.php?curpage1=<?php echo $i-1;?>&curpage=<?php echo $c;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }?>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;</td></tr><?php } ?>
					</table> 
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><!--<div align="right"><input type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17"></div>--></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
			  <?php
			  }
			  else
			  {
			  		$msg="No records exist in database !";		
					$color = "black";
					?>
			 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td class="welcome">Learner Log Book By Learner</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<?php echo $color;?>"><b><?php echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='index.php'"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>					
	           <?php }
			  ?>
			
			</form></td>
        </tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <?php include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
