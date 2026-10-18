<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Upload Photo<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

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
								<a class="nav-link" id="summery-tab" href="my-account" role="tab" aria-controls="summery" aria-selected="false"><i class="fa fa-university" aria-hidden="true"></i> Account Summary</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="information-tab" href="my-ac-personal-information" role="tab" aria-controls="information" aria-selected="false"><i class="fa fa-address-card" aria-hidden="true"></i> Personal Information</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="qualification-tab" href="my-ac-qualification" role="tab" aria-controls="qualification" aria-selected="false"><i class="fa fa-certificate" aria-hidden="true"></i> Qualification</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="uploadphoto-tab" href="my-ac-upload-photo" role="tab" aria-controls="uploadphoto" aria-selected="true"><i class="fa fa-camera" aria-hidden="false"></i> Upload Photo</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="joincourse-tab" href="my-ac-join-course" role="tab" aria-controls="joincourse" aria-selected="false" title="Add to purchase the course"><i class="fa fa-book" aria-hidden="true"></i> Join Course</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="changepassword-tab" href="my-ac-change-password" role="tab" aria-controls="changepassword" aria-selected="false"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="uploadphoto" role="tabpanel" aria-labelledby="uploadphoto-tab">
								<h5>Upload Photo</h5>								
								<div class="row">
									<div class="col-md-3">
									</div>
									<div class="col-md-6">
										<div class="card shadow">											
											<div class="card-content">
												<div class="card-body">
												
													<?php 
														$proimg = "assets/images/faces/2.jpg";
														$picarray = array();
														if(isset($_POST['photoupload'])){
															//echo $user_id;
															$target_path="uploads/";
															$user1=$_FILES['picture']['name'];
															$target_path=$target_path.basename($_FILES['picture']['name']); 
															if(move_uploaded_file($_FILES['picture']['tmp_name'],$target_path)){
																$q="select * from cpo_usermaster where iUserId='$user_id'";
																$r=runquery($q);
																$f=mysqli_fetch_array($r);
																$picture=$f['picture'];
																if($picture==""){
																	$query="update cpo_usermaster set picture='$user1' where iUserId='$user_id'";
																	runquery($query);
																}else{
																	$proimg = $target_path;

																	$picture=$f['picture'].','.$user1;
																	$q1="update cpo_usermaster set picture='$picture' where iUserId='$user_id'";
																	//echo $q1;
																	runquery($q1);
																}																
																echo "<div class='alert alert-success text-center' role='alert'>Image has been uploaded..</div>";

															 }else{
																 echo "<div class='alert alert-danger' role='alert'>There was an error uploading the file, please try again!</div>";
															}
														}else{
															$q="select * from cpo_usermaster where iUserId='$user_id'";
															$r=runquery($q);
															if(mysqli_num_rows($r) > 0){																
																$f=mysqli_fetch_array($r);
																$picture=$f['picture'];
																if($picture !== ""){	
																	$picarray = explode(',', $picture);
																	$proimg = "uploads/".end($picarray);
																}

															}															
														}	
													?>

													<form class="" name="frmex" method="post" action="my-ac-upload-photo" enctype="multipart/form-data">
													  <div class="form-group">
													  	<div class="input-group">
															<input type="file" name="picture" class="form-control" id="imgprofile" accept="image/*" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
															<button class="btn btn-primary" type="submit" id="inputGroupFileAddon04" name="photoupload">Upload</button>
														</div>
														<div class="text-center">
														  <img src="<?php echo $proimg; ?>" id="preview" class="img-preview img-thumbnail">
														</div>
													  </div>													  
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3">
									</div>
								</div>
								<div class="row">
									<?php
										foreach($picarray as $simg){
											$simg = "uploads/".$simg;
											echo "<div class='col-md-2 text-center'><img src='$simg' class='img-preview img-thumbnail'></div>";
										}
									?>									
								</div>
							</div>
						</div>							
                    </div>
                </section>
            </div>
			<?php include "footer.php"; ?>
        </div>
    </div>															
	<script>				
		$('input[type="file"]').change(function(e) {
		  var fileName = e.target.files[0].name;
		  //$("#imgprofile").val(fileName);
		  var reader = new FileReader();
		  reader.onload = function(e) {
			// get loaded data and render thumbnail.
			document.getElementById("preview").src = e.target.result;
		  };
		  // read the image file as a data URL.
		  reader.readAsDataURL(this.files[0]);
		});
	</script>
</body>

</html>