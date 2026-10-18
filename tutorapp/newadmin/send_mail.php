<?php
//@ob_start();
//session_cache_expire(time()-1);
//session_cache_limiter('nocache');
require "../include/globals.php";
$deladmin = $_SESSION["delAdmin"];
$getms = isset($_GET['ms'])?$_GET['ms']:'';
$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<html>
<head>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript">
function sendmail($valid)
{
	if($valid==1)
	{
		getselectedval();
		if(document.frmSendMail.selecteditems.value=='')
		{
			alert('Select atleast one member');
			return false;
		}
		else
		{
			document.frmSendMail.action = 'compose_mail.php';
			document.frmSendMail.submit();
		}
		document.frmSendMail.action = 'compose_mail.php';
		document.frmSendMail.submit();
	}
	else
	{
		alert('You have no rights to send mails');
		return false;
	}
}
function getsel()
{
	var str = document.frmSendMail.selecteditems.value;
	str = str.split(',');
	for(i=0;i<str.length;i++)
	{
		var len=document.all.length;
		for(j=0;j<len;j++)
		{
			if(document.all(j).type=="checkbox")
			{	
				if(document.all(j).name==str[i])
				{
					document.all(j).checked=true;
				}
			}
		}
	}
}
function getselectedval()
{
	var len=document.all.length;
	var chkname;
	var str =document.frmSendMail.selecteditems.value;
	for(i=0;i<len;i++)
	{
		if(document.all(i).type=="checkbox" && document.all(i).name!="visibility")
		{
			if(document.all(i).checked)
			{
				document.frmSendMail.selecteditems.value=addstr(document.all(i).name);
			}
			else
			{
				document.frmSendMail.selecteditems.value=remstr(document.all(i).name);
			}
		}
	}
}
function addstr(nm)
{
	str1 = document.frmSendMail.selecteditems.value.split(',');
	newstr='';
	old= document.frmSendMail.selecteditems.value;
	flg=0;
	for(l=0;l<str1.length-1;l++)
	{
		if(str1[l]==nm)
		{
			flg=1;
		}
	}
	if(flg==1)
	{
		newstr=old;		
	}
	else
	{
		newstr=	old + nm + ',';
	}
	return newstr;
}
function remstr(nm)
{
	str1 = document.frmSendMail.selecteditems.value.split(',');
	old = document.frmSendMail.selecteditems.value;
	newstr='';
	for(k=0;k<str1.length-1;k++)
	{
		if(str1[k]!=nm)
		{
			newstr = newstr + str1[k] + ',';
		}
	}
	return newstr;
}
function chkall()
{
	var len=document.all.length;
	var chkname;
	for(i=0;i<len;i++)
	{
		if(document.all(i).type=="checkbox")
		{
			chkname=document.all(i).name;
			if(document.getElementById("visibility").checked)
			{
				if(document.all(i).name=="visibility")
				{
					document.all(i).checked=true;
				}
				else
				{
					document.all(i).checked=true;
					str=document.all(i).name;
					document.getElementById(str).style.backgroundColor="#F7F5FE";
				}
				
			}
			else
			{
				if(document.all(i).name=="visibility")
				{
					document.all(i).checked=false;
				}
				else
				{
					document.all(i).checked=false;
					str=document.all(i).name;
					document.getElementById(str).style.backgroundColor="#FFFFFF";
				}
			}
		}
	}
}
function getselected(val,obj)
{
	if(val != "")
	{
		for(i=obj.length-1;i>=0;i--)
		{
			if(obj.options[i].value==val)
			{
				obj.options[i].selected=true;
			}
		}
	}
	else
	{
		obj.options[0].selected=true;
	}
}
function getsearch()
{
	ms=document.frmSendMail.cmbmembership.value;	
	ct=document.frmSendMail.cmbcategory.value;	
	document.frmSendMail.action = 'send_mail.php?ms='+ms+'&ct='+ct;
	document.frmSendMail.submit();
}
function goto($cur)
{
	getselectedval();
	ms=document.frmSendMail.cmbmembership.value;	
	ct=document.frmSendMail.cmbcategory.value;	
	document.frmSendMail.action = 'send_mail.php?ms='+ms+'&ct='+ct+'&curpage='+$cur;
	document.frmSendMail.submit();
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect">
<form name="frmSendMail" method="post">
<table width="100%" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td>
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr> 
					<td><h3><b>Admin - User</b></h3></td>
				</tr>
				<tr> 
					<td> 
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="0%"  height="23"><img src=".images/start.jpg" width="6" height="23"></td>
                  <td width="24%" background="/images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Send 
                      Mail </font></div></td>
                  <td width="1%" valign="top" background="file://///Www/web/Concept/ReelBrokers/admin/./images/middle.jpg"><img src="file://///Www/web/Concept/ReelBrokers/admin/./images/active_last.jpg" width="11" height="23"></td>
                  <td width="76%" background="file://///Www/web/Concept/ReelBrokers/admin/./images/middle_last.jpg"><div align="right"></div></td>
                </tr>
              </table> 
					</td>
				</tr>
				<tr> 
					<td> 
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
							<tr> 
								<td colspan="2" bgcolor="F5F8FF">&nbsp;</td>
							</tr>
							<tr> 
								<td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
							<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="file://///Www/web/Concept/ReelBrokers/images/print.jpg" width="16" height="16" border="0"></a></td>
								<td width="13%" bgcolor="#FFFFFF"><a href="javascript:print()">Print this page</a></td>
							</tr>
							<tr> 
								<td height="35" colspan="2" bgcolor="#FFFFFF">
										<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
										  <tr> 
											<td width="20%" class="bodytext"><strong>Select Membership :</strong></td>
											<td width="15%"><select name="cmbmembership" class="bodytext">
												<option value="" selected>ALL</option>
												<option value="2">GOLD</option>
												<option value="1">Silver</option>
												<option value="0">Normal</option>
											  </select></td>
											<?php if ($getms<>'')
												{?>  
											  <script language="JavaScript">getselected('<?php echo $getms;?>',document.frmSendMail.cmbmembership);</script>
												<?php
												}?>
											<td width="17%" class="bodytext"><strong>Select Category :</strong></td>
											<td width="17%"><select name="cmbcategory" class="bodytext">
												<option value="" selected>ALL</option>
												<option value="1">Film Market</option>
												<option value="2">Script Box</option>
												<option value="3">Reel Jobs</option>
												<option value="4">Talent Bees</option>
												<option value="5">Biz Board</option>
												<option value="6">Reel Community</option>
											  </select></td>
											  <?php if ($getct<>'')
												{?>  
											  <script language="JavaScript">getselected('<?php echo $getct;?>',document.frmSendMail.cmbcategory);</script>
												<?php
												}?>
											<td>
											<img src="file://///Www/web/Concept/ReelBrokers/admin/images/search.gif" width="73" height="21" style="cursor:hand" onClick="javascript:getsearch();">
											<input type="hidden" name="selecteditems" value="<?php if (isset($_POST['selecteditems'])){ echo $_POST['selecteditems'];}?>">
											</td>
										  </tr>
										</table></td>
							</tr>
							<tr> 
								<td colspan="2">
									
									<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr> 
											<td width="100%">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td width="3"><img src="file://///Www/web/Concept/ReelBrokers/admin/./images/round_corner.gif" width="3" height="20"></td>
														<td width="237" class="headingtd">&nbsp;List of User</td>
														<td width="427" class="headingtd" align="right">&nbsp;</td>
														<td width="342" class="headingtd"><div align="right"><img height=20 src="file://///Www/web/Concept/ReelBrokers/admin/./images/img_header_gradient.jpg" width=147></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr> 
											<td height="22"> <div align="right">
												
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr class="table"> 
                                <td width="9%" height="32" align="center" class="lighttd"> 
                                  <div align="center"><strong> All 
                                    <input type="checkbox" name="visibility" value="visibility"  onClick="chkall(this)">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<br>
                                    </strong> </div></td>
                                <td width="15%" height="32" align="left" class="lighttd"><div align="Left"><strong>User 
                                    Name<br>
                                    </strong> </div></td>
                                <td width="10%" height="32" align="left" class="lighttd"><div align="Left"><strong>City<br>
                                    </strong> </div></td>
                                <td width="10%" height="32" align="left" class="lighttd"><div align="Left"><strong>State<br>
                                    </strong> </div></td>
                                <td width="11%" height="32" align="left" class="lighttd"><div align="Left"><strong>Country<br>
                                    </strong> </div></td>
                                <td width="17%" height="32" align="left" class="lighttd"><div align="Left"><strong>E-mail<br>
                                    </strong> </div></td>
                                <td width="9%" height="32" align="left" class="lighttd"><div align="Left"><strong>Premium<br>
                                    </strong></div></td>
                              </tr>
<?php
	if($getct=='')						  
	{
		$sqlspn = "select u.UID,u.FirstName,u.LastName,u.City,u.State,co.Name as CountryName,u.EmailID,u.IsActive,u.IsPremium from country co , users u where co.CID=u.CID";
		if($getms<>'')
		{
			$sqlspn.= " AND IsPremium=".$getms;
		}
	}	
	else
	{
		if($getct==1)
		{
			$sqlspn = "select distinct u.UID,u.FirstName,u.LastName,u.City,u.State,co.Name as CountryName,u.EmailID,u.IsActive,u.IsPremium from country co , users u , film_market fm where co.CID=u.CID AND fm.UID=u.UID";
		}
		if($getct==2)
		{
			$sqlspn = "select distinct u.UID,u.FirstName,u.LastName,u.City,u.State,co.Name as CountryName,u.EmailID,u.IsActive,u.IsPremium from country co , users u , script_box sb where co.CID=u.CID AND sb.UID=u.UID";
		}
		if($getct==3)
		{
			$sqlspn = "select distinct u.UID,u.FirstName,u.LastName,u.City,u.State,co.Name as CountryName,u.EmailID,u.IsActive,u.IsPremium from country co , users u , jobs rj where co.CID=u.CID AND rj.UID=u.UID";
		}
		if($getct==4)
		{
			$sqlspn = "select distinct u.UID,u.FirstName,u.LastName,u.City,u.State,co.Name as CountryName,u.EmailID,u.IsActive,u.IsPremium from country co , users u , talents tb where co.CID=u.CID AND tb.UID=u.UID";
		}
		if($getct==5)
		{
			$sqlspn = "select distinct u.UID,u.FirstName,u.LastName,u.City,u.State,co.Name as CountryName,u.EmailID,u.IsActive,u.IsPremium from country co , users u , bizb_users bb where co.CID=u.CID AND bb.user_email=u.EmailID";
		}
		if($getct==6)
		{
			$sqlspn = "select distinct u.UID,u.FirstName,u.LastName,u.City,u.State,co.Name as CountryName,u.EmailID,u.IsActive,u.IsPremium from country co , users u , rcom_users rc where co.CID=u.CID AND rc.user_email=u.EmailID";
		}
		if($getms<>'')
		{
			$sqlspn.= " AND IsPremium=".$getms;
		}
	}
	$result = runquery($sqlspn);
	$count = mysqli_num_rows($result);
	$page=Ceil($count/page_size);
	  if(isset($_GET['curpage']))
	  {
		$curpage = $_GET['curpage'];
		if($curpage==0)
		{
			 $sqlspn.=" order by name  Limit 0,".page_size;
		}
		else
		{
			$current=page_size*($curpage);
			$sqlspn.=" order by name  Limit " .$current. ",".page_size;
		}
	  }
	  else
	  {
	   $sqlspn.=" order by name  Limit 0,".page_size;
	   $curpage=0;
	  }
	  //echo $sqlspn;
		$result = runquery($sqlspn);
	$counter = 1;
	$num=0;
	if($result)
	{
		$num = mysqli_num_rows($result);
	}
	if($num > 0)
	{
		while($rslist = mysqli_fetch_array($result))
		{
?>
                              <tr class="whittd" id="a<?php echo $rslist["UID"];?>"> 
                                <td align="center" class="bodytext" height="28"><input type="checkbox" id="<?php echo $rslist["EmailID"];?>" name="<?php echo $rslist["EmailID"];?>"></td>
                                <td align="left" class="bodytext"><?php echo $rslist["FirstName"]." ".$rslist["LastName"];?></td>
                                <td align="left" class="bodytext"><?php echo $rslist["City"]; ?></td>
                                <td align="left" class="bodytext"><?php echo $rslist["State"]; ?></td>
                                <td align="left" class="bodytext"><?php echo $rslist["CountryName"]; ?></td>
                                <td align="left" class="bodytext"><?php echo $rslist["EmailID"]; ?></td>
                                <td align="left" class="bodytext"> 
                                  <?php	if(!$rslist["IsPremium"]==0)
														{?>
                                  Yes 
                                  <?php 
														}
														else
														{?>
                                  No 
                                  <?php 
														} ?>
                                </td>
                              </tr>
                              <?php
		$counter++;
		}
?>
                              <tr class="whittd"> 
                                <td height="28"><div align="center"><img src="file://///Www/web/Concept/ReelBrokers/admin/images/send.gif" width="73" height="21" style="cursor:hand" onClick="javascript:sendmail(<?php echo $deladmin;?>);"></div></td>
                                <td height="28" colspan="5"><strong><input type="hidden" name="operation" value=""></strong></td>
                                <td height="28"><div align="center"></div></td>
								<script language="JavaScript">
								getsel();
								</script>
                              </tr>
                              <?php
	}
	else
	{			
?>
                              <tr class="whittd"> 
                                <td align="center" class="error" height="28" colspan="7">No 
                                  User exists in Database...!</td>
                                <?php
}
?>
                              </tr>
                            </table>
												</div>
											</td>
										</tr>  
										<tr>
											<td height="22" valign="top"> 
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr> 
														<td width="148" class="headingtd"><img height=20 src="file://///Www/web/Concept/ReelBrokers/admin/./images/img_header_gradient1.jpg" width=147></td>
														<td width="772" class="headingtd">&nbsp;</td>
														<td width="1" ><div align="right"><img src="file://///Www/web/Concept/ReelBrokers/admin/./images/round_corner1.gif" width="3" height="20"></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr> 
											
                        <td height="22" valign="top" align="right" class="bodytext"> 
                          <?php	if($page>1){ 
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
                          <a href="javascript:goto(<?php echo $i-1;?>)"><b><?php echo $i;?></b></a> 
                          <?php
												}									
											 }}?>
                          &nbsp;&nbsp;&nbsp;&nbsp; </td>
										</tr>
										<tr> 
											<td bgcolor="#FFFFFF">&nbsp;</td>
										</tr>
									</table>
									
                  </td>
							</tr>
						</table>
					</td>	
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</body>
</html>
