<?php
@ob_start();
include_once 'dbConnection.php';
if(isset($_GET['active']))
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
	
	
		
	$rscheck=mysqli_query($query,$_SESSION['conn']) or die('error'.mysqli_error());

}
}


	$sql="SELECT * FROM cpo_TutorForCourses";
    $rID=mysqli_query( $sql,$_SESSION['conn']);
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
									  $rID=mysqli_query( $sql,$_SESSION['conn']);
?>

<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title></title>
<script language="JavaScript">
function sub1()
{
	document.frmcourse.action="viewcourse.php?active=1";
	document.frmcourse.submit();
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
<form name="frmcourse" method="post" action="deletecourse.php">		
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Tutor - Course Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=tutorintegrate>Overview</a></div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></div></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><font color="#000099"><a class="tablink" href="addtutorintegrate.php">Add</a></font></div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Edit 
                / Delete</div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listtutorintegrate.php">List</a></div></td>
            <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            <td width="34%" background="images/middle_last.jpg"></td>
          </tr>
        </table></td>
	</tr>
	<tr> 
      <td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
          <tr> 
            <td bgcolor="F5F8FF">&nbsp;</td>
          </tr>
         
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF"><table width="85%" cellSpacing=0 cellPadding=0 border=0 class="table" align="center">
                <tr> 
                  <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        <td width="517" class="headingtd">Edit / Delete Tutor 
                          Integrate</td>
                        <td width="346" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td width="5%" height="15" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td height="25"  class="lighttd2"><b>Tutor Name</b> </td>
				  <td height="25"  class="lighttd2"><b>Course Name</b> </td>
				  <td height="25"  class="lighttd2"><b>Subjects</b> </td>
                 
                 
                  <td  class="lighttd2"><div align="center"><strong>Delete</strong></div></td>
                </tr>
                <tr bgcolor="#FFFFFF" > 
                  <td colspan="5"> <div align="center"></div></td>
                </tr>
                <?php if($rID)
                  {
                    $cnt=1;
                   while($rslist = mysqli_fetch_array($rID))
					
                    {
                    	?>
                <tr class="whittd"> 
                  <td align="center"> <input type="checkbox" name=cbo<?phpecho $cnt;?>> 
                    <input type="hidden" name=hb<?phpecho $cnt;?> value=<?phpecho $rs[0];?>> 
                  </td>
                  <td width="56%" height="30" align=left > <a href="edittutorintegrate.php?id=<?phpecho $rs[0];?>" ><?php
							  		$sql1="select vUserfName from cpo_usermaster where iUserId = '".$rslist["iUserID"]."'";
									
									$result1=mysqli_query($sql1) or die('could not execute query'.mysqli_error());
									$name=mysqli_result($result1,0,0);
							  							
									
									 echo $name; ?></a> 
                  </td>
				  <td align="left" class="bodytext">
							  	<?php
							  		$sql1="select vCourseName from cpo_CourseMaster where iCourseId = '".$rslist["iCourseID"]."'";
									
									$result1=mysqli_query($sql1) or die('could not execute query'.mysqli_error());
									$name=mysqli_result($result1,0,0);
									
							  
									
									 echo $name; ?></td>
									 <td align="left" class="bodytext">
									 <?php
									 	if($rslist["vSubjectIDs"]==-2)
										{
											echo "ALL SUBJECT";
										}
										else
										{
									 					$id=explode(",", $rslist["vSubjectIDs"]);
														
														$str="";
														for($i=0;$i<count($id);$i++)
														{
															
                            								$sql2="select vSubjectName from cpo_SubjectMaster where iSubjectId= '".$id[$i]."'";
							  								$result2=mysqli_query($sql2) or die('could not execute query'.mysqli_error());
															$name=mysqli_result($result2,0,0);
									 						$str=$str."  ".$name."  "; 
														}
															echo $str;
										}
														?>
														</td>
                  
                 
                  <td width="13%" align=left ><div align="center"><a href="deletecourse.php?id=<?phpecho $rs[0];?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                
                
                <tr > 
                  <td height="30" colspan="2" align=left><input name="image" type="image" src="images/delete1.gif" width="73" height="22"> 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  
                  <td align=left><div align="center"><img src="images/submit.gif" width="73" height="22" onClick="sub1()" style="cursor:hand"></div></td>
                  <td align=left>&nbsp;</td>
                </tr>
                <tr align="right" bgcolor="#FFFFFF" >
                  <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="148" class="headingtd"><img height=20 src="./images/img_header_gradient1.jpg" width=147></td>
                        <td width="772" class="headingtd">&nbsp;</td>
                        <td width="1" ><div align="right"><img src="./images/round_corner1.gif" width="3" height="20"></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="5">&nbsp;</td>
                </tr>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="5"> 
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
                    <a href="viewtutorintegrate.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a> 
                    <?php
												}									
											 }}?>
                    &nbsp;&nbsp;</td>
                </tr>
                <?php
				  }
				  else
				  {
				      echo "No Course found";
				  }
			?>
              </table> </td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
         
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
         
        </table>
		</td>
	</tr>
</table>
</form>
</BODY>
</HTML>

