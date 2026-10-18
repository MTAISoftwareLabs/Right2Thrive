<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 
if(isset($_GET['id']))
{
	$flg="green";
	$msg="";
	$msg1="";
	$flg1="false";

	$sql="select * from cpo_subjectincourse";
	$result=runquery1($sql);
	while($rslist = mysqli_fetch_array($result))
	{
		$id=explode(",",$rslist["vSubjectID"]);
														
		for($i=0;$i<count($id);$i++)
		{
				if($id[$i]==$_GET['id'])
				{
					$sql="select vSubjectName from cpo_subjectmaster where iSubjectId='".$_GET['id']."'";
					$result=runquery1($sql);
					$cname=mysqli_result($result,0,0);
					$flg="red";
					$msg=$msg.$cname.",Subject Cannot be Deleted!<br>They are Integrated to Course And Tutors First Remove From There";
					$flg1="true";
					break;
				}
		}		
	}
	if($flg1!="true")
	{
		$sql="select * from cpo_tutorforcourses";
		$result=runquery1($sql);
		while($rslist = mysqli_fetch_array($result))
		{
			$id=explode(",",$rslist["vSubjectIDs"]);														
			for($i=0;$i<count($id);$i++)
			{
				if($id[$i]==$_GET['id'])
				{
					$sql="select vSubjectName from cpo_subjectmaster where iSubjectId='".$_GET['id']."'";
					$result=runquery1($sql);
					$cname=mysqli_result($result,0,0);
					$flg="red";
					$msg=$msg.$cname.",Subject Cannot be Deleted!<br>They are Integrated to Course And Tutors First Remove From There";
					$flg1="true";
					break;
				}
			}							
		}
	}
	if($flg1!="true")
	{
		$sql="select us.I_subjectid,sm.iSubjectId,sm.vSubjectName from cpo_user_subject us, cpo_subjectmaster sm where sm.iSubjectId=us.I_subjectid and us.I_subjectid=".$_GET['id'];
		$result=runquery1($sql);
		while($rslist = mysqli_fetch_array($result))
		{
				$cname=$rslist['vSubjectName'];
				$flg="red";
				$msg='Subject "'.$cname.'" cannot be deleted. It is already assigned to learner.';
				$flg1="true";
				break;						
		}
	}
	if($flg1!="true")
	{
		$sql="delete from cpo_subjectmaster where iSubjectId=".$_GET['id'];
		$rscheck=runquery1($sql);
		$msg1="Subject deleted successfully.";
		if(file_exists("../admin/flash/".$_GET['id'].".swf"))
		{
			unlink("../admin/flash/".$_GET['id'].".swf");
		}
	}	
}  
elseif($_POST['txtcnt']>1)
{
	$flg="green";
	$msg="";
	$msg1="";
	$flg1="false";
	
	for($count=1;$count<=$_POST['txtcnt'];$count++)
	{
	   if(isset($_POST['cbo'.$count]))
	   {
			$sql="select * from cpo_subjectincourse";
			$result=runquery1($sql);
			while($rslist = mysqli_fetch_array($result))
			{
				$id=explode(",",$rslist["vSubjectID"]);
																					
				for($i=0;$i<count($id);$i++)
				{
					if($id[$i]==$_POST['hb'.$count])
					{
						$sql="select vSubjectName from cpo_subjectmaster where iSubjectId='".$_POST['hb'.$count]."'";
						$result=runquery1($sql);
						$cname=mysqli_result($result,0,0);
						$flg="red";
						$msg=$msg.$cname.",Subject Cannot be Deleted!<br>They are Integrated to Course And Tutors First Remove From There";
						$flg1="true";
						break;
					}	
				}	
			}
			
			if($flg1!="true")
			{
				$sql="select * from cpo_tutorforcourses";
				$result=runquery1($sql);
				while($rslist = mysqli_fetch_array($result))
				{
					$id=explode(",",$rslist["vSubjectIDs"]);
																					
					for($i=0;$i<count($id);$i++)
					{
						if($id[$i]==$_POST['hb'.$count])
						{
							$sql="select vSubjectName from cpo_subjectmaster where iSubjectId='".$_POST['hb'.$count]."'";
							$result=runquery1($sql);
							$cname=mysqli_result($result,0,0);
							$flg="red";
							$msg=$msg.$cname.",Subject Cannot be Deleted!<br>They are Integrated to Course And Tutors First Remove From There";
							$flg1="true";
							break;
						}
					}
				}
			}
			
			if($flg1!="true")
			{
				$sql="select us.I_subjectid,sm.iSubjectId,sm.vSubjectName from cpo_user_subject us, cpo_subjectmaster sm where sm.iSubjectId=us.I_subjectid and us.I_subjectid='".$_POST['hb'.$count]."'";
				$result=runquery1($sql);
				while($rslist = mysqli_fetch_array($result))
				{
						$cname=$rslist['vSubjectName'];
						$flg="red";
						$msg='Subject "'.$cname.'" cannot be deleted. It is already assigned to learner.';
						$flg1="true";
						break;						
				}
			}
			if($flg1!="true")
			{
				$sql="delete from cpo_subjectmaster where iSubjectId=" .$_POST['hb'.$count];
				$rscheck=runquery1($sql);
				$flg1="false";
				$msg1="Subject deleted successfully.";
				if(file_exists('../admin/flash/'.$_POST['hb'.$count].".swf"))
				{
					unlink("../admin/flash/".$_POST['hb'.$count].".swf");
				}
			}
		}
	}
}
?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Delete Subject</title>
</HEAD>
<BODY>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
    <td width="791" align="center" valign="top">
        <table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td class="schoolfont" align="left">Subject Admin</td>
          </tr>
          <tr>
            <td class="graydotline">&nbsp;</td>
          </tr>
          <tr>
            <td height="30px;"></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="overview.php?id=subject" class="greendeactfont">Overview</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="addsubject.php" class="greendeactfont">Add</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
						<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                        <td width="25%" align="center" class="midtabgreen">Edit / Delete</td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                        <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                        <td width="25%" align="center" class="graymid"><a href="listsubject.php" class="greendeactfont">List</a></td>
                        <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="3" class="greenborder" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                  <tr>
                                    <td bgcolor="#FFFFFF" align="center"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
                                        <tr>
                                          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              
											  <tr>
                                                <td class="toheaderbg" colspan="3">Subject Information</td>
                                              </tr>
												<?php if($flg=="red")
											{?>
											<tr> 
					<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
				</tr>
				<tr>
					<td colspan="2" align="center" height="35" class="error"><?php echo $msg."<br>";?></td>
				</tr>
											<?php }
											else
											{?>
												<tr> 
												  <td height="35" colspan="2" class="fontblue" align="center"><?php echo $msg1;?></td>
												</tr>
											<?php }?>
												<tr> 
												  <td colspan="2" ><div align="right">&nbsp; 
													  <a href="viewsubject.php?curpage=<?php echo $_GET['curpage'] ?>"><img src="images/edit1.gif"  border="0"></a>
													  <font face=verdana size=2><b><a href="overview.php?id=subject"><img src="images/cancel.gif"  border="0"></a></b></font>&nbsp;&nbsp; 
													</div></td>
												</tr>
                                            </table></td>
                                        </tr>
                                      </table>
                                  </tr>
                                  <tr>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        
                                    
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="0%"><img src="images/green_left_corn.gif" /></td>
                        <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                        <td width="0%"><img src="images/green_right_corn.gif" /></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
    </td>
  </tr>
</table>
</body>
</html>
