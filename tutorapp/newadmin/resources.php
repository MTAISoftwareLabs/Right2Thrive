<?php
//@session_start();
@ob_start();
extract($_REQUEST);
$act=$_REQUEST['act'];
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
} ?>
<script language="JavaScript">

function openwin(obj)
{
	window.open("user.php?id="+obj,null,"width=850,height=700,scrollbars=yes");
}
</script>
<?php
if( isset($act) && $act == 'delete' ){
	$qDelAdmin = "DELETE from `resources` WHERE `id` = '$aid'";
	runquery1($qDelAdmin);
	header("location:resources.php?act=edit");
	exit;
}
if(isset($_POST['addintial_x']))
{
extract($_POST);
$target_path1 = "../upload/";
 $target_path1 = $target_path1 . basename($_FILES['file']['name']); 

if(move_uploaded_file($_FILES["file"]["tmp_name"],"../upload/" . $_FILES["file"]["name"])){

$file=$_FILES['file']['name'];
   
}
else{
}
//echo $image;
if($file=="")
{
$file=$file1;
}
$qry="insert into resources (title,student,website) values('$file','$student','$website')";
runquery1($qry);
header("location:resources.php?act=view");
}
if(isset($_POST['editintial_x']))
{
extract($_POST);
$target_path1 = "../upload/";
 $target_path1 = $target_path1 . basename($_FILES['file']['name']); 

if(move_uploaded_file($_FILES["file"]["tmp_name"],"../upload/" . $_FILES["file"]["name"])){

$file=$_FILES['file']['name'];
   
}
else{
}
//echo $image;
if($file=="")
{
$file=$file1;
}
$qry="update resources set title='$file',student='$student',website='$website' where id='$aid'";
runquery1($qry);
header("location:resources.php?act=edit");
}
?>
<html>
<head>
<title>List Functional Skills Resources</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>
<?php
	$sqlspn = "Select * from resources";
	//echo $sqlspn;
	//die();
	$result = runquery1($sqlspn) or die('could not execuate');
	if($result)
	{	
		$count = mysqli_num_rows($result);
		$page=Ceil($count/page_size);
		if(isset($_GET['curpage']))
		{
			$curpage = $_GET['curpage'];
			if($curpage==0)
			{
				 $sqlspn.=" order by title   Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by title   Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by title  Limit 0,".page_size;
		   $curpage=0;
		}
		$result = runquery1($sqlspn);
	}
?>
<body leftmargin="0" topmargin="0" class="seffact">
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Functional Skills Resources Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td>
						<?php
						if($act=="view"){?>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=overview" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=add" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=edit" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen"><a href="resources.php?act=view" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td > 
						
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
											<tr><td height="15"></td></tr>
																
																			<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a>&nbsp;<a href="javascript:print()">Print this page</a>&nbsp;&nbsp;</td>
							</tr>
							<tr><td height="15"></td></tr>
											<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">&nbsp;Functional Skills Resources </td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr > 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
																
					<tr> 
                  <td align='right' class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class=""> 
                              <td width="8%" height="32" align="center" class="lighttd2"> 
                                <div align="center"><strong>Sr No.<br>
                                  </strong> </div></td>
                              <td width="41%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Title<br>
                                  </strong> </div></td>
                              <td width="38%" align="left" class="lighttd2"><strong>Learner</strong></td>
							  <td  align="left" class="lighttd2"><strong>Website</strong></td>
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
		{
						   $regfetch="select * from cpo_usermaster where iUserId='".$rslist["student"]."'";
							$regresult=runquery1($regfetch);
							$regrow=mysqli_fetch_array($regresult);
							?>

                            <tr class="whittd"> 
                              <td align="center" class="bodytext" height="28"><?php echo $counter; ?>                              </td>
                              <td align="left" class="bodytext"><?php echo $rslist["title"] ?></td>
                              <td width="38%" align="left" class="bodytext"><?php echo $regrow["vUserName"] ?></td>
                              <td align="left"  height="28"><?php echo $rslist["website"]; ?>
							  </tr>
                            <?php
		$counter++;
		}
	}
	else
	{			
?>
                            <tr class="whittd"> 
                              <td align="center" height="35" colspan="3"><img src="images/alert.gif" border="0"></td>
                            </tr>
                            <tr class="whittd"> 
                              <td></td>
                              <td align="center" class="error" height="28" colspan="2">No Functional Skills Resources Information Found</td>
                              <?php
}
?>
                            </tr>
                          </table></td></tr>
				
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
												<a href="intialass.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
										</tr>
							
							
    															
</table></td>
											</tr>
        						</table>
																
						</td>
    			
				</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td ></tr>
</table></td>
    			
				</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td ></tr>
</table>
								
								<?php } else if($act=="edit"){ ?>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=overview" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=add" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="left"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen"><a href="resources.php?act=edit" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=view" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td > 
						
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
											<tr><td height="15"></td></tr>
																
																			<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a>&nbsp;<a href="javascript:print()">Print this page</a>&nbsp;&nbsp;</td>
							</tr>
							<tr><td height="15"></td></tr>
											<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">&nbsp;Functional Skills Resources </td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr > 
            								 	<td align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
																
					<tr> 
                  <td align='right' class="bodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class=""> 
                              <td width="8%" height="32" align="center" class="lighttd2"> 
                                <div align="center"><strong>Sr No.<br>
                                  </strong> </div></td>
                              <td width="41%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Title 
                                  Name<br>
                                  </strong> </div></td>
                              <td width="38%" align="left" class="lighttd2"><strong>Learner</strong></td>
                              <td width="13%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Action<br>
                                  </strong> </div></td>
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
		{  
		$regfetch="select * from cpo_usermaster where iUserId='".$rslist["student"]."'";
		$regresult=runquery1($regfetch);
		$regrow=mysqli_fetch_array($regresult);
?>

                            <tr class="whittd"> 
                              <td align="center" class="bodytext" height="28"><?php echo $counter; ?> 
                              </td>
                              <td align="left" class="bodytext"><?php echo $rslist["title"] ?></td>
                              <td width="38%" align="left" class="bodytext"><?php echo $regrow["vUserName"] ?></td>
                              <td width="13%" align="left" class="bodytext"><span class="center"><a href="resources.php?act=listedit&aid=<?=$rslist['id']?>"><img src="images/edit.png" border="0" alt="Edit" title="Edit" /></a> | <a href="resources.php?act=delete&aid=<?=$rslist['id']?>"><img src="images/delete.gif" border="0" alt="View" title="View" /></a></span>                              </td>
                            </tr>
                            <?php
		$counter++;
		}
	}
	else
	{			
?>
                            <tr class="whittd"> 
                              <td align="center" height="35" colspan="4"><img src="images/alert.gif" border="0"></td>
                            </tr>
                            <tr class="whittd"> 
                              <td></td>
                              <td align="center" class="error" height="28" colspan="3">No Functional Skills Resources Information Found</td>
                              <?php
}
?>
                            </tr>
                          </table></td></tr>
				
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
												<a href="intialass.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
											 <?php
												}									
											 }}?>&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
										</tr>
							
							
    															
