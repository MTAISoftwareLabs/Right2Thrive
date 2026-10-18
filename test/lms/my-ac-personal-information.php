<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Personal Information<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<?php
	$sql="select us.I_user_subid,us.I_subjectid,us.V_sublevel,sb.vSubjectName,sb.iSubjectId,um.iUserId, um.vUserName    from cpo_usermaster as um, cpo_user_subject as us, cpo_subjectmaster as sb where us.I_studentid =".$_SESSION['user_id']." and sb.iSubjectId = us.I_subjectid and us.I_tutorid = um.iUserId group by us.I_subjectid";
	$result1=runquery1($sql);
	$count=mysqli_num_rows($result1);
	$page=Ceil($count/page_size);
	if(isset($_GET['curpage'])){
		$curpage = $_GET['curpage'];
		if($curpage==0){
			$sql.=" order by sb.vSubjectName Limit 0,".page_size;
		}else{
			$current=page_size*($curpage);
			$sql.=" order by sb.vSubjectName Limit " .$current. ",".page_size;
		}
	}else{
		$sql.=" order by sb.vSubjectName Limit 0,".page_size;
		$curpage=0;
	}
	$rID = runquery1($sql);
	$num = $rID ? mysqli_num_rows($rID) : 0 ;
?>
<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>My Account</h4>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="summery-tab" href="my-account" role="tab" aria-controls="summery" aria-selected="true"><i class="fa fa-university" aria-hidden="true"></i> Account Summary</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="information-tab" href="my-ac-personal-information" role="tab" aria-controls="information" aria-selected="false"><i class="fa fa-address-card" aria-hidden="false"></i> Personal Information</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="qualification-tab" href="my-ac-qualification" role="tab" aria-controls="qualification" aria-selected="false"><i class="fa fa-certificate" aria-hidden="true"></i> Qualification</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="uploadphoto-tab" href="my-ac-upload-photo" role="tab" aria-controls="uploadphoto" aria-selected="false"><i class="fa fa-camera" aria-hidden="true"></i> Upload Photo</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="joincourse-tab" href="my-ac-join-course" role="tab" aria-controls="joincourse" aria-selected="false" title="Add to purchase the course"><i class="fa fa-book" aria-hidden="true"></i> Join Course</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="changepassword-tab" href="my-ac-change-password" role="tab" aria-controls="changepassword" aria-selected="true"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="information" role="tabpanel" aria-labelledby="information-tab">
								<h5>Personal Information</h5>
															
								<div class="row">
									<div class="col-md-12">
										<div class="card frm-border">											
											<div class="card-content">
												<div class="card-body">

													<div class="col-md-12 form-section">
													  <?php
													  		$formstat = "disabled" ;
															if(isset($_GET['mode']) && $_GET['mode'] == "edit"){
																$formstat = "";
															}
															
															if (isset($_POST['submit'])){ 
																$username = trim($_POST['TXLEARNNAME']);
																$addres = trim($_POST['TXLEARNADDRESS']);
																$postcode =  trim($_POST['TXLEARNPOSTCODE']);
																$country = trim($_POST['CBLEARNCOUNTRY']);
																$tele = trim($_POST['TXLEARNTELEPHONE']);
																$mobile = trim($_POST['TXLEARNMOBILE']);
																$bddate = trim($_POST['CBBIRTHDAY']);
																if ($_POST['CBLEARNETHENTICITY'] == "Other"){
																	$eth = $_POST['TXLEARNETHENTICITY'];
																}else{
																	$eth = trim($_POST['CBLEARNETHENTICITY']);
																}
																$gender = $_POST['RBLEARNSEX'];
																
																$sqlupdate = "update cpo_usermaster set vUserName='".$username."',vUserAddress='".$addres."',vUserPostCode='".$postcode."',";
																$sqlupdate .= "vUserCountry='".$country."',vUserPhone='".$tele."',vUserMobile='".$mobile."',dUserBirthDate='".$bddate."',";
																$sqlupdate .= "vUserEthenticity='".$eth."',iUserGender=".$gender." where iUserId=".$_SESSION['user_id'];
																$tst = runquery1($sqlupdate);
																//echo $sqlupdate;
																$_SESSION['user_name'] = $username;
																addlog(2);
																echo "<div class='lfm alert alert-success'>$tst - Your Personal Information has been updated successfully.</div>";
															}

															$sqledit = "select vUserName,vUserEmailId,vUserAddress,vUserPostCode,vUserCountry,vUserPhone,vUserMobile,dUserBirthDate,vUserEthenticity,iUserGender,I_schoolyear,I_schoolid,V_schoolclass  from cpo_usermaster where iUserId=".$_SESSION['user_id'];
															$rsedit = runquery1($sqledit);
															$num = $rsedit ? mysqli_num_rows($rsedit) : 0 ;
															if ($num > 0)
															{
																$rsdata = mysqli_fetch_array($rsedit);
																$school = ""; $cntselected = "0"; $ethselected = "0";
																if($rsdata["I_schoolid"] != ""){
																	$sql_scl = "select * from  cpo_school where I_schoolid =".$rsdata['I_schoolid'];
																	$res_scl = runquery1($sql_scl);
																	$fet_scl = mysqli_fetch_array($res_scl);
																	$school = $fet_scl["I_schoolname"];
																}
																if($rsdata["vUserCountry"] !== "" && $rsdata["vUserCountry"] !== "0"){
																	$cntselected = $rsdata["vUserCountry"];
																}
																if($rsdata["vUserEthenticity"] !== "" && $rsdata["vUserEthenticity"] !== "0"){
																	$ethselected = $rsdata["vUserEthenticity"];
																}
														  ?>
														  <p class="form-subtitle" style="display:<?php if(!isset($_GET['mode'])){echo "none";} ?>">You must fill in any box that has a red asterisk (*) by it.</p>
														  <form name="frmpersonal" id="frmpersonal" method="post" action="my-ac-personal-information">
															<div class="row">
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="uname">User Name*</label>
																	  <input type="text" class="form-control" id="uname" name="TXLEARNNAME" value="<?php echo $rsdata['vUserName']; ?>" required>				  
																	</fieldset>
																</div>
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="emailid">E-Mail Address*</label>
																	  <input type="email" class="form-control" id="emailid" name="TXEMAILID" value="<?php echo $rsdata['vUserEmailId']; ?>" disabled>
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="telephone">Telephone</label>
																	  <input type="tel" class="form-control" id="telephone" name="TXLEARNTELEPHONE" value="<?php echo $rsdata['vUserPhone']; ?>" maxlength="12" size="20">	  
																	</fieldset>
																</div>
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="mobile">Mobile</label>
																	  <input type="tel" class="form-control" id="mobile" name="TXLEARNMOBILE" value="<?php echo $rsdata['vUserMobile']; ?>" maxlength="12" size="20">				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="uname" style="padding-right: 10px; display:block;">Gender: </label>
																	  <div class="form-check form-check-inline">
																		 <input class="form-check-input" type="radio" name="RBLEARNSEX" value="Male" id="inlineRadio1" <?php if ($rsdata['iUserGender'] == 1) { echo "checked" ; }?>>
																		 <label class="form-check-label" for="inlineRadio1">Male</label>
																	  </div>
																	  <div class="form-check form-check-inline">
																		 <input class="form-check-input" type="radio" name="RBLEARNSEX" value="Female" id="inlineRadio2" <?php if ($rsdata['iUserGender'] == 0) { echo "checked" ; }?>>
																		 <label class="form-check-label" for="inlineRadio2">Female</label>
																	  </div>				  
																	</fieldset>
																</div>
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="uname" style="padding-right: 10px; display:block;">Date of Birth</label>
																	  <input type="date" class="form-control " id="birthdate" name="CBBIRTHDAY" value="<?php echo $rsdata['dUserBirthDate']; ?>">				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="address" style="padding-right: 10px; display:block;">Address </label>
																	  <input type="text" class="form-control " id="address" name="TXLEARNADDRESS" value="<?php echo $rsdata['vUserAddress']; ?>" required>				  
																	</fieldset>
																</div>
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="pincode" style="padding-right: 10px; display:block;">Pincode*</label>
																	  <input type="text" class="form-control " id="pincode" name="TXLEARNPOSTCODE" value="<?php echo $rsdata['vUserPostCode']; ?>" required>				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="FormControlSelect1">Country*</label>				  
																	  <select class="form-control" id="FormControlSelect1" name="CBLEARNCOUNTRY" onchange="getOthers()" required>
																		<option value="0" disabled <?php if($cntselected == "0"){echo "selected"; }?>>Select Country</option>
																		 <?php
																			$countries = array("ANTIGUA", "ARGENTINA", "ARMENIA", "AUSTRALIA", "AUSTRIA", "BARBADOS", "BERMUDA", "BOTSWANA", "BRAZIL", "BRITISHCOLUMBIA", "CALIFORNIA-NORTH", "CALIFORNIA-SOUTH", "CAMBODIA", "CANADA", "CAYMANISLANDS", "CHILE", "CHINA-BEIJING", "CHINA-HONGKONG", "CHINA", "COLOMBIA", "COLORADO", "CONNECTICUT", "CROATIA", "CYPRUS", "CZECHREPUBLIC", "DAKOTAS", "DELAWARE", "DENMARK", "DIST.COLUMBIA", "DOMINICANREPUBLIC", "ECUADOR", "EGYPT", "ENGLAND/WALES", "ESTONIA", "FLORIDA", "FRANCE", "GEORGIA", "GERMANY", "GHANA", "GRENADA", "GRENADINES", "GUATEMALA", "GUYANA", "HAITI", "HUNGARY", "ICELAND", "ILLINOIS", "INDIA", "INDIANA", "INDONESIA", "IRAN", "ISRAEL", "ITALY", "JAPAN", "JORDAN", "KENTUCKY", "KOREA-SOUTH", "LAOS", "LEBANON", "LITHUANIA", "LUXEMBOURG", "MALAYSIA", "MALTA", "MEXICO", "NEPAL", "NETHERLANDS", "NEVADA", "NEWSOUTHWALES", "NEWYORK/NEWJERSEY", "NEWZEALAND", "NIGERIA", "NORTHCAROLINA", "NORTHERNIRELAND", "NORWAY", "OHIO", "OKLAHOMA", "ONTARIO", "OREGON", "PAKISTAN", "PALESTINE", "PENNSYLVANIA", "PHILIPPINES", "PORTUGAL", "PUERTORICO", "QATAR", "QUEBEC", "QUEENSLAND", "REPUBLICOFIRELAND", "ROMANIA", "RUSSIA", "SAUDIARABIA", "SCOTLAND", "SERBIA", "SINGAPORE", "SLOVENIA", "SOUTHAFRICA", "SOUTHCAROLINA", "SPAIN", "SRILANKA", "STLUCIA", "STVINCENT", "SWEDEN", "SWITZERLAND", "TAIWAN", "TANZANIA", "TENNESSEE", "TESTCOUNTRY", "TEXAS", "THAILAND", "TUNISIA", "TURKEY", "UGANDA", "UK-NORTHERNIRELAND", "UK-SCOTLAND", "UK", "UKRAINE", "UNITEDARABEMIRATES", "URUGUAY", "UTAH", "UZBEKISTAN", "VIETNAM", "VIRGINIA", "WASHINGTONSTATE", "WESTVIRGINIA", "WISCONSIN");
																			foreach($countries as $cnt){
																				$citem = "";
																				if($cntselected == $cnt){
																					$citem = "selected"; 
																				}
																				echo"<option value='$cnt' $citem>$cnt</option>";
																			}
																		 ?>
																	  </select>				  
																	</fieldset>
																</div>
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="FormControlSelect1">Ethnicity* - <?php echo $ethselected; ?></label>
																	  <select class="form-control" id="FormControlSelect2" name="CBLEARNETHENTICITY">
																		<option disabled <?php if($ethselected == "0"){echo "selected"; }?>>Select Ethnicity</option>
																		<?php
																			$ethincity = array("African", "African Caribbean", "Asian", "Black British", "Chinese", "White European", "Other");
																			foreach($ethincity as $eth){
																				$citem = "";
																				if($ethselected == $eth){
																					$citem = "selected"; 
																				}
																				echo"<option value='$eth' $citem>$eth</option>";
																			}
																		 ?>
																	  </select>				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="FormControlSelect1">School</label>
																	  <input type="text" class="form-control" id="school" name="TXLEARNSCHOOL" value="<?php echo $school; ?>">
																	</fieldset>
																</div>
																<div class="col-md-6">
																	  <label for="FormControlSelect1">Year</label>
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <input type="text" class="form-control" id="year" name="TXLEARNYEAR" value="<?php echo $rsdata['I_schoolyear']; ?>">
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<fieldset class="form-group" <?php echo $formstat; ?>>
																	  <label for="class">Class</label>
																	  <input type="text" class="form-control" id="class" name="TXLEARNCLASS" value="<?php echo $rsdata['V_schoolclass']; ?>">
																	</fieldset>
																</div>
																<div class="col-md-6 text-right">
																<?php																	
																	if($formstat == "disabled"){
																		echo "<a href='my-ac-personal-information?mode=edit' class='btn btn-primary mt-4'><i class='fa fa-pencil-square-o'></i> Edit Details</a>";
																	}else{
																		echo "<button type='submit' name='submit' class='btn btn-primary mt-4'><i class='fa fa-check-square'></i> Update</button>";
																	}																
																?>
																</div>
															</div>
														  </form>
														  <?php
															}
														  ?>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>							
                    </div>
                </section>
            </div>
			<?php include "footer.php"; ?>
        </div>
    </div>
</body>

</html>