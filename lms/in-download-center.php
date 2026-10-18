<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php";
	$hub_interactive_tab = 'download';
	?>	
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
                <p class="hub-page-sub mb-0">Download hub files and switch to chat or mail using the tabs below.</p>
            </div>
            <div class="page-content">
			 <!--include "in-section-chat.php"; -->
                <section class="row">
                    <div class="col-12">
						<?php include "in-interactive-tabs.php"; ?>
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
																			$path = "../../app/newadmin/adminupload/".$rsdata['iFileId'].".".$ext;
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