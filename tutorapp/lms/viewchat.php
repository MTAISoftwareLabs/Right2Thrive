<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
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
<?
if (!isset($_SESSION['user_id']))
{ ?>

	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?
} 
	$sql="SELECT * FROM cpo_bookchattime where 1=1";
	if (isset($_REQUEST['CMBTUTOR']) && $_REQUEST['CMBTUTOR'] <> "0")
	{
		$sql .= " and iTutorId=".$_POST['CMBTUTOR'];
	}
	if (isset($_REQUEST['CMBLEARNER']) && $_REQUEST['CMBLEARNER'] <> "0")
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
									 
									  $num = $rID ? mysqli_num_rows($rID) : 0 ;
									 
?>

<HTML>
<HEAD>
<link href="adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title></title>
<script language="JavaScript" src="calendar1.js"></script> 
<script language="JavaScript">
function openwin(obj)
{
	new1=window.open("Detail_Chating.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function submitpage()
{
	document.FRMCHAT.action = "viewchat.php";
	document.FRMCHAT.submit();
}
function disppage(page)
{
	document.FRMCHAT.action = "viewchat.php?curpage="+page;
	document.FRMCHAT.submit();
}
function validation()
{
	var len=document.all.length;
	var flag = 0;
	for(i=0;i<len;i++)
	{
		if(document.all(i).type=="checkbox" && document.all(i).id==1)
		{
			if (document.all(i).checked == true)
			{
				flag = 1;
			}
		}
	}
	if (flag == 0)
	{
		alert("First Select Item !");
		return false;
	}	
	return true;
}

</script>
</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="FRMCHAT" method="post" action="deletechat.php?curpage=<? echo $curpage; ?>" onSubmit="return validation()">		
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
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"> 
                Delete</div></td>
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
            <td class="bodytext" align="center">&nbsp;Select Tutor&nbsp; 
              <?
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_bookchattime uc where um.iUserId =uc.iTutorId order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select name="CMBTUTOR" class="textbox">
					<option value="0">Select Tutor</option>
				<?
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<? echo $rstutor[1]?>" <? if (isset($_POST['CMBTUTOR']) && $_POST['CMBTUTOR'] == $rstutor[1]) {?> selected <? }?>><? echo $rstutor[0]?></option>
					<? }
				?>
				</select>
              Select Learner&nbsp;&nbsp; 
              <?
				$seltutor = "select distinct um.vUserName,um.iUserId from cpo_usermaster um,cpo_bookchattime uc where um.iUserId=uc.iUserId order by um.vUserName";
				$rst = runquery($seltutor);
			?>
              <select class="textbox" name="CMBLEARNER">
				<option value="0">Select Learner</option>				
				<?
					while ($rstutor = mysqli_fetch_array($rst))
					{ ?>
						<option value="<? echo $rstutor[1]?>" <? if (isset($_POST['CMBLEARNER']) && $_POST['CMBLEARNER'] == $rstutor[1]) {?> selected <? }?>><? echo $rstutor[0]?></option>
					<? }
				?>				

				</select>&nbsp;&nbsp;
				<img src="./images/search.gif" style="cursor:hand" onClick="submitpage();" align="absmiddle">
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
                  <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        <td width="517" class="headingtd">Delete Chat Time Booking</td>
                        <td width="346" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td width="5%" height="15" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td width="11%" class="lighttd2"><b>Tutor </b></td>
                  <td width="19%" class="lighttd2"><b>Learner</b></td> 
				  <td width="20%" class="lighttd2"><b>Booking Time</b></td>  
                  <td width="19%" class="lighttd2"><b>Chat Start Time</b></td>
                  <td width="19%" class="lighttd2"><b>Chat End Time</b></td>                    
                  <td width="7%" align="center" class="lighttd2"><b>Delete</b></td>
                </tr>
                <? if($num)
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
						 $sdt=explode(" ",$rs[3]); 
						 $sddt=explode("-",$sdt[0]);
						 $stdt=explode(":",$sdt[1]);
														
						$sdcon=$sddt[2]."/".$sddt[1]."/".$sddt[0];
						$stcon=$stdt[0].":".$stdt[1].":".$stdt[2];
						if($rs[8]==1)
						{
						
						$sdt1=explode(" ",$rs[6]); 
						 $sddt1=explode("-",$sdt1[0]);
						 $stdt1=explode(":",$sdt1[1]);
														
						$sdcon1=$sddt1[2]."/".$sddt1[1]."/".$sddt1[0];
						$stcon1=$stdt1[0].":".$stdt1[1].":".$stdt1[2];
						
						$sdt2=explode(" ",$rs[7]); 
						 $sddt2=explode("-",$sdt2[0]);
						 $stdt2=explode(":",$sdt2[1]);
														
						$sdcon2=$sddt2[2]."/".$sddt2[1]."/".$sddt2[0];
						$stcon2=$stdt2[0].":".$stdt2[1].":".$stdt2[2];
						}
						 
										
											
                    	?>
                <tr class="whittd"> 
                <td align="center"> <input type="checkbox" id="1" name="cbo<? echo $cnt;?>"><input type="hidden" name="hb<? echo $cnt;?>" value=<? echo $rs[0];?>></td>
                <td><a href="#" onClick="javascript:openwin(<? echo $rs[0] ?>)"><? echo $tutorname; ?></a></td>
                <td><a href="#" onClick="javascript:openwin(<? echo $rs[0] ?>)"><? echo $stuname;?></a></td>
				<td><a href="#" onClick="javascript:openwin(<? echo $rs[0] ?>)"><? echo $sdcon." ".$stcon;?></a></td>
				<td><a href="#" onClick="javascript:openwin(<? echo $rs[0] ?>)"><? if($rs[8]==1)
																					{ echo $sdcon1." ".$stcon1;
																					}?></a></td>
				<td><a href="#" onClick="javascript:openwin(<? echo $rs[0] ?>)"><? if($rs[8]==1)
																					{ echo $sdcon2." ".$stcon2;
																					}?></a></td>
                <td align="center"><a href="deletechat.php?id=<? echo $rs[0];?>&curpage=<? echo $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></td>
                </tr>
                <?
			            $cnt=$cnt+1;
					}
					
				 ?>
                <tr > 
                  <td height="30" colspan="2"><input name="image" type="image" src="images/delete1.gif" width="73" height="22"><input name="txtcnt" value="<? echo $cnt; ?>" type="hidden"></td>
                 <td colspan="7">&nbsp;</td>
                </tr>
				<?
				}
				 else
				  { ?>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="7" align="center">No Chat Information found.</td>
                </tr>
				  <? }

					?>
			<tr align="right" bgcolor="#FFFFFF" >
                  <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="148" class="headingtd"><img height=20 src="./images/img_header_gradient1.jpg" width=147></td>
                        <td width="772" class="headingtd">&nbsp;</td>
                        <td width="1" ><div align="right"><img src="./images/round_corner1.gif" width="3" height="20"></div></td>
                      </tr>
                    </table></td>
                </tr>
              </table> </td>
          </tr>
                 <?	if($page>1){ ?>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" class="bodytext"> 
                   <?
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
                    <a href="javascript:disppage(<? echo $i-1;?>)"><b><? echo $i;?></b></a> 
                    <?
												}									
											 }?>
                    &nbsp;&nbsp;</td>
					<td></td>
                </tr>
                <?
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

