<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
$curpage = 0;

if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
if(isset($_GET['active']) && $_GET['active']==1)
{
	for($count=1;$count<=$_POST['txtcnt']-1;$count++)
	{
		$str="chk".$count;
		if(isset($_POST[$str]))
		{
			$abc="hb".$count;
			$query="update cpo_coursemaster set iStatus=1 where iCourseId=".$_POST[$abc];
		}
		else
		{
			$abc="hb".$count;
			$query="update cpo_coursemaster set iStatus=0 where iCourseId=".$_POST[$abc];
		}
		$rscheck=runquery1($query) or die('error'.mysqli_error());
	}
}
// Saving for ordering of courses
if(isset($_GET['active']) && $_GET['active']==2)
{
	for($count=1;$count<=$_POST['txtcnt']-1;$count++)
	{
		$str="ord".$count;
		$abc="hb".$count;
		$query="update cpo_coursemaster set iCourseOrder=".$_POST[$str]." where iCourseId=".$_POST[$abc];
		$rscheck=runquery1($query) or die('error'.mysqli_error());
	}
}

$sqlspn = "select * from cpo_coursemaster";
//echo $sqlspn;
//die();
$result = runquery1($sqlspn) or die('could not execuate'.mysqli_error());
if($result)
{	
	$count = mysqli_num_rows($result);
	$page=Ceil($count/page_size);
	if(isset($_GET['curpage']))
	{
		$curpage = $_GET['curpage'];
		if($curpage==0)
		{
			 $sqlspn.=" order by iCourseOrder  Limit 0,".page_size;
		}
		else
		{
			$current=page_size*($curpage);
			$sqlspn.=" order by iCourseOrder  Limit " .$current. ",".page_size;
		}
	}
	else
	{
	   $sqlspn.=" order by iCourseOrder Limit 0,".page_size;
	   $curpage=0;
	}
	$result = runquery1($sqlspn);
}
?><HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Edit / Delete Course</title>
<script language="JavaScript">
function sub1(ob)
{
	document.frmcourse.action="viewcourse.php?active=1&curpage="+ob;
	document.frmcourse.submit();
}
function sub2(obj)
{
	for(i=1;i<=obj;i++)
	{
		for(j=i+1;j<=obj;j++)
		{
			if(eval('document.frmcourse.ord'+i+'.value')==eval('document.frmcourse.ord'+j+'.value'))
			{
				alert('Order No :'+eval('document.frmcourse.ord'+j+'.value')+' already exist..');
				return false;
			}
		}
	}
	document.frmcourse.action="viewcourse.php?active=2";
	document.frmcourse.submit();
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
<body leftmargin="0" topmargin="0" class="seffact">
<form name="frmcourse" method="post" action="deletecourse.php?curpage=<?php echo $curpage; ?>" onSubmit="return validation();">	
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
    <td class="schoolfont" align="left">Course Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=cource" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addcourse.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listcourse.php" class="greendeactfont">List</a></td>
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
																								
																								
                            <td class="toheaderbg" colspan="3">Edit / Delete Course</td>
																								
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
                  <td width="9%" height="15" align="center"  class="lighttd2"></td>
                  <td width="55%" height="25" class="lighttd2"><b>Course Name</b> </td>
                  <td width="12%" class="lighttd2"><div align="center"><b>Order</b></div></td>
                  <td width="12%" class="lighttd2"><div align="center"><b>Active</b></div></td>
                  <td width="12%" class="lighttd2"><div align="center"><strong>Delete</strong></div></td>
                </tr>
			<?php	
			if($curpage!=0)
			{
				$counter = ($curpage*page_size)+1;
			}else
			{
				$counter = 1;
			}
			$num = mysqli_num_rows($result);
			if($num > 0)
			{
				while($rslist = mysqli_fetch_array($result))
				{?>
                <tr class="whittd"> 
                  <td align="center"> <input type="checkbox" id="1" name="cbo<?phpecho $cnt;?>"> 
                    <input type="hidden" name="hb<?phpecho $cnt;?>" value="<?php echo $rslist["iCourseId"];?>"> 
                  </td>
                  <td height="30"><a href="EditCourse.php?id=<?php echo $rslist["iCourseId"];?>" ><?php echo $rslist["vCourseName"]; ?></a></td>
                  <td height="30" align="center">
				  <select name="ord<?php echo $cnt; ?>" class="textbox">
				  	<?php
						for($i=1;$i<=$count;$i++)
						{
							if($i==$rs[8])
								echo "<option value='$i' selected>$i</option>";
							else
								echo "<option value='$i'>$i</option>";						
						}
					?>	
				  </select>
				  </td>
                  <td><div align="center"> 
                      <?php
				   if($rslist["iStatus"]==0)
				   {
				   ?>
                      <input type="checkbox" name="chk<?php echo $cnt; ?>" value="0">
                      <?php
					 }
					 else
					 {
					 ?>
                      <input type="checkbox" name="chk<?php echo $cnt; ?>" value="1" checked>
                      <?php
					   }
					   ?>
                    </div></td>
                  <td><div align="center"><a href="deletecourse.php?id=<?php echo $rslist["iCourseId"];?>&curpage=<?phpecho $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
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
                  <td height="30" align="center" style="padding-left:45px"><input name="image" type="image" src="images/delete1.gif"  alt="Delete Courses"> 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  <td align=left  >&nbsp;</td>
				  <td style="padding-left:25px"><div align="center"><img src="images/submit.gif"  onClick="sub2(<?php echo $cnt-1;?>)" style="cursor:hand" alt="Save Order"></div></td>
                  <td align=left style="padding-left:45px"><div align="center"><img src="images/submit.gif"  onClick="sub1(<?php echo $curpage; ?>)" style="cursor:hand" alt="Save Active"></div></td>
                  <td align=left >&nbsp;</td>
                </tr>
				<?php
				  }
				  else
				  { ?>
				  	<tr class="whittd"> 
                              <td align="center" height="35" colspan="7"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="7" align="center" class="error" height="28">No Course Information Found</td>
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
												<a href="./viewcourse.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
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
