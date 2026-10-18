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
} ?>

<?php

//echo $HTTP_POST_VARS['txtCourseId'];
$tid=$_POST['txtTutorId'];
//echo $tid;
//exit;
//@session_start();
@ob_start();
include_once 'dbConnection.php';
?>
<html>
<head>
<title>Add Subject</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">

<script language="JavaScript">

function validation()
{
	var str;
	var f = 0;
	//alert(document.frmtutorintegrate.htc.value);
	for(i=1;i<=document.frmtutorintegrate.htc.value-1;i++)
	{
		str = '';
		/*if (eval('document.frmtutorintegrate.txtSubjectId'+i+'.options[0].value') != "-")
		{
			f = 1;
		}*/
		for(j=0;j<eval('document.frmtutorintegrate.txtSubjectId'+i+'.length');j++)
		{
			
			//alert("in :"+eval('document.frmtutorintegrate.txtSubjectId'+i+'.length'));
			str=str+eval('document.frmtutorintegrate.txtSubjectId'+i+'.options['+j+'].value')+",";
		}
		//alert(str);		
		if(str == '' && eval('document.frmtutorintegrate.txtSubjectId'+i+'.id') != 1)
		{
			alert("first select subject");
			return false;
		}
//		alert(str);
		set = eval('document.frmtutorintegrate.firstval'+i);
		set.value = str ;

	}
	
	return true;
}



