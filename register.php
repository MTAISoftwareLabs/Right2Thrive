<?php
ob_start();
require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/career_progress_lib.php';
require_once __DIR__ . '/onboarding_lib.php';
require_once __DIR__ . '/registration_questionnaire_lib.php';

$regQuestionnaireSettings = null;
$regSetup = registration_questionnaire_ensure_schema($conn);
if ($regSetup['ok']) {
    $regQuestionnaireSettings = registration_questionnaire_settings($conn);
}
$resumeUserId = (int) ($_SESSION['onboarding_resume_user_id'] ?? 0);
$resumeMode = $resumeUserId > 0 && (isset($_GET['resume_questionnaire']) || (isset($_GET['next']) && isset($_POST['resume_user_id'])));

if (isset($_POST['finish_reg']) && isset($_GET['next'])) {
   if (!empty($_POST['resume_user_id'])) {
       $resumeUserId = (int) $_POST['resume_user_id'];
       $resumeMode = $resumeUserId > 0;
   }
   if ($resumeMode) {
       if (empty($_POST['chkterm_cond'])) {
           $er = 'You must accept the terms and conditions.';
       } else {
           $result = onboarding_finish_existing_learner_questionnaire($conn, $resumeUserId, $_POST);
           if ($result['ok']) {
               unset($_SESSION['onboarding_resume_user_id']);
               $_SESSION['registration_email_sent'] = $result['email_sent'];
               $_SESSION['registration_email_note'] = $result['email_note'];
               if (ob_get_level() > 0) {
                   ob_end_clean();
               }
               header('Location: registration_complete.php?existing=1');
               exit;
           }
           $er = $result['error'] !== '' ? $result['error'] : 'Could not save your questionnaire.';
       }
   } else {
   $pending = isset($_SESSION['reg_pending']) && is_array($_SESSION['reg_pending']) ? $_SESSION['reg_pending'] : null;
   if (!$pending) {
       $er = 'Your session expired. Please start registration again from step one.';
   } elseif (empty($_POST['chkterm_cond'])) {
       $er = 'You must accept the terms and conditions.';
   } else {
       $result = onboarding_complete_registration($conn, $pending, $_POST);
       if ($result['ok']) {
           unset($_SESSION['reg_pending']);
           $_SESSION['registration_email_sent'] = $result['email_sent'];
           $_SESSION['registration_email_note'] = $result['email_note'];
           $linkKey = 'verification_link_' . $result['user_id'];
           if (!$result['email_sent'] && !empty($_SESSION[$linkKey])) {
               $_SESSION['registration_verify_link'] = $_SESSION[$linkKey];
               unset($_SESSION[$linkKey]);
           }
           if (ob_get_level() > 0) {
               ob_end_clean();
           }
           header('Location: registration_complete.php');
           exit;
       }
       $er = $result['error'] !== '' ? $result['error'] : 'Registration could not be completed.';
   }
   }
}

if (isset($_POST['submit']) && !isset($_GET['next'])){ 
   $abc = 0;
   $TXusername = isset($_POST['TXusername']) ? $_POST['TXusername'] : '';
   $CBOcountry = isset($_POST['CBOcountry']) ? $_POST['CBOcountry'] : '';
   $TXtelephone = isset($_POST['TXtelephone']) ? $_POST['TXtelephone'] : '';
   $TXmobile = isset($_POST['TXmobile']) ? $_POST['TXmobile'] : '';
   $TXemailid = isset($_POST['TXemailid']) ? trim($_POST['TXemailid']) : '';
   $TXpwd = isset($_POST['TXpwd']) ? $_POST['TXpwd'] : '';
   $TXconfirm_pwd = isset($_POST['TXconfirm_pwd']) ? $_POST['TXconfirm_pwd'] : '';
   $date = isset($_POST['TXbdate']) ? $_POST['TXbdate'] : '';
   $TXethnicity = isset($_POST['CBOethnicity']) ? $_POST['CBOethnicity'] : '';
   $rnde = isset($_POST['rnd']) ? $_POST['rnd'] : 'Male';
   $total = isset($_POST['total']) ? (string) $_POST['total'] : '';
   $capcha = isset($_POST['capcha']) ? (string) $_POST['capcha'] : '';
   if ($TXemailid != ''){
	   $result5 = runquery("SELECT * FROM cpo_usermaster WHERE vUserEmailId='$TXemailid'");
	   if (mysqli_num_rows($result5) > 0)
	   {
		   $er = "Email Already Exist In Our Database";
		   $abc = 5;
	   }
   }if ($capcha != $total){
	   $er = "Capcha code is invalid";
   }if ($TXpwd != $TXconfirm_pwd){
	   $er = "Password Doesn't Match";
   }if ($capcha == $total && $TXpwd == $TXconfirm_pwd && $abc != 5){
       $_SESSION['reg_pending'] = array(
           'TXusername' => $TXusername,
           'CBOcountry' => $CBOcountry,
           'TXtelephone' => $TXtelephone,
           'TXmobile' => $TXmobile,
           'TXemailid' => $TXemailid,
           'TXpwd' => $TXpwd,
           'TXbdate' => $date,
           'TXethnicity' => $TXethnicity,
           'rnd' => $rnde,
       );
       if (ob_get_level() > 0) {
           ob_end_clean();
       }
       header('Location: register.php?next=1');
       exit;
   }   
}