</table></td>
											</tr>
        						</table></td>
    			
				</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td ></tr>
</table>
								<?php } else if($act=="add"){ ?>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=overview" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	<td width="0%" align="left"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen"><a href="resources.php?act=add" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=edit" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=view" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td > 
						
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
											<tr><td height="15"></td></tr>
																
																			<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a>&nbsp;<a href="javascript:print()">Print this page</a>&nbsp;&nbsp;</td>
							</tr>
							<tr><td height="15"></td></tr>
											<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">&nbsp;Functional Skills Resources </td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr > 
            								 	<td align="center" >
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
																
					<tr> 
                  <td align='right' class="bodytext" >
				  <form name="form1" enctype="multipart/form-data" method="post" action="">
				  <table width="68%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
                    <tr>
                      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                         
                          <tr>
                            <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                          </tr>
                      </table></td></tr>
                    <tr>
                      <td height="42" class="">Title</td>
                      <td >
                        <label>
                          <input type="file" name="file">
                          </label>
                      
                      </td>
                    </tr>
					<tr>
                      <td height="42" class="">Website </td>
                      <td >
                        
                          <input type="text" name="website">
                        
                      
                      </td>
                    </tr>
					
                    <tr>
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Select Learner </td>
                      <td width="60%" ><select name="student" id="student">
                          <option value="-">Select Learner </option>
                          <?php
						   $fetch="select * from cpo_usermaster where iUserType=2";
							$result=runquery1($fetch);
							$count= $result ? mysqli_num_rows($result) : 0 ;
							
							while($row=mysqli_fetch_array($result))
							{
							?>
                          <option value="<?php echo $row["iUserId"];?>"><?php echo $row["vUserName"];?></option>
                          <?php
							}
							?>
                        </select>
                          <font color="#FF0000">*</font></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" class="" height="12"><input name="addintial" id="addintial" type="image" src="images/add.gif" width="73" height="22" />                      </td>
                    </tr>
                  </table>
				  </form>
				  </td></tr>
				
										
							
							
    															
</table></td>
											</tr>
        						</table></td>
    			
				</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td ></tr>
</table>
								<?php } else if($act=="listedit"){
								$sqlspn = "Select * from resources where id='$aid'";
								$res=runquery1($sqlspn);
								$intfetch=mysqli_fetch_array($res);
								
								?>
								 
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=overview" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	<td width="0%" align="left"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen"><a href="resources.php?act=add" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=edit" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=view" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td > 
						
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
											<tr><td height="15"></td></tr>
																
																			<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a>&nbsp;<a href="javascript:print()">Print this page</a>&nbsp;&nbsp;</td>
							</tr>
							<tr><td height="15"></td></tr>
											<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td class="toheaderbg" colspan="3">&nbsp;Functional Skills Resources </td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr > 
            								 	<td align="center" >
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
																						
																
					<tr> 
                  <td align='right' class="bodytext" >
				  <form name="form1" enctype="multipart/form-data" method="post" action="">
				  <input type="hidden" name="file1" id="file1" value="<?=$intfetch['title']?>" />
				  <input type="hidden" name="aid" id="aid" value="<?=$aid?>" />
				  <table width="68%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
                    <tr>
                      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                         
                          <tr>
                            <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                          </tr>
                      </table></td></tr>
                    <tr>
                      <td height="42" class="">Title</td>
                      <td >
                        
                          <input type="file" name="file"> &nbsp; <?=$intfetch['title']?>
                        
                      
                      </td>
                    </tr>
					
					<tr>
                      <td height="42" class="">Website </td>
                      <td >
                        
                          <input type="text" name="website" value="<?php echo $intfetch['website'];?>"> &nbsp; 
                        
                      
                      </td>
                    </tr>
					
                    <tr>
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Select Learner </td>
                      <td width="60%" ><select name="student" id="student">
                          <option value="-">Select Learner </option>
                          <?php
						   $fetch="select * from cpo_usermaster where iUserType=2";
							$result=runquery1($fetch);
							$count= $result ? mysqli_num_rows($result) : 0 ;
							
							while($row=mysqli_fetch_array($result))
							{
							?>
                          <option value="<?php echo $row["iUserId"];?>" <?php if($intfetch['student']==$row["iUserId"]){?> selected="selected"<?php } ?>><?php echo $row["vUserName"];?></option>
                          <?php
							}
							?>
                        </select>
                          <font color="#FF0000">*</font></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" class="" height="12"><input name="editintial" id="editintial" type="image" src="images/add.gif" width="73" height="22" />                      </td>
                    </tr>
                  </table>
				  </form>
				  </td></tr>
				
										
							
							
    															
</table></td>
											</tr>
        						</table></td>
    			
				</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td ></tr>
</table>
								<?php  } else{?>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
<td width="0%" align="left"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen"><a href="resources.php?act=overview" class="greendeactfont">Overview</a></td>
   <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=add" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=edit" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="resources.php?act=view" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td > 
						
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
											
											<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
																								
                            <td colspan="3"><table width="95%" cellspacing="1" cellpadding="1" border="0" align="left" style="margin-left:10px;">
              <tbody><tr> 
                <td height="22" class="bodytext"><strong><font color="#666666">What 
                  is </font></strong><span class="fontblue">Functional Skills Resources</span><strong><font color="#666666">
                  admin ?</font></strong></td>
              </tr>
              <tr> 
                <td valign="top" height="50" class="bodytext"><table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody><tr> 
                      <td width="3%"><div align="center"><img src="./images/arrow.gif"></div></td>
                      <td width="97%" height="20" class="bodytext"><strong>Functional Skills Resources</strong> admin is a module from where you will be able to </td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td height="20" class="bodytext"> <table width="100%" cellspacing="0" cellpadding="0" border="0">
					  	                          <tbody><tr> 
                            <td width="3%"> <div align="center"><img width="5" height="5" src="./images/arrow.gif"></div></td>
                            <td width="97%" height="18" class="bodytext">Add</td>
                          </tr>
						  	                          <tr> 
                            <td><div align="center"><img width="5" height="5" src="./images/arrow.gif"></div></td>
                            <td height="18" class="bodytext"> Edit / Delete</td>
                          </tr>
                          <tr> 
                            <td><div align="center"><img width="5" height="5" src="./images/arrow.gif"></div></td>
                            <td height="18" class="bodytext">And View list of </td>
                          </tr>
                          <tr> 
                            <td height="18" class="bodytext" colspan="2">All the 
                              <strong>Functional Skills Resources</strong></td>
                          </tr>
                          <tr> 
                            <td height="18" class="bodytext" colspan="2"></td>
                          </tr>
                        </tbody></table></td>
                    </tr>
						                    <tr> 
                      <td><div align="center"><img src="./images/arrow.gif"></div></td>
                      <td height="20" class="bodytext"> <span class="fontblue">Add Functional Skills Resources</span></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td height="20" class="bodytext">Please use this interface to Add new <strong>Functional Skills Resources</strong>.</td>
                    </tr>
					                    <tr> 
                      <td><div align="center"><img src="./images/arrow.gif"></div></td>
                      <td height="20" class="bodytext"><span class="fontblue">Edit / Delete Functional Skills Resources</span></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td height="20" class="bodytext">Please use this interface to Edit or  Delete <strong>Functional Skills Resources</strong> from system.</td>
                    </tr>
                    <tr> 
                      <td><div align="center"><img src="./images/arrow.gif"></div></td>
                      <td height="20" class="bodytext"><span class="fontblue">List Functional Skills Resources</span></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td height="20" class="bodytext">Please use this interface to see the List of existing <strong>Functional Skills Resources</strong>.</td>
                    </tr>
                  </tbody></table></td>
              </tr>
              			  <tr> 
                <td height="50" class="bodytext"><div align="left">&nbsp;<strong><font color="#666666">Total 
                    No. of Records:</font></strong> <span class="fontblue"><?=$count?></span></div></td>
              </tr>
			 	              <tr>
                <td class="bodytext">&nbsp;</td>
              </tr>
            </tbody></table>
                            </td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								
        						</table>
								</td>
    			
				</tr>
      </table></td></tr>
  
  <tr>
    <td width="0%"><img src="images/green_left_corn.gif" /></td>
    <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
    <td width="0%"><img src="images/green_right_corn.gif" /></td>
  </tr>
</table>
</td ></tr>
</table>
								<?php } ?>
</td >
  </tr>
</table>
		</form>

	</td>
  </tr>
</table>
</body>
</html>
