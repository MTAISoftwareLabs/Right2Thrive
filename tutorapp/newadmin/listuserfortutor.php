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
?>
<html>
<head>
<title>List  Learner - Tutor</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript">
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
		
	ct=document.listuserfortutor.cmbcategory.value;	
	document.listuserfortutor.action ='listuserfortutor.php?ct='+ct;
	document.listuserfortutor.submit();
}
function goto($cur)
{
	//getselectedval();
		
	ct=document.listuserfortutor.cmbcategory.value;	
	document.listuserfortutor.action = 'listuserfortutor.php?ct='+ct+'&curpage='+$cur;
	document.listuserfortutor.submit();
}
function openwin(obj,obj1)
{
	window.open("learnerstatus.php?id="+obj+"&cid="+obj1,"","height=300,width=750,scrollbars=1");
}
</script>

</head>
<?php

	if($getct=='')						  
	{
		$sqlspn = "select * from cpo_usercourse ";
		
	}	
	else
	{
	
	$sqlspn = "select * from cpo_usercourse";
	//echo $sqlspn;
	//die();
	}
		//echo $sqlspn;
	//die();
	$result = runquery1($sqlspn) or die('could not execute'.mysqli_error());
	if($result)
	{	
		$count = mysqli_num_rows($result);
		$page=Ceil($count/page_size);
		if(isset($_GET['curpage']))
		{
			$curpage = $_GET['curpage'];
			if($curpage==0)
			{
				 $sqlspn.=" order by iUserId  Limit 0,".page_size;
			}
			else
			{
				$current=page_size*($curpage);
				$sqlspn.=" order by iUserId  Limit " .$current. ",".page_size;
			}
		}
		else
		{
		   $sqlspn.=" order by iUserId Limit 0,".page_size;
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
    <td align="left" class="schoolfont">Learner - Tutor Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=userfortutor" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="adduserintegrate.php" class="greendeactfont">Add</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewuserfortutor.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">List</td>
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
																								
																								
                            <td class="toheaderbg" colspan="3">List of Learner Tutor Integration</td>
																								
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
                              <td width="26%" height="32" align="left" class="lighttd2"><div align="Left"><strong>Learner 
                                    Name <br>
                                  </strong> </div></td>
							<td width="40%" height="32" align="left" class="lighttd2"><div align="Left"><strong> 
                                    Course Name<br>
                                  </strong> </div></td>
                              <td width="26%" height="32" align="left" class="lighttd2"><div align="Left"><strong> 
                                    Tutor List<br>
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
								
?>
                            <tr class="whittd"> 
                              <td align="center" class="bodytext" height="28"><?php echo $counter; ?> 
                              </td>
                              <td align="left" class="bodytext"><a href="javascript:openwin(<?php echo $rslist["iUserId"] ?>,<?php echo $rslist["iCourseId"] ?>);"><?php
							  		 // $iUserId = $rslist["iUserId"];
            // $iCourseId = $rslist["iCourseId"];
            // $sql1 = "SELECT vUserName FROM cpo_usermaster WHERE iUserId = '$iUserId'";
            // $result1 = runquery1($sql1) or die('Query error: ' . mysqli_error($connection));
            
            
            $iUserId = $rslist["iUserId"];
            $iCourseId = $rslist["iCourseId"];
            
            $sql1 = "SELECT vUserName FROM cpo_usermaster WHERE iUserId = '$iUserId'";
            $result1 = runquery1($sql1) or die('User query error: ' . mysqli_error($connection));

            $sql2 = "SELECT vCourseName FROM cpo_coursemaster WHERE iCourseId = '$iCourseId'";
            $result2 = runquery1($sql2) or die('Course query error: ' . mysqli_error($connection));


            if ($result1 && mysqli_num_rows($result1) > 0) {
                $userData = mysqli_fetch_assoc($result1);
                $vUserName = $userData["vUserName"];
                echo "<a href='javascript:openwin($iUserId, $iCourseId);'>$vUserName</a>";
            } else {
                echo "User not found";
            }
            
            
            
									  ?></a></td>
									  
									  
                              <td align="left" class="bodytext">
							  	<?php
							  		if ($result2 && mysqli_num_rows($result2) > 0) {
                $courseData = mysqli_fetch_assoc($result2);
                $vCourseName = $courseData["vCourseName"];
                echo "<br> $vCourseName";
            } else {
                echo "<br>Course not found";
            }
            
		 
									 ?></td>
									 <td align="left" class="bodytext">
									 <?php
									 
									 	if ($rslist["vTutorId"] == -2) {
    echo "ALL SUBJECT";
} else {
    $tutorIds = explode(",", $rslist["vTutorId"]);
    $tutorNames = array();

    foreach ($tutorIds as $tutorId) {
        $sql2 = "SELECT vUserName FROM cpo_usermaster WHERE iUserId = '$tutorId'";
        $result2 = runquery1($sql2) or die('Tutor query error: ' . mysqli_error($connection));

        if ($result2 && mysqli_num_rows($result2) > 0) {
            $tutorData = mysqli_fetch_assoc($result2);
            $tutorName = $tutorData["vUserName"];
            $tutorNames[] = $tutorName;
        }
    }

    if (!empty($tutorNames)) {
        $tutorsString = implode(", ", $tutorNames);
        echo $tutorsString;
    }
}

														?>
														</td>
                            </tr>
                            <?php
		$counter++;
		}
	}
	else
	{			
?>
                            <tr class="whittd"> 
                              <td align="center" height="35" colspan="5"><img src="images/alert.gif" border="0"></td>
                            </tr>
                            <tr class="whittd">
                              <td align="center" class="error" height="28" colspan="5">No learner - Tutor Information Found</td>
                              <?php
}
?>
                            </tr>
                          </table></td></tr>
				<tr> 
              
											<td height="22" valign="top"> 
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													
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
												<a href="./listuserfortutor.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a>
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
</table>
</td >
  </tr>
</table>
		</form>

	</td>
  </tr>
</table>
</body>
</html>
