<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php";
	$hub_interactive_tab = 'book';
	?>	
    <title>Book Chat Time<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>Interactive</h4>
                <p class="hub-page-sub mb-0">Book a chat slot or use the other tabs for downloads and tutor mail.</p>
            </div>
            <div class="page-content">
				<?php include "in-section-chat.php"; ?>
                <section class="row">
                    <div class="col-12">
						<?php include "in-interactive-tabs.php"; ?>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="book-chat" role="tabpanel" aria-labelledby="book-chat-tab">
								<div class="row">
									<div class="col-md-3">
									</div>
								
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
								
										</div>
									</div>
									<div class="col-md-3">
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
// 	<script>		
// 		$(document).ready(function(){
// 		  $("#tutor").change(function(){
// 			if($("#tutor").val() !== ""){
// 				$("#btnbchat").attr("disabled", false);
// 			}else{
// 				$("#btnbchat").attr("disabled", true);
// 			}
// 		  });
// 		});
		
// 		function chatnow(){
// 			new1=window.open("../chatnew/","","titlebar='CareerPaths Online - Chatting',height=460,width=700,scrollbars=yes,top=50,left=150");
// 		}
// 	</script>
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