if ($resumeMode && !isset($_GET['next'])) {
    if (ob_get_level() > 0) {
        ob_end_clean();
    }
    header('Location: register.php?next=1&resume_questionnaire=1');
    exit;
}
$bodyOnLoad = !isset($_GET['next']) ? 'distext();' : 'winfocus1();';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Sign Up<?php echo sitename; ?></title>
  <?php include "metadata.php"; ?>
</head>
<body onload="<?php echo htmlspecialchars($bodyOnLoad, ENT_QUOTES, 'UTF-8'); ?>">
<div class="container">
	<header>
		<div class="row">
			<div class="col-md-12">
				<h1 class="pagetitle text-center">Welcome to <span class="hub-wordmark">Right2Thrive</span> UK</h1>
			</div>
		</div>
	</header>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="row form-card">
				<div class="col-md-12 form-card-head"><h2>Sign Up</h2></div>
				<div class="col-md-12 form-section">
					  <?php
						if(isset($_GET['msg'])){
							if($_GET['msg'] == 'incorrectcode'){
								echo"<div class='lfm alert alert-warning'>Capcha code is incorrect.</div>";
							}							
						}if(isset($_GET['next'])){
					  ?>
					  					  <?php if ($resumeMode): ?>
					  <h4 class="form-title"><?php echo htmlspecialchars((string) ($regQuestionnaireSettings['form_title'] ?? 'Complete your sign-up questionnaire'), ENT_QUOTES, 'UTF-8'); ?></h4>
					  <p class="form-subtitle"><?php echo htmlspecialchars((string) ($regQuestionnaireSettings['form_subtitle'] ?? 'You already have an account. Please answer the questions below, then verify your email.'), ENT_QUOTES, 'UTF-8'); ?></p>
					  <?php else: ?>
					  <h4 class="form-title"><?php echo htmlspecialchars((string) ($regQuestionnaireSettings['form_title'] ?? 'Register as Learner or Parent ?'), ENT_QUOTES, 'UTF-8'); ?></h4>
					  <p class="form-subtitle"><?php echo htmlspecialchars((string) ($regQuestionnaireSettings['form_subtitle'] ?? 'You must fill in any box that has a red asterisk (*) by it.'), ENT_QUOTES, 'UTF-8'); ?></p>
					  <?php endif; ?>
					  <?php
					    if(isset($er)){
					        echo "<div class='lfm alert alert-warning'>" . htmlspecialchars((string) $er, ENT_QUOTES, 'UTF-8') . "</div>";
					    }
					  ?>
					  <?php if (!$resumeMode && empty($_SESSION['reg_pending'])): ?>
					  <div class="alert alert-warning">Please complete your personal details first.</div>
					  <p><a href="register.php">Back to step 1</a> · <a href="complete_registration.php">Existing account?</a></p>
					  <?php elseif ($resumeMode || !empty($_SESSION['reg_pending'])): ?>
					  <form name="frmqua" id="frmqua" method="post" action="register.php?next=1<?php echo $resumeMode ? '&amp;resume_questionnaire=1' : ''; ?>">
					  	<input type="hidden" name="finish_reg" value="1" />
					  	<?php if ($resumeMode) { ?><input type="hidden" name="resume_user_id" value="<?php echo (int) $resumeUserId; ?>" /><?php } ?>

					  	<?php echo registration_questionnaire_render_form_html($conn); ?>

					  	<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<div class="form-check" style="margin-top: 13px;">
									  <label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="chkterm_cond" style="width: 20px; height: 20px;">
										<a href="#" onclick="termswin();" style="line-height: 27px; margin-left: 10px;"> I agree terms and conditions.</a>
										<div id="ethnicity"><input type="hidden" name="test" value="" /></div>
									  </label>
									</div>
								</div>
							</div>
							<div class="col-md-4 text-right"><div name="regvalidation" class="btn btn-primary" onclick="validation_qua();"><i class="fa fa-check-square"></i> Finish</div></div>
						</div>
					  </form>
					  <?php endif; ?>
					  <?php
						}else{
					  ?>					  
					  <h4 class="form-title">Enter Your Personal Information</h4>
					  <p class="form-subtitle">You must fill in any box that has a red asterisk (*) by it.</p>
					  <?php
					    if(isset($er)){
					        echo "<div class='lfm alert alert-warning'>$er</div>";
					    }
					  ?>
					  <form name="frmpersonal" id="frmpersonal" method="post">
					  	<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <input type="text" class="form-control" id="uname" placeholder="Enter Your Name*" name="TXusername" required>				  
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <input type="email" class="form-control" id="emailid" placeholder="Enter Your E-Mail*" name="TXemailid" required>				  
								</div>
							</div>
						</div>
					  	<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <input type="tel" class="form-control" id="telephone" placeholder="Telephone*" name="TXtelephone" maxlength="12" size="20" required>				  
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <input type="tel" class="form-control" id="mobile" placeholder="Mobile" name="TXmobile" maxlength="12" size="20">				  
								</div>
							</div>
						</div>
					  	<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <label for="uname" style="padding-right: 10px; display:block;">Gender: </label>
								  <div class="form-check form-check-inline">
									 <input class="form-check-input" type="radio" name="rnd" value="Male" id="inlineRadio1" checked>
									 <label class="form-check-label" for="inlineRadio1">Male</label>
								  </div>
								  <div class="form-check form-check-inline">
									 <input class="form-check-input" type="radio" name="rnd" value="Female" id="inlineRadio2">
									 <label class="form-check-label" for="inlineRadio2">Female</label>
								  </div>				  
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="uname" style="padding-right: 10px; display:block;">Date of Birth</label>
								  <input type="date" class="form-control " id="birthdate" name="TXbdate" required>				  
								</div>
							</div>
						</div>
					  	<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <select class="form-control" id="FormControlSelect2" name="CBOethnicity">
									<option disabled selected>Employment Status*</option>
									<option>Employed</option>
									<option>Unemployed</option>
								  </select>				  
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">					  
								  <select class="form-control" id="FormControlSelect1" name="CBOcountry" onchange="getOthers()" required>
									<option value="0" disabled selected>Select Country*</option>
									 <?php
										$countries = array("ANTIGUA", "ARGENTINA", "ARMENIA", "AUSTRALIA", "AUSTRIA", "BARBADOS", "BERMUDA", "BOTSWANA", "BRAZIL", "BRITISHCOLUMBIA", "CALIFORNIA-NORTH", "CALIFORNIA-SOUTH", "CAMBODIA", "CANADA", "CAYMANISLANDS", "CHILE", "CHINA-BEIJING", "CHINA-HONGKONG", "CHINA", "COLOMBIA", "COLORADO", "CONNECTICUT", "CROATIA", "CYPRUS", "CZECHREPUBLIC", "DAKOTAS", "DELAWARE", "DENMARK", "DIST.COLUMBIA", "DOMINICANREPUBLIC", "ECUADOR", "EGYPT", "ENGLAND/WALES", "ESTONIA", "FLORIDA", "FRANCE", "GEORGIA", "GERMANY", "GHANA", "GRENADA", "GRENADINES", "GUATEMALA", "GUYANA", "HAITI", "HUNGARY", "ICELAND", "ILLINOIS", "INDIA", "INDIANA", "INDONESIA", "IRAN", "ISRAEL", "ITALY", "JAPAN", "JORDAN", "KENTUCKY", "KOREA-SOUTH", "LAOS", "LEBANON", "LITHUANIA", "LUXEMBOURG", "MALAYSIA", "MALTA", "MEXICO", "NEPAL", "NETHERLANDS", "NEVADA", "NEWSOUTHWALES", "NEWYORK/NEWJERSEY", "NEWZEALAND", "NIGERIA", "NORTHCAROLINA", "NORTHERNIRELAND", "NORWAY", "OHIO", "OKLAHOMA", "ONTARIO", "OREGON", "PAKISTAN", "PALESTINE", "PENNSYLVANIA", "PHILIPPINES", "PORTUGAL", "PUERTORICO", "QATAR", "QUEBEC", "QUEENSLAND", "REPUBLICOFIRELAND", "ROMANIA", "RUSSIA", "SAUDIARABIA", "SCOTLAND", "SERBIA", "SINGAPORE", "SLOVENIA", "SOUTHAFRICA", "SOUTHCAROLINA", "SPAIN", "SRILANKA", "STLUCIA", "STVINCENT", "SWEDEN", "SWITZERLAND", "TAIWAN", "TANZANIA", "TENNESSEE", "TESTCOUNTRY", "TEXAS", "THAILAND", "TUNISIA", "TURKEY", "UGANDA", "UK-NORTHERNIRELAND", "UK-SCOTLAND", "UK", "UKRAINE", "UNITEDARABEMIRATES", "URUGUAY", "UTAH", "UZBEKISTAN", "VIETNAM", "VIRGINIA", "WASHINGTONSTATE", "WESTVIRGINIA", "WISCONSIN");
										foreach($countries as $cnt){
											echo"<option value='$cnt'>$cnt</option>";
										}
									 ?>
								  </select>				  
								</div>
							</div>
						</div>
					  	<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <input type="password" class="form-control" id="pwd" placeholder="Create password*" name="TXpwd" size="16" maxlength="16" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <input type="password" class="form-control" id="cpwd" placeholder="Confirm password*" name="TXconfirm_pwd" size="16" maxlength="16" required>
								</div>
							</div>
						</div>
					  	<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <label for="pwd" style="padding-right: 10px; display:block;">Capcha: <strong><?php $num1=rand(0,9); $num2=rand(0,9); echo $num1." + ".$num2." = "; ?></strong></label>
								  <input type="hidden" name="total" value="<?php echo $num1+$num2; ?>" />
								  <input type="number" class="form-control" id="capcha" placeholder="Capcha Answer*" name="capcha" required>
								</div>
							</div>
							<div class="col-md-6 text-right"><button type="submit" name="submit" class="btn btn-primary" style="margin-top:30px;"><i class="fa fa-check-square"></i> Submit</button></div>
						</div>
					  </form>
					  <div class="space35"></div>
					  <div class="text-right">
						  <a href="user_login">I am already a member.</a><br/>
					  </div>
					  <?php
						}
					  ?>
					  <div class="space35"></div>
				</div>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
	<footer>
		<?php include "footer.php"; //Add or update footer information and javascript files here ?>
	</footer>
