<?php
@ob_start();
include_once 'dbConnection.php';
?>
<html>
<head>
<title>Add Banner</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">

<script language="JavaScript">
function validation()
{
	if(document.frmBanner.txtBannerTitle.value=="")
	{
		alert("Subject Name can not be blank!");
		document.frmBanner.txtBannerTitle.focus();
		return false;
	}
	if(document.frmBanner.txtSubjectDesc.value=="")
	{
		alert("Subject Description can not be blank!");
		document.frmBanner.txtSubjectDesc.focus();
		return false;
	}
	
	
	return true;
}

function win_onload()
{
 document.frmBanner.txtBannerTitle.focus();
}

</script>
</head>

<body leftmargin="0" topmargin="0" class="seffact" onLoad="win_onload()">
<?php 

		if(isset($_POST['txtBannerTitle']))
			{
				$Subject_name=$_POST['txtBannerTitle'];
       			$Subject_desc=$_POST['txtSubjectDesc'];
			
				$sql="select count(*) from cpo_SubjectMaster where vSubjectname='".$Subject_name."'";
				$rIDPass=runquery1($sql);
				$rIDans=mysqli_fetch_row($rIDPass);
				if($rIDans[0]>0)
				{
					
					$msg="Subject Already Exit of That Name";
				}
				else
				{
							$sql="select max(iSubjectId) from cpo_SubjectMaster";
        					$rscheck=runquery1($sql);
							$num=1;
        					if(! empty($rscheck))
							{
								$rs=mysqli_fetch_row($rscheck);
								if($rs)
								{
								$num=$rs[0]+1;
								}
							}
		
							$uploadDir = './flash/';
							$uploadFile = $uploadDir . $_FILES['userfile']['name'];
			
							if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile))
							{
    									$x=$_FILES['userfile']['name'];
							}
							else
							{
    									$x="";
							}
						
				
				
								if(isset($_POST['chkactive']))
								{
									$status=1;
								}
								else
								{
									$status=0;
								}
			
			
		
          
          					  $addsql="insert into cpo_SubjectMaster values ('','".$Subject_name."','".$Subject_desc."',".$status.",'".$x."')";
						
           				 $record=runquery1($addsql) or die("could not execute query".mysqli_error());
						 $msg="Subject  ".$Subject_name."  Added Successfully";
			}
			?>
		
		
  				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    					<tr> 
      							<td>&nbsp;</td>
    					</tr>
    					<tr> 
      							<td><h3><b>Banner Admin</b></h3></td>
    					</tr>
    					<tr> 
      							<td> 
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
          										<tr> 
            											<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            											<td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=subject">Overview</a></div></td>
            											<td width="1%" valign="top" background="images/middle.jpg"><div align="center"><img src="images/active_middle.jpg" width="11" height="23"></div></td>
            											<td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Add</font></div></td>
            											<td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="viewsubject.php">Edit / Delete</a></div></td>
											            <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listsubject.php">List</a></div></td>
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
            											<td bgcolor="#FFFFFF">&nbsp;</td>
          										</tr>
          										<tr> 
            											<td bgcolor="#FFFFFF">
              													<table width="70%" border="0" align="center" cellpadding="0" cellspacing="1" class="table">
                														<tr> 
                  																<td>
																						<table width="100%" border="0" cellspacing="0" cellpadding="0">
 																	                    		<tr> 
																				                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
																				                        <td width="100%" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Information</strong></font></td>
																			                    </tr>
																		                </table>
																				</td>
                														</tr>
                														<tr> 
                  																<td align="center">&nbsp;</td>
																		</tr>		
                														<tr> 
            																	
            <td align="center"> <font class="fontblue"><b><?php echo $msg ?>.</b></font> 
            </td>
          																</tr>
                														<tr> 
                  																<td align="center">&nbsp;</td>
														                </tr>	
                														<tr> 
																                <td align="center"><div align="right"><a href="addsubject.php"><img src="images/add_new.gif" width="73" height="22" border="0"></a>&nbsp;<a href="overview.php?id=subject"><img src="images/cancel.gif" width="73" height="22" border="0"></a> &nbsp;</div></td>
                														</tr>
                														<tr> 
                  																<td>&nbsp;</td>
                														</tr>
              													</table> 
														<tr> 
                  												<td>&nbsp;</td>
                										</tr>
<?php
}
else
{
?>
		<form action="addsubject.php" enctype="multipart/form-data" name="frmBanner" method="post" onSubmit="return validation();">
  		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
						<td>&nbsp;</td>
				</tr>
				<tr> 
						<td><h3><b>Banner Admin</b></h3></td>
				</tr>
				<tr> 
						<td> 
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr> 
																							<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            											<td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=subject">Overview</a></div></td>
            											<td width="1%" valign="top" background="images/middle.jpg"><div align="center"><img src="images/active_middle.jpg" width="11" height="23"></div></td>
            											<td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Add</font></div></td>
            											<td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="viewsubject.php">Edit / Delete</a></div></td>
											            <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
            											<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listsubject.php">List</a></div></td>
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
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								<td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
																								
                            <td width="417" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Add 
                              Banner</strong></font></td>
																								<td width="246" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
									  													</tr> 
																						<tr> 
																								<td height="19" colspan="3" class="bodytext" ><div align="right">(fields marked with <font color="#FF0000">*</font> are compulsary)&nbsp;</div></td>
																						</tr>
																				</table>
																		</td>
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Banner 
                        Title</td>
      																	<td width="60%" ><input name="txtBannerTitle" type="text" class="textbox" maxlength="70" size="40"> <font color="#FF0000">*</font></td>
    															</tr>
    															<tr> 
                          												
                          
                    <!--  <td width="40%" height="42" class="">&nbsp;&nbsp;Banner 
                        URL </td>
      																	
                          <td width="60%" ><textarea name=txtSubjectDesc value="" rows="10" cols="45" class="textbox"></textarea> <font color="#FF0000">*</font> </td> -->
						  <td width="40%" height="42" class="">&nbsp;&nbsp;Banner 
                        URL</td>
      																	<td width="60%" ><input name="txtBannerURL" type="text" class="textbox" maxlength="70" size="40"> <font color="#FF0000">*</font></td>
    															</tr>
											<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Banner 
                        Category</td>
      																	<td width="60%" ><select name="txtBannerCategory"> <option value="-">Select Category</option></select> <font color="#FF0000">*</font></td>
    															</tr>		
																
																<tr> 
										  								
                          
                      <td width="40%" height="42" class="">&nbsp;&nbsp;Banner 
                        Image </td>
      																	<td width="60%" ><input name="userfile" type="file"/>
 <font color="#FF0000">*</font></td>
    															</tr>
    															
	  					
                      
																
				<!--	<tr> 
                  <td align=right class="bodytext"><div align="left">&nbsp; Active</div></td>
                  <td height="22" align=left>&nbsp;&nbsp; <input name="chkactive" type="checkbox" value="1" checked> 
                    <input type="hidden" name="txtcheck" value="1"></td>
                </tr> -->
							
							
    															<tr> 
      																	<td colspan="2" > <div align="right"><font face=verdana size=2><b> 
                      &nbsp;&nbsp; 
                      <input name="image" type="image" src="images/add.gif" width="73" height="22">
                      &nbsp;&nbsp;<a href="overview.php?id=subject"><img src="images/cancel.gif" width="73" height="22" border="0"></a> 
                      </b></font> </div></div>
                    </td>
    															</tr>
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
	<?php
}
	?>
</body>
</html>
