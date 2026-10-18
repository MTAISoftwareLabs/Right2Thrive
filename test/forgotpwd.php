<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "dbConnection.php"; //Add or update globle site information like sitename, admin mail, database info ?>
  <title>Password Recovery<?php echo sitename; ?></title>
  <?php include "metadata.php"; //Add or update meta data and css files here ?>
</head>
<body>
<?php
$msg = ""; $form = "";
if(isset($_POST['TXEMAIL'])){
	$sql ="select * from cpo_usermaster where vUserEmailId='".$_POST['TXEMAIL']."'";
	$rsuser = runquery($sql);
	$num = $rsuser ? mysqli_num_rows($rsuser) : 0;
	if ($num > 0){
		$rslist=mysqli_fetch_array($rsuser);
		$fromname ="Administrator of CareerPaths Online";
		$fromaddress=admin_email;
		//$toname=$rslist['FirstName'].''.$rslist['LastName'];
		$toname=$rslist['vUserName'];
		$toaddress=$rslist['vUserEmailId'];
		$subject="Account information of CareerPaths Online";
		$message="<br><b>User Name : </b>".$rslist['vUserEmailId']."<br><b>Password : </b>".$rslist['vUserPassword']."<br><br>";
		$message.="<br><b>Warm Regard From </b>"."<br>";
		$message.="<b>CareerPaths Online Team </b>";
		$flgmail=SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
		if($flgmail){
			$msg = "Recovery mail sent to your email id.";
			$form = "hidden";
		}else{
			$msg = "Enable to sending mail on you email id, please connect with support team.";
			$form = "hidden";
		}			
	}else{ 
		$msg = "Please enter correct email id carefully!!";
	}
}
?>
<div class="container">
	<header>
		<div class="row">
			<div class="col-md-12">
				<h1 class="pagetitle text-center">My Digital Future</h1>
			</div>
		</div>
	</header>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="row form-card">
				<div class="col-md-12 form-card-head"><h2>Password Recovery</h2></div>
				<div class="col-md-12 desc-section">
					  <h5>Reset your password?</h5>
					  <?php
						if(!empty($msg)){
							$level = "warning";
							if($form == "hidden"){
								$level = "success";
							}
							echo"<div class='lfm alert alert-$level'>$msg</div>";
						}
					  ?>					  
					  <form action="forgotpwd" method="post" name="FRMPERSONAL" id="FRMPERSONAL" <?php if($form == "hidden"){echo"style='display:none;'";} ?>>
						<div class="form-group">
						  <label for="uname">Type your email address here and we will send you a reminder</label>
						  <input type="email" class="form-control" id="uname" placeholder="Enter register user email" name="TXEMAIL" required>				  
						</div>
						<button type="submit" class="btn btn-primary"><i class="fa fa-unlock-alt"></i> Submit</button>
					  </form>
					  <div class="space35"></div>
					  <div class="">
						  <a href="user_login">Back to login page.</a>
						  <a href="register" style="float:right;">Register new account.</a>
					  </div>
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
<script language="JavaScript" type="text/JavaScript">
	function MM_preloadImages() { //v3.0
	  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
		var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
		if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
	}
</script>
</body>
</html>
