<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d/m/Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}

?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
	$sql="SELECT * FROM cpo_bookchattime where 1=1";
	if (isset($_POST['CMBTUTOR']) && $_POST['CMBTUTOR'] <> "0")
	{
		$sql .= " and iTutorId=".$_POST['CMBTUTOR'];
	}
	if (isset($_POST['CMBLEARNER']) && $_POST['CMBLEARNER'] <> "0")
	{
		$sql .= " and iUserId=".$_POST['CMBLEARNER'];
	}
	$sql .= " order by StartApprovalDateTime desc";
    $rID=runquery1($sql);
	$count = $rID ? mysqli_num_rows($rID) : 0;
	/*Paging Code*/
									  $page=Ceil($count/page_size);
									  if(isset($_GET['curpage']))
									  {
									  	$curpage = $_GET['curpage'];
									  	if($curpage==0)
										{
											 $sql.=" Limit 0,".page_size;
											 $lmt =" Limit 0,".page_size;
										}
										else
										{
											$current=page_size*($curpage);
											$sql.=" Limit " .$current. ",".page_size;
											$lmt=" Limit " .$current. ",".page_size;
										}
									  }
									  else
									  {
									   $sql.=" Limit 0,".page_size;
									   $lmt=" Limit 0,".page_size;
									   $curpage=0;
									  }
									  $rID=runquery($sql);
									 // echo $sql;
									  $num = $rID ? mysqli_num_rows($rID) : 0 ;
?>

