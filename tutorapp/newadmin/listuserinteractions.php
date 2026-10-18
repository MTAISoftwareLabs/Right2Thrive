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
		$def="hb1".$count;
		$query="update cpo_student_interact set iStatus=1 where iSubjectId=".$_POST[$abc]." and iUserId=".$_POST[$def];

	}
	else
	{
		$abc="hb".$count;
		$def="hb1".$count;
		$query="update cpo_student_interact set iStatus=0 where iSubjectId=".$_POST[$abc]." and iUserId=".$_POST[$def];
	}
		
	$rscheck=mysqli_query($query);

}
}


	$sql="SELECT * FROM cpo_student_interact";
	//echo $sql;
    $rID=runquery1( $sql);
	$count = mysqli_num_rows($rID);
	//echo $count;
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
<title>Edit / Delete User - Individual Interactions </title>
<script language="JavaScript">
function sub1()
{
	document.frmsubject.action="viewuserinteractions.php?active=1";
	document.frmsubject.submit();
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
<form name="frmsubject" method="post" action="deleteuserinteractions.php" onSubmit="return validation()">
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
    <td align="left" class="schoolfont">User-Interactions Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=assignind" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="adduserinteractions.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewuserinteractions.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">List</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	
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
																								
																								
                            <td class="toheaderbg" colspan="3">List Learner - Individual Interactions</td>
																								
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
                  <td width="5%" height="15" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td height="25"  class="lighttd2"><b>Student Name</b> </td>
	              <td height="25"  class="lighttd2"><b>Subject Name</b> </td>
                  <td  class="lighttd2"><div align="center"><strong>&nbsp;</strong></div></td>
                </tr>
                <tr bgcolor="#FFFFFF" > 
                  <td colspan="5"> <div align="center"></div></td>
                </tr>
                <?php if($num > 0 )
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_array($rID))
                    {
						$sqlc="select iUserId, vUserName from cpo_usermaster where iUserId=".$rs[0];
						//echo $sqlc;
                        $resc=runquery1($sqlc);
						$name1=mysqli_fetch_array($resc);
                    	?>
                <tr class="whittd"> 
                  <td align="center"> <?php echo $cnt ?> </td>
                  <td width="30%" height="30" align=left ><?php echo $name1['vUserName']; ?>
                  </td>
                  <td width="50%" height="30">
				  <?php	
					$sql2="select iSubjectId,vSubjectName from cpo_subjectmaster where iSubjectId= ".$rs[1]."";
					$result2=runquery1($sql2);
					$num = $result2 ? mysqli_num_rows($result2) : 0;
					if ($num > 0){
						$name=mysqli_fetch_array($result2);
						//echo $i . "/".count($subjectids); 
						echo $name['vSubjectName'];
					} ?>
                  </td>
                  <td width="15%" align="center">&nbsp;</td>
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
                
               <?php
				  }
				  else
				  { ?>
				  	<tr height="28" class="whittd"> 
						<td colspan="6" align="center" height="28">No User - Individual Interactions found.</td>
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
												<a href="./viewuserinteractions.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
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
