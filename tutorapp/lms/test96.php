<?
/*
Our php.ini contains the following settings:

display_errors = On
register_globals = Off
post_max_size = 8M
*/
echo 'Max Exec Time = ' . ini_get('upload_max_filesize') . "<br>";
echo 'display_errors = ' . ini_get('display_errors') . "\n";
echo 'register_globals = ' . ini_get('register_globals') . "\n";
echo 'post_max_size = ' . ini_get('post_max_size') . "\n";
echo 'post_max_size+1 = ' . (ini_get('post_max_size')+1) . "\n"; 
echo 'post_max_size in bytes = ' . return_bytes(ini_get('post_max_size'));

function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val{strlen($val)-1});
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}

exit();

//echo $HTTP_POST_VARS['txtCourseId'];
$tid=$HTTP_POST_VARS['txtTutorId'];
//echo $tid;
//exit;
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@session_start();
@ob_start();
include_once 'dbConnection.php';
?>
<html>
<head>
<title>Add Subject</title>
<link href="adminstyle.css" rel="stylesheet" type="text/css">

<script language="JavaScript">

function validation()
{
	
/*	if(document.frmtutorintegrate.txtTutorId.value=="-")
	{
		alert("Please Select Tutor Name");
		document.frmtutorintegrate.txtTutorId.focus();
		return false;
	}
	if(document.frmtutorintegrate.txtCourseId.value=="-")
	{
		alert("Please Select Course Name");
		document.frmtutorintegrate.txtCourseId.focus();
		return false;
	}*/
/*	if(document.frmtutorintegrate.txtSubjectId.value=="-")
	{
		alert("Please Select Subject Name!");
		document.frmtutorintegrate.txtSubjectId.focus();
		return false;
	} */
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
			
			str=str+eval('document.frmtutorintegrate.txtSubjectId'+i+'.options['+j+'].value')+",";
		}
		alert(str);		
		if(str == '')
		{
			alert("first select subject");
			return false;
		}

		set = eval('document.frmtutorintegrate.firstval'+i);
		set.value = str ;

	}
	/*if (f == 0)
	{
		alert("No Subject");
		return false;
	}*/
		
	return true;
}

/*function win_onload()
{
 document.frmtutorintegrate.txtTutorId.focus();
}*/

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
				//alert(oOption.text);	
				oOption.value=task_id[j];
//				eval('document.frmtutorintegrate.txtSubjectId'+count+'[]');
				desttxt.add(oOption);
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

<!-- <body leftmargin="0" topmargin="0" class="seffact" onLoad="win_onload()"> -->
<form name="frmtutorintegrate" action="addtutorcoursesubject.php" method="post" onSubmit="return validation();">
<input type="hidden" name="txtTutor" value="<? echo $tid; ?>">
  		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
						<td>&nbsp;</td>
						
				</tr>
				<tr> 
						<td><h3><b>Tutor Integrate Admin</b></h3></td>
				</tr>
				<tr> 
						<td> 
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr> 
														<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            											<td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=tutorincourse">Overview</a></div></td>
            											<td width="1%" valign="top" background="images/middle.jpg"><div align="center"><img src="images/active_middle.jpg" width="11" height="23"></div></td>
            											<td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Add</font></div></td>
            											<td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="viewtutorintegrate.php">Edit / Delete</a></div></td>
											            <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listtutorintegrate.php">List</a></div></td>
            											<td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            											<td width="34%" background="images/middle_last.jpg"><div align="right"></div></td>
										</tr>
					  			</table>
						</td>
				  </tr>
				  <tr> 
				  		<td> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
										<tr> 
						  						<td bgcolor="F5F8FF">&nbsp;</td>
										</tr>
										<tr> 
						  						<td bgcolor="#FFFFFF">&nbsp;
														<table width="68%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
                <tr> 
                  <td colspan="3"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>                         <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        <td width="417" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Add 
                          Tutor to Course &amp; Subjects</strong></font></td>
                        <td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                      
                    </table></td>
<? 
$Course_id = "";	
				foreach($_POST['txtCourseId'] as $value)
				{
					$Course_id.= $value. ",";
				}
				$Course_id = substr($Course_id,0,strlen($Course_id)-1);
				if ($Course_id <> "-")
{	?>
<tr> 
                        <td height="19" colspan="3" class="bodytext" ><div align="right">(fields 
                            marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                      </tr>
<?			
$cont=1;
$cnt=1;
	foreach($_POST['txtCourseId'] as $value)
	{
		
		$flg=1;
		
		$ans=explode("~",$value);?>
							
                <tr> 
				<input type="hidden" name="hc<? echo $cnt;?>" value="<? echo $ans[0]?>">

                  <td width="40%" height="42" valign="top" class="">&nbsp;&nbsp;<? echo $ans[1];?>
				  <?		
						   $fetch="select * from cpo_subjectincourse where iCourseID=".$ans[0];
						   $result=runquery1($fetch);
						   $count=$result ? mysqli_num_rows($result) : 0; 
						   ?><select name="txtSubject<? echo $cont;?>"  size="7" multiple><?
						   if($count>0)
							{
								$flg=0;			
							while($row=mysqli_fetch_array($result))
							{
								$anssub=explode(",",$row['vSubjectID']);
								foreach($anssub as $sub)
								{
								$fetchsub="select * from cpo_subjectmaster where iSubjectId=".$sub."";
								$resultsub=runquery1($fetchsub);
								$num1 = $resultsub ? mysqli_num_rows($resultsub) : 0 ;		
								if ($num1 > 0 )
								{
									$resultsub  = mysqli_fetch_array($resultsub);
						?>
						<option value="<? echo $resultsub["iSubjectId"];?>"><? echo $resultsub["vSubjectName"];?></option>
						<?
								}
								}
							}
							}
							else
								{ ?>
								<option value="-">No Subject</option>
								<? $cont++;
								 } ?>
				  </select></td>
				  <? if($flg==0)
				  { ?>
				  <td width="40%" height="42" class="">&nbsp;&nbsp;
                        <img src="images/button1.gif" border="0" alt="Select Subject" name="<? echo $cont;?>" onClick="sendimpex(<? echo $cont; ?>)" style="cursor:hand"></td>
						
                      <td width="60%" > <select name=txtSubjectId<? echo $cont;?> size="7" multiple>
					<!--  <option value="-" selected>Select Subject</option> -->
							</select> 
							</td>
						
						<? $cont++;} ?><input type="hidden" name="firstval<? echo $cont;?>">	


                </tr>
				<? $cnt++;
				}// End of main foreach loop 
				?>
				<input type="hidden" name="htc" value="<? echo $cnt;?>">
                  <tr> 
                  <td colspan="3" align="center" class="" height="12"><input type="image" src="images/next1.gif" border="0" alt="Next" > 
                  </td>
				  <!--<input type="image" src="images/go_back.gif" border="0" alt="Next" > -->
                  </tr>
			<?
			}
			else
			{ ?>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr><td colspan="3" align="center">First Select Courses</td></tr>
				<tr><td colspan="3">&nbsp;</td></tr>				
				  
			<? }
			?>	
              </table>
  												<td bgcolor="#FFFFFF">&nbsp;</td>
          								</tr>
          								<tr> 
            									<td bgcolor="#FFFFFF">&nbsp;</td>
          								</tr>
        						</table>
						</td>
    			</tr>
  		</table>
  		<p>&nbsp;</p>
  		<p>&nbsp;</p>
  		<p>&nbsp;</p>
		</form>
	<?
//}
	?>
</body>
</html>