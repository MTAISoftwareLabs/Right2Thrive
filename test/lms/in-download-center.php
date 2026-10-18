<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Document Download Center<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>Interactive</h4>
            </div>
            <div class="page-content">
				<?php include "in-section-chat.php"; ?>
                <section class="row">
                    <div class="col-12">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="download-center-tab" href="in-download-center" role="tab" aria-controls="download-center" aria-selected="true"><i class="fa fa-cloud-download" aria-hidden="false"></i> Download Center</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="book-chat-tab" href="in-book-chat" role="tab" aria-controls="book-chat" aria-selected="false"><i class="fa fa-clock-o" aria-hidden="true"></i> Book Chat</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="mail-tutors-tab" href="in-mail-tutors" role="tab" aria-controls="mail-tutors" aria-selected="false"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mail To Tutor</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="event-history-tab" href="in-event-history" role="tab" aria-controls="event-history" aria-selected="false"><i class="fa fa-history" aria-hidden="true"></i> Event History</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="download-center" role="tabpanel" aria-labelledby="download-center-tab">
								<h5>Document Download Center</h5>															
								<div class="row">
									<div class="col-md-12">
										<div class="card frm-border">											
											<div class="card-content">
												<div class="card-body">													
													<div class="table-responsive">	
														<h6>Uploaded Files by Admin</h6>
														<table class="table table-hover mb-0">
															<thead class="dark">
																<tr>
																	<th></th>
																	<th>File Name</th>
																	<th>Upload Date</th>
																</tr>
															</thead>
															<tbody>	
																<?php																
																	$sqlfiles = "select * from cpo_uploadfilesadmin where vsection='l' or vsection='b' order by vUploadDate desc";
																	$rsfiles = runquery($sqlfiles);
																	$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
																	if ( $num > 0 ){
																		foreach($rsfiles as $rsdata){
																			$ext = substr(strrchr($rsdata['vFilePath'], '.'), 1);
																			$path = "../admin/adminupload/".$rsdata['iFileId'].".".$ext;
																		?>
																			<tr>
																				<td width="40" class="text-center"><a class="show-ftype" target="_blank" href="<?php echo $path; ?>" title="Download Admin Uploaded file"><img src="<?php echo getIcon($rsdata['vFilePath']); ?>"></a></td>
																				<td><a target="_blank" href="<?php echo $path; ?>" title="Download Admin Uploaded file"><?php echo $rsdata['vFilePath']; ?></a></font></td>
																				<td><?php echo date("d-M-Y", strtotime($rsdata['vUploadDate'])); ?></td>
																			</tr>

																	<?php 	
																		}
																	}else{
																		echo "<tr><td colspan='3'><p class='font-bold text-center mt-3'>No Files Uploaded</p></td></tr>";
																	}
																?>																
															</tbody>
														</table>
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
	<script>		
		function chatnow(){
			new1=window.open("../chatnew/","","titlebar='CareerPaths Online - Chatting',height=460,width=700,scrollbars=yes,top=50,left=150");
		}
	</script>
</body>

</html>