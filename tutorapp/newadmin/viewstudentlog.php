<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
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
		$sql="select iStudentId,iTutorId,dEntryDate,iSubjectId,iLogId from cpo_studentlogbook";
	}	
	else
	{
		$sql = "select iStudentId,iTutorId,dEntryDate,iSubjectId,iLogId from cpo_studentlogbook where iStudentId='".$getct."'";
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
									  $num = $rID ? mysqli_num_rows($rID) : 0 ; 									  
?>

<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Edit / Delete Learner Log Book </title>
<script language="JavaScript">

function openwin(obj)
{
	new1=window.open("Detail_LogBook.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
	return true;
}

function sub1(ob)
{
	document.frmstudentlog.method = "post";
	document.frmstudentlog.action="deleteuser.php?active=1&curpage="+ob;
	document.frmstudentlog.submit();
}
function getsearch()
{
var ct;

		if(document.getElementById('selcat').value != '')
		{	ct=document.getElementById('selcat').value;	}
		else
		{	ct='';	}

	document.frmstudentlog.action ='viewstudentlog.php?ct='+ct;
	document.frmstudentlog.submit();
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
<form name="frmstudentlog" method="post" action="deletenews.php" onSubmit="return validation()">		
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td align="left" class="schoolfont">Learner Log Book Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=logstudent" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="liststudentlog.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
	<td width="0%" align="right">
	</td>
    <td width="25%" align="center">
	</td>
    <td width="0%" align="left">
	</td>
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr ><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr > 
				  		<td > 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
																			<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																 <tr> 
            <td >&nbsp;</td>
          </tr>
		   <tr> 
            <td bgcolor="#FFFFFF" height="10">&nbsp;</td>
          </tr>
		  <tr> 
            <td class="bodytext" align="center">&nbsp;Select Learner&nbsp;<select name="cmbcategory" id="selcat" class="textbox">
												<option value="" selected>ALL</option>
												<?php
						   							$fetch1="select * from cpo_usermaster where iUserType=2 and iUserStatus=1";
													$result1=runquery1($fetch1);
													$count=mysqli_num_rows($result1);
							
												while($row=mysqli_fetch_array($result1))
												{
																									
												?>
						
														<option value="<?php echo $row["iUserId"];?>"><?php echo $row["vUserName"];?></option>
                      							<?php
												}
												?>
											  </select>&nbsp;
											  <?php if ($getct<>'')
												{?>  
											  <script language="JavaScript">getselected('<?php echo $getct;?>',document.frmstudentlog.cmbcategory);</script>
												<?php
												}?> 
              &nbsp;&nbsp; &nbsp;&nbsp; <img src="images/search.gif"  style="cursor:hand" onClick="javascript:getsearch();" align="absmiddle"> 
            </td>
            <td>&nbsp;</td>			
          </tr>
		   <tr> 
            <td bgcolor="#FFFFFF" height="10">&nbsp;</td>
          </tr>
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="6">Learner Log Book </td>
																								
									  													</tr> 
																						
																				   <tr> 
                  <td width="7%" height="15" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td width="19%" height="25"  class="lighttd2"><b>Learner Name</b> </td>
				    <td width="16%" height="10"  class="lighttd2"><b>Log Date</b> </td>
					  <td width="16%" height="25"  class="lighttd2"><b>Tutor Name</b> </td>
					    <td width="32%" height="15"  class="lighttd2"><b>Subject</b> </td>
				 
                 
              
                  <td width="10%"  class="lighttd2"><div align="center"><strong>Delete</strong></div></td>
                </tr>
                <?php if($num > 0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
					
						$tutorname="";
						$studentname="";
						$subjectname="";
		
						$fetchname="select * from cpo_usermaster where iUserId=".$rs["iStudentId"];
						$resultfetchname=mysqli_query($fetchname);
						$num1 = $resultfetchname ? mysqli_num_rows($resultfetchname) : 0 ;
						if ($num1 > 0 )
						{
						$studentname=mysqli_result($resultfetchname,0,1);
						}
																			
						$fetchname="select * from cpo_usermaster where iUserId=".$rs["iTutorId"];
						$resultfetchname=mysqli_query($fetchname);
						$num = $resultfetchname ? mysqli_num_rows($resultfetchname) : 0;
						if ($num > 0)
						{
						$tutorname=mysqli_result($resultfetchname,0,1);
						}
																			
						$fetchname="select * from cpo_subjectmaster where iSubjectId=".$rs["iSubjectId"];
						$resultfetchname=mysqli_query($fetchname);
						$num1 = $resultfetchname ? mysqli_num_rows($resultfetchname) : 0 ;
						if ($num1 > 0 )
						{
						$subjectname=mysqli_result($resultfetchname,0,1);
						}
																			
						$date=$rs["dEntryDate"];
						$logid=$rs["iLogId"];
																		
							
						$dispdate = gdate($date);
						
                    	?>
                <tr height="28" class="whittd"> 
                  <td height="20" align="center"> <input type="checkbox" id="1" name="cbo<?phpecho $cnt;?>"> 
                    <input type="hidden" name="hb<?phpecho $cnt;?>" value="<?php echo $logid;?>" > 
                  </td>
                 				<td align="left" class="bodytext"><a href="new cpo/admin/editstudentlog.php?sid=<?php echo $logid;?>"><?php echo $studentname; ?></a></td>
								<td align="left" class="bodytext"><a href="new cpo/admin/editstudentlog.php?sid=<?php echo $logid;?>"><?php echo $dispdate; ?></a></td>
								<td align="left" class="bodytext"><a href="editstudentlog.php?sid=<?php echo $logid; ?> " ><?php echo $tutorname; ?></a></td>
								<td align="left" class="bodytext"> <a href="editstudentlog.php?sid=<?php echo $logid; ?>"><?php echo $subjectname; ?></a></td>
                                <td width="10%" align=left ><div align="center"><a href="deletestudentlog.php?id=<?php echo $logid;?>&curpage=<?php echo $curpage;?>&ct=<?php echo $getct; ?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                	<tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="6"  >&nbsp;</td>
				</tr> 
				<tr > 																	
                      <td class="toheaderbg1" colspan="6"height="1"></td>
				</tr>
				 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="6"  >&nbsp;</td>
				</tr> 
                
                <tr > 
                  <td height="30" colspan="2" style="padding-left:15px" align=left><input name="image" type="image" src="images/delete1.gif" > 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  
                  <td align=left><div align="center"></div></td>
                  <td align=left>&nbsp;</td>
                </tr>
                <?php
				  }
				  else
				  { ?>
				   <tr class="whittd"> 
                              <td align="center" height="35" colspan="6"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="6" align="center" class="error" height="28">No Learner Log Information Found</td>
					</tr>	
				  		
				  <?php
				  }
			?>		
																				</table>
																		</td>
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
                    <a href="new cpo/admin/viewstudentlog.php?curpage=<?php echo $i-1;?>&ct=<?php echo $getct; ?>"><b><?php echo $i;?></b></a> 
                    <?php
												}									
											 }}?>
                    &nbsp;&nbsp;</td>
                </tr>	
																		

  														</table>
  												
          								</tr>
          								<tr> 
            								 	<td align="center" >
												
												
												
												
												
												
												
												</td>
											</tr >
        						</table>
						</td>
    			
				</tr >
      </table></td></tr >
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table></td ></tr >
</table>
</td >
  </tr>
</table>
		

	</td>
  </tr>
</table>
</form>
</body>
</html>
