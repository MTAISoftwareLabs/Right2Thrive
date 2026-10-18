<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/dbConnection.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

$mail = new PHPMailer(true);
   ob_start();   
   if (isset($_POST['submit'])){ 
       $TXusername = $_POST['TXusername'];
       //$TXaddress= $_POST['TXaddress'];
       //$TXpostcode= $_POST['TXpostcode'];
       $CBOcountry = $_POST['CBOcountry'];
       $TXtelephone = $_POST['TXtelephone'];
       $TXmobile = $_POST['TXmobile'];
       $TXemailid = $_POST['TXemailid'];
       $TXpwd = $_POST['TXpwd'];
       $TXconfirm_pwd = $_POST['TXconfirm_pwd'];
       $date = $_POST['TXbdate'];
       $TXethnicity = $_POST['CBOethnicity'];
       $rnde = $_POST['rnd'];
       $total = $_POST['total'];
       $capcha = $_POST['capcha'];
       $random = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1, 25))) , 1, 25); 
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
           $sql = runquery("INSERT INTO cpo_usermaster (vUserName,vUserPassword,vUserCountry,vUserMobile,vUserPhone,vUserEmailId,dUserBirthDate,vUserEthenticity,iUserGender,iUserType,random)VALUES ('$TXusername','$TXpwd','$CBOcountry','$TXmobile','$TXtelephone','$TXemailid','$date','$TXethnicity','$rnde','2','$random')");
           mysqli_error($conn);
          
          
          
          try {
	$smtp = app_smtp_config();
	$mail->isSMTP();
	$mail->Host = $smtp['host'];
	$mail->SMTPAuth = true;
	$mail->Username = $smtp['username'];
	$mail->Password = $smtp['password'];
	$mail->SMTPSecure = $smtp['encryption'];
	$mail->Port = $smtp['port'];
	$mail->setFrom($smtp['from_email'], $smtp['from_name']);

    // Send to user
    $mail->addAddress($TXemailid);                              // Add a recipient
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = 'Verify CareerPathOnline Registration';
    $mail->Body    = "<p>Thank you for your registration, We will notify you shortly how to login to your MY DiGITAL FUTURE Portfolio!</p>";
    $mail->send();
    $mail->clearAddresses();

    // Send to admin
    $mail->addAddress('	cleeown@yahoo.co.uk');              // Add a recipient
    $mail->Subject = 'New Registration on CareerPathOnline';
    $mail->Body    = "
        <h4>New Registration Detail</h4>
        <table id='tab'>
            <tr><td>Name</td><td>{$TXusername}</td></tr>
            <tr><td>Address</td><td>{$TXaddress}</td></tr>
            <tr><td>Postcode</td><td>{$TXpostcode}</td></tr>
            <tr><td>Country</td><td>{$CBOcountry}</td></tr>
            <tr><td>Telephone & Mobile</td><td>{$TXtelephone}, {$TXmobile}</td></tr>
            <tr><td>E-mail address</td><td>{$TXemailid}</td></tr>
            <tr><td>Date of Birth</td><td>{$date}</td></tr>
            <tr><td>Employment</td><td>{$TXethnicity}</td></tr>
            <tr><td>Sex</td><td>{$rnde}</td></tr>
        </table>
        <style>#tab td { padding: 10px !important; }</style>";
    $mail->send();

    echo "<h2 style= 'text-align: center;'>Registration has been success. Check your email. </h2>";

} catch (Exception $e) {
    echo "Messages could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
	   
          
           
       }   
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CareerPaths Online :: User Login</title>
  <link rel="shortcut icon" href="logo.gif" type="image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
  <script language="JavaScript" src="functions.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="mystyle.css">
