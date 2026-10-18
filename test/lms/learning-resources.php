<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Learning Resources<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>Learning Resources</h4>
            </div>
            <div class="page-content">
                <section>					
					<div class="row">
						<?php 
							$sql="SELECT * FROM cpo_resources_links";
							$rID=runquery1($sql); $posticon="back";
							if(mysqli_num_rows($rID) > 0){
								while($a=mysqli_fetch_array($rID)){
									switch($a['link_name']){
										case "Maths is Fun" : $posticon="calculator"; break;
										case "Revision" : $posticon="book-half"; break;			
										case "GSCE Revision" : $posticon="journal-bookmark-fill"; break;			
										case "History" : $posticon="clock-history"; break;
									}
									?>
									<div class="col-md-6">
										<div class="card resources">
											<a href="<?php echo $a['website_link']; ?>" target="_blank">
												<div class="card-body px-3 py-4-5">
													<div class="row">
														<div class="col-md-4">
															<div class="stats-icon">
																<i class="bi bi-<?php echo $posticon; ?>"></i>
															</div>
														</div>
														<div class="col-md-8">
															<h6 class="font-extrabold" id="locationdiv"><?php echo $a['link_name']; ?></h6>
														</div>
													</div>
												</div>
											</a>
										</div>
									</div>
									<?php
								}
							}else{
								echo"No Resources Found!!";
							}
						?>
					</div>
                </section>
            </div>
			<?php include "footer.php"; ?>
        </div>
    </div>
</body>

</html>