<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title></title>
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function submitpage()
{
	document.FRMCHAT.action = "viewchat1.php";
	document.FRMCHAT.submit();
}
function disppage(page)
{
	document.FRMCHAT.action = "viewchat1.php?curpage="+page;
	document.FRMCHAT.submit();
}
</script>
</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="FRMCHAT" method="post" action="deletestudinfo.php?curpage=<?php echo $curpage; ?>">		
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Chat Time Booking Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=chat">Overview</a></div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/active_middle.jpg" width=11></div></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Edit 
                / Delete</div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/bg_bodytab_crnr1.jpg" width=11></div></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listchat.php">List</a></div></td>
            <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            <td width="45%" background="images/middle_last.jpg"></td>
          </tr>
        </table></td>
	</tr>
	<tr> 
      <td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
          <tr> 
            <td bgcolor="F5F8FF" width="94%">&nbsp;</td>
            <td bgcolor="F5F8FF" width="6%">&nbsp;</td>			
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
          <tr> 
            <td class="bodytext" align="center">&nbsp;Selelct Tutor&nbsp; 
              <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_bookchattime uc where um.iUserId =uc.iTutorId order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select name="CMBTUTOR" class="textbox">
					<option value="0">Select Tutor</option>
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor[1]?>" <?php if (isset($_POST['CMBTUTOR']) && $_POST['CMBTUTOR'] == $rstutor[1]) {?> selected <?php }?>><?php echo $rstutor[0]?></option>
					<?php }
				?>
				</select>
              Select Learner&nbsp;&nbsp; 
              <?php
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_bookchattime uc where um.iUserId=uc.iUserId order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select class="textbox" name="CMBLEARNER">
				<option value="0">Select Learner</option>				
				<?php
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<?php echo $rstutor[1]?>" <?php if (isset($_POST['CMBLEARNER']) && $_POST['CMBLEARNER'] == $rstutor[1]) {?> selected <?php }?>><?php echo $rstutor[0]?></option>
					<?php }
				?>				

				</select>&nbsp;&nbsp;
				<img src="./images/search.gif" style="cursor:hand" onClick="submitpage();">
			</td>
            <td>&nbsp;</td>			
          </tr>
		  <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF" colspan="2"><table width="85%" cellSpacing=0 cellPadding=0 border=0 class="table" align="center">
                <tr> 
                  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        <td width="517" class="headingtd">Delete Chat Time Booking</td>
                        <td width="346" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td width="4%" height="15" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td height="25" width="18%" class="lighttd2"><b>Tutor Name</b> </td>
                  <td height="25" width="14%" class="lighttd2"><b>Learner Name</b> </td>                 
                  <td height="25" width="14%" class="lighttd2"><b>Chating Date</b> 
                  </td>                 				  
                  <td width="34%" class="lighttd2"><div align="center"><b>Topic 
                      Discussed</b></div></td>
                  <td width="16%" class="lighttd2"><div align="center"><strong>Delete</strong></div></td>
                </tr>
                <tr bgcolor="#FFFFFF" > 
                  <td colspan="5"> <div align="center"></div></td>
                </tr>
                <?php if($num)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_row($rID))
                    {
						$tutorname = "";
						$sqltutor = "select vUserName from cpo_usermaster where iUserId=".$rs[2];
						$rstutor = runquery($sqltutor);
						$num1 = $rstutor ? mysqli_num_rows($rstutor) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rstutor);
							$tutorname = $rsdata[0];
						}

						$stuname = "";
						$sqlstu = "select vUserName from cpo_usermaster where iUserId=".$rs[1];
						$rsstu = runquery($sqlstu);
						$num1 = $rsstu ? mysqli_num_rows($rsstu) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rsstu);
							$stuname = $rsdata[0];
						}

						$subname = "";
						$sqlsub = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$rs[3];
						$rssub = runquery($sqlsub);
						$num1 = $rssub ? mysqli_num_rows($rssub) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rssub);
							$subname = $rsdata[0];
						}
						
                    	?>
                <tr class="whittd"> 
                  <td align="center"> <input type="checkbox" name="cbo<?php echo $cnt;?>"> 
                    <input type="hidden" name="hb<?php echo $cnt;?>" value=<?php echo $rs[0];?>>
                  </td>
                  <td width="18%" height="30" align="left"><a href="editstudentinfo.php?sid=<?php echo $rs[0];?>"><?php echo $tutorname; ?></a>
                  </td>
                  <td width="14%" align="left"><a href="editstudentinfo.php?sid=<?php echo $rs[0];?>"><?php echo $stuname;?></a></td>
				  <td width="14%" align=left ><div align="center"><a href="editstudentinfo.php?sid=<?php echo $rs[0];?>"><?php echo $rs[6];?></a></div></td>
				  <td width="34%" align="left"><a href="editstudentinfo.php?sid=<?php echo $rs[0];?>"><?php echo $rs[4];?></a></td>
                  
                  <td width="16%" align=left ><div align="center"><a href="deletestudinfo.php?id=<?php echo $rs[0];?>&curpage=<?php echo $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
				}	
				  else
				  { ?>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="6" align="center"> 
				  	No Student Information found
					</td></tr>
				  <?php }

					?>
                <tr > 
                  <td height="30" colspan="2" align=left><input name="image" type="image" src="images/delete1.gif" width="73" height="22"> 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  <td colspan="2"></td>
                  <td align=left><div align="center"></div></td>
                  <td align=left>&nbsp;</td>
                </tr>
			<tr align="right" bgcolor="#FFFFFF" >
                  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="148" class="headingtd"><img height=20 src="./images/img_header_gradient1.jpg" width=147></td>
                        <td width="772" class="headingtd">&nbsp;</td>
                        <td width="1" ><div align="right"><img src="./images/round_corner1.gif" width="3" height="20"></div></td>
                      </tr>
                    </table></td>
                </tr>
              </table> </td>
          </tr>
                 <?php	if($page>1){ ?>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" class="bodytext"> 
                   <?php
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
                    <a href="javascript:disppage(<?php echo $i-1;?>)"><b><?php echo $i;?></b></a> 
                    <?php
												}									
											 }?>
                    &nbsp;&nbsp;</td>
					<td></td>
                </tr>
                <?php
				 }
			?>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>			
          </tr>
        </table>
		</td>
	</tr>
</table>
</form>
</BODY>
</HTML>

