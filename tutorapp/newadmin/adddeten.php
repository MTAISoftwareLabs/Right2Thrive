<?php 
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';

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
<title>Add Detention</title>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript" src="./calendar1.js"></script> 
<script language="JavaScript">
function win_onload()
{
document.frmdetention.selstudent.focus();
}
function validation()
{
	var d = new Date();	
	date = d.getDate();
	month = d.getMonth()+1;
	year = d.getFullYear();

	for(var i=0; i <10; i++)
	{		
		if(month == i)
		{
			month = "0"+month;	
		}
		if(date == i)
		{
			date = "0"+date;	
		}
	}

	var today = year+month+date;
	var temp = document.frmdetention.txtddate.value.split('/');
	var ldate = temp[2]+temp[1]+temp[0];
	if(document.frmdetention.selstudent.value=="")
	{
		alert("Student must be selected!");
		document.frmdetention.selstudent.focus();
		return false;
	}
	if(document.frmdetention.seltutor.value=="")
	{
		alert("Tutor must be selected!");
		document.frmdetention.seltutor.focus();
		return false;
	}
	if(today > ldate)
	{
		alert("Detention date must be greater than or equal to current date.");
		 document.frmdetention.txtddate.focus();
		return false;
	}
	if(document.frmdetention.txtreason.value=="")
	{
		alert("Detention reason cannot be blank!");
		document.frmdetention.txtreason.focus();
		return false;
	}	
	
	return true;
}
function pickdate(obj)
{
	var mydatetime = new calendar1(document.forms['frmdetention'].elements[obj]);
	mydatetime.year_scroll = true;
	mydatetime.time_comp = false;
	mydatetime.popup();
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
	$student_name = $_POST['selstudent'];
	$tutor_name = $_POST['seltutor'];
	$deten_date = $_POST['txtddate'];
	$deten_reason = $_POST['txtreason'];
	$deten_improve = $_POST['taimprove'];		
	$sdate=explode("/",$deten_date);
	
	$date = $sdate[2]."-".$sdate[1]."-".$sdate[0];	
	$flag = 'D';
	
	//check for duplicate
	  $select = " SELECT I_userid, i_tutorid, D_detention FROM cpo_detention where I_userid='".$student_name."' and i_tutorid='".$tutor_name."' and D_detention='".$date."' and C_flag ='D'";
	 $record=runquery1($select);
	 $num = mysqli_num_rows($record);
	 
	 if($num >0)
	 {
		 $msg="Detention already exists.";
		 $flg = "red";
	}
	else
	{
	 $addsql = "INSERT INTO cpo_detention (I_userid, i_tutorid, D_detention, V_reason, T_improve, C_flag) values ('".$student_name."','".$tutor_name."','".$date."','".$deten_reason."','".$deten_improve."','".$flag."') ";
	
	$record=runquery1($addsql) or die("could not execute query".mysqli_error());
	if($record)
	$msg="Detention added successfully.";
	else
	$msg="Error in insert.";	}?>		
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
    <td width="29%" align="center" class="graymid"><a  href="de_main.php?rid=det" class="greendeactfont">Edit / Delete </a></td>
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
                                              <td class="toheaderbg" colspan="3"><b>Monthly Progress Report</b> Information</td>
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
	<tr> 
            																	
            <?php
									if($flg == "red")
									{
								?>
								<td colspan="2" height="35" align="center"><img src="./images/alert.gif" border="0"></td>
							</tr>
							<tr>
								<td colspan="2" align="center" height="35" class="error"><?php echo $msg; ?></td>
								<?php
								}
								else
								{
								?>
								<td width="13%" height="35" colspan="2" align="center" class="fontblue"><?php echo $msg; }?></td>
          																</tr>
                                      <tr>
                                        <td align="center">&nbsp;</td>
                                      </tr>
                                      
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
							
                              </table></td>
                          </tr>
						  <tr> 
																                <td align="center"><div align="right"><a href="adddeten.php?rid=det"><img src="images/add_new.gif"  border="0"></a>&nbsp;<a href="de_main.php?rid=det"><img src="images/cancel.gif" width="73" height="22" border="0"></a> &nbsp;</div></td>
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
			<form action="" name="frmdetention" method="post" onSubmit="return validation();">
			<input type="hidden" name="rid" value="det">
  		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				
				<tr> 
						<td colspan="3" class="schoolfont">Detention  Admin</td>
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
    <td width="29%" align="center" class="graymid"><a  href="de_main.php?rid=det" class="greendeactfont">Edit / Delete </a></td>
    <td width="2%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="2%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="29%" align="center" class="graymid"><a href="listdet.php?rid=det" class="greendeactfont">List</a></td>
   
    <td width="5%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
	     </tr>
      </table>
						</td>
				  </tr>
				  <tr> 
				  		<td width="100%" class="" colspan="3"> 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="greenborder">
								<tr>
                                              <td class="toheaderbg" colspan="3">Add Detention</td>
                                            </tr>
         <tr> 
            <td bgcolor="#FFFFFF" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodytext">
                                        <tr>
                                          <td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
                                        </tr>
                                  <tr> 
										  								
                          
                      <td width="25%" height="42" class="">&nbsp;&nbsp;Select Learner </td>
   																	<td width="75%" ><select name="selstudent" class="textbox">
                                                                        <option value="">Select </option>
                   <?php $sqls = "select vUserName,iUserId from cpo_usermaster where iUserType=2";
					$querys = runquery1($sqls);
					while($rows = mysqli_fetch_array($querys))
					{								
					?>
				<option value="<?=$rows['iUserId']?>"><?=$rows['vUserName']?></option>
				<?php }?>
                                                                    </select>
																    <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="34%" height="42" class="">&nbsp;&nbsp;Select Tutor </td>
   																	<td width="66%" ><select name="seltutor" class="textbox">
                                                                        <option value="">Select </option>
                   <?php $sqls = "select iUserId,vUserName from cpo_usermaster where iUserType=1";
					$querys = runquery1($sqls);
					while($rows = mysqli_fetch_array($querys))
					{								
					?>
				<option value="<?=$rows['iUserId']?>"><?=$rows['vUserName']?></option>
				<?php }?>
                                                                    </select>
																    <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="34%" height="42" class="">&nbsp;&nbsp;Detention Date</td>
      						<td width="66%" ><input name="txtddate" type="text" class="textbox" readonly value="<?php echo date("d/m/Y");?>">&nbsp;<a href="javascript:pickdate('txtddate')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a> <font color="#FF0000">*</font> </td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="34%" height="42" class="">&nbsp;&nbsp;Reason of Detention </td>
      																	<td width="66%" ><input type="text" name="txtreason" maxlength="100" size="40" class="textbox" > <font color="#FF0000">*</font></td>
    															</tr>
																<tr> 
										  								
                          
                      <td width="34%" height="42" class="">&nbsp;&nbsp;What do learner need to improve? </td>
      																	<td width="66%"  ><textarea name="taimprove"  class="textbox" cols="30"></textarea></td>
    															</tr>
    														<tr> 
      																	<td colspan="2"  style="padding-right:10px"> <div align="right"><font face=verdana size=2><b> 
                      &nbsp;&nbsp; 
                      <input name="image" type="image" src="images/add.gif" ><input type="hidden" name="hdnsubmit" value="1">
                      &nbsp;&nbsp;<a href="de_main.php?rid=det"><img src="images/cancel.gif" border="0"></a> 
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
