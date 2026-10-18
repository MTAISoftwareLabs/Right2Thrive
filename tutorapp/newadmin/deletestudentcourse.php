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
if(isset($_GET['active']))
{
for($count=1;$count<=$_POST['txtcnt']-1;$count++)
{
	
	$str="chk".$count;

	if(isset($_POST[$str]))
	{
		$abc="hb".$count;
		$query="update cpo_usercourse set iCourseStatus=1 where iSubjectId=".$_POST[$abc];

	}
	else
	{
		$abc="hb".$count;
		
		$query="update cpo_usercourse set iCourseStatus=0 where iSubjectId=".$_POST[$abc];
	}
		
	$rscheck=runquery1($query);

}
}


	$sql="SELECT * FROM cpo_usercourse order by iCourseId ";
    $rID=runquery1( $sql);
	$count = mysqli_num_rows($rID);
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
									  $rID=runquery1( $sql);
									    $num = $rID ? mysqli_num_rows($rID) : 0 ;
?>

<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Edit / Delete Subject</title>
<script language="JavaScript" src="txteditor.js"></script>
<script language="JavaScript">
function sub1(ob)
{
	document.frmsubject.action="deletestudcourse.php?active=1&curpage="+ob;
	document.frmsubject.submit();
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

<script language="javascript" type="text/javascript" src="js/functions.js"></script>

<script language="javascript" type="text/javascript">
function setAction(action,eid)
{
	if(action=="delete")
	{
		document.frm1.eid.value="";
		document.frm1.myaction.value=action;
		
		document.frm1.action="deladdcourse.php";
		
		mycount = 0;
		for(i=0;i<document.frm1.elements.length;i++)
		{
			if(document.frm1.elements[i].name=="Event_Ids[]" && document.frm1.elements[i].checked)
				mycount++;
		}

		if(mycount==0)
		{
			alert("You must check one of the checkboxes.");
			return false;
		}

		if(!confirm("Are you sure you want to "+action+" selected student add course?"))
			return false;
	
		document.frm1.submit();
	}
	
	if(action=="active")
	{
		document.frm1.eid.value="";
		document.frm1.myaction.value=action;
		
		document.frm1.action="deladdcourse.php";
		
		mycount = 0;
		for(i=0;i<document.frm1.elements.length;i++)
		{
			if(document.frm1.elements[i].name=="Event_Ids[]" && document.frm1.elements[i].checked)
				mycount++;
		}

		if(mycount==0)
		{
			alert("You must check one of the checkboxes.");
			return false;
		}

		if(!confirm("Are you sure you want to "+action+" selected student add course?"))
			return false;
	
		document.frm1.submit();
	}
	
	
	if(action=="inactive")
	{
		document.frm1.eid.value="";
		document.frm1.myaction.value=action;
		
		document.frm1.action="deladdcourse.php";
		
		mycount = 0;
		for(i=0;i<document.frm1.elements.length;i++)
		{
			if(document.frm1.elements[i].name=="Event_Ids[]" && document.frm1.elements[i].checked)
				mycount++;
		}

		if(mycount==0)
		{
			alert("You must check one of the checkboxes.");
			return false;
		}

		if(!confirm("Are you sure you want to "+action+" selected student add course?"))
			return false;
	
		document.frm1.submit();
	}
	
	
	
	
}

addquestiontype=function(){
//alert("hi");
$("#questiontypediv").show("slow");
//$("#addquestion").hide("slow");
$("#addquestion").css({
			"opacity": "0.5"
		});
};
</script>

</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="frm1" method="post">
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
    <td class="schoolfont" align="left">Student Add Course Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=subject" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="liststudentcourse.php" class="greendeactfont">View</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
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
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">Edit / Delete Subject </td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
																
					<tr > 
                  <td align='right' class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                  <td width="9%" height="15" align="center"  class="lighttd2"><input type="checkbox" name="CheckAll_Event_Ids" onClick="CheckUncheckAll(this.form,this);" /></td>
                  <td height="25"  class="lighttd2"><b>Student Name</b></td>
				  <td class="lighttd2" align="center"><b>Course Name </b></td>
                  <td  class="lighttd2"><div align="center"><b>Active</b></div></td>
                  <td  class="lighttd2"><div align="center"><strong>Delete</strong></div></td>
                </tr>
                            <?php if($num > 0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_row($rID))
                    {
					
					$iCourseId=$rs[2];
		$iUserId=$rs[1];
		
		$userqry="select * from cpo_usermaster where iUserId='$iUserId'";
		$userres=mysqli_query($userqry);
		$userfetch=mysqli_fetch_array($userres);
		
		$courseqry="select * from cpo_coursemaster where iCourseId='$iCourseId'";
		$courseres=mysqli_query($courseqry);
		$coursefetch=mysqli_fetch_array($courseres);
					
                    	?>
                <tr class="whittd"> 
                  <td align="center"><input type="checkbox" name="Event_Ids[]" value="<?=$rs[0]?>" onClick="CheckUncheckAll(this.form,this);"><input type="hidden" name="hb<?php echo $cnt;?>" value="<?php echo $rs[0];?>"></td>
                  <td width="31%" height="30"><?php echo $userfetch["vUserName"]; ?></td>
				  <td width="39%" height="30" align="center"><?php echo $coursefetch["vCourseName"]; ?></td>
                  <td width="11%"><div align="center"> 
                     <?php if($rs[5]==0){ echo "Inactive";}else{ echo "Active";}?>
                    </div></td>
                  <td width="10%" align=left ><div align="center"><a href="deletestudcourse.php?id=<?phpecho $rs[0];?>&curpage=<?phpecho $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                
                <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="5"  >&nbsp;</td>
				</tr> 
				<tr > 																	
                      <td class="toheaderbg1" colspan="5" height="1" ></td>
				</tr>
				 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="5"  >&nbsp;</td>
				</tr> 
                <tr > 
                  <td height="30" colspan="2" align="left" style="padding-left:20px"><input type="button" class="but" value="delete" onClick="setAction('delete');" /> &nbsp;<input type="button" class="but" value="active" onClick="setAction('active');" />
                    <input name="curpage" value="<?php echo $curpage; ?>" type="hidden">
					<input type="hidden" name="myaction">
        <input type="hidden" name="eid">
					</td>
                  <td>&nbsp;</td>
                  <td align="left" style="padding-left:50px"><div align="center" ></div></td>
                  <td align=left>&nbsp;</td>
                </tr>
				<?php
				  }
				  else
				  { ?>
				  	<tr class="whittd"> 
                              <td align="center" height="35" colspan="7"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="7" align="center" class="error" height="28">No Add Course List Found</td>
					</tr>	
				  <?php
				  }
			?>
                           
                          </table></td></tr >
						  
				
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
												<a href="./deletestudentcourse.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
										</tr>
							
							
    															
</table></td>
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
