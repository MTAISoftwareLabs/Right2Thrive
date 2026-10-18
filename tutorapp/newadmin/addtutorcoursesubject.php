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
if(isset($_POST['txtTutor']))
{

$tid = $_POST['txtTutor'];
$lcnt=$_POST['htc'];

for($i=1;$i<=$lcnt-1;$i++)
{
	
	$temp = substr($_POST['firstval'.$i],0,strlen($_POST['firstval'.$i])-1);
	if($temp==""){ $r=0;  } else{ $r=0; } 

	$sqlqry="select * from cpo_tutorforcourses where iUserID=".$tid." and iCourseID=".$_POST['hc'.$i]."";

	$res=runquery($sqlqry);
	$num=$res ? mysqli_num_rows($res) : 0;
	

	if($num>0 && $temp!="")
	{
		$res=mysqli_fetch_array($res);

		$e=explode(",",$res['vSubjectIDs']); 
		$et=explode(",",$temp);
		$Subject_id = '';
		if($res['vSubjectIDs']!="")
		{
			$Subject_id = $res['vSubjectIDs'] .",";
		}
		else
		{
			$change=1;
		}
		$change=0;
		foreach($et as $value)
		{
			$flag = 0;
			for($k=0;$k<=count($e)-1;$k++)
			{
				if ($value == $e[$k])
				{
					$flag = 1;
				}
			}
			if ($flag == 0)
			{
				$Subject_id = $Subject_id . $value .",";
				$change = 1;
			}
		}
				$Subject_id = substr($Subject_id,0,strlen($Subject_id)-1);
				if($change == 0)
				{
					$msg="Record already exist";
				}
				else
				{
					$sql="update cpo_tutorforcourses set vSubjectIDs = '". $Subject_id ."' where iUserID=".$tid." and iCourseID=".$_POST['hc'.$i]."";
					runquery($sql);
					$msg="Record Updated Successfully";
				}
	}
	
	else
	{ 
	$sql="delete from cpo_tutorforcourses where iUserID=".$tid." and iCourseID=".$_POST['hc'.$i]."";
	runquery($sql);
	$sql="insert into cpo_tutorforcourses(iUserID,iCourseID,vSubjectIDs) values(".$tid.",".$_POST['hc'.$i].",'".$temp."')";
	$result=runquery($sql) or die(mysqli_error());
	$msg="Tutor is added Successfully";
	}
}//for
}

?>
<html>
<head>
<title>Add Tutor</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">

<script language="JavaScript">


</script>
</head><body leftmargin="0" topmargin="0" class="seffact">

<?php include_once('top.php')?>
<table width="999"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">

<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Tutor - Course Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=tutorincourse" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewtutorintegrate.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listtutorintegrate.php" class="greendeactfont">List</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	</tr>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr> 
				  		<td> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
												<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 		
                            <td class="toheaderbg" colspan="3">Tutor - Course Information</td>	
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            									<td align="left"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1" class="table">
                														
                														<tr> 
                  																<td align="center">&nbsp;</td>
																		</tr>		
                														<tr> 
            																	<td align="center"> 
			
              			<font class="comment"><b><?php echo $msg ?></b></font> 
               													</td>
          																</tr>
                														<tr> 
                  																<td align="center">&nbsp;</td>
														                </tr>	
                														<tr> 
																                <td align="center"><div align="right"><a href="addtutorintegrate.php"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="overview.php?id=tutorincourse"><img src="images/cancel.gif"  border="0"></a> &nbsp;</div></td>
                														</tr>
                														<tr> 
                  																<td>&nbsp;</td>
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
</td></tr>
</table>
</td>
  </tr>
</table>

	</td>
  </tr>
</table>
</body>
</html>