function sendimpex(count)
{
	var s,i,ind,k;
	var task_id=new Array();
	var impexno=new Array();
	var ind = new Array();
	srctxt=eval('document.frmtutorintegrate.txtSubject'+count);
	desttxt=eval('document.frmtutorintegrate.txtSubjectId'+count);
	//alert(desttxt);
//	desttxt=eval(');
	//alert(desttxt.length);
	
	k=0;
		for ( j=0 ; j < srctxt.length ; j++)
	{
		
		if ( srctxt.options[j].selected == true )
		{
				s = srctxt.options[j].value;
				//task_id[j] = s.substring(0,s.indexOf("-"));
				task_id[j] =  srctxt.options[j].value;
				impexno[j] = srctxt.options[j].text;
	

				var oOption = document.createElement("OPTION");
				oOption.text=impexno[j];
				oOption.value=task_id[j];
				//eval('document.frmtutorintegrate.txtSubjectId'+count+'[]');
				desttxt.options.add(oOption);
				ind[k] = srctxt.options[j].index
				k=k+1;
		}	
		
	}
	j1=ind.length
	for ( i=0 ; i < j1 ; i++)
	{
		srctxt.remove(ind[i]);		
		for ( t = i ; t < j1; t++)				// This loop changes the indexes of all the selected values (after first selected) to 
		{									// one less then original as after one removal from impex_display it's indexes are
			ind[t+1] = ind[t+1] - 1			//reset. so v r changing the array ind[] accordingly.
		}	
	}
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact">

<?php include_once('top.php')?>
<table width="999"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">


<form name="frmtutorintegrate" action="addtutorcoursesubject.php" method="post" onSubmit="return validation();">
<input type="hidden" name="txtTutor" value="<?php echo $tid; ?>">
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
																								
																								
                            <td class="toheaderbg" colspan="3">Add 
                          Tutor to Course &amp; Subjects</td>
																								
									  													</tr> 
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            									<td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
<tr> 
																								<td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
																						</tr>
																<tr><td>&nbsp;</td></tr>
<?php 
$Course_id = "";	
				foreach($_POST['txtCourseId'] as $value)
				{
					$Course_id.= $value. ","; 
				}
				$Course_id = substr($Course_id,0,strlen($Course_id)-1);
				
if ($Course_id <> "-")
{	?>
<tr> 
                        <td height="19" colspan="4" class="bodytext" ><div align="right">(fields 
                            marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                      </tr>
					  <tr><td>&nbsp;</td></tr>
<?php			
$cont=1;
$cnt=1;
	foreach($_POST['txtCourseId'] as $value)
	{
		$flg=1;
		
		$ans=explode("~",$value);?>
							
                <tr> 
				<input type="hidden" name="hc<?php echo $cnt;?>" value="<?php echo $ans[0]?>">
        		  <td width="30%" height="42" valign="top" class="">&nbsp;&nbsp;<?php echo $ans[1];?>
                  <td width="30%" height="42" valign="top" class=""><!--&nbsp;&nbsp;--><?php //echo $ans[1];?>
				  <?php		
						   $fetch="select * from cpo_subjectincourse where iCourseID=".$ans[0];
						   $result=runquery($fetch);
						   $count=$result ? mysqli_num_rows($result) : 0; 
						   ?><select name="txtSubject<?php echo $cont;?>"  size="7" multiple><?php
						   if($count>0)
							{
								$flg=0;			
							while($row=mysqli_fetch_array($result))
							{
								$anssub=explode(",",$row['vSubjectID']);
								foreach($anssub as $sub)
								{
								$fetchsub="select * from cpo_subjectmaster where iSubjectId=".$sub."";
								$resultsub=runquery($fetchsub);
								$num1 = $resultsub ? mysqli_num_rows($resultsub) : 0 ;		
								if ($num1 > 0 )
								{
									$resultsub  = mysqli_fetch_array($resultsub);
						?>
						<option value="<?php echo $resultsub["iSubjectId"];?>"><?php echo $resultsub["vSubjectName"];?></option>
						<?php
								}
								}
							}
							}
							else
								{ 
																?>
								<option value="-">No Subject</option>
								
								<?php  $cont++;
								 } ?>
				  </select>
				  <!-- new-->
				  <?php
				  if ($flg == 1)
				  { ?>
				  	<input type="hidden" name="txtSubjectId<?php echo $cont-1;?>" id="1">
				  <?php }
				  ?>
				   <!-- new-->
				  </td>
				  <?php if($flg==0)
				  { ?>
				  <td width="10%" height="42" class="" align="justify">&nbsp;&nbsp;
                        <img src="images/button1.gif" border="0" alt="Select Subject" name="<?php echo $cont;?>" onClick="sendimpex(<?php echo $cont; ?>)" style="cursor:hand"></td>
						
                      <td width="30%" > <select name=txtSubjectId<?php echo $cont;?> size="7" multiple>
					<!--  <option value="-" selected>Select Subject</option> -->
							</select> 
							</td>
						
						<?php $cont++;} ?><input type="hidden" name="firstval<?php echo $cont-1;?>">	


                </tr>
				<?php $cnt++;
				}// End of main foreach loop 
				?>
				<input type="hidden" name="htc" value="<?php echo $cnt;?>">
				<tr><td colspan="4">&nbsp;</td></tr>
                  <tr> 
                  <td colspan="4" align="right" class="" height="12"><input type="image" src="images/next1.gif" border="0" alt="Next">&nbsp;&nbsp;<a href="overview.php?id=tutorincourse"><img src="images/cancel.gif" border="0"></a>&nbsp;</td>
				  <!--<input type="image" src="images/go_back.gif" border="0" alt="Next" > -->
                  </tr>
			<?php
			}
			else
			{ ?>
				<tr><td colspan="4">&nbsp;</td></tr>
				<tr><td colspan="4" align="center"><b>First Select Courses</b></td></tr>
								<tr><td colspan="4">&nbsp;</td></tr>				
				<tr> 
                  <td colspan="4" align="right" class="" height="12"><a href="addtutorintegrate.php"><img src="images/go_back.gif" border="0" alt="Go Back"></a>&nbsp;
                  </td>
				  
                  </tr>
				<tr><td colspan="4">&nbsp;</td></tr>				
				  
			<?php }
			?>	
				
							
							
    															
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

	</td>
  </tr>
</table>
</body>
</html>