</div>

<script language="JavaScript" src="assets/script/functions.js"></script>
<script language="JavaScript" type="text/JavaScript">
	function userid_avalilibilty(){
		var x = document.frmpersonal.TXemailid.value;
		var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(x)){
			alert("Enter a valid E-mail address!");
			document.frmpersonal.TXemailid.value="";
			document.frmpersonal.TXemailid.focus();
			return false;
		}
		new1=window.open("userid_availability?userid="+document.frmpersonal.TXemailid.value,"",'height=200,width=400,scrollbars=yes,top=50 left=150');
		return true;
	}

	function termswin(){
		new1=window.open("learning_agreement","",'height=550,width=650,scrollbars=yes,top=150 left=150');
		return true;
	}

	function backpersonal(){
		document.frmqua.action="register?back1=yes";
		document.frmqua.submit();
		return true;
	}

	function validation(){
		if(document.frmpersonal.TXusername.value==""){
			alert("Please Enter Name!");
			document.frmpersonal.TXusername.focus();
			return false;
		}
		if(document.frmpersonal.TXpostcode.value==""){
			alert("Please Enter PostCode.!");
			document.frmpersonal.TXpostcode.focus();
			return false;
		}
		if(document.frmpersonal.CBOcountry.value==0){
			alert("Please Select country.!");
			document.frmpersonal.CBOcountry.focus();
			return false;
		}
		if(document.frmpersonal.TXtelephone.value==0){
			alert("Please Enter telephone.!");
			document.frmpersonal.TXtelephone.focus();
			return false;
		}
		if (document.frmpersonal.TXtelephone.value != ""){
			if (!checknum(document.frmpersonal.TXtelephone)){
				alert("Characters are not allowed in Phone No");
				document.frmpersonal.TXtelephone.focus();
				return false;
			}
		}
		if (document.frmpersonal.TXmobile.value != ""){
			if (!checknum(document.frmpersonal.TXmobile)){
				alert("Characters are not allowed in Mobile");
				document.frmpersonal.TXmobile.focus();
				return false;
			}
		}

		var x = document.frmpersonal.TXemailid.value;
		var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(x)){
			alert("Enter a valid E-mail address!");
			document.frmpersonal.TXemailid.value="";
			document.frmpersonal.TXemailid.focus();
			return false;
		}
		if(document.frmpersonal.TXpwd.value==""){
			alert("Please Enter Password!");
			document.frmpersonal.TXpwd.focus();
			return false;
		}
		if(document.frmpersonal.TXpwd.value.length<4){
			alert("Password must be more than 4 character!");
			document.frmpersonal.TXpwd.focus();
			return false;
		}
		if(document.frmpersonal.TXpwd.value.length>16){
			alert("Password not more than 16 character!");
			document.frmpersonal.TXpwd.focus();
			return false;
		}
		if(document.frmpersonal.TXconfirm_pwd.value==""){
			alert("Please Enter Confirm Password!");
			document.frmpersonal.TXconfirm_pwd.focus();
			return false;
		}
		if(document.frmpersonal.TXconfirm_pwd.value.length<4){
			alert("Password must be more than 4 character!");
			document.frmpersonal.TXconfirm_pwd.focus();
			return false;
		}
		if(document.frmpersonal.TXconfirm_pwd.value.length>16){
			alert("Password not more than 16 character");
			document.frmpersonal.TXconfirm_pwd.focus();
			return false;
		}
		if(document.frmpersonal.TXpwd.value!=document.frmpersonal.TXconfirm_pwd.value){
			alert("Both Password Must be same!");
			document.frmpersonal.TXpwd.value="";
			document.frmpersonal.TXconfirm_pwd.value="";
			document.frmpersonal.TXpwd.focus();
			return false;
		}
		if(document.frmpersonal.CBOethnicity.value==0){
			alert("Please select Employment.!");
			document.frmpersonal.CBOethnicity.focus();
			return false;
		}

		document.frmpersonal.action="courses?valid=yes";
		document.frmpersonal.submit();
		return true;
	}

	function validation_qua(){
		if(!document.frmqua.chkterm_cond.checked){
			alert("First Select Terms and Conditions!");
			return false;
		}
		if (document.frmqua.rnddis[0].checked == true){
			if (document.frmqua.TXdisability.value == ""){
				alert("Please enter disibility reason");
				document.frmqua.TXdisability.focus();
				return false;
			}
		}
		document.frmqua.action="register.php?next=1";
		document.frmqua.submit();
	}

	function getOthers(){
		if(document.frmpersonal.CBOethnicity.value=="Other"){
			document.getElementById("ethnicity").style.display='block';
		}else{
			document.getElementById("ethnicity").style.display='none';
		}
	}

	function distext(){
		winfocus();
		document.getElementById("ethnicity").style.display='none';
	}

	function getdisable(obj){
		if(obj.value == 1){
			document.getElementById(1).disabled=false;
		}
		else{
			document.getElementById(1).value="";
			document.getElementById(1).disabled=true;
		}
	}

	function winfocus(){
		document.frmpersonal.TXusername.focus();
	}

	function winfocus1(){
		document.frmqua.TXqua_achieved.focus();
	}
</script>
</body>
</html>