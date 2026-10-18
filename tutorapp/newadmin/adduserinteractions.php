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
$getlid = isset($_GET['lid'])?$_GET['lid']:'';
$getcid = isset($_GET['cid'])?$_GET['cid']:'';

//echo $getlid;
//echo $getcid;

if($getlid=='')
{
//$sqlcourse="select * from cpo_coursemaster";
//echo $sqlcourse;
}
else
{
$sqlcourse="select * from cpo_usercourse where iUserId=$getlid";

//echo $sqlcourse;
}

?>
<html>
<head>
<title>Add Learner to Interactions</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="txteditor.js"></script>
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
function getselected1(val,obj)
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
function validate(id)
{
	//alert(id);
	document.frmuserinteractions.method = "post";
	document.frmuserinteractions.action="adduserinteractions.php?lid="+id;
	document.frmuserinteractions.submit();
}
function validate1(lid,cid)
{
	
	document.frmuserinteractions.method = "post";
	document.frmuserinteractions.action="adduserinteractions.php?lid="+lid+"&cid="+cid;
	document.frmuserinteractions.submit();
}
function sub1()
{
	if(document.frmuserinteractions.txtLearnerId.value=="-")
	{
		alert("Please Select Learner Name");
		document.frmuserinteractions.txtLearnerId.focus();
		return false;
	}
	
	
	var len=document.all.length;
	var flag = 0;
	for(i=0;i<len;i++)
	{
		if(document.all(i).type=="checkbox" && document.all(i).id!='x')
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
	
	document.frmuserinteractions.action="adduserinteractions.php?&active=1";
	document.frmuserinteractions.submit();
}


function win_onload()
{
 //document.frmsubjectintegrate.txtCourseId.focus();
}

</script>
</head>

<body leftmargin="0" topmargin="0" class="seffact" onLoad="win_onload()">
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	<?php 
if(isset($_GET['active'])){
	for($count=1;$count<=$_POST['txtcnt']-1;$count++){
		$str="chk".$count;
		if(isset($_POST[$str])){
			if ($_POST[$str] != 'x') {
				$query="insert into cpo_student_interact values ('$_POST[txtLearnerId]','$_POST[$str]','1')";
				$rscheck=runquery1($query);
			}
			//echo $query;
			
		}
		
	}

$msg = "Records updated";

				
				
			//$record=mysqli_query($addsql1,$HTTP_SESSION_VARS['conn']) or die("could not execute query".mysqli_error());}
?>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Subject Admin</td>
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

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewuserinteractions.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listuserinteractions.php" class="greendeactfont">List</a></td>
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
                            <td class="toheaderbg" colspan="3">Learner - Interactions Information</td>	
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
			
              			<font class="fontblue"><b><?php echo $msg ?></b></font> 
               													</td>
          																</tr>
                														<tr> 
                  																<td align="center">&nbsp;</td>
														                </tr>	
                														<tr> 
																                <td align="center"><div align="right"><a href="adduserinteractions.php"><img src="images/add_new.gif" width="73" height="22" border="0"></a>&nbsp;<a href="overview.php?id=assignind"><img src="images/cancel.gif" width="73" height="22" border="0"></a> &nbsp;</div></td>
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
<?php } else {?>
	<form action="adduserinteractions.php" name="frmuserinteractions" method="post">
	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td class="schoolfont" align="left">Learner - Interactions Admin</td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Add</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="viewuserinteractions.php" class="greendeactfont">Edit / Delete</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="listuserinteractions.php" class="greendeactfont">List</a></td>
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
			  <td class="toheaderbg" colspan="3">Add Learner-Interactions</td>
			 </tr> 
			</table>
		  </td>
		 </tr>
		</table>
	   </td>
  	  </tr>
      <tr> 
       <td align="left">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
		 <tr> 
		  <td height="19" colspan="3" class="bodytext" >
		    <div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div>
		  </td>
		 </tr>
		 <tr> 
		  <td width="29%" height="30" class="">&nbsp;&nbsp;Select Learner</td>
      	  <td width="71%" >
		    <select name="txtLearnerId" class="textbox" onChange="validate(this.value)">
             <option value="-">Select Learner </option>
                <?php
				$fetch="select DISTINCT iUserId from cpo_usermaster where iUserStatus=1 and iUserType=2";
				$result=runquery1($fetch);
				$count= $result ? mysqli_num_rows($result) : 0 ;
				while($row=mysqli_fetch_array($result)) {
					$fetchname="select * from cpo_usermaster where iUserId=".$row["iUserId"];
					$resultfetchname=runquery1($fetchname);
					$learnername=mysqli_result($resultfetchname,0,1);
				?>
                    <option value="<?php echo $row["iUserId"];?>"><?php echo $learnername;?></option>
                <?php
				}
				?>
            </select>
				<?php 
				if ($getlid<>''){
				?>  
					<script language="JavaScript">getselected('<?php echo $getlid;?>',document.frmuserinteractions.txtLearnerId);</script>
				<?php
				}?> 
			<font color="#FF0000">*</font>
		  </td>
		 </tr>
		 <tr> 
		  <td width="29%" height="30" class="">&nbsp;&nbsp;Enrolled Courses</td>
      	  <td width="71%" >
            <?php
			$mysubjectarray = array();
			$overallcount  = 0;
			$result=runquery1($sqlcourse);
			$count= $result ? mysqli_num_rows($result) : 0 ;
			if ($lid==''){ 
				echo "Select a learner";
			} else if ($count == 0){
				echo "Learner is not enrolled in any courses"; 
			} else {
				while($row=mysqli_fetch_array($result)) {
					$sqlfetchname="select * from cpo_coursemaster where iCourseId=$row[iCourseId] and iStatus=1";
					$resultname=runquery1($sqlfetchname);
					$count1= $resultname ? mysqli_num_rows($resultname) : 0 ;
					if ($count1 > 0){
						$name=mysqli_result($resultname,0,1);							
						?>
						<br>
						<?php
						echo "<b>".$name."+</b>";
						$fetchsubject="select vSubjectID from cpo_subjectincourse where iCourseID=$row[iCourseId]";
						$fetchsubjectresult=runquery1($fetchsubject);
						$num = $fetchsubjectresult? mysqli_num_rows($fetchsubjectresult) : 0;
						if ($num > 0){
							$id=mysqli_result($fetchsubjectresult,0,0);
							$id=explode(",",$id);
							//$cnt=1;
							for($i=0;$i<count($id);$i++) {
								$fetchsubjectname="select vSubjectName from cpo_subjectmaster where iSubjectId=$id[$i]";
								$fetchsubjectnameresult=runquery1($fetchsubjectname);
								$name=mysqli_result($fetchsubjectnameresult,0,0);
								//echo $name.", ";
							    $mysubjectarray[$overallcount]['subid'] = $id[$i];
								//echo 'i='.$i;
								//echo 'oall='.$overallcount;
								//echo 'subid='.$mysubjectarray[$overallcount]['subid'];
								$mysubjectarray[$overallcount]['subname'] = $name;
								$mysubjectarray[$overallcount]['ispartcourse'] = 'true';
								$mysubjectarray[$overallcount]['enrolled']= 'false';
								$overallcount++;
							}
						}	
					}
				}
			}	
			 ?>
		  </td>
    	 </tr>
		 <tr>
		  <td width="29%" height="30" class="">&nbsp;&nbsp;Additional Subjects</td>
      	  <td width="71%" >
		</tr>
			<?php
			
			$extra_interact = "select * from cpo_student_interact where i_studentid = $lid and i_active=1";
			$interact=runquery1($extra_interact);
			$count12= $interact ? mysqli_num_rows($interact) : 0 ;
			if ($count12 > 0){
					while($row=mysqli_fetch_array($interact)) {
						$fetchsubjectname="select vSubjectName from cpo_subjectmaster where iSubjectId=$row[i_subjectid]";
						$fetchsubjectnameresult=runquery1($fetchsubjectname);
						$name=mysqli_result($fetchsubjectnameresult,0,0);
						$mysubjectarray[$overallcount]['subid'] = $row[i_subjectid];
						$mysubjectarray[$overallcount]['subname'] = $name;
						$mysubjectarray[$overallcount]['ispartcourse'] = 'false';
						$mysubjectarray[$overallcount]['enrolled']= 'true';
						$overallcount++;
					}	
			}
			if ($lid != '') {
			$subjectquery = "select vSubjectName, iSubjectId from cpo_subjectmaster";
			$result=runquery1($subjectquery);
			$count= $result ? mysqli_num_rows($result) : 0 ;
			if($count > 0) {
                $cnt=1;
                while ($rs = mysqli_fetch_row($result)){
                    ?>
					<tr>
					<td width="29%">&nbsp;</td>
					<td width="35%">
					<b><?php echo $rs[0];?></b> </td>
				  <td><a href="javascript:previewflash('<?php echo $rs[1];?>')"><img border="0" src="images/preview.gif"  style='cursor:hand'></a></td>
                  <td width="36%"><div align="right"> 
                   <?php
					$found='';
					$extracourse='';
					for ($j=0; $j<count($mysubjectarray); $j++) {
						if (($mysubjectarray[$j]['subid'] == $rs[1]) && ($mysubjectarray[$j]['enrolled']== 'true')){
							$found = 1;
							$extracourse=1;
						} else if (($mysubjectarray[$j]['subid'] == $rs[1]) && ($mysubjectarray[$j]['ispartcourse']== 'true')){
							$found = 1;
							$extracourse = 0;
						}
					 }
					 if ($found==1){
						 if ($extracourse==1) {
							 ?><i>-</i><input type="checkbox" name="chk<?php echo $cnt; ?>" value="t" checked disabled> <?php
							 }else{
							?><i>+</i><input type="checkbox" name="chk<?php echo $cnt; ?>" value="x" checked disabled> <?php
							 }
					 } else {
						?><input type="checkbox" name="chk<?php echo $cnt; ?>" value=<?php echo $rs[1]; ?>> <?php	  
					 }
					$cnt++;
					?></td></tr>
					
					<?php
					}
					?> <tr><td colspan="3"><i>Subjects marked with a <b>+</b> are part of a course and can only be removed from the Learner-Course Section.</i></td></tr>
					<tr><td colspan="3"><i>Subjects marked with a <b>-</b> are individual subjects and can be removed by using Modify/Delete in the Learner-Interaction Section.</td></tr><?php
				  }
				  else
				  { ?>
				  	<tr class="whittd"> 
                              <td align="center" height="35" colspan="7"><img src="images/alert.gif" border="0"></td>
                            </tr>
					<tr height="28" class="whittd"> 
						
                  <td colspan="7" align="center" class="error" height="28">No Subject Information Found</td>
					</tr>	
				  <?php
				  }			
				  }?>
		  </td>
		 </tr>
		    <td> <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
		 <tr>
		  <td colspan="2">&nbsp;</td>
		 </tr>															
	  	 <tr> 
          <td> </td>
          <td style="height:50px; padding-right:10px" align="right" valign="middle"><input type="image" src="images/add.gif" border="0" alt="Add" onClick="return sub1()">&nbsp;&nbsp;<a href="overview.php?id=userfortutor"><img src="images/cancel.gif"  border="0"></a></td>
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
		</form>
	<?php }?>
	</td>
  </tr>
</table>


</body>
</html>
