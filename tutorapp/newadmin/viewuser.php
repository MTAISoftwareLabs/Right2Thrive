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
		$query="update cpo_usermaster set iUserStatus=1 where iUserId=".$_GET[$abc];

	}
	else
	{
		$abc="hb".$count;
		
		$query="update cpo_usermaster set iUserStatus=0 where iUserId=".$_GET[$abc];
	}
			
	$rscheck=runquery1($query) or die('error'.mysqli_error());

}
}


//	$sql="SELECT * FROM cpo_CourseMaster order by vCourseName";
	$sql="SELECT * FROM cpo_usermaster where iUserType=2 order by dUserRegDate";
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
									  $count=mysqli_num_rows($rID);
									 /* if($count==0)
									  		{
											?>
												
												echo "<script language=JavaScript>";
												echo "window.locatin.href("viewcourse.php?curpage=")";
												echo "</script>"
											<?php
											}*/
									  
?>

<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Edit / Delete Learner</title>
<script language="JavaScript">

function openwin(obj)
{
	window.open("user.php?id="+obj,"","height=600,width=850,scrollbars=1");
}

function sub1(ob)
{
	document.frmuser.method = "post";
	document.frmuser.action="viewtutor.php?active=1&curpage="+ob;
	document.frmuser.submit();
}
function getconfirm()
{
	return confirm('All the data related to this Learner will be deleted. Do you want to continue ?');
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
	return confirm('All the data related to this Learner will be deleted. Do you want to continue ?');	
	
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
<form name="frmuser" method="post" action="deleteuser.php?curpage=<?php echo $curpage; ?>" onSubmit="return validation()">	
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
    <td class="schoolfont" align="left">Learner Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=learner" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="addlearner.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listuser.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr ><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        
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
																								
																								
                            <td class="toheaderbg" colspan="3">Edit / Delete Learner</td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
																
					<tr > 
                  <td align='right' class="bodytext"  ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr > 
                  <td width="4%" height="30" align="center"   class="lighttd2">
                    <!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">-->                  </td>
                  <td height="30"  class="lighttd2"><b>Learner Name</b></td>
                  <td width="23%" height="30"  class="lighttd2"><b>Email Address</b></td>
				    <td height="30"  class="lighttd2"><b>Learner School</b></td>
                  <td width="12%" height="30"  class="lighttd2"><div align="center"><b>Approve</b></div></td>
                  <td width="16%" height="30"  class="lighttd2"><div align="center"><strong>Delete</strong></div></td>
                </tr>
                               <?php if($count>0)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_row($rID))
                    {
                    	?>
                <tr class="whittd"> 
                  <td align="center"> <input type="checkbox" id="1" name=cbo<?phpecho $cnt;?>> 
                    <input type="hidden" name=hb<?phpecho $cnt;?> value=<?phpecho $rs[0];?>> 
                  </td>
                  <td width="25%" height="30" align=left ><a href="editlearnerinfo.php?sid=<?php echo $rs[0];?>"><?php echo $rs[1]; ?></a></td>
                  <td width="23%"><a href="editlearnerinfo.php?sid=<?php echo $rs[0];?>"><?php echo $rs[8];?></a></td>
				  <td width="23%"><?php $sql1 ="select * from cpo_school where I_schoolid=".$rs[24];
												$res1 = runquery1($sql1);
												$fet1 = mysqli_fetch_array($res1);
												echo ucfirst($fet1['I_schoolname'])?></td>
                  <td width="12%"><div align="center"> 
                      <?php
				   if($rs[9]==0)
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
                  <td width="16%" align=left ><div align="center"><a href="deleteuser.php?id=<?phpecho $rs[0];?>&curpage=<?phpecho $curpage;?>" onClick="return getconfirm();"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
					<tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="6"  >&nbsp;</td>
				</tr> 
				<tr > 																	
                      <td class="toheaderbg1" colspan="6" height="1"></td>
				</tr>
				 <tr bgcolor="#FFFFFF"> 																	
                      <td class="toheaderbg2" colspan="6"  >&nbsp;</td>
				</tr> 
                <tr > 
                  <td height="30" colspan="3" align=left style="padding-left:10px"><input name="image" type="image" src="images/delete1.gif" > 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  <td align=left>&nbsp;</td>
                  <td align=left style="padding-left:50px"><div align="center"><img src="images/submit.gif"  onClick="sub1(<?php echo $curpage; ?>)" style="cursor:hand"></div></td>
                  <td align=left>&nbsp;</td>
                </tr>
				 <?php
				  }
				  else
				  {
				      ?>
					  <tr class="whittd"> 
                              <td align="center" height="35" colspan="6"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="6" align="center" class="error" height="28">No Learner Information Found</td>
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
												<a href="./viewuser.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
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
