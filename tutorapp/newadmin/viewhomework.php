<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
require_once __DIR__ . '/admin_auth.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
$sql="SELECT * FROM cpo_homework group by V_title";
$rID=runquery1( $sql);
$count = mysqli_num_rows($rID);
/*Paging Code*/
$page=Ceil($count/page_size);
if(isset($_GET['curpage']))
{
	$curpage = $_GET['curpage'];
	if($curpage==0)
	{
		$sql.=" order by I_homeworkid Limit 0,".page_size;
		
	}
	else
	{
	$current=page_size*($curpage);
	$sql.=" order by I_homeworkid Limit " .$current. ",".page_size;
	}
}
else
{
	$sql.=" order by I_homeworkid Limit 0,".page_size;
	$curpage=0;
}
$rID=runquery1($sql);
$count=mysqli_num_rows($rID);
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Edit / Delete Homework</title>
<script language="JavaScript">
function sub1(ob)
{
	document.frmhomework.action="viewhomework.php?active=1&curpage="+ob;
	document.frmhomework.submit();
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
<form name="frmhomework" method="post" action="deletehomework.php?curpage=<?php echo $curpage; ?>" onSubmit="return validation();">
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
    <td align="left" class="schoolfont">Homework Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=homework" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addhomework.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listhomework.php" class="greendeactfont">List</a></td>
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
																								
																								
                            <td class="toheaderbg" colspan="3">Edit / Delete <b>Homework</b></td>
																								
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
                  <td width="10%" height="15" align="center"  class="lighttd2"></td>
                  <td height="25"  class="lighttd2"><b>Subject</b> </td>
				   <td height="25"  class="lighttd2"><b>Homework Title</b> </td>
				   <td height="25"  class="lighttd2"><b>Assigned To</b></td>
				  <td height="25"  class="lighttd2"><b>Due Date</b></td>
				   <td width="11%" height="25"  class="lighttd2"><b>Assign Date</b></td>
                  <td width="5%"  class="lighttd2"><div align="center"><strong>Delete</strong></div></td>
                </tr>
                <tr bgcolor="#FFFFFF" > 
                  <td colspan="7"> <div align="center"></div></td>
                </tr>
                <?php if($count>0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
						$d=explode("-",$rs["D_due_date"]);
						$duedate=$d[2]."/".$d[1]."/".$d[0];
						
						$a=explode("-",$rs["D_assign_date"]);
						$assigndate=$a[2]."/".$a[1]."/".$a[0];
                    	?>
                <tr class="whittd"> 
                  <td align="center" ><input type="checkbox" id="1" name="cbo<?php echo $cnt;?>"> 
                    <input type="hidden" name="hb<?php echo $cnt;?>" value="<?php echo $rs[0];?>">
                  </td>
                  <td width="18%" height="30" align="left" > <?php
						$sqls = "select vSubjectName from cpo_subjectmaster where iSubjectId=".$rs["I_Subject"];
						$querys = runquery1($sqls);
						$rows = mysqli_fetch_array($querys);
						echo ucfirst($rows['vSubjectName']);
					 ?></td>
				    <td width="30%" height="30" align="left" ><a href="edithomework.php?id=<?php echo $rs['I_homeworkid'];?>" ><?php echo  ucfirst($rs["V_title"]); ?></a>                   </td>
					<td width="15%" height="30" align=left class="bodytext">
						 <?php $sqls = "select sub.vUserName,sub.iUserId,us.I_studentid from cpo_usermaster as sub, cpo_user_subject as us,cpo_homework as l where sub.iUserId=us.I_studentid and l.I_user_subjectid=".$rs["I_user_subjectid"]." and l.I_user_subjectid=us.I_user_subid";
						$querys = runquery1($sqls);
						$rows = mysqli_fetch_array($querys);
						echo ucfirst($rows['vUserName'])."..."; ?></td>
				    <td width="11%" height="30" align="left" ><?php echo $duedate; ?>                  </td> 
				  <td width="11%" height="30" align="left" ><?php echo $assigndate; ?>                  </td> 
                  <td width="5%" align="left" ><div align="center"><a href="deletehomework.php?id=<?php echo $rs['I_homeworkid'];?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="7"  >&nbsp;</td>
				</tr> 
				<tr > 																	
                      <td class="toheaderbg1" colspan="7" height="1" ></td>
				</tr>
				 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="7"  >&nbsp;</td>
				</tr> 
                
                <tr > 
                  <td height="30" align="left"  style="padding-left:40px" ><input name="image" type="image" src="images/delete1.gif"  > 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  <td align=left colspan="4" >&nbsp;</td>
                  <td align=left></td>
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
						
                  <td colspan="7" align="center" class="error" height="28">No Homework Information Found</td>
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