</head>
<?php if (!isset($_GET['next'])) { ?>
	<body onLoad="distext();">
<?php } else { ?>
	<body onLoad="winfocus1();">
<?php } ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="pagetitle text-center">21K Creative Academy</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="row form-card">
				<div class="col-md-12 form-card-head"><h2>Sign Up</h2></div>
				<div class="col-md-12 form-section">
					  <?php
						if($_GET['msg'] == 'incorrectcode'){
							echo"<div class='lfm alert alert-warning'>Capcha code is incorrect.</div>";
						}if(isset($_GET['next'])){
					  ?>
					  <h4 class="form-title">Register as Learner or Parent ?</h4>
					  <p class="form-subtitle">You must fill in any box that has a red asterisk (*) by it.</p>
					  <?php
					    if(isset($er)){
					        echo "<div class='lfm alert alert-warning'>$er</div>";
					    }
					  ?>
					  <form name="frmqua" id="frmqua" method="post">
					  	<input type="hidden" name="hTXusername" value="<? echo trim($HTTP_POST_VARS['TXusername']) ?>" />
						<input type="hidden" name="hCBOcountry" value="<? echo trim($HTTP_POST_VARS['CBOcountry']) ?>" />
						<input type="hidden" name="hTXtelephone" value="<? echo trim($HTTP_POST_VARS['TXtelephone']) ?>" />
						<input type="hidden" name="hTXmobile" value="<? echo trim($HTTP_POST_VARS['TXmobile']) ?>" />
						<input type="hidden" name="hTXemailid" value="<? echo trim($HTTP_POST_VARS['TXemailid']) ?>" />
						<input type="hidden" name="hTXpwd" value="<? echo trim($HTTP_POST_VARS['TXpwd']) ?>" />
						<input type="hidden" name="hTXconfirm_pwd" value="<? echo trim($HTTP_POST_VARS['TXconfirm_pwd']) ?>" />
						<input type="hidden" name="hTXbdate" value="<? echo trim($HTTP_POST_VARS['TXbdate']) ?>" />
						<? 
						if (trim($HTTP_POST_VARS['CBOethnicity']) == "Other"){
							echo "<input type='hidden' name='hTXethnicity' value='".trim($HTTP_POST_VARS['TXethnicity'])."' />";
						}else{
						    echo "<input type='hidden' name='hTXethnicity' value='".trim($HTTP_POST_VARS['CBOethnicity'])."' />";
						}						   
						?>
						<input type="hidden" name="hrnd" value="<? echo $HTTP_POST_VARS['rnd'] ?>" />

					  	<div class="row">
							<div class="col-md-5">
								<div class="form-group">
								  <label for="uname" style="padding-right: 10px; display:block;">Are you in work?</label>
								  <div class="form-check form-check-inline">
									 <input class="form-check-input" type="radio" name="rnde" value="1" id="rnde1" checked="checked">
									 <label class="form-check-label" for="rnde1">Yes</label>
								  </div>
								  <div class="form-check form-check-inline">
									 <input class="form-check-input" type="radio" name="rnde" value="0" id="rnde2">
									 <label class="form-check-label" for="rnde2">No</label>
								  </div>				  
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
								  <label for="achievedqual">What qualifications (if any) do you have?</label>
								  <textarea class="form-control" rows="3" id="achievedqual" name="TXqua_achieved"></textarea>
								</div>
							</div>
						</div>
					  	<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label for="yourjob">If yes, what is your job? OR If no, how long have you been out of work?</label>
								  <textarea class="form-control" rows="3" id="yourjob" name="TXlong_employed"></textarea>				  
								</div>
							</div>
						</div>
					  	<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label for="yourinterest">What career interests you?</label>
								  <textarea class="form-control" rows="3" id="yourinterest" name="TXcareer_ocuu"></textarea>				  
								</div>
							</div>
						</div>
					  	<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label for="gain-qul">What qualifications do you want to gain?</label>
								  <textarea class="form-control" rows="3" id="gain-qul" name="TXqua_likeachieved"></textarea>				  
								</div>
							</div>
						</div>
					  	<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <label for="skill">What skills do you have?</label>
								  <textarea class="form-control" rows="3" id="skill" name="TXskill_achieved"></textarea>				  
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="hobbies">What are your hobbies?</label>
								  <textarea class="form-control" rows="3" id="hobbies" name="TXhobbies"></textarea>				  
								</div>
							</div>
						</div>
					  	<div class="row">
							<div class="col-md-5">
								<div class="form-group">
								  <label for="uname" style="padding-right: 10px; display:block;">Do you have a disability?</label>
								  <div class="form-check form-check-inline">
									 <input class="form-check-input" type="radio" name="rnddis" value="1" onclick="getdisable(this)">
									 <label class="form-check-label" for="inlineRadio7">Yes</label>
								  </div>
								  <div class="form-check form-check-inline">
									 <input class="form-check-input" type="radio" name="rnddis" value="0" onclick="getdisable(this)" checked>
									 <label class="form-check-label" for="inlineRadio8">No</label>
								  </div>				  
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
								  <label for="1">If yes, please explain.</label>
								  <textarea class="form-control" rows="3" id="1" name="TXdisability" disabled="disabled"></textarea>
								</div>
							</div>
						</div>
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
						  <a href="user_login.php">I am already a member.</a><br/>
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
	<div class="row">
		<div class="col-md-12">
			<div class="copywrite text-center">
				<p><?php echo app_tutorapp_tms_copyright_line(); ?></p>
			</div>
		</div>
	</div>
</div>

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
		new1=window.open("userid_availability.php?userid="+document.frmpersonal.TXemailid.value,"",'height=200,width=400,scrollbars=yes,top=50 left=150');
		return true;
	}

	function termswin(){
		new1=window.open("learning_agreement.php","",'height=550,width=650,scrollbars=yes,top=150 left=150');
		return true;
	}

	function backpersonal(){
		document.frmqua.action="register.php?back1=yes";
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

		document.frmpersonal.action="courses.php?valid=yes";
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
		document.frmqua.action="courses.php?valid=yes";
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

<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-34503062-1']);
	_gaq.push(['_trackPageview']);

	(function () {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
</body>
</html>