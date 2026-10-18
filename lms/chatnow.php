<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Send WhatsApp Message - <?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>Send WhatsApp Message</h4>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
						<div class="tab-content card-header">
							<div class="tab-pane fade active show" id="sendwhatsapp" role="tabpanel" aria-labelledby="sendwhatsapp-tab">
								<div class="row">
									<div class="col-md-3"></div>
									<div class="col-md-6">
										<div class="card shadow mt-4">											
											<div class="card-content">
												<div class="card-body text-center">
													<form class="" name="FRMSENDWHATSAPP" method="post" action="">
														<fieldset class="form-group">
															<select name="phone" class="form-select" id="tutor">
                                                                <option selected>Select Tutor</option>
                                                                <?php
                                                                $sqllearner = "select vUserMobile, vUserName from cpo_usermaster where iUserType=1";
                                                                $rslearner = runquery($sqllearner);
                                                                $num = $rslearner ? mysqli_num_rows($rslearner) : 0 ;

                                                                while ($rsdata = mysqli_fetch_array($rslearner)) { ?>
                                                                    <option value="<?php echo $rsdata['vUserMobile'] ?>"><?php echo $rsdata['vUserName'];?></option>
                                                                <?php } ?>
                                                            </select>
														</fieldset>
														<fieldset class="form-group">
															<div class="input-group">
																<input type="text" name="txtcontents" class="form-control" placeholder="Type Message" required>
																<button class="btn btn-primary" type="submit" name="sendwhatsapp">Send Message</button>
															</div>
														</fieldset>
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3"></div>
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

<?php
if(isset($_POST['sendwhatsapp'])) {
    $phone = $_POST['phone'];
    $message = urlencode($_POST['txtcontents']);

    // Construct the WhatsApp URL
    $whatsapp_url = "https://wa.me/{$phone}?text={$message}";

    // Redirect to the WhatsApp URL
    header("Location: $whatsapp_url");
    exit; // Stop executing the script after redirection
}
?>
