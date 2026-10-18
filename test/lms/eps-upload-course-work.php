<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Upload Course Work<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<?php
if(isset($_GET['delete']) && $_GET['delete'] !==""){
	$id=$_GET['delete'];	
	$qry="select * from cpo_uploadfiles where iFileId=".$id;
	$rsfile=runquery($qry);
	$numrows=mysqli_num_rows($rsfile);
	if($numrows>0){
		$res_file=mysqli_fetch_array($rsfile);
		if($res_file){
			$filename=$res_file['vFilePath'];
			$userid=$res_file['iUserId'];
			$qry="delete from cpo_uploadfiles where iFileId=".$id;
			$res=runquery($qry);
			if(file_exists("./uploads/".$userid."/".$filename)){
				unlink("./uploads/".$userid."/".$filename);
			}
			$msg="File '".$filename."' deleted successully !";
		}
	}	
}
?>
<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>My E-Portfolio</h4>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
						<div class="tab-content card-header">
							<div class="tab-pane fade active show" id="uploadphoto" role="tabpanel" aria-labelledby="uploadphoto-tab">
								<div class="row">
									<div class="col-md-3">
									</div>
									<div class="col-md-6">
										<div class="card shadow">											
											<div class="card-content">
												<div class="card-body text-center">
												<h5>Upload Course Work</h5>
													<?php 
														if(isset($_POST['fileupload'])){
															if($_FILES['FLUPFILE'] !== ""){
																$ext = substr(strrchr($_FILES['FLUPFILE']['name'], '.'), 1);

																if (!(file_exists("./uploads/".$_SESSION['user_id']."/".$_FILES['FLUPFILE']['name'])))
																{
																	$sqladd = "insert into cpo_uploadfiles (iUserId,vFilePath,vUploadDate) values (".$_SESSION['user_id'].",'".$_FILES['FLUPFILE']['name']."','".date("Y-m-d")."')";
																	runquery($sqladd);
																}
																if (!file_exists("./uploads/".$_SESSION['user_id']))
																	mkdir("./uploads/".$_SESSION['user_id'],0755);
																
																$uploaddir = './uploads/'.$_SESSION['user_id'].'/';
																$uploadfile = $uploaddir.mysqli_insert_id($conn).".".$ext;

																move_uploaded_file($_FILES['FLUPFILE']['tmp_name'],$uploadfile);
																addlog(10);
																echo "<div class='alert alert-success text-center' role='alert'>Image has been uploaded..</div>";
															}else{
																echo "<div class='alert alert-danger' role='alert'>There was an error uploading the file, please try again!</div>";
															}	
														}	
													?>
													<form class="" name="FRMUPLOADFILE" method="post" action="eps-upload-course-work" enctype="multipart/form-data">
													  <div class="form-group">
													  	<div class="input-group">
															<input type="file" name="FLUPFILE" class="form-control" id="workimg" accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .swf, .gif, .jpeg, .avi, .mpeg" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
															<button class="btn btn-primary" type="submit" id="inputGroupFileAddon04" name="fileupload">Upload</button>
														</div>
														<p class="small mt-1 text-primary">Only upload <span class="text-danger">.pdf, .doc, .xls, .ppt, .swf, .gif, .jpeg, .avi, .mpeg</span> files.</p>
													  </div>													  
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3">
									</div>
								</div>
								<div class="table-responsive">
									<table class="table table-hover mb-0">
										<thead class="dark">
											<tr>
												<th colspan="2">Document Name</th>
												<th>Upload Date</th>
												<th></th>
											</tr>
										</thead>
										<tbody>											
											<?php
												if(isset($msg) && $msg !== ""){
													echo "<tr><td colspan='4'><div class='alert alert-success text-center' role='alert'>$msg</div></td></tr>";
												}
												
												$sqlfiles = "select vFilePath,vUploadDate,iFileId from cpo_uploadfiles where iUserId=".$_SESSION['user_id']." order by vUploadDate desc";
												$rsfiles = runquery($sqlfiles);
												$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
												if ( $num > 0 )
												{
													foreach($rsfiles as $file){
														$fileid = $file['iFileId'];
														$filename = $file['vFilePath'];
														$uploaddate = date("d-M-Y", strtotime($file['vUploadDate']));
														$ext = substr(strrchr($filename, '.'), 1);													   
														$path = "./uploads/".$_SESSION['user_id']."/".$fileid.".".$ext;
											?>
											<tr>
												<td width="40"><a href="<?php echo $path; ?>" class="show-ftype" target="_blank"><img src="<?php echo getIcon($filename)?>"></a></td>
												<td><a href="<?php echo $path; ?>" target="_blank"><?php echo $filename; ?></a></td>
												<td><?php echo $uploaddate; ?></td>
												<td>
													<button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-work-<?php echo $fileid; ?>">Delete</button>
													<!-- FileDelete-modal theme Modal -->
													<div class="modal fade text-left" id="delete-work-<?php echo $fileid; ?>" tabindex="-1" aria-labelledby="myModalLabel110" style="display: none;" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
															<div class="modal-content">
																<div class="modal-header bg-danger">
																	<h5 class="modal-title white" id="myModalLabel110">
																		Delete File
																	</h5>
																	<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
																		<i data-feather="x"></i>
																	</button>
																</div>
																<div class="modal-body">
																	Do you really want to Delete?
																	<p class="log-text"><i class="bi bi-exclamation-triangle"></i> You are not recover file after delete this!!</p>
																</div>
																<div class="modal-footer">
																	<a href="eps-upload-course-work?delete=<?php echo $fileid; ?>" type="button" class="btn btn-danger ml-1">
																		<span class="d-none d-sm-block">Yes</span>
																	</a>
																	<button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
																		<span class="d-none d-sm-block">No</span>
																	</button>
																</div>
															</div>
														</div>
													</div>		
												</td>
											</tr>
											<?php
													}
												}else{
													echo "<tr><td colspan='4'><p class='font-bold text-center mt-3'>NO FILE FOUND</p></td></tr>";
												}
											?>
										</tbody>
									</table>
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