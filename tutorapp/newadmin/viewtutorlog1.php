<?php
//die();
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		document.location ="index.htm";
	</script> 
<?php
} 
$getct = isset($_GET['ct'])?$_GET['ct']:'';
function gdate($dt)
{
	$datadate = explode("-",$dt);
	$tday = date("d-m-Y", mktime(0,0,0,$datadate[1],$datadate[2],$datadate[0]));
	return $tday;
}

if($getct=='')						  
	{
		$sql="select iStudentId,iTutorId,dEntryDate,vSubject,iLogId from cpo_tutorlogbook";
		
	}	
	else
	{
	
		$sql = "select iStudentId,iTutorId,dEntryDate,vSubject,iLogId from cpo_tutorlogbook where iTutorId='".$getct."'";
	
	}


	
    $rID=runquery1( $sql);
	$count = mysqli_num_rows($rID);
	
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
									  $rID=runquery1( $sql);
																		  
?>

<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title></title>
<script language="JavaScript">

function openwin(obj)
{
	new1=window.open("Detail_LogBookTutor.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
	return true;
}


function getsearch()
{
		
	ct=document.frmtutorlog.cmbcategory.value;	
	document.frmtutorlog.action ='viewtutorlog.php?ct='+ct;
	document.frmtutorlog.submit();
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
function checkall()
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
						
						}
						
					}
				}
	}	
}

</script>
</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="frmtutorlog" method="post" action="deletetutorlog.php?curpage=<?php echo $curpage; ?>">		
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Tutor Log Book Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=logtutor">Overview</a></div></td>
            
            <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"> 
                Delete</div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listtutorlog.php">List</a></div></td>
            <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            <td width="34%" background="images/middle_last.jpg"></td>
          </tr>
        </table></td>
	</tr>
	<tr> 
      <td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
          <tr> 
            <td bgcolor="F5F8FF">&nbsp;</td>
          </tr>
         <tr> 
								<td colspan="2" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
										  <tr> 
											
											
                        
                  <td width="17%" class="bodytext"><strong> Select Tutor</strong></td>
											<td width="17%"><select name="cmbcategory" class="bodytext">
												<option value="" selected>ALL</option>
												<?php
						   							$fetch1="select * from cpo_usermaster where iUserType=1 and iUserStatus=1";
													$result1=runquery1($fetch1);
													$count=mysqli_num_rows($result1);
							
												while($row=mysqli_fetch_array($result1))
												{
																									
												?>
						
														<option value="<?php echo $row["iUserId"];?>"><?php echo $row["vUserName"];?></option>
                      							<?php
												}
												?>
											  </select></td>
											  <?php if ($getct<>'')
												{?>  
											  <script language="JavaScript">getselected('<?php echo $getct;?>',document.frmtutorlog.cmbcategory);</script>
												<?php
												}?>
											<td>
											<img src="file://///Www/web/Concept/ReelBrokers/admin/images/search.gif" width="73" height="21" style="cursor:hand" onClick="javascript:getsearch();">
											<input type="hidden" name="selecteditems" value="<?php if (isset($_POST['selecteditems'])){ echo $_POST['selecteditems'];}?>">
											</td>
										  </tr>
										</table></td>
							</tr>
							<tr></tr>

          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="85%" cellSpacing=0 cellPadding=0 border=0 class="table" align="center">
                <tr> 
                  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        <td width="517" class="headingtd"> Delete Log Entry</td>
                        <td width="346" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td width="5%" height="15" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td height="25"  class="lighttd2"><b>Tutor Name</b> </td>
				  <td height="25"  class="lighttd2"><b>Log Date</b> </td>
				  <td height="25"  class="lighttd2"><b>Learner Name</b> </td>
				  <td height="25"  class="lighttd2"><b>Subject</b> </td>
                 
                
                  <td  class="lighttd2"><div align="center"><strong>Delete</strong></div></td>
                </tr>
                 <tr bgcolor="#FFFFFF" > 
                  <td colspan="5"> <div align="center"></div></td>
                </tr>
                <?php if($rID)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
					
						$tutorname="";
		
						$fetchname="select * from cpo_usermaster where iUserId=".$rs["iStudentId"];
						$resultfetchname=mysqli_query($fetchname);
						$studentname=mysqli_result($resultfetchname,0,1);
																			
						$fetchname="select * from cpo_usermaster where iUserId=".$rs["iTutorId"];
						$resultfetchname=mysqli_query($fetchname);
						$num = $resultfetchname ? mysqli_num_rows($resultfetchname) : 0;
						if ($num > 0)
						{
						$tutorname=mysqli_result($resultfetchname,0,1);
						}
																			
						$fetchname="select * from cpo_subjectmaster where iSubjectId=".$rs["vSubject"];
						$resultfetchname=mysqli_query($fetchname);
						$subjectname=mysqli_result($resultfetchname,0,1);
																			
						$date=$rs["dEntryDate"];
						$logid=$rs["iLogId"];
																		
							
						$dispdate = gdate($date);
						
                    	?>
                	<tr height="28" class="whittd"> 
                  		<td align="center"> <input type="checkbox" name=cbo<?phpecho $cnt;?>> 
                    		<input type="hidden" name=hb<?phpecho $cnt;?> value=<?phpecho $logid;?>> 
                  		</td>
								 <td align="left" >
												  <?php echo $tutorname; ?>
								</td>
                 
								<td align="left" >
                                  <a href="#" onClick="javascript:openwin(<?php echo $logid ?>)"><?php echo $dispdate; ?></a>
                                </td>
									<td align="left">
                                  <?php echo $studentname; ?>
                                </td>
								
								<td align="left">
                                  <?php echo $subjectname; ?>
                                </td>
                  
                 
                  <td width="26%" align=left ><div align="center"><a href="deletetutorlog.php?id=<?phpecho $logid;?>&curpage=<?phpecho $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                
                
                <tr > 
                  <td height="30" colspan="2" align=left><input name="image" type="image" src="images/delete1.gif" width="73" height="22"> 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  
                  <td align=left><div align="center"><img src="images/submit.gif" width="73" height="22" onClick="sub1(<?php echo $curpage; ?>)" style="cursor:hand"></div></td>
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
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="5">&nbsp;</td>
                </tr>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="6"> 
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
                    <a href="viewtutorlog.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a> 
                    <?php
												}									
											 }}?>
                    &nbsp;&nbsp;</td>
                </tr>
                <?php
				  }
				  else
				  {
				      echo "No User found";
				  }
			?>
              </table> </td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
         
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
         
        </table>
		</td>
	</tr>
</table>
</form>
</BODY>
</HTML>

