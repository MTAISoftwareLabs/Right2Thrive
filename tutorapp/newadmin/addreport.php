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
?>

<html>
<head>
<title>Add Monthly Progress Report</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript" src="./calendar1.js"></script> 
<script src="../include/functions.js" language="JavaScript"></script>
<script language="JavaScript">
function win_onload()
{
document.frmreport.sellearner.focus();
}
function validation()
{
	if(document.frmreport.selsubject.value=="")
	{
		alert("Subject must be selected!");
		document.frmreport.selsubject.focus();
		return false;
	}
	if(document.frmreport.sel_tutor.value=="")
	{
		alert("Tutor must be selected!");
		document.frmreport.sel_tutor.focus();
		return false;
	}
	if(document.frmreport.sel_learner.value=="")
	{
		alert("Learner must be selected!");
		document.frmreport.sel_learner.focus();
		return false;
	}
	if(document.frmreport.selmonth.value=="")
	{
		alert("Month must be selected!");
		document.frmreport.selmonth.focus();
		return false;
	}
	if(document.frmreport.selyear.value=="")
	{
		alert("Year must be selected!");
		document.frmreport.selyear.focus();
		return false;
	}
	return true;
}
function get_learner(id)
{
	var xmlHttp;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	if(id !='')
	{
		var query = "gettl.php?id="+id;
	}
	else
	{
		document.getElementById('id_tutor').style.display='none';
		document.getElementById('id_learner').style.display='none';
		return false;
		
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			var number1 = xmlHttp.responseText;
			document.getElementById('id_tutor').innerHTML= number1;
			document.getElementById('id_tutor').style.display='block';
		}
	}
	xmlHttp.open("GET",query,true);
	xmlHttp.send(null);
}
function get_learn(tutor,subject)
{
	var xmlHttp;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	
	if(tutor !='' && subject !='')
	{
		var query = "getstu.php?tid="+tutor+"&sub="+subject;
	}
	else
	{
		document.getElementById('id_learner').style.display='none';
		return false;
		
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			var number = xmlHttp.responseText;
			document.getElementById('id_learner').innerHTML= number;
			document.getElementById('id_learner').style.display='block';
		}
	}
	xmlHttp.open("GET",query,true);
	xmlHttp.send(null);
}
</script>
</head>
<body leftmargin="0" topmargin="0" class="seffact">
	
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0"   >
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
		<table width="97%"  border="0" cellspacing="0" cellpadding="0">
	<tr><td width="100%" colspan="3"><?php include_once('top_personal.php');?></td></tr>
  	<tr><td colspan="3"><table  width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder" align="center" >
		
			
		<tr><td width="100%">
		<?php 
		if(isset($_POST['hdnsubmit'])  && $_POST['hdnsubmit'] ==1)
{
	$sub_id = $_POST['selsubject'];
	$student_name = $_POST['sel_learner'];
	$tutor_name = $_POST['sel_tutor'];
	$year = $_POST['selyear'];
	$month = $_POST['selmonth'];
	
	$sql = "select I_userid from cpo_progressreport where I_userid=".$student_name." and  I_tutorid=".$tutor_name." and I_month=".$month." and I_year=".$year." and I_subjectid =".$sub_id;
	$exists=runquery1($sql) or die("could not execute query".mysqli_error());
	$num = mysqli_num_rows($exists);
	if($num)
	{
		$msg = "Report for $month and $year already exists.";
		$flg = "red";
	}
	else
	{
		$addsql="insert into cpo_progressreport (I_userid,I_tutorid,I_subjectid,I_month,I_year) values (".$student_name.",".$tutor_name.",".$sub_id.",".$month.",".$year.")";
		$record=runquery1($addsql) or die("could not execute query".mysqli_error());
		if($record)
		$msg="Monthly report added successfully.";
		else
		$msg="Error in insert.";
	}	?>	
      <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" class="schoolfont">Monthly Progress Report Admin</td>
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
			<td width="2%" align="left"><img src="images/left-corn-ac.gif" /></td>
    <td width="28%" align="center" class="midtabgreen">Add</td>
    <td width="1%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
    <td width="2%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a  href="mon_main.php?rid=report" class="greendeactfont">Edit / Delete </a></td>
    <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="2%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a href="listreport.php?rid=report" class="greendeactfont">List</a></td>
   
    <td width="5%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
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
                                              <td class="toheaderbg" colspan="3">Monthly Progress Report Information</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table>
                                </tr>
                                <tr>
                                  <td align="left"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="1">
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
 <?php
									if($flg == "red")
									{
								?>
								<td height="35" align="center"><img src="./images/alert.gif" border="0"></td>
							</tr>
							<tr>
								<td  align="center" height="35" class="error"><?php echo $msg; ?></td>
								<?php
								}
								else
								{
								?>
								<td align="center" height="35" class="fontblue"><?php echo $msg; }?></td>
          																</tr>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
								<tr>
                                        <td align="center"><div align="right"><a href="addreport.php?rid=report"><img src="images/add_new.gif" width="73" height="22" border="0"></a>&nbsp;<a href="mon_main.php?rid=report"><img src="images/cancel.gif" width="73" height="22" border="0"></a> &nbsp;</div></td>
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
		<tr><td  height="20">&nbsp;</td></tr>
      </table>
      <?php } else {?>
			<form action="" name="frmreport" method="post" onSubmit="return validation();">
			<input type="hidden" name="rid" value="report">
  		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
				
				<tr> 
						<td colspan="3" class="schoolfont">Monthly Progress Report Admin</td>
				</tr>
				<tr>
						<td colspan="3">&nbsp;</td>
				</tr>
			
				<tr> 
						<td colspan="3"> 
								
								
<table width="71%" border="0" cellspacing="0" cellpadding="0">
	       	<tr> 
			<td width="2%" align="left"><img src="images/left-corn-ac.gif" /></td>
    <td width="28%" align="center" class="midtabgreen">Add</td>
    <td width="1%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
    <td width="2%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a  href="mon_main.php?rid=report" class="greendeactfont">Edit / Delete </a></td>
    <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="2%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a href="listreport.php?rid=report" class="greendeactfont">List</a></td>
   
    <td width="5%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	     </tr>
      </table>
						</td>
				  </tr>
				  <tr> 
				  		<td width="100%" class="" colspan="3"> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder">
								<tr>
                                              <td class="toheaderbg" colspan="3">Add Monthly Progress Report </td>
                                            </tr>
         
          <tr> 
            <td bgcolor="#FFFFFF" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        <tr>
                                          <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                                        </tr>
                                   <tr> 
										  								
                          
                      <td width="27%" height="42" class="">&nbsp;&nbsp;Subject </td>
   																	<td width="73%" ><select name="selsubject" class="textbox" onChange="get_learner(this.value)">
                                <option value="">Select Subject</option>
                                <?php $sqls = "select iSubjectId,vSubjectName from cpo_subjectmaster where iStatus=1";
								$querys = runquery1($sqls);
								while($rows = mysqli_fetch_array($querys))
								{								
								?>
                                <option value="<?=$rows['iSubjectId']?>">
                                    <?=$rows['vSubjectName']?>
                                    </option>
                                <?php }?>
                            </select>  
																    <font color="#FF0000">*</font></td>
    															</tr>
																<tr><td colspan="2" class="bodytext"> <div id="id_tutor" style="display:block"></div></td></tr>
																<tr><td colspan="2" class="bodytext"><div id="id_learner" style="display:block"></div></td></tr>
																<tr> 
										  								
                          
                      <td width="27%" height="42" class="">&nbsp;&nbsp;Select Month and Year </td>
      																	<td width="73%" ><select name="selmonth"  >
			<option value="">Month</option>
			<?php 
			for ($m=1;$m<13;$m++){
			if($m<10)
			$m = "0".$m;
			
			?>
						<option value="<?php echo $m;?>"><?php echo $m;?></option>
						<?php }?>		
			</select>&nbsp;<select name="selyear">
			<option value="">Year</option>
			<?php 
					$yr = date('Y')-100;
					$year = date('Y')+1;
					for ($year;$year>$yr;$year--){
					?>
						<option value="<?php echo $year;?>" ><?php echo $year;?></option>
						<?php }?>
			</select>
			 <font color="#FF0000">*</font></td>
    															</tr>
    															<tr> 
      																	<td colspan="2"  style="padding-right:10px"> <div align="right"><font face=verdana size=2><b> 
                      &nbsp;&nbsp; 
                      <input name="image" type="image" src="images/add.gif" ><input type="hidden" name="hdnsubmit" value="1">
                      &nbsp;&nbsp;<a href="mon_main.php?rid=report"><img src="images/cancel.gif" border="0"></a> 
                      </b></font> </div></div>                    </td>
    															</tr>
                                      </table> </td>
          </tr>
                
          
        </table>
						</td>
    			</tr>
				<tr>
                    <td width="0%"><img src="images/green_left_corn.gif" /></td>
                      <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
                      <td width="0%"><img src="images/green_right_corn.gif" /></td>
                   
              </tr>
  		</table>
		</form>
		<?php } ?>
			</td>
		</tr>
      </table></td></tr>
	   <tr>
		  <td width="0%"><img src="images/green_left_corn.gif" /></td>
		  <td width="100%" class="greenborbotte"><img src="images/spacerx.gif" /></td>
		  <td width="0%"><img src="images/green_right_corn.gif" /></td>
        </tr>
	  </table></td></tr></table>
	


</form>
</body>
</html>
